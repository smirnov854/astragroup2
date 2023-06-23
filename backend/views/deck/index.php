<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DeckSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Decks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deck-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Deck', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'number',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a($data->ID, \yii\helpers\Url::to(['view', 'id' => $data->ID]));
                }
            ],
            'name',
            'shipName',
            //'description:ntext',
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
