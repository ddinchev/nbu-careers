<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

/* @var $this \yii\web\View */
/* @var $content string */

\frontend\assets\FrontendAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?= Html::csrfMetaTags() ?>
</head>
<body>

<?php $this->beginBody() ?>
<div class="wrap container">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
        /* 'innerContainerOptions' => [
            'class' => 'container-fluid'
        ]*/
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => Yii::t('frontend', 'Home'), 'url' => ['/site/index']],
            ['label' => Yii::t('frontend', 'Articles'), 'url' => ['/article/index']],
            ['label' => Yii::t('frontend', 'Contact'), 'url' => ['/site/contact']],
            ['label' => Yii::t('frontend', 'About'), 'url' => ['/page/view', 'slug' => 'about']],
            // За студенти
            [
                'label' => 'За студенти',
                'visible' => Yii::$app->user->isGuest,
                'items' => [
                    ['label' => 'Вход', 'url' => ['/user/sign-in/login']],
                    ['label' => 'Регистрация за студенти', 'url' => ['/user/sign-in/user-sign-up']],
                ]
            ],
            // За работодатели
            [
                'label' => 'Работодатели',
                'visible' => Yii::$app->user->isGuest,
                'items' => [
                    ['label' => 'Вход', 'url' => ['/user/sign-in/login']],
                    ['label' => 'Регистрация за работодатели', 'url' => ['/user/sign-in/company-sign-up']],
                ]
            ],
            [
                'label' => Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->getPublicIdentity(),
                'visible' => !Yii::$app->user->isGuest,
                'items' => [
                    [
                        'label' => Yii::t('frontend', 'Account'),
                        'url' => ['/user/default/index'],
                    ],
                    [
                        'label' => "Фирмен профил",
                        'url' => ['/user/default/company-profile'],
                        'visible' => Yii::$app->user->can('company'),
                    ],
                    [
                        'label' => "Мои обяви",
                        'url' => ['/company/index', 'id' => Yii::$app->user->id],
                        'visible' => Yii::$app->user->can('company'),
                    ],
                    [
                        'label' => "Добави обява",
                        'url' => ['/company/create'],
                        'visible' => Yii::$app->user->can('company'),
                    ],
                    [
                        'label' => Yii::t('frontend', 'Profile'),
                        'url' => ['/user/default/user-profile'],
                        'visible' => Yii::$app->user->can('user'),
                    ],
                    [
                        'label' => Yii::t('frontend', 'Backend'),
                        'url' => Yii::getAlias('@backendUrl'),
                        'visible' => Yii::$app->user->can('manager')
                    ],
                    [
                        'label' => Yii::t('frontend', 'Logout'),
                        'url' => ['/user/sign-in/logout'],
                        'linkOptions' => ['data-method' => 'post']
                    ]
                ]
            ],
        ]
    ]);
    NavBar::end();
    ?>

    <?= $content ?>

</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; НБУ Кариери <?= date('Y') ?></p>
        <p class="pull-right">Open Sourced on <a href="https://github.com/ddinchev/nbu-careers" rel="external">GitHub</a></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
