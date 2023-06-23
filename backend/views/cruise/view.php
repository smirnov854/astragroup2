<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;
$isPage=Yii::$app->request->get('page');
$isPage1=Yii::$app->request->get('dp-1-page');
/* @var $this yii\web\View */
/* @var $model backend\models\Cruise */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cruises', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="cruise-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Edit', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <ul class="nav nav-tabs">
        <li<?if(!$isPage && !$isPage1){?> class="active"<?}?>>
            <a href="#main" data-toggle="tab">Круиз</a>
        </li>
        <li<?if($isPage){?> class="active"<?}?>>
            <a href="#route" data-toggle="tab">Маршрут</a>
        </li>
        <li<?if($isPage1){?> class="active"<?}?>>
            <a href="#price" data-toggle="tab">Цены</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane<?if(!$isPage && !$isPage1){?> active<?}?>" id="main">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'ID',
                    'name',
//                    'companyTypeName',
                    'regionName',
                    'companyName',
                    'shipName',
                    'portName',
                    'departure_date',
                    'cruise_length',
                    'min_price',
                    'tagNames',
                    'useful_info:ntext',
                    'meta.title',
                    'spec_date',
                    'special.name',
                    'vender',
                ],
            ]) ?>
        </div>
        <div class="tab-pane<?if($isPage){?> active<?}?>" id="route">
            <?= GridView::widget([
                'dataProvider' => $routeProvider,
                'filterModel' => false,
                'columns' => [
                    'day',
                    [
                        'attribute' => 'ID',
                        'format' => 'raw',
                        'value' => function ($data) {
                            $obPort = \common\models\Port::findOne($data->port_id);
                            if(!$obPort) return null;
                            return "<span style=\"background-color: ".($obPort->check?"green":"red").";display: inline-block;width: 15px;height: 15px;border-radius: 50%;margin: 0px 6px 0 0;line-height: 1;\">&nbsp;</span>".
                            Html::a($data->portName, Url::to(['port/view', 'id' => $data->port_id]),[
                                'target' => '_blank'
                            ]);
                        }
                    ],
                    'date',
                    'arrival',
                    'departure',
                    //'info:ntext',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header'=>'Edit',
                        'controller'=>'cruisePort',
                        'buttonOptions'=>["target"=>"_blank"],
                        'template' => '{update}',
                    ]
                ],
            ]); ?>
        </div>
        <div class="tab-pane<?if($isPage1){?> active<?}?>" id="price">
            <?= GridView::widget([
                'dataProvider' => $priceProvider,
                'filterModel' => false,
                'columns' => [
                    [
                        'attribute' => 'ID',
                        'format' => 'raw',
                        'value' => function ($data) {
                            return Html::a($data->ID, Url::to(['price/view', 'id' => $data->ID]),[
                                'target' => '_blank'
                            ]);
                        }
                    ],
                    [
                        'attribute' => 'cabin_id',
                        'format' => 'raw',
                        'value' => function ($data) {
                            $obCabin = \common\models\Cabin::findOne($data->cabin_id);
                            return Html::a($obCabin->code . ", " . $obCabin->name, Url::to(['cabin/view', 'id' => $data->cabin_id]),[
                                'target' => '_blank'
                            ]);
                        }
                    ],
                    'value',
                    'currency',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header'=>'Edit',
                        'controller'=>'cruisePort',
                        'buttonOptions'=>["target"=>"_blank"],
                        'template' => '{update}',
                    ]
                ],
            ]); ?>
        </div>
    </div>
</div>
