<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
   'id' => 'mdt-be',
   'basePath' => dirname(__DIR__),
   'bootstrap' => ['log'],
   'aliases' => [
      '@bower' => '@vendor/bower-asset',
      '@npm'   => '@vendor/npm-asset',
   ],
   'modules' => [
      'api' => [
         'class' => 'app\modules\api\rest',
      ],
   ],
   'components' => [
      'request' => [
         // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
         'cookieValidationKey' => 'uRQ04f6JOjWR-tIHlJOQg_AuKOGQ6_G5',
         'parsers' => [
            'application/json' => 'yii\web\JsonParser',
            'multipart/form-data' => 'yii\web\MultipartFormDataParser'
         ],
         'enableCsrfValidation' => false,
      ],
      'cache' => [
         'class' => 'yii\caching\FileCache',
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
         // send all mails to a file by default. You have to set
         // 'useFileTransport' to false and configure a transport
         // for the mailer to send real emails.
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
      /** */
      'urlManager' => [
         'enablePrettyUrl' => true,
         //'enableStrictParsing' => true,
         'showScriptName' => false,
         'rules' => [
               ['class' => 'yii\rest\UrlRule', 'controller' => 'modules/api/controllers/address'],
               ['class' => 'yii\rest\UrlRule', 'controller' => 'modules/api/controllers/bloodtype'],
               ['class' => 'yii\rest\UrlRule', 'controller' => 'modules/api/controllers/citytype'],
               ['class' => 'yii\rest\UrlRule', 'controller' => 'modules/api/controllers/civilstatustype'],
               ['class' => 'yii\rest\UrlRule', 'controller' => 'modules/api/controllers/drinkertype'],
               ['class' => 'yii\rest\UrlRule', 'controller' => 'modules/api/controllers/educationleveltype'],
               ['class' => 'yii\rest\UrlRule', 'controller' => 'modules/api/controllers/employeetype'],
               ['class' => 'yii\rest\UrlRule', 'controller' => 'modules/api/controllers/gendertype'],
               ['class' => 'yii\rest\UrlRule', 'controller' => 'modules/api/controllers/hometype'],
               ['class' => 'yii\rest\UrlRule', 'controller' => 'modules/api/controllers/languagetype'],
               ['class' => 'yii\rest\UrlRule', 'controller' => 'modules/api/controllers/regiontype'],
               ['class' => 'yii\rest\UrlRule', 'controller' => 'modules/api/controllers/releducationlevel'],
               ['class' => 'yii\rest\UrlRule', 'controller' => 'modules/api/controllers/rellanguages'],
               ['class' => 'yii\rest\UrlRule', 'controller' => 'modules/api/controllers/smokertype'],
               ['class' => 'yii\rest\UrlRule', 'controller' => 'modules/api/controllers/transporttype'],
               ['class' => 'yii\rest\UrlRule', 'controller' => 'modules/api/controllers/userprofile'],
         ],
      ]
      /**/
   ],
   'params' => $params,
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
   