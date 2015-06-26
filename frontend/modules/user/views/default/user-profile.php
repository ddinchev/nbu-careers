<?php

use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserProfile */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('frontend', 'Profile')
?>

<div class="user-profile-form">
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <fieldset>
                <legend><?php echo Yii::t('frontend', 'Student Profile') ?></legend>

                <?php echo $form->field($model->getModel('profile'), 'firstname')->textInput(['maxlength' => 255]) ?>

                <?php echo $form->field($model->getModel('profile'), 'middlename')->textInput(['maxlength' => 255]) ?>

                <?php echo $form->field($model->getModel('profile'), 'lastname')->textInput(['maxlength' => 255]) ?>

                <?php
                    echo $form->field($model->getModel('profile'), 'gender')->dropDownlist([
                        \common\models\UserProfile::GENDER_FEMALE => Yii::t('frontend', 'Female'),
                        \common\models\UserProfile::GENDER_MALE => Yii::t('frontend', 'Male')
                    ])
                ?>

                <?php
                    echo $form->field($model->getModel('profile'), 'picture')->widget(Upload::classname(), [
                        'url' => ['avatar-upload']
                    ])
                ?>
            </fieldset>
        </div>

        <div class="col-md-6">
            <fieldset>
                <legend><?php echo Yii::t('frontend', 'Account Settings') ?></legend>
                <?php echo $form->field($model->getModel('account'), 'locale')->dropDownlist(Yii::$app->params['availableLocales']) ?>

                <?php echo $form->field($model->getModel('account'), 'username') ?>

                <?php echo $form->field($model->getModel('account'), 'password')->passwordInput() ?>

                <?php echo $form->field($model->getModel('account'), 'password_confirm')->passwordInput() ?>
            </fieldset>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('frontend', 'Update'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
