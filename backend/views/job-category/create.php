<?php

/* @var $this yii\web\View */
/* @var $model common\models\JobCategory */

$this->title = Yii::t('backend', 'Create Job Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Job Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-category-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
