<?php

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
            'id',
            'company_id',
            'job_category_id',
            'title',
            // 'description:ntext',
            // 'employment_form',
            'status',
            'created_at',
            'updated_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
