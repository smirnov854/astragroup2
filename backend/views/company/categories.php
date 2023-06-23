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
    <h1>Сортировка кают компании <?=$model->name?></h1>
    <ul class="nav nav-tabs">
        <?$active=1; foreach($arCategories as $category){ ?>
            <li class="<?if($active){?> active<? $active=0;}?>">
                <a href="#tab-<?=$category->ID?>" data-toggle="tab"><?=$category->name?></a>
            </li>
        <?}?>
        <li>
            <a href="#tab-new" data-toggle="tab">New</a>
        </li>
    </ul>
    <div class="tab-content">
        <? $active=1; foreach($arCategories as $category){ ?>
            <div class="tab-pane <?if($active){?> active<? $active=0;}?>" id="tab-<?=$category->ID?>">
                <?php Pjax::begin([
                    'enablePushState'=>false,
                ]); ?>
                <? include(Yii::getAlias('@app/views/group-company/_form.php')); ?>
                <?php Pjax::end(); ?>
            </div>
        <?}?>
        <div class="tab-pane" id="tab-new">
            <? $category = new \common\models\GroupCompany();
            $category->company_id = $model->ID;
            ?>
            <?php

            $form = \yii\widgets\ActiveForm::begin([
                'action' => '/admin/group-company/create',
                'options' => [
                    'enctype'=>'multipart/form-data',
                ],
            ]); ?>

            <?= $form->field($category, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($category, 'sort')->textInput(['maxlength' => true]) ?>
            <?= $form->field($category, 'cabin_loc_id')->dropdownList(
                \common\models\CabinLoc::find()->select(['name', 'id'])->where(['IN','ID',[36,37,39,41]])->indexBy('id')->column(),
                ['prompt'=>'Не выбрано']
            ) ?>
            <?= $form->field($category, 'company_id')->hiddenInput([]) ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
            <?php \yii\widgets\ActiveForm::end(); ?>
        </div>
    </div>
    <hr>
    <?= Html::a('Применить ко всем лайнерам '.$model->name, ['company/accept', 'id' => $model->ID], [
        'class' => 'btn btn-success btn-lg',
        'data' => [
            'method' => 'post',
        ],
    ]) ?>
</div>