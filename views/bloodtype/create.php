<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bloodtype */

$this->title = 'Create Bloodtype';
$this->params['breadcrumbs'][] = ['label' => 'Bloodtypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bloodtype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
