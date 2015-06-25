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

    <div class="row">
        <div class="col-md-6">
            <fieldset>
                <legend><?=Yii::t('frontend', 'Login Information')?></legend>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
            </fieldset>
            <fieldset>
                <legend><?=Yii::t('frontend', 'Company information')?></legend>
                <?= $form->field($model, 'name') ?>
                <?= $form->field($model, 'website') ?>
                <?= $form->field($model, 'address') ?>
            </fieldset>
            <fieldset>
                <legend><?=Yii::t('frontend', 'Contact information')?></legend>
                <?= $form->field($model, 'contact_name') ?>
                <?= $form->field($model, 'contact_email') ?>
            </fieldset>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?php
                    echo Html::submitButton(Yii::t('frontend', 'Sign up'), [
                        'class' => 'btn btn-primary',
                        'name' => 'sign-up-button'
                    ]);
                ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
