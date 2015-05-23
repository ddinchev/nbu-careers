<?php

use common\models\Job;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Jobs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-index">
    <p>
        <?= Html::a(Yii::t('backend', 'Create Job'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'company_id',
                'value' => function (Job $data) {
                    return $data->company->name;
                }
            ],
            [
                'attribute' => 'job_type',
                'value' => function (Job $data) {
                    return Job::$jobTypes[$data->job_type];
                }
            ],
            [
                'attribute' => 'employment_type',
                'value' => function (Job $data) {
                    return Job::$employmentTypes[$data->employment_type];
                }
            ],
            [
                'attribute' => 'job_category_id',
                'value' => function (Job $data) {
                    return $data->jobCategory->name;
                }
            ],
            'title',
            [
                'attribute' => 'description',
                'value' => function (Job $data) {
                    return $data->getShortDescription();
                }
            ],
            [
                'attribute' => 'status',
                'value' => function (Job $data) {
                    return Job::$statuses[$data->status];
                }
            ],
            'created_at',
            'updated_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
