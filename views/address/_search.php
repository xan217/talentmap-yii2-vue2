<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AddressSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="address-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'pk_id') ?>

    <?= $form->field($model, 'fk_region_id') ?>

    <?= $form->field($model, 'fk_city_id') ?>

    <?= $form->field($model, 'streetType') ?>

    <?= $form->field($model, 'streetNumber') ?>

    <?php // echo $form->field($model, 'streetChar') ?>

    <?php // echo $form->field($model, 'streetCardinal') ?>

    <?php // echo $form->field($model, 'intersectionNumber') ?>

    <?php // echo $form->field($model, 'intersectionChar') ?>

    <?php // echo $form->field($model, 'intersectionCardinal') ?>

    <?php // echo $form->field($model, 'buildingNumber') ?>

    <?php // echo $form->field($model, 'complement') ?>

    <?php // echo $form->field($model, 'details') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
