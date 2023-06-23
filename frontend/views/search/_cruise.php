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
<li class="form__result__list">
    <div class="form__result__item__left clear">
        <div class="form__result__list__title"><?= $model->ancor ? $model->ancor : $model->name ?></div>
        <div class="form__result__item__left__top clear">
            <div class="form__result__item__img">
                <div class="form__result__item__img__wrap">
                    <div class="form__result__item__img__wrap" style="background-image: url('<?= @$obShip->src ? ($obShip->src) : "/i_ships/no-ship.png" ?>'); background-size: cover; background-repeat: no-repeat;">
                    </div>
                    <? if ($model->sale_text) {?>
                    <div class="form__result__item__img__sale"><?= $model->sale_text ?></div>
                    <?}?>
                </div>
                <div class="form__result__item__bottom">
                    <? if($model->icons) {?>
                    <ul class="form__result__item__bottom__wrap__list">
                        <?foreach($model->icons as $icon) {?>
                        <li class="form__result__item__bottom__list">
                            <img src="<?= $icon->src ?>" alt="<?= $icon->name ?>">
                            <div class="form__result__item__bottom__popup"><?= preg_replace('/(\s)/', '&nbsp;', $icon->name); ?></div>
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
            <div class="form__result__item__text">
                <div class="form__result__item__text__title">
                    <?= $model->itinerary ?>
                </div>
                <div class="form__result__item__text__list__wrap block__flex">
                    <div class="form__result__item__text__list sale__date__map"><?= $model->regionName ?></div>
                    <div class="form__result__item__text__list sale__date"><?= $model->saledate ?></div>
                    <div style="display: none" class="form__result__item__text__list sale__date__history">История, Архетектура</div>
                    <div style="display: none" class="form__result__item__text__list sale__date__name">Посмотреть на карте</div>
                </div>
                <div class="form__result__mobile">
                    <div>
                        <span class="form__result__mobile__price">от <?= $model->price_rub ?> руб/чел.</span>
                        <? if($model->company->currency != "RUB") {?>
                        <span class="form__result__mobile__price">от <?= $model->printPrice ?>/чел.</span>
                        <? } ?>
                    </div>
                    <a href="/cruise/<?= $model->ID ?>/" class="button form__result__mobile--button">Подробнее</a>
                </div>
            </div>
        </div>
    </div>
    <div class="form__result__item__right">
        <div class="form__result__item__right__logo" style="background-size: contain; background-image: url(<?= @$obLogo ? ($obLogo) : "images/251d2b42e31a5f104383829d8130cb9e-min.jpg" ?>);"></div>
        <div class="form__result__item__right__social" style="display: none">
            <div class="form__result__item__right__social__item"></div>
            <div class="form__result__item__right__social__item"></div>
            <div class="form__result__item__right__social__item"></div>
        </div>
        <? if($model->printPrice) { ?>
        <div class="form__result__item__right__price">
            от <?= $model->printPrice ?>/чел.
        </div>
        <?}?>
        <? if($model->company->currency == "RUB") {?>
        <div class="form__result__item__right__price">
            от <?= $model->price_rub ?> руб/чел.
        </div>
        <?} else {?>
        <div class="form__result__item__right__price__rub">
            от <?= $model->price_rub ?> руб/чел.
        </div>
        <?}?>
        <div class="form__result__item__right__button">
            <div class="form__result__item__right__select custom-select">
                <select>
                    <option value="">Другие даты</option>
                    <option value="">дата</option>
                    <option value="">еще дата</option>
                </select>
            </div>
            <a target="_blank" data-pjax="0" href="/cruise/<?= $model->ID ?>/" class="button form__result__item__right-button">Подробнее</a>
        </div>
    </div>
</li>