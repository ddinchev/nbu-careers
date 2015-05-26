<?php

use common\models\Job;
use yii\widgets\LinkSorter;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\JobSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = sprintf('Търсете сред %d предложения подходящи за студенти', Job::find()->searchable()->count());
?>
<div class="job-index">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="col-md-9 job-offers-column">
        <?php
        echo ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item'],
            'layout' => "{items}\n{pager}",
            'itemView' => function ($model, $key, $index, $widget) {
                return $this->render('_view', ['model' => $model]);
            },
        ]);
        ?>
    </div>
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Топ компании</h3>
            </div>
            <div class="panel-body">
                <?php /* списък с компании по брой обяви */ ?>
            </div>
        </div>
    </div>
</div>
