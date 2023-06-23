<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\Banner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banner-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'preview')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <? // = $form->field($model->image, 'image')->fileInput() ?>
    <? /*= Html::img($model->image->subdir . "/" . $model->image->name,[
        'alt' => 'картинка',
        'style' => 'width:100%;'
    ]) */ ?>

    <?= $form->field($model, 'page_id')->dropDownList(
        \common\models\Page::find()->select(['title', 'ID'])->indexBy('ID')->column(),
        ['prompt'=>'Главная']
    )?>
    <?
    $cropHeight = 443;
    $cropWidth = 1903;
    if($model->page_id > 0) $cropHeight = 296;
    ?>
    <?= \dpodium\yii2\widget\upload\crop\UploadCrop::widget(
    [
    'form' => $form,
    'model' => $model,
    'attribute' => 'image',
    'maxSize' => $cropWidth,
    'imageSrc' => (isset($model->image->src)) ? $model->image->src : '',
    'jcropOptions' => [
        'modal' => false,
        'dragMode' => 'move',
        'viewMode' => 3,
        'autoCropArea' => '0.8',
        'autoCrop' => true,
        'rotatable'=> false,
        'restore' => false,
        'guides' => true,
        'center' => false,
        'movable' => true,
        'highlight' => false,
        'cropBoxMovable' => false,
        'cropBoxResizable' => false,
        'background' => false,
        'minContainerHeight' => $cropHeight,
        'minContainerWidth' => $cropWidth,
        'minCanvasHeight' => $cropHeight,
        'minCanvasWidth' => $cropWidth,
        'minCropBoxHeight' => $cropHeight,
        'minCropBoxWidth' => $cropWidth,
        'responsive' => false,
        'toggleDragModeOnDblclick' => false
    ]
    ]
    ); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
<style>
    .modal-lg {
        width: 100%;
    }
</style>