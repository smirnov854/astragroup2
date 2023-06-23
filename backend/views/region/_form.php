<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Region */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="region-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'info')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ],
    ]); ?>
    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'region_id')->dropdownList(
        \backend\models\Region::find()->select(['name', 'id'])->indexBy('id')->column(),
        ['prompt'=>'Не выбрано']
    ) ?>
    <?= $form->field($model, 'climat')->widget(\unclead\multipleinput\MultipleInput::className(), [
        'columns' => [

            [
                'name'  => 'date',
                'type'  => DatePicker::classname(),
                'title' => 'месяц',
                'value' => function($data) {
                    return $data['date'];
                },
                'items' => [
                    '0' => 'Saturday',
                    '1' => 'Monday'
                ],
                'options' => [
                    'pluginOptions' => [
                        'format' => 'mm.yyyy',
                        'todayHighlight' => true
                    ]
                ]
            ],
            [
                'name'  => 'temp',
                'type'  => 'textInput',
                'title' => 'температура',
            ],
            [
                'name'  => 'icon',
                'type'  => 'dropDownList',
                'title' => 'Значок',
                'defaultValue' => 'sun',
                'items' => [
                    'sun' => 'Солнечно',
                    'cloud' => 'Облачно',
                    'rain' => 'Дождливо',
                ]
            ]
        ]
    ]); ?>
    <?= $form->field($model->meta, 'title')->textInput() ?>
    <?= $form->field($model->meta, 'keywords')->textarea(['rows' => 6]) ?>
    <?= $form->field($model->meta, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
