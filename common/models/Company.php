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

    public static $statuses = [
        self::STATUS_PENDING => 'Изчакваща',
        self::STATUS_APPROVED => 'Одобрена',
        self::STATUS_REJECTED => 'Отхвърлена'
    ];

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
            [['user_id', 'name', 'address', 'website'], 'required'],
            ['user_id', 'integer'],
            ['user_id', 'exist', 'targetClass' => '\common\models\User', 'targetAttribute' => 'id'],
            ['website', 'url', 'defaultScheme' => 'http'],
            [['name', 'address', 'logo_path', 'logo_base_url'], 'string', 'max' => 255],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            ['status', 'in', 'range' => array_keys(Company::$statuses)]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'name' => Yii::t('app', 'Name'),
            'address' => Yii::t('app', 'Address'),
            'description' => Yii::t('app', 'Description'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'logo_path' => Yii::t('app', 'Logo Path'),
            'logo_base_url' => Yii::t('app', 'Logo Base Url'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
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
}
