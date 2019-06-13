<?php

//use codemix\localeurls\UrlManager;
use yii\web\UrlManager;
use yii\i18n\PhpMessageSource;
use yii\debug\Module;
use yii\log\FileTarget;
use yii\swiftmailer\Mailer;
use app\models\UserIdentity;
use app\components\Bootstrap;
use yii\redis\Cache;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'language' => 'en',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'bootstrap'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'bootstrap' => [
            'class' => Bootstrap::class
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => PhpMessageSource::class,
                ]
            ]
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Nu1ju6NRd4CapWjgXylAvlhvKbd-THqj',
        ],
        'cache' => [
            'class' => Cache::class,
            'redis' => [
                'hostname' => 'localhost',
                'port' => 6379,
                'database' => 0,
            ],
        ],
        'user' => [
            'identityClass' => UserIdentity::class,
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => Mailer::class,
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'class' => UrlManager::class,
//            'languages' => ['en', 'ru'],
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/' => 'site/index',
                '<action:(about|contact|login)>' => 'site/<action>',
                '<controller>/page/<page:\d+>/per-page/<per-page:\d+>' => '<controller>/index',
                '<controller>' => '<controller>/index',
                '<controller>/<id:\d+>' => '<controller>/view',
                '<controller>/<id:\d+>/<action>' => '<controller>/<action>',


            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => Module::class,
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => \yii\gii\Module::class,
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
