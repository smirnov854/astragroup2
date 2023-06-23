<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CruiseGroup */

$this->title = 'Edit Cruise Group: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cruise Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="cruise-group-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
