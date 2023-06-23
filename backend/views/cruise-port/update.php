<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CruisePort */

$this->title = 'Update Cruise Port: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Cruise Ports', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cruise-port-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
