<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RelLanguages */

$this->title = 'Create Rel Languages';
$this->params['breadcrumbs'][] = ['label' => 'Rel Languages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rel-languages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
