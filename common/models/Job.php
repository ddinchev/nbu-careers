<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

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

    public static $status = [
        self::STATUS_PENDING => 'Изчакваща',
        self::STATUS_APPROVED => 'Одобрена',
        self::STATUS_REJECTED => 'Отхвърлена'
    ];

    const EMPLOYMENT_TYPE_PART_TIME = 1;
    const EMPLOYMENT_TYPE_FULL_TIME = 2;

    public static $employmentType = [
        self::EMPLOYMENT_TYPE_FULL_TIME => 'Пълен работен ден',
        self::EMPLOYMENT_TYPE_PART_TIME => 'Половин работен ден'
    ];

    const JOB_TYPE_INTERNSHIP = 1;
    const JOB_TYPE_SEASONAL = 2;
    const JOB_TYPE_REGULAR = 3;
    const JOB_TYPE_PROJECT = 4;

    public static $jobType = [
        self::JOB_TYPE_INTERNSHIP => 'Стаж',
        self::JOB_TYPE_SEASONAL => 'Сезонна',
        self::JOB_TYPE_REGULAR => 'Постоянна',
        self::JOB_TYPE_PROJECT => 'Еднократен проект',
    ];

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
            ['employment_type', 'in', 'range' => array_keys(self::$employmentType)],
            ['job_type', 'in', 'range' => array_keys(self::$jobType)],
            ['title', 'string', 'max' => 60],
            ['ref_no', 'string', 'max' => 20],
            [['description'], 'string', 'min' => 160],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ref_no' => Yii::t('app', 'Ref.No'),
            'company_id' => Yii::t('app', 'Company ID'),
            'job_category_id' => Yii::t('app', 'Category'),
            'employment_type' => Yii::t('app', 'Employment Type'),
            'job_type' => Yii::t('app', 'Job Type'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
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
}
