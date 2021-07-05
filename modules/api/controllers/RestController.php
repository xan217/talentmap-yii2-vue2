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
   /**
   * List of allowed domains.
   * Note: Restriction works only for AJAX (using CORS, is not secure).
   *
   * @return array List of domains, that can access to this API
   */
   public static function allowedDomains()
   {
      return [
         'http://localhost:8080',
      ];
   }
   
   /**
   * @inheritdoc
   */
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
   
   private function params() {
      return \Yii::$app->params['constraints'];
   }
   
   /**
   * List of allowed domains.
   * Note: Restriction works only for AJAX (using CORS, is not secure).
   *
   * @param selects string or array of strings
   * @param distinct boolean
   * @param from string name of table
   * @param joins object( type, table, condition )
   * @param wheres array of strings
   * @param orderBy array of object( order, type )
   * @param groupBy arrray of object( group )
   * @return array List of domains, that can access to this API
   */
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
         sizeof( $selects ) == 1
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
      
      if( $wheres !== null ) {
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
            
            $condition_parsed = [
               'id'     => $key,
               'field'  => $condition['table'],
               'label'  => $condition['name'],
               'type'   => $condition['type'],
               'values' => []
            ];
            
            switch($condition['type']){
               case 'STC': 
                  $condition_parsed['values'] = $condition['values'];
                  
                  break;
                  
               case 'ACQ':
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
                     $acquired_values = self::buildQuery( $selects, false, $table, null, null, $orderBy, null );
                     $acquired_values = $acquired_values->all();
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
                     $acquired_values = self::buildQuery( $selects, false, $table, null, null, $orderBy, null );
                     $acquired_values = $acquired_values->all();
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
               case 'DEP': 
                  $condition_parsed['requirements'] = $condition['required_tables'];
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

   public function actionGetSubcondition() {
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      
      if( \Yii::$app->request->isGet ){
         $params = self::params();
         $tableFrom = \Yii::$app->request->getBodyParam('table');

         $subcondition = array_filter($params, function( $param ) {
            return $param->table === $tableFrom;
         });

         $select = '*';
         $from = $subcondition['required_tables']['table'];
         $where = $subcondition['required_tables']['condition'];
         
         $rows = self::buildQuery( $select, false, $from, null, $where, null, null );
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
               
   public function actionGetQty()
   {
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
               $constraintGroup
            );
               
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
                                 