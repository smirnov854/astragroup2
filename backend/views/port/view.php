<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\jui\AutoComplete;
use yii\widgets\ActiveForm;
use backend\models\Port;
use yii\web\JsExpression;
use yii\grid\GridView;
use phpnt\yandexMap\YandexMaps;

/* @var $this yii\web\View */
/* @var $model backend\models\Port */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Ports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="port-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?if(!$model->check){?>
    <h3 style="color: red;">Внимание! Порт не проверен!</h3>
    <?}?>
    <p>
        <?= Html::a('Edit', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?if(!$model->check){
            print Html::a('Check', ['checking', 'id' => $model->ID], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => 'Are you sure you want check this item?',
                    'method' => 'post',
                ]
            ]);
        }?>
    </p>
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#main" data-toggle="tab">Порт</a>
        </li>
        <li>
            <a href="#cruises" data-toggle="tab">Круизы</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="main">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'ID',
                    'name',
                    'name_en',
                    'lat',
                    'lon',
                    'regionName',
                    'countryName',
                    // 'coords',
                    'info:ntext',
                    'excursion:ntext',
                    'places:ntext',
                    [
                        'attribute' => 'coords',
                        'value' => function($data){
                            if(!$data->coords) return '';
                            $items = [
                                [
                                    'latitude' => $data->lat,
                                    'longitude' => $data->lon,//59.954092,
                                    'options' => [
                                        [
                                            'hintContent' => $data->name,
                                            'balloonContentHeader' => $data->name,
                                        ],
                                        [
                                            'preset' => 'islands#icon',
                                            'iconColor' => '#19a111'
                                        ]
                                    ]
                                ]
                            ];
                            return YandexMaps::widget([
                                'myPlacemarks'          => $items,
                                'mapOptions'            => [
                                    'center'            => [$data->lat, $data->lon],                                                // центр карты
                                    'zoom'              => 6,                                                    // показывать в масштабе
                                    'controls'          => ['zoomControl'],  // использовать эл. управления
                                    'control'           => [
                                        'zoomControl'   => [                                                        // расположение кнопок управлением масштабом
                                            'top'       => 75,
                                            'left'      => 5
                                        ],
                                    ],
                                ],
                                'disableScroll'         => true,                                                    // отключить скролл колесиком мыши (по умолчанию true)
                                'windowWidth'           => '100%',                                                  // длинна карты (по умолчанию 100%)
                                'windowHeight'          => '400px',                                                 // высота карты (по умолчанию 400px)
                            ]);
                        },
                        'format'=>'raw',
                    ],
                    // 'meta.title',
                    'meta.keywords',
                    // 'meta.description',
                ],
            ]) ?>
        </div>
        <div class="tab-pane" id="cruises">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => false,
                'columns' => [
                    [
                        'attribute' => 'ID',
                        'value' => function ($data) {
                            return Html::a(Html::encode($data->ID), Url::to(['cruise/view', 'id' => $data->ID]),[
                                'target' => '_blank'
                            ]);
                        },
                        'format' => 'raw',
                    ],
                    'name',
                    'companyName',
                    'regionName'
                ],
            ]); ?>
        </div>
    </div>
    <?if(!$model->check) {
//        $data = \common\models\Port::find()
//            ->select(['ID as value', 'name as label'])
//            ->where(['check'=>1])
//            ->asArray()
//            ->all();
        $form = ActiveForm::begin([
            'action' => ['port/change','id' => $model->ID],
        ]);
        ?>
        <pre style="display: none">
            <?
            $arPorts = \common\models\Port::find()
//                ->select()
                ->where(['check'=>1])
                ->with('country')
                ->with('region')
                ->asArray()
                ->all();
            foreach($arPorts as &$port) {
                $port=[
                    "value" => $port["ID"],
                    "label"=>$port["name"].", ".$port["country"]["name"].", ".$port["region"]["name"]
                ];
            }
            //            print_r($arPorts);
            //            print_r($data);
            ?>
        </pre>
        <h4>Для выбора правильного порта, начните набирать его название:</h4>
        <div class="form-group">
            <p>
                <?= AutoComplete::widget([
                    'name' => 'new_port',
                    'clientOptions' => [
                        'source' => $arPorts,
                        'select' =>new JsExpression("function(event, ui) {
                        console.log(event);
                        $('#newid').val(ui.item.value);
                        $(event.target).val(ui.item.label);
                        return false;
                    }")
                    ],
                    'options'=>[
                        'class'=>'form-control'
                    ]
                ]);
                ?>
            </p>
            <?=Html::hiddenInput('new_id',"",["id"=>"newid"])?>
            <?= Html::submitButton('Change', ['class' => 'btn btn-success','data' => [
                'confirm' => 'Are you sure you want change this port? Current Port will be delete',
            ]]) ?>
        </div>
        <?php ActiveForm::end();
    }?>
</div>
