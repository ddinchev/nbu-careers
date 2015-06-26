<?php

use common\models\Company;
use common\models\Job;
use common\models\JobCategory;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Job */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="job-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company_id')->dropDownList(ArrayHelper::map(Company::find()->all(), 'user_id', 'name')) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'ref_no')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'job_category_id')->dropDownList(ArrayHelper::map(JobCategory::getDropdownCategories(), 'id', 'name')) ?>

    <?= $form->field($model, 'employment_type')->dropDownList(Job::getEmploymentTypes()) ?>

    <?= $form->field($model, 'job_type')->dropDownList(Job::getJobTypes()) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 8]) ?>

    <?= $form->field($model, 'published')->checkbox() ?>

    <?= $form->field($model, 'status')->dropDownList(Job::getStatuses()) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
