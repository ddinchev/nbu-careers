<?php

namespace common\models;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "company".
 *
 * @property integer $user_id
 * @property string $name
 * @property string $address
 * @property string $website
 * @property string $description
 * @property string $contact_name
 * @property string $contact_email
 * @property string $latitude
 * @property string $longitude
 * @property string $logo_name
 * @property string $logo_size
 * @property string $logo_path
 * @property string $logo_base_url
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $user
 */
class Company extends ActiveRecord
{
    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;
    const STATUS_REJECTED = 2;

    public $logo;

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'value' => new Expression('NOW()'),
            ],
            'logo' => [
                'class' => UploadBehavior::className(),
                'attribute' => 'logo',
                'nameAttribute' => 'logo_name',
                'sizeAttribute' => 'logo_size',
                'pathAttribute' => 'logo_path',
                'baseUrlAttribute' => 'logo_base_url'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'name', 'address', 'website', 'contact_name', 'contact_email'], 'filter', 'filter' => 'trim'],
            [['user_id', 'name', 'address', 'website', 'contact_name', 'contact_email'], 'required'],
            ['user_id', 'integer'],
            ['user_id', 'exist', 'targetClass' => '\common\models\User', 'targetAttribute' => 'id'],
            ['website', 'url', 'defaultScheme' => 'http'],
            [['name', 'address', 'logo_path', 'logo_base_url'], 'string', 'max' => 255],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            ['logo', 'safe'],
            ['status', 'in', 'range' => array_keys(Company::getStatuses()), 'when' => function() {
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
            'user_id' => Yii::t('common', 'User ID'),
            'name' => Yii::t('common', 'Name'),
            'address' => Yii::t('common', 'Address'),
            'description' => Yii::t('common', 'Description'),
            'contact_name' => Yii::t('common', 'Contact name'),
            'contact_email' => Yii::t('common', 'Contact email'),
            'latitude' => Yii::t('common', 'Latitude'),
            'longitude' => Yii::t('common', 'Longitude'),
            'logo_path' => Yii::t('common', 'Logo Path'),
            'logo_base_url' => Yii::t('common', 'Logo Base Url'),
            'status' => Yii::t('common', 'Status'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
        ];
    }

    public function attributeHints()
    {
        return [
            'logo' => Yii::t('common', 'For best results upload a 2:1 logo image. It will be cropped otherwise.'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return CompanyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CompanyQuery(get_called_class());
    }

    /**
     * @return false|string
     */
    public function getLogo() {
        return $this->logo_path
            ? Yii::getAlias($this->logo_base_url . '/' . $this->logo_path)
            : false;
    }

    /**
     * return string
     */
    public function getStatus()
    {
        return self::getStatuses()[$this->status];
    }

    public static function getStatuses()
    {
        return [
            self::STATUS_PENDING => Yii::t('common', 'Pending'),
            self::STATUS_APPROVED => Yii::t('common', 'Approved'),
            self::STATUS_REJECTED => Yii::t('common', 'Rejected'),
        ];
    }
}
