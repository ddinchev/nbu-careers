<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\JobCategory */

$this->title = Yii::t('backend', 'Create Job Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Job Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
