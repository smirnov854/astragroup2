<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Special */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Specials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="special-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
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
            'ID',
            'name',
            'cruisesList',
            'info:ntext',
            'image_id',
            'procent',
            'from',
            'to',
            [
                'label' => 'Изображение',
                'value' => @$model->image->subdir . "/" . @$model->image->name,
                'format' => ['image',['width'=>'200']],
            ],
        ],
    ]) ?>

</div>
