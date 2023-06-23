<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ShipType */

$this->title = 'Update Ship Type: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Ship Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ship-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
