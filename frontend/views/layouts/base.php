<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

/* @var $this \yii\web\View */
/* @var $content string */

$this->beginContent('@frontend/views/layouts/_clear.php')
?>
    <div class="wrap">
        <?php
        NavBar::begin([
            'brandLabel' => Yii::t('frontend', 'NBU Careers'),
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
                [
                    'label'=>Yii::t('frontend', 'Language'),
                    'items'=>array_map(function ($code) {
                        return [
                            'label' => Yii::$app->params['availableLocales'][$code],
                            'url' => ['/site/set-locale', 'locale'=>$code],
                            'active' => Yii::$app->language === $code
                        ];
                    }, array_keys(Yii::$app->params['availableLocales']))
                ],
                // ['label' => Yii::t('frontend', 'Home'), 'url' => ['/site/index']],
                // ['label' => Yii::t('frontend', 'Articles'), 'url' => ['/article/index']],
                // ['label' => Yii::t('frontend', 'Contact'), 'url' => ['/site/contact']],
                // Students
                [
                    'label' => Yii::t('frontend', 'Students'),
                    'visible' => Yii::$app->user->isGuest,
                    'items' => [
                        ['label' => Yii::t('frontend', 'Sign in'), 'url' => ['/user/sign-in/login']],
                        ['label' => Yii::t('frontend', 'Register as student'), 'url' => ['/user/sign-in/user-sign-up']],
                    ]
                ],
                // Employers
                [
                    'label' => Yii::t('frontend', 'Employers'),
                    'visible' => Yii::$app->user->isGuest,
                    'items' => [
                        ['label' => Yii::t('frontend', 'Sign in'), 'url' => ['/user/sign-in/login']],
                        ['label' => Yii::t('frontend', 'Register as employer'), 'url' => ['/user/sign-in/company-sign-up']],
                    ]
                ],
                // Student / Employer menu
                [
                    'label' => Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->getPublicIdentity(),
                    'visible' => !Yii::$app->user->isGuest,
                    'items' => [
                        [
                            'label' => Yii::t('frontend', 'Account'),
                            'url' => ['/user/default/index'],
                        ],
                        [
                            'label' => Yii::t('frontend', 'Company profile'),
                            'url' => ['/user/default/company-profile'],
                            'visible' => Yii::$app->user->can('company'),
                        ],
                        [
                            'label' => Yii::t('frontend', 'My offers'),
                            'url' => ['/company/index', 'id' => Yii::$app->user->id],
                            'visible' => Yii::$app->user->can('company'),
                        ],
                        [
                            'label' => Yii::t('frontend', "Add job offer"),
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
                ['label' => Yii::t('frontend', 'About'), 'url' => ['/page/view', 'slug' => 'about']],
            ]
        ]);
        NavBar::end();
        ?>

        <?php echo $content ?>

    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; <?php echo Yii::t('frontend', 'NBU Careers') ?> <?php echo date('Y') ?></p>

            <p class="pull-right">Open Sourced on <a href="https://github.com/ddinchev/nbu-careers"
                                                     rel="external">GitHub</a></p>
        </div>
    </footer>
<?php $this->endContent() ?>