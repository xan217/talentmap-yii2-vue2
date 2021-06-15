<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Smokertype */

$this->title = 'Create Smokertype';
$this->params['breadcrumbs'][] = ['label' => 'Smokertypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="smokertype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
