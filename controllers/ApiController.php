<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\db\Query;
use yii\helpers\Url;

class ApiController extends Controller
{
   public static function allowedDomains()
   {
      return [
         //'*',                        // star allows all domains
         'http://localhost',
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
   
   private function loadConditions(){
      $conditions = json_decode(file_get_contents(Url::base(true).'/config-params.json'));
      return $conditions;
   }
   
   public function actionIndex()
   {
      $conditions = $this->loadConditions();
      return $this->render('index', ["conditions" => json_encode($conditions)]);
   }
   
}
