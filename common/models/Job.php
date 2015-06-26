<?php

namespace common\models;

use Carbon\Carbon;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\StringHelper;

/**
 * This is the model class for table "job".
 *
 * @property integer $id
 * @property integer $company_id
 * @property integer $job_category_id
 * @property integer $job_type
 * @property integer $employment_type
 * @property string $title
 * @property string $ref_no
 * @property string $description
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property JobCategory $jobCategory
 * @property Company $company
 */
class Job extends ActiveRecord
{
    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;
    const STATUS_REJECTED = 2;

    const EMPLOYMENT_TYPE_PART_TIME = 1;
    const EMPLOYMENT_TYPE_FULL_TIME = 2;

    const JOB_TYPE_INTERNSHIP = 1;
    const JOB_TYPE_SEASONAL = 2;
    const JOB_TYPE_REGULAR = 3;
    const JOB_TYPE_PROJECT = 4;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'job_category_id', 'job_type', 'employment_type', 'title', 'ref_no', 'description'], 'required'],
            [['company_id', 'job_category_id', 'employment_type', 'job_type'], 'integer'],
            ['company_id', 'exist', 'targetClass' => Company::className(), 'targetAttribute' => 'user_id'],
            ['job_category_id', 'exist', 'targetClass' => JobCategory::className(), 'targetAttribute' => 'id'],
            ['employment_type', 'in', 'range' => array_keys(self::getEmploymentTypes())],
            ['job_type', 'in', 'range' => array_keys(self::getJobTypes())],
            ['title', 'string', 'max' => 60],
            ['ref_no', 'string', 'max' => 20],
            [['description'], 'string', 'min' => 160],
            ['status', 'in', 'range' => array_keys(Job::getStatuses()), 'when' => function() {
                return Yii::$app->user->can('manager');
            }]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'ref_no' => Yii::t('common', 'Ref.No'),
            'company_id' => Yii::t('common', 'Company ID'),
            'job_category_id' => Yii::t('common', 'Category'),
            'employment_type' => Yii::t('common', 'Employment Type'),
            'job_type' => Yii::t('common', 'Job Type'),
            'title' => Yii::t('common', 'Title'),
            'description' => Yii::t('common', 'Description'),
            'status' => Yii::t('common', 'Status'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
        ];
    }

    public static function getStatuses()
    {
        return [
            self::STATUS_PENDING => Yii::t('common', 'Pending'), // 'Изчакваща',
            self::STATUS_APPROVED => Yii::t('common', 'Approved'), // 'Одобрена',
            self::STATUS_REJECTED => Yii::t('common', 'Rejected'), // 'Отхвърлена'
        ];
    }

    public static function getEmploymentTypes()
    {
        return [
            self::EMPLOYMENT_TYPE_FULL_TIME => Yii::t('common', 'Full-Time'), // 'Пълен работен ден',
            self::EMPLOYMENT_TYPE_PART_TIME => Yii::t('common', 'Part-Time'), // 'Половин работен ден'
        ];
    }

    public static function getJobTypes()
    {
        return [
            self::JOB_TYPE_INTERNSHIP => Yii::t('common', 'Internship'), // 'Стаж',
            self::JOB_TYPE_SEASONAL => Yii::t('common', 'Seasonal'), // 'Сезонна',
            self::JOB_TYPE_REGULAR => Yii::t('common', 'Permanent'), // 'Постоянна',
            self::JOB_TYPE_PROJECT => Yii::t('common', 'Project'), // 'Еднократен проект',
        ];
    }

    /**
     * Returns a model prepared for insertion.
     * @return Job
     */
    public static function getInsertModel() {
        $model = new Job();
        // we assume that the logged-in user is a company, otherwise
        // how did he access the "create job offer" page?
        $model->company_id = Yii::$app->user->id;
        return $model;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobCategory()
    {
        return $this->hasOne(JobCategory::className(), ['id' => 'job_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['user_id' => 'company_id']);
    }

    /**
     * @inheritdoc
     * @return JobQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JobQuery(get_called_class());
    }

    public function getShortDescription($words = 50)
    {
        return trim(preg_replace('/\s\s+/', ' ', StringHelper::truncateWords($this->description, $words)));
    }

    /**
     * return string
     */
    public function getStatus()
    {
        return self::getStatuses()[$this->status];
    }

    /**
     * @return null|string
     */
    public function getJobType()
    {
        return $this->job_type ? self::getJobTypes()[$this->job_type] : null;
    }

    public function getEmploymentType()
    {
        return $this->employment_type ? self::getEmploymentTypes()[$this->employment_type] : null;
    }

    public function getHumanLastUpdated()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->updated_at)->diffForHumans();
    }
}
