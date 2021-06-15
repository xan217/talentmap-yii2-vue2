<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RelLanguages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rel-languages-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fk_userprofile_id')->textInput() ?>

    <?= $form->field($model, 'fk_language_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
