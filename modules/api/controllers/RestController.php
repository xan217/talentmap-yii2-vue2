<?php

namespace app\modules\api\controllers;

use yii\web\Controller;
use yii\helpers\Url;
use yii\db\Query;

/**
* Default controller for the `api` module
*/
class RestController extends Controller
{
   private function params() {
      return \Yii::$app->params['constraints'];
   }
   
   public function actionGetConditions(){
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      $params = self::params();
      
      if( \Yii::$app->request->isGet ){
         $conditionalGroup = [];
         
         foreach($params['conditions'] as $key => $condition){
            
            $condition_parsed = [];
            
            switch($condition['type']){
               case 'STC': 
                  
                  $condition_parsed['name']   = $key;
                  $condition_parsed['type']   = $condition['type'];
                  $condition_parsed['field']  = $condition['field'];
                  $condition_parsed['label']  = $condition['label'];
                  $condition_parsed['values'] = $condition['values'];
                  
                  break;
               
               case 'ACQ':
                  $condition_parsed = [
                     'name' => $key,
                     'type' => $condition['type'],
                     'field' => $condition['field'],
                     'label' => $condition['name'],
                     'values' => []
                  ];
                  if(isset($condition['values'])){
                     foreach($condition['values'] as $subcondition){
                        $condition_parsed['values'][] = [ 
                           'label' => strtoupper($subcondition['label']), 
                           'value' => $subcondition['value']
                        ];
                     }
                  }
                  else{
                     $rows = new Query;
                     $rows->select( $condition['table'].'.'.$condition['field'].' as field, '.$condition['table'].'.'.$condition['pk'].' as pk' );
                     $rows->from( $condition['table'] );
                     $rows->orderBy( $condition['table'].'.'.$condition['field'], 'ASC' );
                     $acquired_values = $rows->all();
                     $condition_parsed['values'] = array_map( 
                        function($item){
                           return [
                              'label' => strtoupper(trim($item['field'])), 
                              'value' => strtoupper(trim($item['pk']))
                           ];
                        }, 
                        array_filter( 
                           $acquired_values, 
                           function($item) { 
                              return $item['field'] !== '' && $item['field'] !== ' '; 
                           }
                        )
                     );
                  }
                  break;

               case 'REL': 
                  $condition_parsed = [
                     'name' => $key,
                     'type' => $condition['type'],
                     'field' => $condition['field'],
                     'label' => $condition['name'],
                     'values' => []
                  ];
                  
                  if(isset($condition['values'])){
                     foreach($condition['values'] as $subcondition){
                        $condition_parsed['values'][] = [ 
                           'label' => strtoupper($subcondition['label']), 
                           'value' => $subcondition['value']
                        ];
                     }
                  }
                  else{
                     $default_condition = $params['base_table_requirements']['constraints'];
                     $rows = new Query;
                     $rows->from( $params['base_table']['name'] );
                     if( sizeof( $params['base_table_requirements']['tables']) > 0 ){
                        foreach( $params['base_table_requirements']['tables'] as $tableKey => $tableDetails ) {
                           $rows->join(
                              'LEFT JOIN', 
                              $tableDetails['name'], 
                              $tableDetails['name'].'.'.$tableDetails['fk'].' = '.$params['base_table']['name'].'.'.$params['base_table']['pk'].'');   
                        }
                     }
                     if( sizeof( $params['base_table_requirements']['constraints']) > 0 ){
                        foreach ( $params['base_table_requirements']['constraints'] as $constraintKey => $constraintDetails) {
                           $rows->where( $constraintDetails['table'].'.'.$constraintDetails['field'].' '.$constraintDetails['condition'].' "'.$constraintDetails['value'].'"' );
                        }
                     }
                     
                     $rows->select( $condition['table'].'.'.$condition['field'].' as field, '.$condition['table'].'.'.$condition['pk'] );
                     $rows->join( 'JOIN', $condition['table'], $condition['join'] )->distinct();
                     $rows->orderBy( $condition['table'].'.'.$condition['field'], 'ASC' );
                     $acquired_values = $rows->all();
                     
                     $condition_parsed['values'] = array_map( 
                                                      function($item){
                                                         return [
                                                            'label' => strtoupper(trim($item['field'])), 
                                                            'value' => strtoupper(trim($item['field']))
                                                         ];
                                                      }, 
                                                      array_filter( 
                                                         $acquired_values, 
                                                         function($item) { 
                                                            return $item['field'] !== '' && $item['field'] !== ' '; 
                                                         }
                                                      )
                                                   );
                  }
                  break;

               default: break;
            }
            $conditionalGroup[] = $condition_parsed;
         }
               
         return [
            'code' => '200',
            'type' => 'success',
            'message' => 'OK',
            'data' => $conditionalGroup
         ];
      }
      return [
         'code' => '405',
         'type' => 'warning',
         'message' => 'Tipo de solicitud no aceptada',
         'data' => []
      ];
   }
}
                     