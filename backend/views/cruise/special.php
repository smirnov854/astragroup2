<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use \yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CruiseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cruises';
$this->params['breadcrumbs'][] = $this->title;
$cruiseSearch = Yii::$app->request->get('CruiseSearch');
?>
<div class="cruise-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cruise', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php $filter = ActiveForm::begin(['action'=>['cruise/special'], 'method'=>"get"]); ?>
        <?= $filter->field($searchModel, 'departure_date')->widget(DatePicker::classname(),
            [
                'options' => ['placeholder' => 'Дата отправления лайнера','class'=>'form-control'],
                'dateFormat' => 'yyyy-MM-dd',
                'language' => 'ru'
            ])
        ?>
        <?= $filter->field($searchModel, 'cruise_length')->textInput(['type' => 'number'])?>

        <?= $filter->field($searchModel, 'company_id')->dropdownList(
            \backend\models\Company::find()->select(['name', 'id'])->indexBy('id')->column(),
            ['prompt'=>'Не выбрано']
        ) ?>

        <? $company_id = $cruiseSearch["company_id"]?$cruiseSearch["company_id"]:false;
        if($company_id) {
            print $filter->field($searchModel, 'ship_id')->dropdownList(
                \backend\models\Ship::find()->where(["company_id"=>$company_id])->select(['name', 'id'])->indexBy('id')->column(),
                ['prompt'=>'Не выбрано']
            );
        } ?>

        <?= $filter->field($searchModel, 'region_id')->dropdownList(
            \backend\models\Region::find()->select(['name', 'id'])->indexBy('id')->column(),
            ['prompt'=>'Не выбрано']
        ); ?>

        <? $region_id = $cruiseSearch["region_id"];
        if($region_id) {
            print $filter->field($searchModel, 'port_id')->dropdownList(
                \backend\models\Port::find()->select(['name', 'id'])->indexBy('id')->column(),
                ['prompt'=>'Не выбрано']
            );
        }
         ?>

        <div class="form-group">
            <?= Html::submitButton('Find', ['class' => 'btn btn-success']) ?>
        </div>
    <?php ActiveForm::end(); ?>

    <?php $form = ActiveForm::begin(['action'=>['special/create'], 'method'=>"post"]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'ID',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a($data->ID, Url::to(['view', 'id' => $data->ID]));
                },
                'filter' => false
            ],
            [
                'class' => 'yii\grid\CheckboxColumn',
            ],
            [
                'attribute' => 'name',
                'filter' => false
            ],
            [
                'attribute' => 'departure_date',
                'value' => 'departure_date',
                'filter' => false,
                'format' => 'html',
                'filter' => false
            ],
            [
                'attribute' =>'cruise_length',
                'filter' => false
            ],
            [
                'attribute' =>'shipName',
                'filter' => false
            ],
            [
                'attribute' => 'companyName',
                'filter' => false,
            ],
//            'companyType.name',
            [
                'attribute' => 'typeId',
                'filter' => false,
                'value' => function ($model, $key, $index, $column) {
                    $companyType = \common\models\CompanyType::findOne($model->{$column->attribute});
                    if($companyType && $companyType->name) return $companyType->name;
                    return null;
                }
            ],
            [
                'attribute' => 'regionName',
                'filter' => false,
            ],
            [
                'attribute' => 'portName',
                'filter' => false,
            ],
            // 'group_id',
            // 'min_price',
            //'useful_info:ntext',
            //'meta_id',
            //'spec_date',
            //'special_id',
            //'vender',
        ],
    ]); ?>
    <?= Html::submitButton('Новая акция', ['class' => 'btn btn-success']) ?> или привязать к существующей:
    <?= Html::dropDownList("special_id", "", ArrayHelper::map(\common\models\Special::find()->all(),'ID','name'))?>
    <?= Html::Button('Привязать', ['class' => 'btn btn-success', 'onclick' => "toupdate();"]) ?>
    <?php ActiveForm::end(); ?>
    <script>
        function toupdate() {
            console.log($('[name=special_id]').val());
            $('form#w1').attr('action','/admin/special/update?id='+$('[name=special_id]').val());
            $('form#w1').submit();
            return false;
        }
    </script>
    <? // =Html::input("button","special","новое предложение",["id"=>"special",'class' => 'btn btn-success'])?>
</div>