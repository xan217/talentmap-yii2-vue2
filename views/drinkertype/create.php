<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Drinkertype */

$this->title = 'Create Drinkertype';
$this->params['breadcrumbs'][] = ['label' => 'Drinkertypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="drinkertype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
