<?php

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
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => 60]) ?>

            <?= $form->field($model, 'ref_no')->textInput(['maxlength' => 30]) ?>

            <?php
            echo $form->field($model, 'job_category_id')->dropDownList(
                ArrayHelper::map(JobCategory::getDropdownCategories(), 'id', 'name'),
                ['prompt' => 'Изберете']
            );
            ?>

            <?php
            echo $form->field($model, 'employment_type')->dropDownList(Job::$employmentType, [
                'prompt' => 'Изберете'
            ]);
            ?>

            <?php
            echo $form->field($model, 'job_type')->dropDownList(Job::$jobType, [
                'prompt' => 'Изберете'
            ]);
            ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 8]) ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('frontend', 'Create') : Yii::t('frontend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>