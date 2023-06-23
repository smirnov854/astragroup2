<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Cabin */

$this->title = 'Create Cabin';
$this->params['breadcrumbs'][] = ['label' => 'Cabins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cabin-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
