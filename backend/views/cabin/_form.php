<?php
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Ship;
use bupy7\cropbox\CropboxWidget;

/* @var $this yii\web\View */
/* @var $model backend\models\Cabin */
/* @var $form yii\widgets\ActiveForm */
if($model->name && !$model->code) {
    $translit = new \dastanaron\translit\Translit();
    $model->code = $translit->translit($model->name, true, 'ru-en');
};
?>

<div class="cabin-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'sort')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ship_id')->dropdownList(
        \backend\models\Ship::find()->select(['name', 'id'])->indexBy('id')->column(),
        ['prompt'=>'Не выбрано']
    ); ?>
    <? if($model->ship && $model->ship->cabinGroups) {?>
        <?= $form->field($model, 'cabin_grp_id')->dropdownList(
            \common\models\CabinGroup::find()->select(['name', 'id'])->where(["ship_id"=>$model->ship->ID])->indexBy('id')->column(),
            ['prompt'=>'Не выбрано']
        );?>
    <?}?>

    <!--    --><?//= $form->field($model, 'cabin_loc_id')->dropdownList(
    //        \backend\models\CabinLoc::find()->select(['name', 'id'])->indexBy('id')->column(),
    //        ['prompt'=>'Не выбрано']
    //    );?>

    <?= $form->field($model, 'capacity')->textInput() ?>
    <?= $form->field($model, 'info')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ],
    ])?>
    <? //= $form->field($model, 'image_id')->textInput() ?>


    <?
    $cropHeight = 540;
    $cropHeight2 = $cropHeight;
    $cropWidth = 720;

    ?>
    <? /* =$form->field($model, 'image')->widget(CropboxWidget::className(), [
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
    ]); */ ?>
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
    $script = <<< JS
                
                jQuery('.field-cabin-images .multiple-input').on('afterAddRow', function(e, row, currentIndex){
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
                                    console.log($(row).find("input[name*=crop_infos]").prop('disabled', true));
                                    console.log($(row).find(".cropbox input[type=file]").prop('disabled', true));
                                    $(row).find(".cropbox").append('<input type="hidden" value="'+res+'" name="Cabin[imageIds][]">');
                                }
                             },
                             error: function(){
                                console.log('Error!');
                             }
                        });
                    });
                    var key = elid.replace("cabin-images-","");
                    
                    // $(row).find('.cropbox').append('<input type="hidden" id="image-crop_infos-'+key+'" value="" name="Image[crop_infos]['+key+']">');
                }).on('afterInit', function(){
                    // console.log('calls on after initialization event');            
                    $(".cropbox input[name*='crop_infos']").prop('disabled',true);
                    $('.form-group.field-cabin-images input[type=file]').each(function(i,val){
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
JS;
    $this->registerJs($script, yii\web\View::POS_READY);
 */
    ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
