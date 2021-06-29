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

   private function buildQuery( 
      array $selects = null, 
      bool $distinct = false, 
      string $from = null, 
      array $joins = null, 
      array $wheres = null, 
      array $orderBy = null,
      array $groupBy = null
   ){
      $params = self::params();

      $baseQuery = new Query;
      if( $selects !== null ) {
         sizeof( $selects = 1 )
            ? $baseQuery->select( $selects[0] )
            : $baseQuery->select( implode(' , ', $selects) );
      }

      if( $from === null ){
         $baseQuery->from( $params['base_table']['name'] );
         if( sizeof( $params['base_table_requirements']['tables']) > 0 ){
            foreach( $params['base_table_requirements']['tables'] as $tableKey => $tableDetails ) {
               $baseQuery->join(
                  'LEFT JOIN', 
                  $tableDetails['name'], 
                  $tableDetails['name'].'.'.$tableDetails['fk'].' = '.$params['base_table']['name'].'.'.$params['base_table']['pk'].'');   
            }
         }
         if( sizeof( $params['base_table_requirements']['constraints']) > 0 ){
            foreach ( $params['base_table_requirements']['constraints'] as $constraintKey => $constraintDetails) {
               $baseQuery->where( $constraintDetails['table'].'.'.$constraintDetails['field'].' '.$constraintDetails['condition'].' "'.$constraintDetails['value'].'"' );
            }
         }
      }
      else{
         $baseQuery->from( $from );
      }

      if( $joins !== null ){
         foreach( $joins as $key => $join ){
            $baseQuery->join( $join['type'], $join['table'], $join['condition'] );
         }
      }
      
      if( $where !== null ) {
         foreach( $wheres as $key => $where ){
            $baseQuery->where( $where );
         }
      }

      if( $orderBy !== null ){
         foreach ($orderBy as $key => $ordering) {
            $baseQuery->orderBy( $ordering['order'], $ordering['type'] );
         }
      }
      
      if( $groupBy !== null ){
         foreach ($groupBy as $key => $grouping) {
            $baseQuery->groupBy( $grouping['group'] );
         }
      }

      return $baseQuery;
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
                     $selects = [
                        $condition['table'].'.'.$condition['field'].' as field',
                        $condition['table'].'.'.$condition['pk'].' as pk'
                     ];
                     $table = $condition['table'];
                     $orderBy = [
                        [ 
                           'order' => $condition['table'].'.'.$condition['field'], 
                           'type'=> 'ASC' 
                        ]
                     ];
                     $acquired_values = self::buildQuery( $selects, false, $table, null, null, $orderBy, null )->all();
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
                     // #TODO: Define process when the values needs to be retrieved
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

   public function actionGetQty(){
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

      if( \Yii::$app->request->isGet ){
         $params = self::params();
         
         $select = 'count(*) as qty';
         $rows = self::buildQuery( $select, null, true, null, null );
         $data = $rows->all();

         if( sizeOf($data) == 0 ){
            return [
               'code' => '204',
               'type' => 'warning',
               'message' => 'Ningún dato encontrado',
               'data' => []
            ];
         }
         return [
            'code' => '200',
            'type' => 'success',
            'message' => 'OK',
            'data' => $data[0]
         ];
      }
      return [
         'code' => '405',
         'type' => 'warning',
         'message' => 'Tipo de solicitud no aceptada',
         'data' => []
      ];
   }

   public function actionGetGroups(){
      Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

      if( Yii::$app->request->isPost ){
         $req = Yii::$app->request->post();

         if(sizeof($req) == 0){ 
            return [
               'code' => '400',
               'type' => 'warning',
               'data' => [
                  'message' => 'No se definieron grupos de condiciones'
               ]
            ];
         }
         $data = [];

         foreach ($req as $constraintKey => $constraintGroup) {
            $selects = implode( ', ', $params['node_info'] );
            $wheres = array_map( 
                        function($constraint){
                           return array_keys( $constraint )[0].'.name = '.$constraint['name'];
                        },
                        $constraintGroup);
               
            $joins = [];
            foreach( $constraintGroup as $key => $constraint ){
               $join = array_filter(
                  $params['conditions'], 
                  function($condition){
                     return $condition['table'] === $key;
                  }
               )[0];
               $joins[] = [
                  'type' => 'LEFT JOIN',
                  'table' => $join['table'],
                  'condition' => $join['join']
               ];
            }
            $data[] = self::buildQuery( $select, true, null, null, $wheres, null, null )->all();
         }
         return [
            'code' => '200',
            'type' => 'success',
            'message' => 'OK',
            'data' => $data
         ];
      }
      return [
         'code' => '405',
         'type' => 'warning',
         'message' => 'Tipo de solicitud no aceptada',
         'data' => []
      ];
   }

   public function actionGetGraphics(){
      Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

      if( Yii::$app->request->isPost ){
         $params = self::params();
         $req = Yii::$app->request->post();

         if(sizeof($req) == 0){ 
            return [
               'code' => '400',
               'type' => 'warning',
               'data' => [
                  'message' => 'No se definieron grupos de condiciones'
               ]
            ];
         }
         $data = [];

         $selects = [ 'name' ];
         $orderBy = [
            'order' => $req.'.name',
            'type' => 'ASC'
         ];
         $groupBy = [ $req.'.name' ];
         $values = self::buildQuery( $selects, false, $req, null, null, $orderBy, null )->all();
         
         foreach ($values as $key => $value) {
            $selects = [ 'count(*)' ];
            $where = [
               $req.'.name = '.$value['name']
            ];
            $conditionJoin = array_filter(
                                 $params, 
                                 function($condition){
                                    return $condition['table'] == $req; 
                                 }
                              );
            $join = [
               'type' => 'LEFT JOIN',
               'table' => $req,
               'condition' => $conditionJoin[0]['join']
            ];

            $qty = self::buildQuery( $selects, true, null, $join, $where, $orderBy, $groupBy )->all();
            $data[] = [ $value['name'] => $qty ];
         }
         return [
            'code' => '200',
            'type' => 'success',
            'message' => 'OK',
            'data' => $data
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
                     