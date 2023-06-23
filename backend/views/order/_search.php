<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'bookid') ?>

    <?= $form->field($model, 'status_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'manager_id') ?>

    <?php // echo $form->field($model, 'cruise_id') ?>

    <?php // echo $form->field($model, 'cabin_id') ?>

    <?php // echo $form->field($model, 'cabin') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
