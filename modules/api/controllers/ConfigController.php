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

   public function actionGetConfig(){
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

      if (\Yii::$app->request->isGet) {
        $model = Config::find()->where(['pk_id' => 1])->one();

        $model->logo = ''.Url::home(true).''.$model->logo;

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
      $model = Config::find()->one();
      $logo = $model->logo;

      if (\Yii::$app->request->isPost) {
         $model->name = \Yii::$app->request->post('name');
         $model->primaryColor = \Yii::$app->request->post('primaryColor');
         $model->secondaryColor = \Yii::$app->request->post('secondaryColor');
         $model->tertiaryColor = \Yii::$app->request->post('tertiaryColor');
         $model->logo = $logo;

         if( $model->save() )
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
