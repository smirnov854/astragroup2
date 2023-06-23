<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CruiseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cruises';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cruise-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cruise', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php // $form = ActiveForm::begin(['action'=>['special/create'], 'method'=>"post"]); ?>
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
//            [
//                'class' => 'yii\grid\CheckboxColumn',
//            ],
            [
                'attribute' => 'check',
                'filter' => ['нет', 'да'],
                'value' => function ($model, $key, $index, $column) {
                    $active = $model->{$column->attribute} === 1;
                    return $active ? 'Да' : 'Нет';
                }
            ],
//            'name',
            [
                'attribute' => 'departure_date',
                'value' => 'departure_date',
                'filter' => \yii\jui\DatePicker::widget([
                    'model'=>$searchModel,
                    'attribute'=>'departure_date',
                    'language' => 'ru',
                    'dateFormat' => 'yyyy-MM-dd',
                ]),
                'format' => 'html',
            ],
            'cruise_length',
            'shipName',
            [
                'attribute' => 'company_id',
                'filter' => ArrayHelper::map(\common\models\Company::find()->all(), 'ID', 'name'),
                'value' => function ($model, $key, $index, $column) {
                    $company = \common\models\Company::findOne($model->{$column->attribute});
                    if($company && $company->name) return $company->name;
                    return null;
                }
            ],
//            'companyType.name',
            [
                'attribute' => 'typeId',
                'filter' => ArrayHelper::map(\common\models\CompanyType::find()->all(), 'ID', 'name'),
                'value' => function ($model, $key, $index, $column) {
                    $companyType = \common\models\CompanyType::findOne($model->{$column->attribute});
                    if($companyType && $companyType->name) return $companyType->name;
                    return null;
                }
            ],
            [
                'attribute' => 'regionName',
                'filter' => ArrayHelper::map(\common\models\Region::find()->all(), 'name', 'name'),
            ],
            'portName',
            // 'group_id',
            'min_price',
            //'useful_info:ntext',
            //'meta_id',
            //'spec_date',
            //'special_id',
            //'vender',
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
    ]);
   // print_r(ArrayHelper::map(\common\models\Special::find()->all(),"ID","name"));
    ?>
    <?// = Html::submitButton('Новая акция', ['class' => 'btn btn-success']) или привязать к существующей: ?>
    <?// = Html::dropDownList("special_id", "", ArrayHelper::map(\common\models\Special::find()->all(),'ID','name'))?>
    <?// = Html::submitButton('Привязать', ['class' => 'btn btn-success']) ?>
    <?// php ActiveForm::end(); ?>
    <? // =Html::input("button","special","новое предложение",["id"=>"special",'class' => 'btn btn-success'])?>
</div>
<!--<script>-->
<!--    document.addEventListener("DOMContentLoaded", function(event) {-->
<!--        $("#special").on("click", function(e){-->
<!--            e.preventDefault()-->
<!--            var keys = $("#grid").yiiGridView("getSelectedRows");-->
<!--            console.log(keys);-->
<!--        });-->
<!--    });-->
<!---->
<!--</script>-->
