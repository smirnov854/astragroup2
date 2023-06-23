<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use sjaakp\bandoneon\Bandoneon;
?>
<br>
<? if($category->ID) { ?>
    <?= Html::a('Delete', ['group-company/delete', 'id' => $category->ID], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Are you sure you want to delete this item?',
            'method' => 'post',
        ],
    ]) ?>
    <?= Html::a('+ New category', ['group-category/create', 'group' => $category->ID, 'company' => $category->company_id], [
        'class' => 'btn btn-success',
        'data' => [
            'method' => 'post',
        ],
    ]) ?>
<?}?>

    <?php $form = \yii\widgets\ActiveForm::begin([
        'action' => '/admin/group-company/update?id='.$category->ID,
        'options' => [
            'enctype'=>'multipart/form-data',
            'data-pjax' => true
        ],
    ]); ?>
    <?= $form->field($category, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($category, 'sort')->textInput(['maxlength' => true]) ?>

    <?= $form->field($category, 'cabin_loc_id')->dropdownList(
        \common\models\CabinLoc::find()->select(['name', 'id'])->where(['IN','ID',[36,37,39,41,62,63]])->indexBy('id')->column(),
        ['prompt'=>'Не выбрано']
    ) ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php \yii\widgets\ActiveForm::end(); ?>
<? if($category->groupCategories) {
    $dataProvider = new \yii\data\ActiveDataProvider( [
        'query' => \common\models\GroupCategory::find( )->where(["group_company_id"=>$category->ID])->orderBy( 'sort' ),	// notice the orderBy clause
        'sort' => false,
        'pagination' => false
    ] );
    ?>
    <div class="form-group">
        <label class="control-label" >Каюты</label>
        <?= \sjaakp\sortable\SortableGridView::widget( [
            'dataProvider' => $dataProvider,
            'orderUrl' => ['group-company/order'],
            'columns' => [
                'code',
                'name',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>'Edit',
                    'template' => '{update}',
                    'urlCreator' => function($action,  $model,  $key,  $index) {
                        return "/admin/group-category/{$action}?id={$key}";
                    }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>'Delete',
                    'template' => '{delete}',
                    'urlCreator' => function($action,  $model,  $key,  $index) {
                        return "/admin/group-category/{$action}?id={$key}";
                    }
                ],

            ],
        ] ); ?>
    </div>
<? } ?>
<br>