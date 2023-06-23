<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\CruisePort */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Cruise Ports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cruise-port-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Edit', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID',
            'port_id',
            'cruise_id',
            'arrival',
            'departure',
            'info:ntext',
            'date',
            'day',
        ],
    ]) ?>

</div>
