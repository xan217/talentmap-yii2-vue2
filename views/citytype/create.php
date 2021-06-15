<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Citytype */

$this->title = 'Create Citytype';
$this->params['breadcrumbs'][] = ['label' => 'Citytypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="citytype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
