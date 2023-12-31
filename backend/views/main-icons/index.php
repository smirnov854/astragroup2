<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MainIconsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Main Icons';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-icons-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Main Icons', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'title',
            'image_id',
            'link',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
