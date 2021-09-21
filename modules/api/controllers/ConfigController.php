<?php

namespace app\modules\api\controllers;

use yii\web\Controller;
use app\models\Config;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use yii\helpers\Url;

/**
 * Default controller for the `api` module
 */
class ConfigController extends Controller
{
   public $enableCsrfValidation = false;

   public static function allowedDomains()
   {
      return [
         //'*',                        // star allows all domains
         'http://localhost:8080',
         //'http://newstetic.vcb.com.co/',
         //'http://test2.example.com',
      ];
   }
   
   public function behaviors()
   {
      return array_merge(parent::behaviors(), [
    
         // For cross-domain AJAX request
         'corsFilter'  => [
             'class' => \yii\filters\Cors::className(),
             'cors'  => [
                 // restrict access to domains:
                 'Origin'                           => static::allowedDomains(),
                 'Access-Control-Request-Method'    => ['*'],
                 'Access-Control-Request-Headers'   => ['*'],
                 'Access-Control-Allow-Credentials' => true,
                 'Access-Control-Max-Age'           => 3600,                 // Cache (seconds)
             ],
         ],
 
     ]);
   }

   public function actionGetTables(){
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

      if (\Yii::$app->request->isGet) {
        $tables = Config::find()->where(['type' => 'TABLE'])->orderBy([ 'mask' => SORT_ASC ])->all();

        return [
            'status' => 200,
            'type' => 'success',
            'message' => 'OK',
            'data' => [
              'tables' => $tables
            ]
        ];
      }
      return [
         'status' => 405,
         'type' => 'error',
         'message' => 'Tipo de solicitud no aceptada'
      ];
   }

   public function actionSaveTables(){
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

      if (\Yii::$app->request->isPost) {
        $tables = \Yii::$app->request->post('tables');

        $saved = true;
        foreach( $tables as $object ){
          $updateTable = Config::find()->where(['field' => $object['field']])->one();
          $updateTable->value = $object['value'];
          if( !$updateTable->save() ) $saved = false;
        }

        if( $saved )
          return [
              'status' => 200,
              'type' => 'success',
              'message' => 'Lista de tablas guardada correctamente',
              'data' => [
                'tables' => $tables
              ]
          ];
        return [
          'status' => 500,
          'type' => 'error',
          'message' => 'El registro no pudo ser guardado'
        ];
      }
      return [
         'status' => 405,
         'type' => 'error',
         'message' => 'Tipo de solicitud no aceptada'
      ];
   }
   public function actionGetConfig(){
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

      if (\Yii::$app->request->isGet) {
        $name =             Config::find()->where(['field' => 'name'])->one();
        $logo =             Config::find()->where(['field' => 'logo'])->one();
        $primaryColor =     Config::find()->where(['field' => 'primaryColor'])->one();
        $secondaryColor =   Config::find()->where(['field' => 'secondaryColor'])->one();
        $tertiaryColor =    Config::find()->where(['field' => 'tertiaryColor'])->one();

        $logo = ''.Url::home(true).''.$logo->value;
        $model = [
          'name' => $name->value,
          'logo' => $logo,
          'primaryColor' => $primaryColor->value,
          'secondaryColor' => $secondaryColor->value,
          'tertiaryColor' => $tertiaryColor->value
        ];

        return [
            'status' => 200,
            'type' => 'success',
            'message' => 'OK',
            'data' => [
              'config' => $model
            ]
        ];
      }
      return [
         'status' => 405,
         'type' => 'error',
         'message' => 'Tipo de solicitud no aceptada'
      ];
   }
   public function actionSave(){
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

      if (\Yii::$app->request->isPost) {
        $saved = false;

        $name = Config::find()->where(['field' => 'name'])->one();
        $name->value = \Yii::$app->request->post('name');
        if( $name->save() ) $saved = true;

        $primaryColor = Config::find()->where(['field' => 'primaryColor'])->one();
        $primaryColor->value = \Yii::$app->request->post('primaryColor');
        if( $primaryColor->save() ) $saved = true;
        
        $secondaryColor = Config::find()->where(['field' => 'secondaryColor'])->one();
        $secondaryColor->value = \Yii::$app->request->post('secondaryColor');
        if( $secondaryColor->save() ) $saved = true;
        
        $tertiaryColor = Config::find()->where(['field' => 'tertiaryColor'])->one();
        $tertiaryColor->value = \Yii::$app->request->post('tertiaryColor');
        if( $tertiaryColor->save() ) $saved = true;

        $logo = Config::find()->where(['field' => 'logo'])->one();
        $logo = ''.Url::home(true).''.$logo->value;
        $model = [
          'name' => $name->value,
          'logo' => $logo,
          'primaryColor' => $primaryColor->value,
          'secondaryColor' => $secondaryColor->value,
          'tertiaryColor' => $tertiaryColor->value
        ];
        
         if( $saved )
            return [
               'status' => 200,
               'type' => 'success',
               'message' => 'Guardado correctamente',
               'data' => [
                  'config' => $model
               ]
            ];
         return [
            'status' => 500,
            'type' => 'error',
            'message' => 'El registro no pudo ser guardado'
         ];
      }
      return [
         'status' => 405,
         'type' => 'error',
         'message' => 'Tipo de solicitud no aceptada'
      ];
   }
   public function actionSaveLogo(){
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

      if (\Yii::$app->request->isPost) {

        $uploaddir = \Yii::$app->basePath.'/web/uploads/';
        $uploadfile = $uploaddir . basename($_FILES['logo']['name']);
        
        if( move_uploaded_file($_FILES['logo']['tmp_name'], $uploadfile) ){

          $config = Config::find()->where(['pk_id' => 1])->one();
          $config->logo = 'uploads/' . basename($_FILES['logo']['name']);
          
          if( $config->save() )

            $config->logo = ''.Url::home(true).''.$config->logo;
             return [
               'status' => 200,
               'type' => 'success',
               'message' => 'Imagen guardada correctamente',
               'data' => [
                   'config' => $config
               ]
             ];
        }


         return [
            'status' => 500,
            'type' => 'error',
            'message' => 'El registro no pudo ser guardado'
         ];
      }
      return [
         'status' => 405,
         'type' => 'error',
         'message' => 'Tipo de solicitud no aceptada'
      ];
   }
}
