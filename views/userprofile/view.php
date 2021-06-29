<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Userprofile */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Userprofiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="userprofile-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pk_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pk_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pk_id',
            'fk_t_blood_id',
            'fk_t_civilStatus_id',
            'fk_t_home_id',
            'fk_t_transport_id',
            'fk_t_smoker_id',
            'fk_t_drinker_id',
            'fk_t_gender_id',
            'fk_t_employee_id',
            'fk_address_id',
            'name',
            'lastname',
            'idCard',
            'childNumber',
            'livesAlone',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
