<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RelEducationlevel */

$this->title = 'Create Rel Educationlevel';
$this->params['breadcrumbs'][] = ['label' => 'Rel Educationlevels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rel-educationlevel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
