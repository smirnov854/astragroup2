<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CruisePort */

$this->title = 'Create Cruise Port';
$this->params['breadcrumbs'][] = ['label' => 'Cruise Ports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cruise-port-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
