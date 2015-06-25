<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\LoginForm */

$this->title = Yii::t('frontend', 'Sign in');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
    <div class="row">
        <div class="col-md-6">
            <fieldset>
                <legend><?= Html::encode($this->title) ?></legend>
                <?php echo $form->field($model, 'identity') ?>
                <?php echo $form->field($model, 'password')->passwordInput() ?>
                <?php echo $form->field($model, 'rememberMe')->checkbox() ?>
                <div class="form-group">
                    <?php echo Html::submitButton(Yii::t('frontend', 'Sign in'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            </fieldset>

            <div style="color:#333;margin:1em 0">
                <?php
                    echo Yii::t('frontend', 'If you forgot your password you can reset it <a href="{link}">here</a>', [
                        'link' => yii\helpers\Url::to(['sign-in/request-password-reset'])
                    ]);
                ?> |
                <?php
                    echo Yii::t('frontend', 'Need an account? Register as a {company-sign-up-link} or {user-sign-up-link}.', [
                        'company-sign-up-link' => Html::a(Yii::t('frontend', 'employer'), ['company-sign-up']),
                        'user-sign-up-link' => Html::a(Yii::t('frontend', 'student'), ['user-sign-up']),
                    ]);
                ?>
            </div>
        </div>
        <div class="col-md-6">
            <fieldset>
                <legend><?php echo Yii::t('frontend', 'Or login using (students only):') ?></legend>
                <div class="form-group">
                    <?php echo yii\authclient\widgets\AuthChoice::widget([
                        'baseAuthUrl' => ['/user/sign-in/oauth']
                    ]) ?>
                </div>
            </fieldset>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
