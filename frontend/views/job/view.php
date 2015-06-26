<?php

use common\models\Job;
use yii\bootstrap\Button;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Job */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => $model->company->name, 'url' => ['company/view', 'id' => $model->company_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if ($model->company_id == Yii::$app->user->id): // TODO: Use RBAC ?>
    <p>
        <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php endif; ?>

    <div class="job-info">
        <?php
        echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                'ref_no',
                'description:ntext',
                [
                    'attribute' => 'company_id',
                    'label' => Yii::t('frontend', 'Company'),
                    'format' => 'html',
                    'value' => Html::a($model->company->getLogo() ? Html::img($model->company->getLogo()) : $model->company->name, [
                        'company/view', 'id' => $model->company_id
                    ])
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
                'company.contact_name',
                'company.contact_email',
                [
                    'attribute' => 'published',
                    'value' => $model->published ? Yii::t('frontend', 'Yes') : Yii::t('frontend', 'No'),
                    'visible' => $model->company_id == Yii::$app->user->id // TODO: RBAC
                ],
                [
                    'attribute' => 'status',
                    'value' => Job::getStatuses()[$model->status],
                    'visible' => $model->company_id == Yii::$app->user->id // TODO: RBAC
                ],
                [
                    'attribute' => 'updated_at',
                    'label' => 'Последно обновена',
                    'value' => $model->getHumanLastUpdated(),
                ],
            ],
        ]);
        ?>
    </div>

    <?php if (Yii::$app->user->can('user')) { ?>
        <div class="apply-button-container">
            <?php
                echo Html::a(Yii::t('frontend', 'Apply for this position'), ['job/apply', 'id' => $model->id], [
                    'class' => 'btn btn-primary',
                    'id' => 'job-apply-button'
                ])
            ?>
        </div>
    <?php } else if ($model->company_id != Yii::$app->user->id) { // TODO: RBAC ?>
        <div class="container">
            <div class="col-md-4 col-md-offset-4">
                <?php echo Yii::t('frontend', 'Register and sign in as a student to apply for this offer.'); ?>
            </div>
        </div>
    <?php } ?>
</div>
