<?php

use common\models\Company;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Company */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->user_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php

    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'address',
            'website',
            'user.email',
            'description:ntext',
            [
                'attribute' => 'logo',
                'format' => 'html',
                'value' => $model->getLogo() ?: null
            ],
            [
                'attribute' => 'status',
                'value' => Company::getStatuses()[$model->status]
            ],
            'created_at',
            'updated_at',
        ],
    ])

    ?>

</div>
