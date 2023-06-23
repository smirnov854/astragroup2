<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<section class="page">
    <div class="wrap clear">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="alert alert-danger">
            <?= nl2br(Html::encode($message)) ?>
        </div>
        <?if(strstr($this->title,"#404")) {?>
            <p>
                Проверьте адрес страницы, скорее всего страница в разработке.
            </p>
        <?}
        else{?>
            <p>
                The above error occurred while the Web server was processing your request.
            </p>
            <p>
                Please contact us if you think this is a server error. Thank you.
            </p>
        <?}?>
    </div>
</section>
