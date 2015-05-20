<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\SignupForm */

$this->title = Yii::t('frontend', 'Company sign up');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-company-sign-up">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['id' => 'form-company-sign-up']); ?>

    <fieldset>
        <legend><?=Yii::t('frontend', 'Login Information')?></legend>

        <div class="row">
            <div class="col-md-5">
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
            </div>
        </div>
    </fieldset>

    <fieldset>
        <legend><?=Yii::t('frontend', 'Company information')?></legend>
        <div class="row">
            <div class="col-md-5">
                <?= $form->field($model, 'name') ?>
                <?= $form->field($model, 'website') ?>
                <?= $form->field($model, 'address') ?>
            </div>
        </div>
    </fieldset>

    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <?= Html::submitButton(Yii::t('frontend', 'Sign up'), ['class' => 'btn btn-primary', 'name' => 'sign-up-button']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
