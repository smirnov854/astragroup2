<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
$dataProvider->setSort([
	'attributes' => [
		'ID' => [
			'asc' => ['ID' => SORT_ASC],
			'desc' => ['ID' => SORT_DESC],
			'label' => 'ID',
			'default' => SORT_DESC
		]
	],
	'defaultOrder' => ['ID' => SORT_DESC]
]);
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            [
                'attribute' => 'ID',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a($data->ID, \yii\helpers\Url::to(['view', 'id' => $data->ID]));
                }
            ],
//            'bookid',
            'status_id',
	        'create',
//            'user_id',
//            'manager_id',
            [
                'attribute' => 'cruise_id',
                'format' => 'raw',
                'value' => function ($data) {
//                    return Html::a($data->cruise_id, \yii\helpers\Url::to(['cruise/view', 'id' => $data->cruise_id]));
                    return Html::a($data->cruise_id, \yii\helpers\Url::to('https://astartagroup.ru/cruise/'. $data->cruise_id . '/'));
                }
            ],
            //'cabin_id',
			[
				'attribute' => 'cabin_id',
				'format' => 'raw',
				'value' => function ($data) {
					return Html::a($data->cabin_id, \yii\helpers\Url::to(['cabin/view', 'id' => $data->cabin_id]));
				}
			],
            'cabin.code',
            'fio',
            'phone',
            'email',
            'commet',
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
