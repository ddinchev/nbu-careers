<?php

use common\models\Company;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CompanySearch */
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
        'filterModel' => $searchModel,
        'columns' => [
            'name',
            [
                'attribute' => 'status',
                'filter' => Company::$statuses,
                'value' => function (Company $data) {
                    return $data->getStatus();
                }
            ],
            'address',
            [
                'attribute' => 'logo',
                'format' => 'html',
                'value' => function (Company $data) {
                    return $data->logo_path ? Html::img($data->getLogo(), ['style' => 'width: 100px']) : null;
                }
            ],
            [
                'attribute' => 'created_at',
                'filter' => false,
            ],
            [
                'attribute' => 'updated_at',
                'filter' => false,
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
