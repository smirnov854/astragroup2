<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use unclead\multipleinput\MultipleInput;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ShipSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ships';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ship-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ship', ['create'], ['class' => 'btn btn-success']) ?>
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
            [
                'attribute' => 'ID',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a($data->ID, Url::to(['view', 'id' => $data->ID]));
                }
            ],

            'name',
            // 'code',
            // 'preview:ntext',
            // 'detail:ntext',
            //'info:ntext',
            //'cabin_info:ntext',
            //'food_info:ntext',
            //'Entertainment_Info:ntext',
            'type.name',
            [
                'attribute' => 'companyName',
                'filter' => ArrayHelper::map(\common\models\Company::find()->all(), 'name', 'name'),
            ],
            [
                'label' => 'картинка',
                'format' => 'raw',
                'value' => function($data){

                    if($data->image && $data->image->subdir && $data->image->name) {
                        $path = $data->image->subdir . "/" . $data->image->name;
                        return Html::img($path,[
                            'alt'=>'картинка',
                            'style' => 'width:58px;'
                        ]);
                    }
                    return 'noimage';
                },
            ],
            // 'image_id',
            //'gallery_id',
//            'meta.title',
//            'meta.description',
//            'meta.keywords',

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Edit',
                'template' => '{update}',
            ],
            [
                'attribute' => 'cabins',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a("Groups", Url::to(['categories', 'id' => $data->ID]));
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Del',
                'template' => '{delete}'
            ]
        ],
    ]); ?>
</div>