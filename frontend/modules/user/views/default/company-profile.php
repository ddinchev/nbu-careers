<?php

use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Company */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('frontend', 'Profile')
?>

<div class="company-profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-5">

            <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'website')->textInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'address')->textInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 8]) ?>

            <?= $form->field($model, 'logo')->widget(Upload::classname(), [
                'url' => ['logo-upload']
            ]) ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('frontend', 'Update'), ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
