<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model backend\models\Cruise */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cruise-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'region_id')->dropdownList(
        \backend\models\Region::find()->select(['name', 'id'])->indexBy('id')->column(),
        ['prompt'=>'Не выбрано']
    ); ?>

    <?= $form->field($model, 'company_id')->dropdownList(
        \backend\models\Company::find()->select(['name', 'id'])->indexBy('id')->column(),
        ['prompt'=>'Не выбрано']
    ) ?>

    <?= $form->field($model, 'ship_id')->dropdownList(
        \backend\models\Ship::find()->select(['name', 'id'])->indexBy('id')->column(),
        ['prompt'=>'Не выбрано']
    ) ?>

    <?= $form->field($model, 'port_id')->dropdownList(
        \backend\models\Port::find()->select(['name', 'id'])->indexBy('id')->column(),
        ['prompt'=>'Не выбрано']
    ) ?>

<!--    --><?//= $form->field($model, 'group_id')->dropdownList(
//        \common\models\Group::find()->select(['name', 'id'])->indexBy('id')->column(),
//        ['prompt'=>'Не выбрано']
//    ) ?>

    <?= $form->field($model, 'departure_date')->widget(DatePicker::classname(), ['options' => ['placeholder' => 'Select issue date ...'],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
        ]]) ?>
    <?
//    DatePicker::widget([
//        'name' => 'check_issue_date',
//        'value' => date('d-M-Y', strtotime('+2 days')),
//        'options' => ['placeholder' => 'Select issue date ...'],
//        'pluginOptions' => [
//            'format' => 'dd-mm-yyyy',
//            'todayHighlight' => true
//        ]
//    ])

    ?>

    <?= $form->field($model, 'cruise_length')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'min_price')->textInput() ?>

    <?= $form->field($model, 'useful_info')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ],
    ]); ?>

    <?= $form->field($model, 'tagNames')->widget(\dosamigos\selectize\SelectizeTextInput::className(), [
        // calls an action that returns a JSON object with matched
        // tags
        'loadUrl' => ['tag/list'],
        'options' => ['class' => 'form-control'],
        'clientOptions' => [
            'plugins' => ['remove_button'],
            'valueField' => 'name',
            'labelField' => 'name',
            'searchField' => ['name'],
            'create' => true,
        ],
    ])->hint('Use commas to separate tags') ?>

    <?= $form->field($model->meta, 'title')->textInput() ?>
    <?= $form->field($model->meta, 'keywords')->textarea(['rows' => 6]) ?>
    <?= $form->field($model->meta, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
