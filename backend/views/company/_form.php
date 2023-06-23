<?php
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\CompanyGroup;
/* @var $this yii\web\View */
/* @var $model backend\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_group_id')->dropdownList(
        CompanyGroup::find()->select(['name', 'id'])->indexBy('id')->column(),
        ['prompt'=>'Не выбрано']
    ); ?>

	<?= $form->field($model, 'description')->widget(CKEditor::className(),['editorOptions' => ['preset' => 'standard', 'inline' => false, ], ]);?>
	<?= $form->field($model, 'flot_info')->widget(CKEditor::className(),['editorOptions' => ['preset' => 'standard', 'inline' => false, ], ]);?>
	<?= $form->field($model, 'food_info')->widget(CKEditor::className(),['editorOptions' => ['preset' => 'standard', 'inline' => false, ], ]);?>
	<?= $form->field($model, 'activity_info')->widget(CKEditor::className(),['editorOptions' => ['preset' => 'standard', 'inline' => false, ], ]);?>
	<?= $form->field($model, 'dress_info')->widget(CKEditor::className(),['editorOptions' => ['preset' => 'standard', 'inline' => false, ], ]);?>
	<?= $form->field($model, 'kids_info')->widget(CKEditor::className(),['editorOptions' => ['preset' => 'standard', 'inline' => false, ], ]);?>
	<?= $form->field($model, 'celebration_info')->widget(CKEditor::className(),['editorOptions' => ['preset' => 'standard', 'inline' => false, ], ]);?>
	<?= $form->field($model, 'rus_info')->widget(CKEditor::className(),['editorOptions' => ['preset' => 'standard', 'inline' => false, ], ]);?>
	<?= $form->field($model, 'loyalty_info')->widget(CKEditor::className(),['editorOptions' => ['preset' => 'standard', 'inline' => false, ], ]);?>
	<?= $form->field($model, 'villa_info')->widget(CKEditor::className(),['editorOptions' => ['preset' => 'standard', 'inline' => false, ], ]);?>
	<?= $form->field($model, 'age_limit')->widget(CKEditor::className(),['editorOptions' => ['preset' => 'standard', 'inline' => false, ], ]);?>
	<?= $form->field($model, 'booking_info')->widget(CKEditor::className(),['editorOptions' => ['preset' => 'standard', 'inline' => false, ], ]);?>

    <?= $form->field($model, 'detail')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ],
    ]);?>
	==============================================================
    <?= $form->field($model, 'preview')->textarea(['rows' => 6]) ?>


    <? // = $form->field($model, 'image_id')->textInput() ?>
    <?
    $cropHeight = 100;
    $cropHeight2 = $cropHeight;
    $cropWidth = 200;
    ?>
    <?=$form->field($model, 'image')->widget(\bupy7\cropbox\CropboxWidget::className(), [
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
        //'originalImageUrl' => @$model->image->src,
    ]);?>
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
    <?= $form->field($model, 'penalty_info')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ],
    ]); ?>

    <?= $form->field($model, 'ship_info')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ],
    ]); ?>

    <?= $form->field($model->meta, 'title')->textInput() ?>
    <?= $form->field($model->meta, 'keywords')->textInput() ?>
    <?= $form->field($model->meta, 'description')->textInput() ?>

    <?= $form->field($model, 'currency')->dropdownList(['EUR'=>'EUR','USD'=>'USD','RUB'=>'RUB']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
