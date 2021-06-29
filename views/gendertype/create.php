<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Gendertype */

$this->title = 'Create Gendertype';
$this->params['breadcrumbs'][] = ['label' => 'Gendertypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gendertype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
