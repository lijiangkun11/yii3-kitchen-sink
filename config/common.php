<?php

return [
    'app' => [
        'basePath' => dirname(__DIR__) . '/src',
        'aliases' => [
            '@app' => dirname(__DIR__),
            '@github' => dirname(__DIR__) . '/runtime/github',
            '@vendor' => dirname(__DIR__) . '/vendor',
            '@runtime' => dirname(__DIR__) . '/runtime',
        ]
    ],
    'db' => [
        '__class'   => \Yiisoft\Db\Connection::class,
        'dsn'       => 'sqlite:dbname=' . $params['db.name']
            . (!empty($params['db.host']) ? (';host=' . $params['db.host']) : '')
            . (!empty($params['db.port']) ? (';port=' . $params['db.port']) : ''),
        'username'  => $params['db.user'],
        'password'  => $params['db.password'],
    ],
    'cache' => [
        '__class' => \Yiisoft\Cache\Cache::class,
        '__construct()' => [
               '__class' => Yiisoft\Cache\ArrayCache::class,
           ],
    ],
    'user' => [
        '__class' => yii\web\User::class,
        'identityClass' => \app\models\User::class,
    ],
];
