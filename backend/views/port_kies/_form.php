<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PortKies */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="port-kies-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'port_id')->textInput() ?>

    <?= $form->field($model, 'keyword')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
