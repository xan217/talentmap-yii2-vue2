<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Hometype */

$this->title = 'Create Hometype';
$this->params['breadcrumbs'][] = ['label' => 'Hometypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hometype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
