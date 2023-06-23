<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use sjaakp\bandoneon\Bandoneon;

/* @var $this yii\web\View */
/* @var $model backend\models\Ship */
$this->params['breadcrumbs'][] = ['label' => 'Ships', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Categories';
?>
<div class="ship-view">
    <h1>Категории кают лайнера <?=$model->name?></h1>
    <ul class="nav nav-tabs">
        <?$active=1; foreach($groups as $category){ ?>
            <li class="<?if($active){?> active<? $active=0;}?>">
                <a href="#tab-<?=$category->ID?>" data-toggle="tab"><?=$category->name?></a>
            </li>
        <?}?>
        <li>
            <a href="#tab-new" data-toggle="tab">New</a>
        </li>
    </ul>
    <div class="tab-content">
        <? $active=1; foreach($groups as $category){ ?>
            <div class="tab-pane <?if($active){?> active<? $active=0;}?>" id="tab-<?=$category->ID?>">
                <?php Pjax::begin([
                    'enablePushState'=>false,
                ]); ?>
                    <? include(Yii::getAlias('@app/views/cabin-group/_form.php')); ?>
                <?php Pjax::end(); ?>
            </div>
        <?}?>
        <div class="tab-pane" id="tab-new">
            <? $category = new \common\models\CabinGroup();
             ?>


            <?php

            $form = \yii\widgets\ActiveForm::begin([
                'action' => '/admin/cabin-group/create',
                'options' => [
                    'enctype'=>'multipart/form-data',
                ],
            ]); ?>
            <?= $form->field($category, 'ship_id')->hiddenInput([
                'value' => $model->ID
            ])?>
            <?= $form->field($category, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($category, 'cabin_loc_id')->dropdownList(
                \common\models\CabinLoc::find()->select(['name', 'id'])->where(['IN','ID',[36,37,39,41]])->indexBy('id')->column(),
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
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
            <?php \yii\widgets\ActiveForm::end(); ?>
        </div>
    </div>
</div>
