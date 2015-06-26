<?php

use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Company */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('frontend', 'Company Profile');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="company-profile-form">
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <fieldset>
                <legend><?php echo Yii::t('frontend', 'Company Profile') ?></legend>
                <?php echo $form->field($model->getModel('company'), 'name')->textInput(['maxlength' => 255]) ?>

                <?php echo $form->field($model->getModel('company'), 'website')->textInput(['maxlength' => 255]) ?>

                <?php echo $form->field($model->getModel('company'), 'address')->textInput(['maxlength' => 255]) ?>

                <?php echo $form->field($model->getModel('company'), 'contact_name')->textInput(['maxlength' => 255]) ?>

                <?php echo $form->field($model->getModel('company'), 'contact_email')->textInput(['maxlength' => 255]) ?>

                <?php echo $form->field($model->getModel('company'), 'description')->textarea(['rows' => 8]) ?>

                <?php
                    echo $form->field($model->getModel('company'), 'logo')->widget(Upload::classname(), [
                        'url' => ['logo-upload']
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
