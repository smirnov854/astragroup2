<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Port */

$this->title = 'Create Port';
$this->params['breadcrumbs'][] = ['label' => 'Ports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="port-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
