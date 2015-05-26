<?php
use common\models\Job;
use yii\helpers\Html;

/* @var $model Job */
?>
<div class="row job-offer">
    <div class="col-md-9 col-sm-8 col-xs-12">
        <div class="job-title" style="font-size: 18px">
            <?php echo Html::a(Html::encode($model->title), ['job/view', 'id' => $model->id])?>
        </div>
        <div class="row">
            <div class="col-md-5 job-category" style="font-size: 0.9em; font-style: italic; color: #333;">
                <i class="fa fa-tags"></i>
                Категория: <?=$model->jobCategory->name?>
            </div>
            <div class="col-md-3 job-type" style="font-size: 0.9em; font-style: italic; color: #333;">
                <i class="fa fa-briefcase"></i>
                Тип: <?=$model->getJobType()?>
            </div>
            <div class="col-md-4 job-employment-type" style="font-size: 0.9em; font-style: italic; color: #333;">
                <i class="fa fa-clock-o"></i>
                <?=$model->getEmploymentType()?>
            </div>
        </div>
        <div class="job-description" style="margin-top: 10px;">
            <?=Html::encode($model->getShortDescription(50))?>
        </div>
    </div>
    <div class="col-md-3">
        <div class="company-logo">
            <?php echo $model->company->logo ? Html::img($model->company->getLogo(), ['style' => 'width: 125px']) : ''; ?>
        </div>
        <div class="company-name">
            <?=$model->company->name?>
        </div>
        <div class="company-address">
            <?=$model->company->address?>
        </div>
        <div class="job-last-updated" style="font-size: 0.8em; color: #333;">
            <em>Последно обновена: <?=$model->getHumanLastUpdated()?></em>
        </div>
    </div>
</div>