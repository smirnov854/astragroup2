<?php
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Ship;
use bupy7\cropbox\CropboxWidget;

/* @var $this yii\web\View */
/* @var $model backend\models\Cabin */
/* @var $form yii\widgets\ActiveForm */
if($model->name && !$model->code) {
    $translit = new \dastanaron\translit\Translit();
    $model->code = $translit->translit($model->name, true, 'ru-en');
};
?>

<div class="cabin-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
    <?
    $query = \common\models\GroupCompany::find()->select(['name', 'id'])->indexBy('id');
    if(Yii::$app->request->get('company')) {
        $query->where(['company_id'=>Yii::$app->request->get('company')]);
    }
    ?>
    <?= $form->field($model, 'group_company_id')->dropdownList(
            $query->column(),
            ['prompt'=>'Не выбрано']
        );?>
    <?= $form->field($model, 'sort')->hiddenInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
