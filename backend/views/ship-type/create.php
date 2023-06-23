<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ShipType */

$this->title = 'Create Ship Type';
$this->params['breadcrumbs'][] = ['label' => 'Ship Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ship-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
