<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CompanyType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'page_id')->dropDownList(
        \common\models\Page::find()->select(['title', 'id'])->indexBy('id')->column(),
        ['prompt'=>'Не выбрано']
    ); ?>

    <?= $form->field($model->image, 'image')->fileInput() ?>
    <?= Html::img($model->image->subdir . "/" . $model->image->name,[
        'alt' => 'картинка',
        'style' => 'width:258px;'
    ])?>
    <? if($model->ID) {?>
        <?= $form->field($model, 'gallery')->widget(\dosamigos\fileupload\FileUploadUI::className(),[
            'url' => ['company-type/upload',"id"=>$model->ID],
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
            $a = Html::a($i.'<span>Delete</span>', ['image-delete', 'id' => $image->ID, 'return' => 'company-type/update:'.$model->ID], [
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
    <?= $form->field($model, 'meta_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
