<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'name' => 'WorldWideVi',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    //'layout' => '../velzon/layouts-two-column',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
            'authTimeout' => 1800,
            'enableSession' => true,
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'WorldWideVi-frontend',
            'class' => 'yii\web\Session',
            'timeout' => 1800,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/' =>'site/index',
                'login'=>'site/login',
                'signup' => 'site/signup',
                'logout' => 'site/logout',
                'clients' => 'site/clients'
            ],
        ],
        
    ],
    'params' => $params,
];
