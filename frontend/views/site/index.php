<?php

use common\models\Job;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\JobSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frontend', 'Search {job-offers-count} offers suitable for students.', [
    'job-offers-count' => Job::find()->searchable()->count()
]);
?>
<div class="job-index">

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row">
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
                    <h3 class="panel-title"><?php echo Yii::t('frontend', 'Top Employers') ?></h3>
                </div>
                <div class="panel-body">
                    <?php /* списък с компании по брой обяви */ ?>
                </div>
            </div>
        </div>
    </div>
</div>
