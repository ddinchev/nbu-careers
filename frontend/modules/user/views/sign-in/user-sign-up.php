<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\SignUpForm */

$this->title = Yii::t('frontend', 'User sign up');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-user-sign-up">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin(['id' => 'form-sign-up']); ?>

    <div class="row">
        <div class="col-md-6">
            <fieldset>
                <legend><?=Yii::t('frontend', 'Login Information')?></legend>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
            </fieldset>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('frontend', 'Sign up'), ['class' => 'btn btn-primary', 'name' => 'sign-up-button']) ?>
            </div>
        </div>
        <div class="col-md-6">
            <fieldset>
                <legend><?php echo Yii::t('frontend', 'Or sign up with')  ?></legend>
                <div class="form-group">
                    <?= yii\authclient\widgets\AuthChoice::widget([
                        'baseAuthUrl' => ['/user/sign-in/oauth']
                    ]) ?>
                </div>
            </fieldset>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
