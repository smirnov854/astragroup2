<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PortSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ports';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="port-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Port', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
            'firstPageLabel' => 'First',
            'lastPageLabel'  => 'Last'
        ],
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            'ID',
            'name',
            'name_en',
            ['attribute' => 'RegionName','label' => 'Регион', 'value'=>'region.name'],
            ['attribute' => 'CountryName','label' => 'Страна', 'value'=>'country.name'],
            //'info:ntext',
            //'excursion:ntext',
            //'places:ntext',
            // 'meta.keywords',
            ['class' => 'yii\grid\ActionColumn'],
            'check'
        ],
    ]); ?>
</div>
