<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'mailer' => [
          'class' => 'yii\swiftmailer\Mailer',
          'useFileTransport' => false,
          'transport' => [
              'class' => 'Swift_SmtpTransport',
              'host' => 'smtp.gmail.com',
              'username' => 'merlin.ege@gmail.com',
              'password' => 'Merlin11223344',
              'port' => '587',
              'encryption' => 'tls',
              ],
    ],
        'db' => $db,
        'authManager' => [
            'class' => yii\rbac\DbManager::className()
        ]
    ],
    'params' => $params,
    'controllerMap' => [
    'batch' => [
        'class' => 'schmunk42\giiant\commands\BatchController',
        'overwrite' => true,
        'modelNamespace' => 'app\\modules\\crud\\models',
        'crudTidyOutput' => true,
    ]
],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
