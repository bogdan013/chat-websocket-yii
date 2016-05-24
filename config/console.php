<?php

Yii::setAlias('@tests', dirname(__DIR__) . '/tests/codeception');

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    
    'modules' => [
        'user' => [
            'class' => 'amnah\yii2\user\Module',
        ],
    ],
    
    'components' => [
        
        'user' => [
            'class' => 'amnah\yii2\user\components\User'
        ],
        
        'session' => [ // for use session in console application
            'class' => 'yii\web\Session'
        ],
        
        
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
        
        'websocket' => [
            'class' => 'morozovsk\yii2websocket\Connection',
            'servers' => [
                'chat3' => [
                    'class' => 'morozovsk\websocket\examples\chat3\server\Chat3WebsocketDaemonHandler',
                    'pid' => '/tmp/websocket_chat.pid',
                    'websocket' => 'tcp://127.0.0.1:8004',
                    'localsocket' => 'tcp://127.0.0.1:8010',
                    //'master' => 'tcp://127.0.0.1:8020',
                    //'eventDriver' => 'event'
                ],
                'chat' => [
                    'class' => 'morozovsk\websocket\examples\chat\server\ChatWebsocketDaemonHandler',
                    'pid' => '/tmp/websocket_chat.pid',
                    'websocket' => 'tcp://127.0.0.1:8000',
                    'localsocket' => 'tcp://127.0.0.1:8010',
                    //'master' => 'tcp://127.0.0.1:8020',
                    //'eventDriver' => 'event' 
                ],
            ],
        ],

        'db' => $db,
    ],
    'params' => $params,
    
    'controllerMap' => [
        'websocket' => 'morozovsk\yii2websocket\console\controllers\WebsocketController',
        /*
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],*/
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
