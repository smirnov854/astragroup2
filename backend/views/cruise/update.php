<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Cruise */

$this->title = 'Edit Cruise: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cruises', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="cruise-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
