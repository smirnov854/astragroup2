<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Cruise */

$this->title = 'Create Cruise';
$this->params['breadcrumbs'][] = ['label' => 'Cruises', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cruise-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
