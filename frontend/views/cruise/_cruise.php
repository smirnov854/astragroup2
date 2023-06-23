<?php

/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 19.11.2018
 * Time: 11:21
 */

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

$obShip = @$model->ship->image;
$obLogo = @$model->company->logo;
// var_dump($model->company->currency);
?>

<li class="sale__item clear" style="margin-bottom: 20px;">
    <div class="sale__popular"><span>%</span></div>
    <div class="sale__social" style="display: none;">
        <a href="" class="sale__social__item sale__social__item--active"></a>
        <a href="" class="sale__social__item sale__social__item--active"></a>
        <a href="" class="sale__social__item sale__social__item--active"></a>
    </div>
    <div class="sale__title"><?= $model->ancor ? $model->ancor : $model->name ?></div>
    <div class="sale__item__component">
        <div class="sale__item__left">
            <div class="sale__img">
                <div class="sale__img__wrap" style="background-image: url('<?= @$obShip->src ? ($obShip->src) : "/i_ships/no-ship.png" ?>');"></div>
                <? if ($model->sale_text) {?>
                <div class="sale__img__sale"><?= $model->sale_text ?></div>
                <?}?>
            </div>
            <div class="form__result__item__bottom sale__bottom__result" style="opacity: 0.3">
                <ul class="form__result__item__bottom__wrap__list">
                    <li class="form__result__item__bottom__list">
                        <img src="/images/ship.svg" alt="">
                    </li>
                    <li class="form__result__item__bottom__list">
                        <img src="/images/ship.svg" alt="">
                    </li>
                    <li class="form__result__item__bottom__list">
                        <img src="/images/ship.svg" alt="">
                    </li>
                    <li class="form__result__item__bottom__list">
                        <img src="/images/ship.svg" alt="">
                    </li>
                    <li class="form__result__item__bottom__list">
                        <img src="/images/ship.svg" alt="">
                    </li>
                </ul>
                <div class="form__result__item__button" style="display: none;">
                    <a href="" target="_blank">Отзывы</a>
                    <a href="" target="_blank">Скачать PDF</a>
                </div>
            </div>
        </div>
        <div class="sale__item__right">
            <div class="sale__text">
                <div class="sale__title__wrap">
                    <div class="sale__tur" style="min-height: 70px;"><?= $model->itinerary ?>
                    </div>
                </div>
                <div class="form__result__item__text__list__wrap block__flex" style="display: none;">
                    <div class="form__result__item__text__list sale__date__name">Посмотреть на карте</div>
                    <div class="form__result__item__text__list sale__date__history">История, Архетектура</div>
                    <div class="form__result__item__text__list sale__date__map">Средиземное море</div>
                </div>
                <div class="sale__bottom clear">
                    <div class="sale__price">
                        <div class="sale__price__wrap">
                            <span class="form__result__mobile__price">от <?= $model->price_rub ?> руб</span>
                            <? if($model->company->currency != "RUB") {?>
                            <span class="form__result__mobile__price">от <?= $model->printPrice ?></span>
                            <? } ?>
                        </div>
                        <a href="<? $model->getAncor()?>" class="button form__result__item__right-button" style="font-weight: normal;">Подробнее&nbsp;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</li>