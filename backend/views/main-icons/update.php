<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MainIcons */

$this->title = 'Update Main Icons: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Main Icons', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="main-icons-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
