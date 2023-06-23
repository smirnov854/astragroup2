<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CruisePortSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cruise-port-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'port_id') ?>

    <?= $form->field($model, 'cruise_id') ?>

    <?= $form->field($model, 'arrival') ?>

    <?= $form->field($model, 'departure') ?>

    <?php // echo $form->field($model, 'info') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'day') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
