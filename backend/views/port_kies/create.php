<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PortKies */

$this->title = 'Create Port Kies';
$this->params['breadcrumbs'][] = ['label' => 'Port Kies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="port-kies-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
