<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use sjaakp\bandoneon\Bandoneon;
?>
<br>
<? if($category->ID) { ?>
    <?= Html::a('Delete', ['cabin-group/delete', 'id' => $category->ID], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Are you sure you want to delete this item?',
            'method' => 'post',
        ],
    ]) ?>
<?}?>

    <?php $form = \yii\widgets\ActiveForm::begin([
        'action' => '/admin/cabin-group/update?id='.$category->ID,
        'options' => [
            'enctype'=>'multipart/form-data',
            'data-pjax' => true
        ],
    ]); ?>
    <?= $form->field($category, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($category, 'sort')->textInput(['maxlength' => true]) ?>

    <?= $form->field($category, 'cabin_loc_id')->dropdownList(
        \common\models\CabinLoc::find()->select(['name', 'id'])->where(['IN','ID',[36,37,39,41,62,63]])->indexBy('id')->column(),
        ['prompt'=>'Не выбрано']
    ) ?>
    <?= $form->field($category, 'info')->widget(\mihaildev\ckeditor\CKEditor::className(),[
            'options' => [
                'id' => 'cabingroup-info-' . $category->ID
            ],
            'editorOptions' => [
                'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                'inline' => false, //по умолчанию false
            ],
        ])?>
    <? if($category->cabins) { ?>
        <div class="form-group">
            <label class="control-label" >Каюты</label>
            <?php Bandoneon::begin() ?>
                <?foreach ($category->cabins as $cabin){?>
                    <h4><?=$cabin->name?>&nbsp;<?=$cabin->code?>&nbsp;<a href="/admin/cabin/update/?id=<?=$cabin->ID?>" target="_blank" class="btn btn-success">Edit</a></h4>
                    <div>
                    <?= DetailView::widget([
                        'model' => $cabin,
                        'attributes' => [
                            'code',
                            'sort',
                            'shipName',
                            'capacity',
                            [
                                'label' => 'Изображение',
                                'value' => @$cabin->image->src,
                                'format' => ['image',['width'=>'150']],
                            ],
                            // 'gallery_id',
                            'cabinLocName',
                            'info:text'
                        ],
                    ]) ?>
                    </div>
                <?}?>
            <?php Bandoneon::end() ?>
        </div>
    <? } ?>
    <?
    $cropHeight = 540;
    $cropHeight2 = $cropHeight;
    $cropWidth = 720;

    ?>
    <?=$form->field($category, 'image')->widget(\bupy7\cropbox\CropboxWidget::className(), [
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
        @$category->image->src
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

    <?= $form->field($category, 'images')->widget(\unclead\multipleinput\MultipleInput::className(), [
    'min'   => 0,
    'max'   => 20,
    'columns' => [
        [
            'name'  => 'images',
            'type'  => \bupy7\cropbox\CropboxWidget::classname(),
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
            ]
        ],
    ]
    ]);
    $script = <<< JS
    
    jQuery('.field-cabingroup-images .multiple-input').on('afterAddRow', function(e, row, currentIndex){
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
                    $(row).find(".cropbox").append('<input type="hidden" value="'+res+'" name="CabinGroup[imageIds][]">');
                }
             },
             error: function(){
                console.log('Error!');
             }
        });
    });
    var key = elid.replace("cabingroup-images-","");
    
    // $(row).find('.cropbox').append('<input type="hidden" id="image-crop_infos-'+key+'" value="" name="Image[crop_infos]['+key+']">');
    }).on('afterInit', function(){
    // console.log('calls on after initialization event');            
    $(".cropbox input[name*='crop_infos']").prop('disabled',true);
    $('.form-group.field-cabingroup-images input[type=file]').each(function(i,val){
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
    ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php \yii\widgets\ActiveForm::end(); ?>
<br>