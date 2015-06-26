<?php

use common\models\Job;
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\JobSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $topCompanies yii\data\ActiveDataProvider */

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
            <div class="top-companies panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo Yii::t('frontend', 'Top Employers') ?></h3>
                </div>
                <div class="panel-body">
                    <?php foreach ($topCompanies->getModels() as $model): ?>
                    <div class="company-row row">
                        <div class="col-xs-8 company-name">
                            <?php echo Html::a(Html::encode($model->name), ['company/view', 'id' => $model->user_id]) ?>
                        </div>
                        <div class="col-xs-4 company-logo">
                            <?php echo $model->logo ? Html::img($model->getLogo(), ['style' => 'width: 40px']) : ''; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
