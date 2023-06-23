<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use yii\jui\AutoComplete;

/* @var $this yii\web\View */
/* @var $model common\models\Deck */
/* @var $form yii\widgets\ActiveForm */

$ships = \common\models\Ship::find()->select(['ID as value', 'name as label'])->asArray()->all();
// $ships = \yii\helpers\ArrayHelper::map(\common\models\Ship::find()->select(['ID', 'name'])->all(),'name','name');
?>

<div class="deck-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'number')->textInput() ?>

    <?= $form->field($model->image, 'image')->fileInput() ?>
    <?= Html::img($model->image->subdir . "/" . $model->image->name,[
        'alt' => 'Схема',
        'style' => 'width:258px;'
    ])?>

    <? //= $form->field($model, 'ship_id')->textInput() ?>

    <?= $form->field($model, 'ship_id')->widget(
        AutoComplete::className(), [
        'clientOptions' => [
            'source' => $ships,
        ],
        'options'=>[
            'class'=>'form-control'
        ]
    ]);
    ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ],
    ]) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
