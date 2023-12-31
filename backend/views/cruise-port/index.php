<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CruisePortSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cruise Ports';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cruise-port-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cruise Port', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'port_id',
            'cruise_id',
            'arrival',
            'departure',
            //'info:ntext',
            //'date',
            //'day',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
