<?php

use bupy7\cropbox\CropboxWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use dosamigos\fileupload\FileUploadUI;

/* @var $this yii\web\View */
/* @var $model common\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin([
		'options' => ['enctype'=>'multipart/form-data'],
	]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'preview')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'detail')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ],
    ]) ?>

	<?
	if($model && $model->ID){
	$cropHeight = 300;
	$cropHeight2 = $cropHeight;
	$cropWidth = 600;
	?>

	<?= $form->field($model, 'image')->widget(CropboxWidget::className(), [
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
	]) ?>
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
	</style>

	<? } ?>

    <?= $form->field($model, 'special_id')->dropdownList(
        \backend\models\Special::find()->select(['name', 'id'])->indexBy('id')->column(),
        ['prompt'=>'Не выбрано']
    ) ?>
    <? //= $form->field($model, 'special_id')->textInput() ?>

    <?= $form->field($model->meta, 'title')->textInput() ?>
    <?= $form->field($model->meta, 'keywords')->textInput() ?>
    <?= $form->field($model->meta, 'description')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
