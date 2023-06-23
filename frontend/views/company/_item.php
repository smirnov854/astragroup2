<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 25.11.2018
 * Time: 15:50
 */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;
if($model->image && $model->image->name) {
    $imageSrc = $model->image->subdir . "/" . $model->image->name;
}
else {
    $imageSrc = "/images/lainer/MSC.png";
}
?>
    <div class="company__list__item__top">
        <div class="company__list__item__top__icon" style="background-image: url(<?=$imageSrc?>);"></div>
        <div class="company__list__item__top__name"><?=$model->name?></div>
    </div>
    <div class="company__list__item__descr">
        <div class="company__list__item__left">Количество кораблей</div>
        <div class="company__list__item__right"><?=count($model->ships)?></div>
    </div>
    <div class="company__list__item__descr">
        <div class="company__list__item__left">Категория корабля</div>
        <div class="company__list__item__right">
            <ul class="star__wrap__liner">
                <li class="star__item"><img src="/images/cart/Star.png" alt=""></li>
                <li class="star__item"><img src="/images/cart/Star.png" alt=""></li>
                <li class="star__item"><img src="/images/cart/Star.png" alt=""></li>
                <li class="star__item"><img src="/images/cart/Star.png" alt=""></li>
                <li class="star__item"><img src="/images/lainer/Star.svg" alt=""></li>
            </ul>
        </div>
    </div>
    <div class="company__list__item__bottom">
        <a href="/company/<?=$model->ID?>/" class="company__list__item__bottom__button">Подробнее</a>
    </div>