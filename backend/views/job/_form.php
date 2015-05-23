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

    <?= $form->field($model, 'title')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'ref_no')->textInput(['maxlength' => 30]) ?>

    <?php
    echo $form->field($model, 'job_category_id')->dropDownList(
        ArrayHelper::map(JobCategory::getDropdownCategories(), 'id', 'name'),
        ['prompt' => 'Изберете']
    );
    ?>

    <?php
    echo $form->field($model, 'employment_type')->dropDownList(Job::$employmentTypes, [
        'prompt' => 'Изберете'
    ]);
    ?>

    <?php
    echo $form->field($model, 'job_type')->dropDownList(Job::$jobTypes, [
        'prompt' => 'Изберете'
    ]);
    ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 8]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
