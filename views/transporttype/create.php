<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Transporttype */

$this->title = 'Create Transporttype';
$this->params['breadcrumbs'][] = ['label' => 'Transporttypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transporttype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
