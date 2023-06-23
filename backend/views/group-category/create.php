<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Cabin */

$this->title = 'Создание эталона для каюты';
if($model->groupCompany && $model->groupCompany->company_id) {
    $this->params['breadcrumbs'][] = ['label' => 'Company', 'url' => ['company/categories?id='.$model->groupCompany->company_id]];
}
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="cabin-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
