<?php
$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');
$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'pXnEEDkVkB-vZmBQLe800BDDPN4ivzyH',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        
        'formatter' => [
            'dateFormat' => 'php:d.m.Y',
            'datetimeFormat' => 'php:d.m.Y H:i:s',
            'defaultTimeZone' => 'Europe/Moscow',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => 'RUR',
],
          'i18n' => [
        'translations' => [
            'kvgrid' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@vendor/kartik-v/yii2-grid/messages',
            ],
      ],
 ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
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
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'login' => 'site/login',
            ],
        ],
        'authManager' => [
            'class' => yii\rbac\DbManager::className()
        ]
        
    ],
    'params' => $params,
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
        'super' => [
              'class' => 'app\modules\super\Module',
          ],
        'teacher' => [
            'class' => 'app\modules\teacher\Module',
        ],
        'curator' => [
             'class' => 'app\modules\curator\Module',
        ],
        'student' => [
              'class' => 'app\modules\student\Module',
          ],
        'gridview' =>  [
        'class' => '\kartik\grid\Module'
    ],
         'datecontrol' =>  [
        'class' => '\kartik\datecontrol\Module'
    ]
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
