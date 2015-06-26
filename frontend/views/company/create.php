<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Job */

$this->title = Yii::t('frontend', 'Create a job offer');
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'My offers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
