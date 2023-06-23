<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ReviewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reviews';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="review-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Review', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'ID',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a($data->ID, Url::to(['view', 'id' => $data->ID]));
                }
            ],
            'title',
//            'description:ntext',
            [
                'attribute' => 'user_id',
                'value' => 'userName',
                'filter' => ArrayHelper::map(\common\models\Users::find()->all(), 'id', 'username'),
            ],
            [
                'attribute' => 'cruise_id',
                'value' => 'cruiseName',
            ],
            [
                'attribute' => 'ship_id',
                'value' => 'shipName',
            ],
            [
                'attribute' => 'region_id',
                'value' => 'regionName',
                'filter' => ArrayHelper::map(\common\models\Region::find()->all(), 'ID', 'name'),
            ],
            [
                'attribute' => 'service',
                'filter' => [1,2,3,4,5],
            ],
            [
                'attribute' => 'ship',
                'filter' => [1,2,3,4,5],
            ],
            [
                'attribute' => 'ofice',
                'filter' => [1,2,3,4,5],
            ],
            [
                'attribute' => 'programms',
                'filter' => [1,2,3,4,5],
            ],
            [
                'attribute' => 'food',
                'filter' => [1,2,3,4,5],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Edit',
                'template' => '{update}',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Del',
                'template' => '{delete}'
            ]
        ],
    ]); ?>
</div>
