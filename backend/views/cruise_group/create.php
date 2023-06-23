<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CruiseGroup */

$this->title = 'Create Cruise Group';
$this->params['breadcrumbs'][] = ['label' => 'Cruise Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cruise-group-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
