<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Smokertype */

$this->title = 'Update Smokertype: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Smokertypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->pk_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="smokertype-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
