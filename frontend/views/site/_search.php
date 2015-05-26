<?php

use common\models\Job;
use common\models\JobCategory;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\JobSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="job-search">
    <?php $form = ActiveForm::begin(['action' => ['index'], 'method' => 'get', ]); ?>
    <div class="job-search-title">
        <h2><?= Html::encode($this->title) ?></h2>
    </div>
    <fieldset>
        <div class="row row-centered">
            <div class="col-md-4 col-centered">
                <?= $form->field($model, 'keywords') ?>
            </div>
            <div class="col-md-3 col-centered">
                <?php
                echo $form->field($model, 'job_category_id')->dropDownList(
                    ArrayHelper::map(JobCategory::getDropdownCategories(), 'id', 'name'),
                    ['prompt' => 'Изберете']
                );
                ?>
            </div>
            <div class="col-md-2 col-centered">
                <?php
                echo $form->field($model, 'job_type')->dropDownList(Job::$jobTypes, [
                    'prompt' => 'Изберете'
                ]);
                ?>
            </div>
            <div class="col-md-2 col-centered">
                <?php
                echo $form->field($model, 'employment_type')->dropDownList(Job::$employmentTypes, [
                    'prompt' => 'Изберете'
                ]);
                ?>
            </div>
            <div class="col-md-1 col-centered">
                <div class="row">
                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('frontend', 'Search'), ['class' => 'btn btn-primary btn-search']) ?>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
    <?php ActiveForm::end(); ?>
</div>
