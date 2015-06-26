<?php

use yii\bootstrap\Button;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Job */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => $model->company->name, 'url' => ['site/index', 'JobSearch[company_id]' => $model->company_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="job-info">
        <?php
        echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                'ref_no',
                'description:ntext',
                [
                    'attribute' => 'company_id',
                    'label' => Yii::t('frontend', 'Company'),
                    'format' => 'html',
                    'value' => Html::a($model->company->getLogo() ? Html::img($model->company->getLogo()) : $model->company->name, [
                        'company/view', 'id' => $model->company_id
                    ])
                ],
                [
                    'attribute' => 'job_type',
                    'value' => $model->getJobType(),
                ],
                [
                    'attribute' => 'employment_type',
                    'value' => $model->getEmploymentType(),
                ],
                [
                    'attribute' => 'job_category_id',
                    'value' => $model->jobCategory->name,
                ],
                [
                    'attribute' => 'updated_at',
                    'label' => 'Последно обновена',
                    'value' => $model->getHumanLastUpdated(),
                ],
            ],
        ]);
        ?>
    </div>

    <div class="apply-button-container">
        <?php
            echo Html::a(Yii::t('frontend', 'Apply for this position'), ['job/apply', 'id' => $model->id], [
                'class' => 'btn btn-primary',
                'id' => 'job-apply-button'
            ])
        ?>
    </div>
</div>
