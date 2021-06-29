<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Userprofile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="userprofile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fk_t_blood_id')->textInput() ?>

    <?= $form->field($model, 'fk_t_civilStatus_id')->textInput() ?>

    <?= $form->field($model, 'fk_t_home_id')->textInput() ?>

    <?= $form->field($model, 'fk_t_transport_id')->textInput() ?>

    <?= $form->field($model, 'fk_t_smoker_id')->textInput() ?>

    <?= $form->field($model, 'fk_t_drinker_id')->textInput() ?>

    <?= $form->field($model, 'fk_t_gender_id')->textInput() ?>

    <?= $form->field($model, 'fk_t_employee_id')->textInput() ?>

    <?= $form->field($model, 'fk_address_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idCard')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'childNumber')->textInput() ?>

    <?= $form->field($model, 'livesAlone')->dropDownList([ 'SI' => 'SI', 'NO' => 'NO', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'ACTIVE' => 'ACTIVE', 'INACTIVE' => 'INACTIVE', 'DELETED' => 'DELETED', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
