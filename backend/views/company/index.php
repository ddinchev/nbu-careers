<?php

use common\models\Company;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Companies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">
    <p>
        <?= Html::a(Yii::t('backend', 'Create Company'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'name',
            'user.email',
            'address',
            'website',
            [
                'attribute' => 'logo',
                'format' => 'html',
                'value' => function (Company $data) {
                    return $data->logo_path ? Html::img($data->getLogo()) : null;
                }
            ],
            'description:ntext',
            [
                'attribute' => 'status',
                'value' => function (Company $data) {
                    return Company::$statuses[$data->status];
                }
            ],
            'created_at',
            'updated_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
