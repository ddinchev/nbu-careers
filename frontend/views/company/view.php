<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model common\models\Company */

$this->title = Yii::t('frontend', 'Job offers by {company-name}', ['company-name' => $model->name]);
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="company-view-page">
    <div class="company-page-title">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="row">
        <div class="col-md-9">
            <?php
            echo ListView::widget([
                'dataProvider' => $model->getPublicJobOffers(),
                'itemOptions' => ['class' => 'item'],
                'layout' => "{items}\n{pager}",
                'itemView' => function ($model, $key, $index, $widget) {
                    return $this->render('_job', ['model' => $model]);
                },
            ]);
            ?>
        </div>

        <div class="col-md-3">
            <div class="company-logo">
                <?php echo $model->logo ? Html::img($model->getLogo(), ['style' => 'width: 125px']) : ''; ?>
            </div>
            <div class="company-name">
                <?php echo $model->name ?>
            </div>
            <?php if ($model->website): ?>
            <div class="company-website">
                <?php echo Html::a(parse_url($model->website, PHP_URL_HOST), $model->website, ['target' => '_blank']); ?>
            </div>
            <?php endif; ?>
            <div class="company-address">
                <?php echo Html::encode($model->address) ?>
            </div>
            <?php if ($model->description): ?>
            <div class="company-description">
                <?php echo Html::encode($model->description); ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
