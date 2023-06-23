<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 25.11.2018
 * Time: 14:22
 */
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;?>
<?if($model->page){?>
    <a href="/<?=$model->page->alias?>/" class="cart__link">
        <div class="cart__top"><?=$model->name?></div>
        <div class="cart__img">
            <div class="cart__img__wrap" style="background-image: url(<?=@$model->image->src?>);">

            </div>
        </div>
    </a>
<?} else {?>
    <span class="cart__link">
        <div class="cart__top"><?=$model->name?></div>
        <div class="cart__img">
            <div class="cart__img__wrap" style="background-image: url(<?=@$model->image->src?>);">

            </div>
        </div>
    </span>
<?}?>
