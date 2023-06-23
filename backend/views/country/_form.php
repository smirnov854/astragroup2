<?php

use yii\helpers\Html;
use dastanaron\translit\Translit;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Country */
/* @var $form yii\widgets\ActiveForm */
if($model->name && !$model->code) {
    $translit = new \dastanaron\translit\Translit();
    $model->code = $translit->translit($model->name, true, 'ru-en');
};
?>

<div class="country-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <? // = $form->field($model->meta, 'title')->textInput() ?>
    <?= $form->field($model->meta, 'keywords')->textInput() ?>
    <? //= $form->field($model, 'visa_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
