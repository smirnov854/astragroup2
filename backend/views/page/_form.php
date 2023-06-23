<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <? //= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ],
    ])?>

    <? //= $form->field($model, 'image_id')->textInput() ?>
    <? if($model->ID) {?>
    <?= $form->field($model, 'gallery')->widget(\dosamigos\fileupload\FileUploadUI::className(),[
        'url' => ['page/upload',"id"=>$model->ID],
        'gallery' => true,
        'fieldOptions' => [
            'accept' => 'image/*'
        ],
        'clientOptions' => [
            'maxFileSize' => 2000000
        ],
        'clientEvents' => [
            'fileuploaddone' => 'function(e, data) {
                                    console.log(e);
                                    console.log(data);
                                }',
            'fileuploadfail' => 'function(e, data) {
                                    console.log(e);
                                    console.log(data);
                                }',
        ],
    ]) ?>
    <?
    foreach ($model->gallery->images as $image) {
        print Html::img($image->subdir . "/" . $image->name,[
            'alt' => 'картинка',
            'style' => 'width:258px; padding: 5px'
        ]);
        $i = Html::tag("i", "",["class"=>"glyphicon glyphicon-trash"]);
        $a = Html::a($i.'<span>Delete</span>', ['image-delete', 'id' => $image->ID, 'return' => 'page/update:'.$model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this image?',
                'method' => 'post',
            ],
        ]);
        print Html::tag("div", $a, ["style"=> "display:inline-block"]);
    }
    ?>
    <?}?>
    <? //= $form->field($model, 'meta_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
