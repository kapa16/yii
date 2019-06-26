<?php

use mdm\admin\components\AccessControl;
use yii\rbac\DbManager;
use yii\i18n\PhpMessageSource;
use yii\debug\Module;
use yii\log\FileTarget;
use yii\swiftmailer\Mailer;
use app\models\UserIdentity;
use app\components\Bootstrap;
use app\components\BootstrapWeb;
use yii\redis\Cache;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$urlManager = require __DIR__ . '/url_manager.php';

$config = [
    'id' => 'basic',
    'language' => 'en',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'bootstrap', 'bootstrapWeb'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'bootstrap' => [
            'class' => Bootstrap::class
        ],
        'bootstrapWeb' => [
            'class' => BootstrapWeb::class
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
        'authManager' => [
            'class' => DbManager::class,
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
        'urlManager' => $urlManager,
    ],
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => 'app\entities\Users',
                    'usernameField' => 'login',
                ]
            ],
            'menus' => [
                'user' => null,
            ],
        ]
    ],
    'as access' => [
        'class' => AccessControl::class,
        'allowActions' => [
            'site/index',
            'site/login',
            'site/about',
            'site/contact',
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
