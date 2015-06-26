<?php

use common\models\Company;
use common\models\Job;
use common\models\JobCategory;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model Company */

$this->title = Yii::t('frontend', 'Dashboard');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('frontend', 'Create Job'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $model->getJobsDataProvider(),
        'columns' => [
            'ref_no',
            [
                'attribute' => 'job_type',
                'filter' => Job::getJobTypes(),
                'value' => function (Job $data) {
                    return $data->getJobType();
                }
            ],
            [
                'attribute' => 'employment_type',
                'filter' => Job::getEmploymentTypes(),
                'value' => function (Job $data) {
                    return $data->getEmploymentType();
                }
            ],
            [
                'attribute' => 'job_category_id',
                'filter' => ArrayHelper::map(JobCategory::find()->all(), 'id', 'name'),
                'value' => function (Job $data) {
                    return $data->jobCategory->name;
                }
            ],
            'title',
            [
                'attribute' => 'status',
                'filter' => Job::getStatuses(),
                'value' => function (Job $data) {
                    return $data->getStatus();
                }
            ],
            [
                'attribute' => 'published',
                'value' => function (Job $data) {
                    return $data->published ? Yii::t('frontend', 'Published') : Yii::t('frontend', 'Unpublished');
                }
            ],
            [
                'attribute' => 'created_at',
                'filter' => false,
            ],
            [
                'attribute' => 'updated_at',
                'filter' => false,
            ],
            [
                'class' => 'yii\grid\ActionColumn'
            ],
        ],
    ]); ?>

</div>
