<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Educationleveltype */

$this->title = 'Create Educationleveltype';
$this->params['breadcrumbs'][] = ['label' => 'Educationleveltypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="educationleveltype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
