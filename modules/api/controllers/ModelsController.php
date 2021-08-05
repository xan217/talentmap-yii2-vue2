<?php

namespace app\modules\api\controllers;

use yii\web\Controller;
use app\models\Bloodtype;
use app\models\Citytype;
use app\models\CivilStatustype;
use app\models\Drinkertype;
use app\models\Employeetype;
use app\models\Gendertype;
use app\models\Hometype;
use app\models\Regiontype;
use app\models\Smokertype;
use app\models\Transporttype;

use yii\di\Instance;

/**
 * Default controller for the `api` module
 */
class ModelsController extends Controller
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
         $model_name = 'app\models\\'.\Yii::$app->request->get('name');
         $data = $model_name::find()->all();

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
      $model_name = 'app\models\\'.\Yii::$app->request->get('name');
      $model = new $model_name();

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
         $model_name = 'app\models\\'.\Yii::$app->request->get('name');
         $model = $model_name::find()->where(['pk_id' => \Yii::$app->request->getBodyParam('value')])->one();
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
         $model_name = 'app\models\\'.\Yii::$app->request->get('name');
         $model = $model_name::find()->where(['pk_id' => \Yii::$app->request->getBodyParam('value')])->one();
         
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
