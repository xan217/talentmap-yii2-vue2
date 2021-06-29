<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RelEducationlevelSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rel-educationlevel-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'pk_id') ?>

    <?= $form->field($model, 'fk_userprofile_id') ?>

    <?= $form->field($model, 'fk_educationLevel_id') ?>

    <?= $form->field($model, 'fk_educationStatus_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
