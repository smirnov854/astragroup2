<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 25.11.2018
 * Time: 14:22
 */
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;?>
<a href="<?=$model->link ?>" class="cartblock__link">
    <div class="cartblock__img" style="background-size: 56px; background-image: url('<?=$model->image->src?>');"></div>
    <div class="cartblock__text"><?=$model->title?></div>
</a>