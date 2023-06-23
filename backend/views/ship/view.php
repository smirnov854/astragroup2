<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Ship */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Ships', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ship-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Edit', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Groups', ['categories', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
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
            'code',
            'preview:ntext',
            'detail:ntext',
            'info:ntext',
            'cabin_info:ntext',
            'food_info:ntext',
            'Entertainment_Info:ntext',
            'type.name',
            'company.name',
            // 'image.image:image',
            [
                'label' => 'Изображение',
                'value' => $model->image->src,
                'format' => ['image',['height'=>'150']],
            ],
            // 'gallery_id',
            'meta.title',
            'meta.keywords',
            'meta.description',
        ],
    ]) ?>

</div>
