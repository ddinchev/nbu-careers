<?php

use common\models\Job;
use common\models\JobCategory;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\JobSearch */
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
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'company_name',
                'value' => function (Job $data) {
                    return $data->company->name;
                }
            ],
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
                'attribute' => 'created_at',
                'filter' => false,
            ],
            [
                'attribute' => 'updated_at',
                'filter' => false,
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
