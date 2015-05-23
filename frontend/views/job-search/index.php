<?php

use common\models\Job;
use frontend\models\JobSearch;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\JobSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = sprintf('Търсете сред %d предложения подходящи за студенти', $dataProvider->count);
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
            'description:ntext',
            // 'status',
            // 'created_at:datetime',
        ],
    ]);

    ?>

</div>
