<?php

namespace app\modules\api\controllers;

use yii\web\Controller;
use app\models\Userprofile;
use app\models\Address;

/**
 * Default controller for the `api` module
 */
class UserprofileController extends Controller
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
         $users = Userprofile::find()->all();
         $data = array_map( function( $user ){
            return [
               'id' => strval($user->pk_id),
               'name'=> strval($user->name),
               'lastname'=> strval($user->lastname),
               'idCard'=> strval($user->idCard),
               'status'=> strval($user->status),
               'bloodType'=> strval($user->fk_t_blood_id),
               'civilstatusType'=> strval($user->fk_t_civilstatus_id),
               'homeType'=> strval($user->fk_t_home_id),
               'livesAlone'=> strval($user->livesAlone),
               'childNumber'=> strval($user->childNumber),
               'smokerType'=> strval($user->fk_t_smoker_id),
               'transportType'=> strval($user->fk_t_transport_id),
               'drinkerType'=> strval($user->fk_t_drinker_id),
               'genderType'=> strval($user->fk_t_gender_id),
               'employeeType'=> strval($user->fk_t_employee_id),
               'regionType'=> strval($user->address->fk_t_region_id) ?? null,
               'cityType'=> strval($user->address->fk_t_city_id) ?? null,
               'streetType'=> strval($user->address->streetType) ?? null,
               'streetNumber'=> strval($user->address->streetNumber) ?? null,
               'streetChar'=> strval($user->address->streetChar) ?? null,
               'streetCardinal'=> strval($user->address->streetCardinal) ?? null,
               'intersectionNumber'=> strval($user->address->intersectionNumber) ?? null,
               'intersectionChar'=> strval($user->address->intersectionChar) ?? null,
               'intersectionCardinal'=> strval($user->address->intersectionCardinal) ?? null,
               'buildingNumber'=> strval($user->address->buildingNumber) ?? null,
               'complement'=> strval($user->address->complement) ?? null,
               'details'=> strval($user->address->details) ?? null,
            ];
         }, $users);
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
      $user = new Userprofile();
      $address = new Address();

      if (\Yii::$app->request->isPost) {
         $user->name                      = \Yii::$app->request->post('name');
         $user->status                    = \Yii::$app->request->post('status');
         $user->idCard                    = \Yii::$app->request->post('idCard');
         $user->lastname                  = \Yii::$app->request->post('lastname');
         $user->livesAlone                = \Yii::$app->request->post('livesAlone') == "" ? null : \Yii::$app->request->post('livesAlone');
         $user->childNumber               = \Yii::$app->request->post('childNumber') == "" ? null : \Yii::$app->request->post('childNumber');
         $user->fk_t_home_id              = \Yii::$app->request->post('homeType') == "" ? null : intval(\Yii::$app->request->post('homeType'));
         $user->fk_t_blood_id             = \Yii::$app->request->post('bloodType') == "" ? null : intval(\Yii::$app->request->post('bloodType'));
         $user->fk_t_smoker_id            = \Yii::$app->request->post('smokerType') == "" ? null : intval(\Yii::$app->request->post('smokerType'));
         $user->fk_t_gender_id            = \Yii::$app->request->post('genderType') == "" ? null : intval(\Yii::$app->request->post('genderType'));
         $user->fk_t_drinker_id           = \Yii::$app->request->post('drinkerType') == "" ? null : intval(\Yii::$app->request->post('drinkerType'));
         $user->fk_t_employee_id          = \Yii::$app->request->post('employeeType') == "" ? null : intval(\Yii::$app->request->post('employeeType'));
         $user->fk_t_transport_id         = \Yii::$app->request->post('transportType') == "" ? null : intval(\Yii::$app->request->post('transportType'));
         $user->fk_t_civilstatus_id       = \Yii::$app->request->post('civilstatusType') == "" ? null : intval(\Yii::$app->request->post('civilstatusType'));
         if( $user->save() ){
            $address->details                = \Yii::$app->request->post('details');
            $address->complement             = \Yii::$app->request->post('complement');
            $address->streetType             = \Yii::$app->request->post('streetType');
            $address->streetChar             = \Yii::$app->request->post('streetChar');
            $address->fk_t_city_id           = \Yii::$app->request->post('cityType') == "" ? null : intval(\Yii::$app->request->post('cityType')) ?? null;
            $address->streetNumber           = \Yii::$app->request->post('streetNumber');
            $address->fk_t_region_id         = \Yii::$app->request->post('regionType') == "" ? null : intval(\Yii::$app->request->post('regionType')) ?? null;
            $address->streetCardinal         = \Yii::$app->request->post('streetCardinal');
            $address->buildingNumber         = \Yii::$app->request->post('buildingNumber');
            $address->intersectionChar       = \Yii::$app->request->post('intersectionChar');
            $address->intersectionNumber     = \Yii::$app->request->post('intersectionNumber');
            $address->intersectionCardinal   = \Yii::$app->request->post('intersectionCardinal');
            if( $address->save() ){
               $user->fk_address_id = $address->pk_id;
               $user->save();
               return [
                  'status'    => 200,
                  'type'      => 'success',
                  'message'   => 'Guardado correctamente.',
                  'data'      => $user
               ];
            }
            else{
               $address->validate();
               return [
                  'status'    => 206,
                  'type'      => 'warning',
                  'message'   => 'El usuario fue guardado correctamente, pero su dirección no pudo ser procesada.',
                  'errors'    => $address->getErrors(),
                  'data'      => array_merge((array)$user, (array)$address)
               ];
            }
         }
         else{
            $user->validate();
            
            return [
               'status'    => 500,
               'type'      => 'error',
               'message'   => 'El registro no pudo ser guardado',
               'errors'    => $user->getErrors()
            ];
         }
      }
      return [
         'status'    => 405,
         'type'      => 'error',
         'message'   => 'Tipo de solicitud no aceptada'
      ];
   }
   public function actionUpdate(){
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

      if (\Yii::$app->request->isPatch) {
         $user = Userprofile::find()->where(['pk_id' => \Yii::$app->request->getBodyParam('id')])->one();
         $address = Address::find()->where(['pk_id' => $user->fk_address_id])->one();

         $user->name                      = \Yii::$app->request->post('name');
         $user->status                    = \Yii::$app->request->post('status');
         $user->idCard                    = \Yii::$app->request->post('idCard');
         $user->lastname                  = \Yii::$app->request->post('lastname');
         $user->livesAlone                = \Yii::$app->request->post('livesAlone') == "" ? null : \Yii::$app->request->post('livesAlone');
         $user->childNumber               = \Yii::$app->request->post('childNumber') == "" ? null : \Yii::$app->request->post('childNumber');
         $user->fk_t_home_id              = \Yii::$app->request->post('homeType') == "" ? null : intval(\Yii::$app->request->post('homeType'));
         $user->fk_t_blood_id             = \Yii::$app->request->post('bloodType') == "" ? null : intval(\Yii::$app->request->post('bloodType'));
         $user->fk_t_smoker_id            = \Yii::$app->request->post('smokerType') == "" ? null : intval(\Yii::$app->request->post('smokerType'));
         $user->fk_t_gender_id            = \Yii::$app->request->post('genderType') == "" ? null : intval(\Yii::$app->request->post('genderType'));
         $user->fk_t_drinker_id           = \Yii::$app->request->post('drinkerType') == "" ? null : intval(\Yii::$app->request->post('drinkerType'));
         $user->fk_t_employee_id          = \Yii::$app->request->post('employeeType') == "" ? null : intval(\Yii::$app->request->post('employeeType'));
         $user->fk_t_transport_id         = \Yii::$app->request->post('transportType') == "" ? null : intval(\Yii::$app->request->post('transportType'));
         $user->fk_t_civilstatus_id       = \Yii::$app->request->post('civilstatusType') == "" ? null : intval(\Yii::$app->request->post('civilstatusType'));
         if( $user->save() ){
            $address->details                = \Yii::$app->request->post('details');
            $address->complement             = \Yii::$app->request->post('complement');
            $address->streetType             = \Yii::$app->request->post('streetType');
            $address->streetChar             = \Yii::$app->request->post('streetChar');
            $address->fk_t_city_id           = \Yii::$app->request->post('cityType') == "" ? null : intval(\Yii::$app->request->post('cityType')) ?? null;
            $address->streetNumber           = \Yii::$app->request->post('streetNumber');
            $address->fk_t_region_id         = \Yii::$app->request->post('regionType') == "" ? null : intval(\Yii::$app->request->post('regionType')) ?? null;
            $address->streetCardinal         = \Yii::$app->request->post('streetCardinal');
            $address->buildingNumber         = \Yii::$app->request->post('buildingNumber');
            $address->intersectionChar       = \Yii::$app->request->post('intersectionChar');
            $address->intersectionNumber     = \Yii::$app->request->post('intersectionNumber');
            $address->intersectionCardinal   = \Yii::$app->request->post('intersectionCardinal');
            if( $address->save() ){
               return [
                  'status'    => 200,
                  'type'      => 'success',
                  'message'   => 'Guardado correctamente.',
                  'data'      => array_merge((array)$user, (array)$address)
               ];
            }
            else{
               $address->validate();
               return [
                  'status'    => 206,
                  'type'      => 'warning',
                  'message'   => 'El usuario fue guardado correctamente, pero su dirección no pudo ser procesada.',
                  'errors'    => $address->getErrors(),
                  'data'      => $user
               ];
            }
         }
         else{
            $user->validate();
            
            return [
               'status'    => 500,
               'type'      => 'error',
               'message'   => 'El registro no pudo ser guardado',
               'errors'    => $user->getErrors()
            ];
         }
      }
      return [
         'status'    => 405,
         'type'      => 'error',
         'message'   => 'Tipo de solicitud no aceptada'
      ];
   }
   public function actionDelete(){
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

      if (\Yii::$app->request->isDelete) {
         $model = Transporttype::find()->where(['pk_id' => \Yii::$app->request->getBodyParam('id')])->one();
         
         if( $model !== null ){
            $model->status = "ELIMINADO";
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
