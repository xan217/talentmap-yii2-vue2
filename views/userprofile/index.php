<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserprofileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Userprofiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="userprofile-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Userprofile', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'pk_id',
            'fk_t_blood_id',
            'fk_t_civilStatus_id',
            'fk_t_home_id',
            'fk_t_transport_id',
            //'fk_t_smoker_id',
            //'fk_t_drinker_id',
            //'fk_t_gender_id',
            //'fk_t_employee_id',
            //'fk_address_id',
            //'name',
            //'lastname',
            //'idCard',
            //'childNumber',
            //'livesAlone',
            //'status',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
