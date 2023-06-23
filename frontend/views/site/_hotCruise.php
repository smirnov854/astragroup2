<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 25.11.2018
 * Time: 14:22
 */
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
$obShip=@$model->ship->image;?>
<div class="sale__popular"><span>%</span></div>
<div class="sale__social" style="display: none">
    <a href="" class="sale__social__item sale__social__item--active"></a>
    <a href="" class="sale__social__item sale__social__item--active"></a>
    <a href="" class="sale__social__item sale__social__item--active"></a>
</div>
<div class="sale__title"><?=$model->ancor?$model->ancor:$model->name?></div>
<div class="sale__item__component">
    <div class="sale__item__left">
        <div class="sale__img">
            <div class="sale__img__wrap" style="background-image: url('<?=@$obShip->src?($obShip->src):"/i_ships/no-ship.png"?>');"></div>
            <? if ($model->sale_text) {?>
                <div class="sale__img__sale"><?=$model->sale_text?></div>
            <?}?>
        </div>
        <div class="form__result__item__bottom sale__bottom__result">
            <? if($model->icons) {?>
                <ul class="form__result__item__bottom__wrap__list">
                    <?foreach($model->icons as $icon) {?>
                        <li class="form__result__item__bottom__list">
                            <img src="<?=$icon->src?>" alt="<?=$icon->name?>">
                            <div class="form__result__item__bottom__popup"><?=preg_replace('/(\s)/', '&nbsp;', $icon->name);?></div>
                        </li>
                    <?}?>
                </ul>
            <?}?>
            <div class="form__result__item__button">
                <a style="display: none" href="" target="_blank">Отзывы</a>
                <a style="display: none" href="" target="_blank">Скачать PDF</a>
            </div>
        </div>
    </div>
    <div class="sale__item__right">
        <div class="sale__text">
            <div class="sale__title__wrap">
                <div class="sale__tur">
                    <?=$model->itinerary?>
                </div>
            </div>
            <div class="form__result__item__text__list__wrap block__flex">
                <div style="display: none" class="form__result__item__text__list sale__date__name">Посмотреть на карте</div>
                <div style="display: none" class="form__result__item__text__list sale__date__history">История, Архетектура</div>
                <div class="form__result__item__text__list sale__date__map"><?=$model->regionName?></div>
            </div>
            <div class="sale__bottom clear">
                <div class="sale__price">
                    <div class="sale__price__wrap">
                        <span>от <?=$model->price_rub?> руб/чел.</span>
                        <? if($model->company->currency != "RUB") {?>
                            <span>от <?=$model->printPrice?>/чел.</span>
                        <? } ?>
                    </div>
	                <a target="_blank" data-pjax="0" href="/cruise/<?= $model->ID?>/" class="button sale__price--button">Подробнее</a>
                    <!-- div class="button sale__price--button">Подробнее</div -->
                </div>
            </div>
        </div>
    </div>
</div>