<?php

use common\models\Company;
use common\models\Job;
use common\models\JobCategory;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\JobSearch */
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
                'attribute' => 'company_id',
                'filter' => ArrayHelper::map(Company::find()->all(), 'user_id', 'name'),
                'value' => function (Job $data) {
                    return $data->company->name;
                }
            ],
            'ref_no',
            [
                'attribute' => 'job_type',
                'filter' => Job::$jobTypes,
                'value' => function (Job $data) {
                    return $data->getJobType();
                }
            ],
            [
                'attribute' => 'employment_type',
                'filter' => Job::$employmentTypes,
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
                'attribute' => 'description',
                'value' => function (Job $data) {
                    return $data->getShortDescription();
                }
            ],
            [
                'attribute' => 'status',
                'filter' => Job::$statuses,
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
