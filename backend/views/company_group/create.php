<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CompanyGroup */

$this->title = 'Create Company Group';
$this->params['breadcrumbs'][] = ['label' => 'Company Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-group-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
