<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Ship */

$this->title = 'Edit Ship: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Ships', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="ship-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?=Html::a("Groups", \yii\helpers\Url::to(['categories', 'id' => $model->ID]),['class' => 'btn btn-primary']);?>
    <br>
    <br>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
