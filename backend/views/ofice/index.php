<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OficeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ofices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ofice-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ofice', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'name',
            'time:ntext',
            'addr:ntext',
            'map',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
