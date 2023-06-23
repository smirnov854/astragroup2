<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CruisePort */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cruise-port-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'port_id')->textInput() ?>

    <?= $form->field($model, 'cruise_id')->textInput() ?>

    <?= $form->field($model, 'arrival')->textInput() ?>

    <?= $form->field($model, 'departure')->textInput() ?>

    <?= $form->field($model, 'info')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'day')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
