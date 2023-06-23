<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CabinLoc */

$this->title = 'Update Cabin Loc: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cabin Locs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cabin-loc-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
