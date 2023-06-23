<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Page', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'ID',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a($data->ID, Url::to(['view', 'id' => $data->ID]));
                }
            ],
            'title',
            'alias',
            // 'description:ntext',
            /*
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
            */
            //'gallery_id',
            //'meta_id',

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
