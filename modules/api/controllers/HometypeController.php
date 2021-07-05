<?php

namespace app\modules\api\controllers;

use yii\web\Controller;
use app\models\Hometype;

/**
 * Default controller for the `api` module
 */
class HometypeController extends Controller
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

   public function actionList(){
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      if (\Yii::$app->request->isGet) {
         $data = Hometype::find()->all();
         return [
            'status' => 200,
            'type' => 'success',
            'message' => 'Listado',
            'data' => $data
         ];
      }
      return [
         'status' => 405,
         'type' => 'error',
         'message' => 'Tipo de solicitud no aceptada'
      ];
   }
   public function actionCreate(){
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      $model = new Hometype();

      if (\Yii::$app->request->isPost) {
         $model->name = \Yii::$app->request->post('label');
         if( $model->save() )
            return [
               'status' => 200,
               'type' => 'success',
               'message' => 'Guardado correctamente',
               'data' => [
                  'value' => $model->pk_id,
                  'label' => $model->name
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
   public function actionUpdate(){
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

      if (\Yii::$app->request->isPatch) {
         $model = Hometype::find()->where(['pk_id' => \Yii::$app->request->getBodyParam('value')])->one();
         $model->name = \Yii::$app->request->getBodyParam('label');
         if( $model->save() )
            return [
               'status' => 200,
               'type' => 'success',
               'message' => 'Guardado correctamente',
               'data' => [
                  'value' => $model->pk_id,
                  'label' => $model->name
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
   public function actionDelete(){
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

      if (\Yii::$app->request->isDelete) {
         $model = Hometype::find()->where(['pk_id' => \Yii::$app->request->getBodyParam('value')])->one();
         
         if( $model !== null ){
            $model->delete();
            return [
               'status' => 200,
               'type' => 'success',
               'message' => 'Eliminado correctamente'
            ];
         }
         return [
            'status' => 500,
            'type' => 'error',
            'message' => 'El registro no pudo ser eliminado'
         ];
      }
      return [
         'status' => 405,
         'type' => 'error',
         'message' => 'Tipo de solicitud no aceptada'
      ];
   }
}
