<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Gendertype */

$this->title = 'Update Gendertype: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Gendertypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->pk_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gendertype-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
