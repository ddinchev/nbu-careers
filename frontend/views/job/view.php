<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Job */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Jobs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('frontend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('frontend', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('frontend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php

    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'ref_no',
            [
                'attribute' => 'company_id',
                'value' => $model->company->name,
            ],
            [
                'attribute' => 'job_type',
                'value' => $model->getJobType(),
            ],
            [
                'attribute' => 'employment_type',
                'value' => $model->getEmploymentType(),
            ],
            [
                'attribute' => 'job_category_id',
                'value' => $model->jobCategory->name,
            ],
            'description:ntext',
            [
                'attribute' => 'status',
                'value' => $model->getStatus(),
            ],
        ],
    ]);

    ?>
</div>
