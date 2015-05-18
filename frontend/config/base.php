<?php

return [
    'id' => 'frontend',
    'sourceLanguage' => 'en-US',
    'language' => 'bg-BG',
    'basePath' => dirname(__DIR__),
    'components' => [
        'urlManager' => require(__DIR__ . '/_urlManager.php'),
    ],
];
