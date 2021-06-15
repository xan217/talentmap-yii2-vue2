<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserprofileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="userprofile-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'pk_id') ?>

    <?= $form->field($model, 'fk_t_blood_id') ?>

    <?= $form->field($model, 'fk_t_civilStatus_id') ?>

    <?= $form->field($model, 'fk_t_home_id') ?>

    <?= $form->field($model, 'fk_t_transport_id') ?>

    <?php // echo $form->field($model, 'fk_t_smoker_id') ?>

    <?php // echo $form->field($model, 'fk_t_drinker_id') ?>

    <?php // echo $form->field($model, 'fk_t_gender_id') ?>

    <?php // echo $form->field($model, 'fk_t_employee_id') ?>

    <?php // echo $form->field($model, 'fk_address_id') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'lastname') ?>

    <?php // echo $form->field($model, 'idCard') ?>

    <?php // echo $form->field($model, 'childNumber') ?>

    <?php // echo $form->field($model, 'livesAlone') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
