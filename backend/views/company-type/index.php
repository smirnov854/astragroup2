<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CompanyTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Company Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-type-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Company Type', ['create'], ['class' => 'btn btn-success']) ?>
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
            'name',
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
