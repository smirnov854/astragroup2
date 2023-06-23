<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Review */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="review-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ],
    ]) ?>
    <?= $form->field($model, 'user_id')->dropdownList(
        \common\models\Users::find()->select(['username', 'id'])->indexBy('id')->column(),
        ['prompt'=>'Не выбрано']
    ) ?>
    <? // = $form->field($model, 'user_id')->textInput() ?>
    <?= $form->field($model, 'cruise_id')->textInput() ?>

    <?= $form->field($model, 'ship_id')->textInput() ?>

    <?= $form->field($model, 'region_id')->dropdownList(
        \common\models\Region::find()->select(['name', 'id'])->indexBy('id')->column(),
        ['prompt'=>'Не выбрано']
    ) ?>

    <?= $form->field($model, 'service')->dropdownList([1=>1,2=>2,3=>3,4=>4,5=>5]) ?>

    <?= $form->field($model, 'ship')->dropdownList([1=>1,2=>2,3=>3,4=>4,5=>5]) ?>

    <?= $form->field($model, 'ofice')->dropdownList([1=>1,2=>2,3=>3,4=>4,5=>5]) ?>

    <?= $form->field($model, 'programms')->dropdownList([1=>1,2=>2,3=>3,4=>4,5=>5]) ?>

    <?= $form->field($model, 'food')->dropdownList([1=>1,2=>2,3=>3,4=>4,5=>5]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
