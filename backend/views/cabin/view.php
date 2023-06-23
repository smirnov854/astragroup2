<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Cabin */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cabins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
if($model->ship && $model->ship->name) {
    $shipName = $model->ship->name;
} else $shipName="";
if($model->image && $model->image->name) {
    $imageName = $model->image->name;
}
else $imageName = "";
if($model->cabinLoc && $model->cabinLoc->name) {
    $cabinLocName = $model->cabinLoc->name;
}
else $cabinLocName = "";
if($model->cabinLoc && $model->cabinLoc->name) {
    $cabinLocName = $model->cabinLoc->name;
}
else $cabinLocName = "";
?>
<div class="cabin-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Edit', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'ID',
//            'name',
            'code',
            [                                                  // name свойство зависимой модели owner
                'label' => 'Судно',
                'value' => $shipName,
            ],
            'cabinGrpName',
            //'ship_id',
            'capacity',
            [
                'label' => 'Изображение',
                'value' => $model->image->src,
                'format' => ['image',['width'=>'150']],
            ],
//            'image_id',
            // 'gallery_id',
            [
                'label' => 'Расположение',
                'value' => $cabinLocName
            ],
            'info:html'
        ],
    ]) ?>

</div>
