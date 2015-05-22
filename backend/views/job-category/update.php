<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\JobCategory */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Job Category',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Job Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="job-category-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
