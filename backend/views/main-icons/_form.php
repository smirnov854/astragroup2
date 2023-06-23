<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MainIcons */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="main-icons-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model->image, 'image')->fileInput() ?>
    <?= Html::img($model->image->subdir . "/" . $model->image->name,[
        'alt' => 'картинка',
        'style' => 'width:60px;'
    ])?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
