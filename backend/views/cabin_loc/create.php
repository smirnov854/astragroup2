<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CabinLoc */

$this->title = 'Create Cabin Loc';
$this->params['breadcrumbs'][] = ['label' => 'Cabin Locs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cabin-loc-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
