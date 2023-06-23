<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CruiseGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cruise Groups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cruise-group-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cruise Group', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'name',
            'description:ntext',
            'image_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
