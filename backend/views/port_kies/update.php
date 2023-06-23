<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PortKies */

$this->title = 'Edit Port Kies: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Port Kies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="port-kies-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
