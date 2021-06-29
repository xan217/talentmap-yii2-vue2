<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Civilstatustype */

$this->title = 'Create Civilstatustype';
$this->params['breadcrumbs'][] = ['label' => 'Civilstatustypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="civilstatustype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
