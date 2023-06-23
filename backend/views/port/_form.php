<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\AutoComplete;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model backend\models\Port */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="port-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'name_en')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'lat')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'lon')->textInput(['maxlength' => true]) ?>
    <? /*=$form->field($model, 'coords', [
        'template' => '{label}<div class="custom-class"><div class="form-control">{input}</div>{map}</div>{error}',
    ])->widget(\kalyabin\maplocation\SelectMapLocationWidget::className(), [
        'attributeLatitude' => 'lat',
        'attributeLongitude' => 'lon',
        'googleMapApiKey' => 'AIzaSyAhm2J4c4D4cvCh8LnoLS3lSOPZofJpwHU',
    ]); */ ?>
    <?= $form->field($model, 'region_id')->dropdownList(
        \backend\models\Region::find()->select(['name', 'id'])->indexBy('id')->column(),
        ['prompt'=>'Не выбрано']
    ); ?>

    <?= $form->field($model, 'country_id')->dropdownList(
        \backend\models\Country::find()->select(['name', 'id'])->indexBy('id')->column(),
        ['prompt'=>'Не выбрано']
    ); ?>
    <?= $form->field($model, 'info')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ],
    ]); ?>
    <?= $form->field($model, 'excursion')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ],
    ]); ?>
    <?= $form->field($model, 'places')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ],
    ]); ?>

    <? /* = $form->field($model, 'info')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'excursion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'places')->textarea(['rows' => 6]) */ ?>
    <? //= $form->field($model->meta, 'title')->textInput() ?>
    <?= $form->field($model->meta, 'keywords')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'check')->checkbox(['label' => 'Проверено',
        'labelOptions' => [
            'style' => 'padding-left:20px;'
        ]
    ]) ?>
    <? //= $form->field($model->meta, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
