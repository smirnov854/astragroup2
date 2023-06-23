<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Company', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'ID',
            'name',
            ['attribute' => 'CompanyGroupName','label' => 'Группа', 'value'=>'companyGroup.name'],
            // 'company_group_id',
            'preview',
            // 'detail:ntext',
            // 'image_id:image',
            [
                'label' => 'Лого',
                'format' => 'raw',
                'value' => function($data){
                    if($data->image) {
                        return Html::img($data->image->subdir . "/" . $data->image->name, [
                            'alt' => 'картинка',
                            'style' => 'width:58px;'
                        ]);
                    }
                    else return "no_image";
                },
            ],
            //'gallery_id',
            //'penalty_info:ntext',
            //'ship_info:ntext',
            //'meta_id',
            //'currency',
            [
                'attribute' => 'cabins',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a("Groups", Url::to(['categories', 'id' => $data->ID]));
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
