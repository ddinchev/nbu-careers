<?php

namespace common\models;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "company".
 *
 * @property integer $user_id
 * @property string $name
 * @property string $address
 * @property string $description
 * @property string $latitude
 * @property string $longitude
 * @property string $logo_path
 * @property string $logo_base_url
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $user
 */
class Company extends ActiveRecord
{
    public $logo;

    public function behaviors()
    {
        return [
            'picture' => [
                'class' => UploadBehavior::className(),
                'attribute' => 'logo',
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
            ['user_id', 'exist', 'targetClass' => '\common\models\User'],
            ['website', 'url', 'defaultScheme' => 'http'],
            [['description'], 'string'],
            [['latitude', 'longitude'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'address', 'logo_path', 'logo_base_url'], 'string', 'max' => 255]
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
