<?php
use common\models\Job;
use yii\helpers\Html;

/* @var $model Job */
?>
<div class="job-offer">
    <div class="job-title" style="font-size: 18px">
        <?php echo Html::a(Html::encode($model->title), ['job/view', 'id' => $model->id]) ?>
    </div>
    <div class="row">
        <div class="col-md-5 job-category" style="font-size: 0.9em; font-style: italic; color: #333;">
            <i class="fa fa-tags"></i>
            <?php echo Yii::t('frontend', 'Category') ?>
            : <?= Html::a($model->jobCategory->name, ['site/index', 'JobSearch[job_category_id]' => $model->job_category_id]) ?>
        </div>
        <div class="col-md-3 job-type" style="font-size: 0.9em; font-style: italic; color: #333;">
            <i class="fa fa-briefcase"></i>
            <?php echo Yii::t('frontend', 'Job Type') ?>: <?= Html::a($model->getJobType(), ['site/index', 'JobSearch[job_type]' => $model->job_type]) ?>
        </div>
        <div class="col-md-4 job-employment-type" style="font-size: 0.9em; font-style: italic; color: #333;">
            <i class="fa fa-clock-o"></i>
            <?php echo Yii::t('frontend', 'Employment') ?>: <?= Html::a($model->getEmploymentType(), ['site/index', 'JobSearch[employment_type]' => $model->employment_type]) ?>
        </div>
    </div>
    <div class="job-description" style="margin-top: 10px;">
        <?= Html::encode($model->getShortDescription(50)) ?>
    </div>
    <div class="job-last-updated">
        <em><?php echo Yii::t('frontend', 'Last updated')?>: <?= $model->getHumanLastUpdated() ?></em>
    </div>
</div>