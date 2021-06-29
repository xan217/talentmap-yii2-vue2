<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RelEducationlevel */

$this->title = 'Update Rel Educationlevel: ' . $model->pk_id;
$this->params['breadcrumbs'][] = ['label' => 'Rel Educationlevels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pk_id, 'url' => ['view', 'id' => $model->pk_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rel-educationlevel-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
