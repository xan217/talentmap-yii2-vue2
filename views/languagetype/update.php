<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Languagetype */

$this->title = 'Update Languagetype: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Languagetypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->pk_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="languagetype-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
