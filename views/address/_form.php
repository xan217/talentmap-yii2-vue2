<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Address */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="address-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fk_region_id')->textInput() ?>

    <?= $form->field($model, 'fk_city_id')->textInput() ?>

    <?= $form->field($model, 'streetType')->dropDownList([ 'CARRERA' => 'CARRERA', 'AUTOPISTA' => 'AUTOPISTA', 'CALLE' => 'CALLE', 'AVENIDA' => 'AVENIDA', 'CIRCULAR' => 'CIRCULAR', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'streetNumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'streetChar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'streetCardinal')->dropDownList([ 'NORTE' => 'NORTE', 'SUR' => 'SUR', 'ESTE' => 'ESTE', 'OESTE' => 'OESTE', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'intersectionNumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'intersectionChar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'intersectionCardinal')->dropDownList([ 'NORTE' => 'NORTE', 'SUR' => 'SUR', 'ESTE' => 'ESTE', 'OESTE' => 'OESTE', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'buildingNumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'complement')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'details')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
