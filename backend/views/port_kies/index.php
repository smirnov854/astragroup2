<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PortKiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Port Kies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="port-kies-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Port Kies', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'port_id',
            'keyword',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
