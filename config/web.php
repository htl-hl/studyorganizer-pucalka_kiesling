<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'EW4Fr0lV3GWkNihFl-8m8dASLAmdK22j',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['site/login'], // Zur Login-Seite weiterleiten
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            'transport' => [
                'scheme' => 'smtp',
                'host' => 'localhost',
                'username' => '',
                'password' => '',
                'port' => '1025'
            ],
            // send all mails to a file by default.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],

    // ACCESS CONTROL für ALLE Seiten
    'as access' => [
        'class' => 'yii\filters\AccessControl',
        'rules' => [
            [
                'allow' => true,
                'actions' => ['login', 'signup', 'error'], // HIER signup hinzugefügt
                'roles' => ['?'],
            ],
            [
                'allow' => true,
                'roles' => ['@'],
            ],
        ],
        'denyCallback' => function($rule, $action) {
            return Yii::$app->response->redirect(['site/login']);
        },
    ],

    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*'],
        'on beforeAction' => function ($event) {
            if (Yii::$app->user->isGuest || !Yii::$app->user->identity->isAdmin()) {
                throw new \yii\web\ForbiddenHttpException('Nur für Admins.');
            }
        },
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*'],
    ];
}

return $config;