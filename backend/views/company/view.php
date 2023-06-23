<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Company */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-view">
	<pre style="display: none">
		<?  print_r($model->cruiseIcons); ?>
	</pre>
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
            'ID',
            'name',
            'companyGroup.name',
            'preview',
            'detail:ntext',
            // 'image_id',
            //'gallery_id',
            [
                'label' => 'Изображение',
                'value' => $model->image->subdir . "/" . $model->image->name,
                'format' => ['image',['width'=>'150']],
            ],
            'penalty_info:ntext',
            'ship_info:ntext',
            'meta.title',
            'meta.keywords',
            'meta.description',
            'currency',
        ],
    ]) ?>

</div>
