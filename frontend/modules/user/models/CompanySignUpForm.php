<?php

namespace frontend\modules\user\models;

use common\models\User;
use Yii;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

class CompanySignUpForm extends SignUpForm
{
    public $name;
    public $website;
    public $address;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['name', 'website', 'address'], 'filter', 'filter' => 'trim'],
            [['name', 'website', 'address'], 'required'],
            ['name', 'string', 'min' => 4, 'max' => 255],
            ['website', 'url', 'defaultScheme' => 'http'],
            ['name', 'unique',
                'targetClass' => '\common\models\Company',
                'message' => Yii::t('frontend', 'Company with this name already exists.')
            ],
            ['website', 'unique',
                'targetClass' => '\common\models\Company',
                'message' => Yii::t('frontend', 'Company with this website already exists.')
            ]
        ]);
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::rules(), [
            'name' => Yii::t('frontend', 'Name'),
            'website' => Yii::t('frontend', 'Website'),
            'address' => Yii::t('frontend', 'Address'),
        ]);
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signUp()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);

            $transaction = Yii::$app->db->beginTransaction();
            try {
                $user->save();
                $user->afterCompanySignUp([
                    'name' => $this->name,
                    'website' => $this->website,
                    'address' => $this->address
                ]);
                $transaction->commit();
                return $user;
            } catch(Exception $e) {
                $transaction->rollBack();
            }
        }

        return null;
    }
}