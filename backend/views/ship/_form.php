<?php

use bupy7\cropbox\CropboxWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use dastanaron\translit\Translit;
use dosamigos\fileupload\FileUploadUI;

/* @var $this yii\web\View */
/* @var $model backend\models\Ship */
/* @var $form yii\widgets\ActiveForm */
if($model->name && !$model->code) {
    $translit = new \dastanaron\translit\Translit();
    $model->code = strtolower($translit->translit($model->name, true, 'ru-en'));
};
?>
<div class="ship-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype'=>'multipart/form-data'],
    ]); ?>
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#main" data-toggle="tab">Лайнер</a>
        </li>
        <li>
            <a href="#tabs" data-toggle="tab">Вкладки</a>
        </li>
        <li>
            <a href="#old" data-toggle="tab">Старое</a>
        </li>
        <li>
            <a href="#meta" data-toggle="tab">Мета теги</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="main">
            <br>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'type_id')->dropdownList(
                \backend\models\ShipType::find()->select(['name', 'id'])->indexBy('id')->column(),
                ['prompt'=>'Не выбрано']
            ) ?>
            <?= $form->field($model, 'company_id')->dropdownList(
                \backend\models\Company::find()->select(['name', 'id'])->indexBy('id')->column(),
                ['prompt'=>'Не выбрано']
            ) ?>
            <?= $form->field($model, 'options')->widget(\unclead\multipleinput\MultipleInput::className(), [
                'columns' => [
                    [
                        'name'  => 'title',
                        'type'  => 'textInput',
                        'title' => 'Title',
                    ],
                    [
                        'name'  => 'value',
                        'type'  => 'textInput',
                        'title' => 'Value',
                    ],
                ]
            ]); ?>

            <?
            if($model && $model->ID) {

            $cropHeight = 300;
            $cropHeight2 = $cropHeight;
            $cropWidth = 600;

            ?>
            <?=$form->field($model, 'image')->widget(CropboxWidget::className(), [
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

            <? /* = $form->field($model, 'images')->widget(\unclead\multipleinput\MultipleInput::className(), [
                'min'   => 0,
                'max'   => 20,
                'columns' => [
                    [
                        'name'  => 'images',
                        'type'  => CropboxWidget::classname(),
                        'title' => 'Image',
                        'value' => function($data) {
                            $result = [
                                "id" => $data["ID"],
                                "src" => $data['src']
                            ];
                            return json_encode($result);
                        },
                        'options' => [
                            'croppedDataAttribute' => 'crop_infos[]',
                            'croppedDataName' => 'Image[crop_infos][]',
                            'pluginOptions'=>[
                                'variants' => [
                                    [
                                        'width' => $cropWidth,
                                        'height' => $cropHeight2,
                                        'minWidth' => $cropWidth,
                                        'minHeight' => $cropHeight2,
                                        'maxWidth' => $cropWidth,
                                        'maxHeight' => $cropHeight2
                                    ]
                                ]
                            ],
                            'croppedImagesUrl' => [
                                '/i_ships/no-ship.png'
                            ],
        //                    'originalImageUrl' => function($data) {
        //                        return $data['src'];
        //                    }
                        ]
                    ],
                ]
            ]);
            */
            /* $script = <<< JS
                
                jQuery('.field-ship-images .multiple-input').on('afterAddRow', function(e, row, currentIndex){
                    var elid=$(row).find('.cropbox').attr("id");
                    $(row).find('.plugin').on('cb:cropped', function(event, info) {
                        // console.log($(row).find("input[name*=crop_infos]").val());
                        // console.log($(row).find(".cropbox input[type=file]").val());
                        var formData = {
                            'crop_info': $(row).find("input[name*=crop_infos]").val(),
                            'imageName': $(row).find(".cropbox input[type=file]").val()
                        };
                        jQuery.each($(row).find(".cropbox input[type=file]").files, function(i, file) {
                            formData['imageFile'] = file;
                        });
                        $.ajax({
                            url: '/admin/image/upload',
                             type: 'POST',
                             data: formData,
                             success: function(res){
                                console.log(res);
                                console.log('add img');
                                if(res != 'error') {
                                    // console.log($(row).find("input[name*=crop_infos]").prop('disabled', true));
                                    // console.log($(row).find(".cropbox input[type=file]").prop('disabled', true));
                                    // $(row).find(".cropbox").append('<input type="hidden" value="'+res+'" name="Ship[imageIds][]">');
                                }
                             },
                             error: function(){
                                console.log('Error!');
                             }
                        });
                    });
                    var key = elid.replace("ship-images-","");
                    
                    // $(row).find('.cropbox').append('<input type="hidden" id="image-crop_infos-'+key+'" value="" name="Image[crop_infos]['+key+']">');
                }).on('afterInit', function(){
                    console.log('calls on after initialization event');            
                    $(".cropbox input[name*='crop_infos']").prop('disabled',true);
                    $('.form-group.field-ship-images input[type=file]').each(function(i,val){
                        var img = jQuery.parseJSON($(val).attr('value'));
                        console.log(img.src);
                        $(this).parents('.list-cell__images').find('.cropped-images-cropbox img').attr('src',img.src);
                        $(this).parents('.list-cell__images').find('.btn-group, .btn-file').hide();
                        console.log(i);
                    });
                }).on('beforeDeleteRow',function(e, row, currentIndex) {
                     var elid=$(row).find('.cropbox').attr("id");
                     var img=jQuery.parseJSON( $(row).find('input[type=file]').attr('value') );
                     console.log(img);
                    console.log('del_row '+elid);
                    if(!img.id) {
                        return true;
                    }
                    if(confirm('Are you sure you want to delete row?') ) {
                         var data = {'id':img.id};
                         $.ajax({
                            url: '/admin/image/delete?id='+img.id,
                             type: 'POST',
                             data: data,
                             success: function(res){
                                console.log(res);
                                console.log('del'+img.id);
                             },
                             error: function(){
                                console.log('Error!');
                             }
                        });
                        return true;
                    }
                    return false;
                });
JS; */
            // $this->registerJs($script, yii\web\View::POS_READY);
            ?>
            <? /* = \dpodium\yii2\widget\upload\crop\UploadCrop::widget(
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
            ); */?>
            <? /* if($model->ID) {?>
                <?= $form->field($model, 'gallery')->widget(FileUploadUI::className(),[
                    'model' => $model->gallery,
                    'attribute' => 'images',
                    'url' => ['ship/upload',"id"=>$model->ID],
                    'gallery' => true,
                    'fieldOptions' => [
                        'accept' => 'image/*'
                    ],
                    'clientOptions' => [
                        'maxFileSize' => 4000000
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
                ]); ?>
                <?
                foreach ($model->gallery->images as $image) {
                    print Html::img($image->subdir . "/" . $image->name,[
                        'alt' => 'картинка',
                        'style' => 'width:258px; padding: 5px'
                    ]);
                    $i = Html::tag("i", "",["class"=>"glyphicon glyphicon-trash"]);
                    $a = Html::a($i.'<span>Delete</span>', ['image-delete', 'id' => $image->ID, 'return' => 'ship/update:'.$model->ID], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this image?',
                            'method' => 'post',
                        ],
                    ]);

                    // $a =  Html::a($i, "image-delete?id=".$image->ID);
                    print Html::tag("div", $a, ["style"=> "display:inline-block"]);
                }
                ?>
            <?} */ ?>

            <? } ?>
        </div>
        <div class="tab-pane" id="tabs">
            <br>
            <?= $form->field($model, 'detail')->widget(CKEditor::className(),[
                'editorOptions' => [
                    'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                    'inline' => false, //по умолчанию false
                ],
            ])?>
            <?= $form->field($model, 'food_info')->widget(CKEditor::className(),[
                'editorOptions' => [
                    'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                    'inline' => false, //по умолчанию false
                ],
            ]) ?>
            <?= $form->field($model, 'pool_info')->widget(CKEditor::className(),[
                'editorOptions' => [
                    'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                    'inline' => false, //по умолчанию false
                ],
            ]) ?>
            <?= $form->field($model, 'Entertainment_Info')->widget(CKEditor::className(),[
                'editorOptions' => [
                    'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                    'inline' => false, //по умолчанию false
                ],
            ]) ?>
            <?= $form->field($model, 'map_info')->widget(CKEditor::className(),[
                'editorOptions' => [
                    'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                    'inline' => false, //по умолчанию false
                ],
            ]) ?>
            <?= $form->field($model, 'info')->widget(CKEditor::className(),[
                'editorOptions' => [
                    'preset' => 'standard', // разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                    'inline' => false, // по умолчанию false
                ],
            ]) ?>
        </div>
        <div class="tab-pane" id="old">
            <br>
            <?= $form->field($model, 'preview')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'cabin_info')->widget(CKEditor::className(),[
                'editorOptions' => [
                    'preset' => 'standard', // разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                    'inline' => false, // по умолчанию false
                ],
            ]) ?>
            <?= $form->field($model, 'bars_info')->widget(CKEditor::className(),[
                'editorOptions' => [
                    'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                    'inline' => false, //по умолчанию false
                ],
            ]) ?>
            <?= $form->field($model, 'cazino_info')->widget(CKEditor::className(),[
                'editorOptions' => [
                    'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                    'inline' => false, //по умолчанию false
                ],
            ]) ?>

            <?= $form->field($model, 'cinima_info')->widget(CKEditor::className(),[
                'editorOptions' => [
                    'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                    'inline' => false, //по умолчанию false
                ],
            ]) ?>

        <!--    <div class="form-group field-image-image">-->
        <!--        <label class="control-label" for="image-image">Галлерея</label>-->
        <!--        --><?// $galleryModel = new \common\models\Image(); ?>
        <!--        --><?//= FileUploadUI::widget([
        //            'model' => $galleryModel,
        //            'attribute' => 'image',
        //
        //        ]); ?>
        <!--    </div>-->
            <? // = $form->field($model, 'gallery_id')->textInput() ?>
        </div>
        <div class="tab-pane" id="meta">
            <br>
            <?= $form->field($model->meta, 'title')->textInput() ?>
            <?= $form->field($model->meta, 'keywords')->textInput() ?>
            <?= $form->field($model->meta, 'description')->textInput() ?>

        </div>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
