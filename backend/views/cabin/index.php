<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CabinSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cabins';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cabin-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cabin', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'name',
            'code',
            ['attribute' => 'ShipName','label' => 'Судно', 'value'=>'ship.name'],
            [
                'label' => 'Фото',
                'format' => 'raw',
                'value' => function($data){
                    if($data->image) {
                        return Html::img( $data->image->src, [
                            'alt' => 'картинка',
                            'style' => 'width:58px;'
                        ]);
                    }
                    else return "no_image";
                },
            ],
            'capacity',
            //'image_id',
            //'gallery_id',
            //'cabin_loc_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
