<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Employeetype */

$this->title = 'Create Employeetype';
$this->params['breadcrumbs'][] = ['label' => 'Employeetypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employeetype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
