<?php

use Carbon\Carbon;
use common\models\Job;
use frontend\models\JobSearch;
use yii\grid\GridView;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\JobSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = sprintf('Търсете сред %d предложения подходящи за студенти', Job::find()->searchable()->count());
?>
<div class="job-index">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        // 'showHeader' => false,
        'columns' => [
            [
                'attribute' => 'company_id',
                'value' => function (JobSearch $data) {
                    return $data->company->name;
                }
            ],
            [
                'attribute' => 'job_category_id',
                'value' => function (JobSearch $data) {
                    return $data->jobCategory->name;
                }
            ],
            [
                'attribute' => 'employment_type',
                'value' => function (JobSearch $data) {
                    return Job::$employmentType[$data->employment_type];
                }
            ],
            [
                'attribute' => 'job_type',
                'value' => function (JobSearch $data) {
                    return Job::$jobType[$data->job_type];
                }
            ],
            'title',
            [
                'attribute' => 'description',
                'format' => 'ntext',
                'value' => function (JobSearch $data) {
                    return trim(preg_replace('/\s\s+/', ' ', StringHelper::truncateWords($data->description, 50)));
                }
            ],
            [
                'attribute' => 'created_at',
                'value' => function (JobSearch $data) {
                    return Carbon::createFromFormat('Y-m-d H:i:s', $data->updated_at)->diffForHumans();
                }
            ]
        ],
    ]);

    ?>

</div>
