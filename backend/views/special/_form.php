<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Special */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="special-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>
    <?= $form->field($model, 'cruisesList')->textInput() ?>
    <?= $form->field($model, 'info')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ],
    ]); ?>

    <? /*
    $cropHeight = 540;
    $cropHeight2 = $cropHeight;
    $cropWidth = 720;

    ?>
    <? =$form->field($model, 'image')->widget(\bupy7\cropbox\CropboxWidget::className(), [
        'croppedDataAttribute' => 'crop_info',
        'pluginOptions'=>[
            'variants' => [
                [
                    'width' => $cropWidth,
                    'height' => $cropHeight,
                    'minWidth' => $cropWidth,
                    'minHeight' => $cropHeight,
                    'maxWidth' => $cropWidth,
                    'maxHeight' => $cropHeight
                ]
            ]
        ],
        'croppedImagesUrl' => [
            @$model->image->src
        ],
        'originalImageUrl' => @$model->image->src,
    ]); ?>
    <style>
        .workarea-cropbox, .bg-cropbox {
            height: <?=$cropHeight+100?>px;
            min-height: <?=$cropHeight+100?>px;
            width: <?=$cropWidth+50?>px;
            min-width: <?=$cropWidth+50?>px;
        }
        .img-thumbnail {
            max-width: 350px;
        }
        .multiple-input-list__item {
            border-top: 2px solid #ddd;
        }
    </style */ ?>

    <?= $form->field($model, 'procent')->textInput() ?>
    <?= $form->field($model, 'sale_text')->textInput() ?>

    <?= $form->field($model, 'from')->widget(DateTimePicker::classname(), ['options' => ['placeholder' => 'Select issue date ...'],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd hh:ii',
            'todayHighlight' => true
        ]]) ?>
    <?= $form->field($model, 'to')->widget(DateTimePicker::classname(), ['options' => ['placeholder' => 'Select issue date ...'],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd hh:ii',
            'todayHighlight' => true
        ]]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
