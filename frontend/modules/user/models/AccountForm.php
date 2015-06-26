<?php

namespace frontend\modules\user\models;

use common\models\User;
use common\models\UserProfile;
use Yii;
use yii\base\Model;

/**
 * Account form
 */
class AccountForm extends Model
{
    public $locale;
    public $username;
    public $password;
    public $password_confirm;

    /**
     * @var User
     */
    private $user;

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
        $this->locale = $user->locale;
        $this->username = $user->username;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique',
                'targetClass' => '\common\models\User',
                'message' => Yii::t('frontend', 'This username has already been taken.'),
                'filter' => function ($query) {
                    $query->andWhere(['not', ['id' => Yii::$app->user->getId()]]);
                }
            ],
            ['username', 'string', 'min' => 1, 'max' => 255],
            ['locale', 'default', 'value' => Yii::$app->language],
            ['locale', 'in', 'range' => array_keys(Yii::$app->params['availableLocales'])],
            ['password', 'string'],
            [['password_confirm'], 'compare', 'compareAttribute' => 'password'],

        ];
    }

    public function attributeLabels()
    {
        return [
            'locale' => Yii::t('common', 'Locale'),
            'username' => Yii::t('frontend', 'Username'),
            'password' => Yii::t('frontend', 'Password'),
            'password_confirm' => Yii::t('frontend', 'Confirm Password')
        ];
    }

    public function save()
    {
        $this->user->locale = $this->locale;
        $this->user->username = $this->username;
        if ($this->password) {
            $this->user->setPassword($this->password);
        }
        return $this->user->save();
    }
}
