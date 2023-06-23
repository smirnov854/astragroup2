<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MainIcons */

$this->title = 'Create Main Icons';
$this->params['breadcrumbs'][] = ['label' => 'Main Icons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-icons-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
