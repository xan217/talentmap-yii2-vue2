<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Languagetype */

$this->title = 'Create Languagetype';
$this->params['breadcrumbs'][] = ['label' => 'Languagetypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="languagetype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
