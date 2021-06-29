<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Educationleveltype */

$this->title = 'Update Educationleveltype: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Educationleveltypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->pk_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="educationleveltype-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
