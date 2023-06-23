<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 19.11.2018
 * Time: 11:00
 */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\widgets\ListView;
use yii\bootstrap\ActiveForm;

?>
<section class="breadcrumbs">
    <ul class="wrap breadcrumbs__list">
        <li class="breadcrumbs__item">
            <a href="/" class="breadcrumbs__link">Главная</a>
            <span class="breadcrumbs__sep">></span>
        </li>
        <li class="breadcrumbs__item">
            <a href="/ship/" class="breadcrumbs__link">Лайнеры</a>
        </li>
    </ul>
</section>
<section class="page__menu">
    <div class="wrap">
        <div class="page__menu__wrap">
            <h1 class="page__menu__title">Лайнер</h1>
            <ul class="page__menu__nav">
                <li class="page__menu__nav__item">
                    <a href="#info" class="page__menu__nav__link">Инфраструктура</a>
                </li>
                <? if($model->cabins) { ?>
                <li class="page__menu__nav__item">
                    <a href="#cabins" class="page__menu__nav__link">Каюты</a>
                </li>
                <?}?>
                <? if($model->decks) { ?>
                <li class="page__menu__nav__item">
                    <a href="#decks" class="page__menu__nav__link">Палубы</a>
                </li>
                <?}?>
                <? if($model->actions) { ?>
                <li class="page__menu__nav__item">
                    <a href="#actions" class="page__menu__nav__link">Спецпредложения</a>
                </li>
                <?}?>
            </ul>
        </div>
    </div>
</section>
<section class="liner__slider">
    <div class="wrap">
        <div class="liner__slider__flex">
            <?if(@$model->imageList) { ?>
            <div class="lineri__left">
                <div class="kruiz__company__slider">
                    <div class="cart__slider__top--ship kruiz__company__slider__for">
                        <?foreach($model->imageList as $image) {?>
                            <? if(@$image->src) { ?>
                                <div class="cart__slider__bottom__item">
                                    <img src="<?=$image->src?>" alt="">
	                                <?if($model->logo) {?>
	                                    <div class="card__left__photo__logo" style="background-image: url('<?=@$model->logo?>');"></div>
									<?}?>
                                </div>
                            <?}?>
                        <?}?>
                    </div>
                    <?if(count(@$model->imageList) > 1) {?>
                    <div class="cart__slider__bottom--ship kruiz__company__slider__nav">
                        <?foreach($model->imageList as $image) {?>
                            <div class="cart__slider__bottom__item">
                                <img src="<?=$image->src?>" alt="">
                            </div>
                        <?}?>
                    </div>
                    <?}?>
                </div>
            </div>
            <?} else {?>
            <div class="lineri__left">
                <div class="kruiz__company__slider">
                    <div class="cart__slider__top--ship kruiz__company__slider__for">
                        <div class="cart__slider__bottom__item">
                            <img src="<?=@$model->image->src?($model->image->src):"/i_ships/no-ship.png"?>" alt="">
	                        <?if($model->logo) {?>
	                            <div class="card__left__photo__logo" style="background-image: url('<?=@$model->logo?>');"></div>
							<?}?>
                        </div>
                    </div>
                </div>
            </div>
            <?}?>
            <div class="lineri__right">
                <div class="liner__tech">
                    <div class="ship__block__tech__item">
                        <h3><?=$model->name?></h3>
                    </div>
                    <? foreach ($model->options as $option){
                        if($option->value){ ?>
                            <div class="ship__block__tech__item">
                                <div class="ship__block__tech__item__title"><?=$option->title?></div>
                                <div class="ship__block__tech__item__text"><?=$option->value?></div>
                            </div>
                        <?}
                    }?>
                </div>
                <a href="/search/?ships[]=<?=$model->ID?>"  class="button__all">Все круизы на лайнере</a>
            </div>
        </div>
    </div>
</section>
<section class="infra kruiz__title"  >
    <div class="wrap">
        <a name="info"></a>
        <h2>Инфраструктура</h2>
        <div class="tabs cart__tabs tabs__infra">
            <div class="swiper-infra">
                <div class="tabs__wrap tabs__wrap__slide swiper-wrapper">
                    <?if($model->detail) {?>
                        <div class="tabs__item swiper-slide first">Описание лайнера</div>
                    <?}?>
                    <?if($model->food_info) {?>
                        <div class="tabs__item swiper-slide second">Рестораны и бары</div>
                    <?}?>
                    <?if($model->pool_info) {?>
                        <div class="tabs__item swiper-slide third">Басейны</div>
                    <?}?>
                    <?if($model->Entertainment_Info) {?>
                        <div class="tabs__item swiper-slide fours">Развлечения</div>
                    <?}?>
                    <?if($model->map_info) {?>
                        <div class="tabs__item swiper-slide fives">Сервис для детей</div>
                    <?}?>
                    <?if($model->info) {?>
                        <div class="tabs__item swiper-slide sixs">Особенности лайнера</div>
                    <?}?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <div class="tabs__content tabs__content--infra">
                <?if($model->detail) {?>
                    <div class="tabs__content__item first">
                        <?=$model->detail?>
                    </div>
                <?}?>
                <?if($model->food_info) {?>
                    <div class="tabs__content__item second">
                        <?=$model->food_info?>
                    </div>
                <?}?>
                <?if($model->pool_info) {?>
                    <div class="tabs__content__item third">
                        <?=$model->pool_info?>
                    </div>
                <?}?>
                <?if($model->Entertainment_Info) {?>
                    <div class="tabs__content__item fours">
                        <?=$model->Entertainment_Info?>
                    </div>
                <?}?>
                <?if($model->map_info) {?>
                    <div class="tabs__content__item fives">
                        <?=$model->map_info?>
                    </div>
                <?}?>
                <?if($model->info) {?>
                    <div class="tabs__content__item sixs">
                        <?=$model->info?>
                    </div>
                <?}?>
            </div>
        </div>
    </div>
</section>
<? if($model->cabins) { ?>
<section class="infra kruiz__title">
    <div class="wrap">
        <a name="cabins"></a>
        <h2>Каюты</h2>
        <div class="tabs cart__tabs tabs__cabin">
            <div class="swiper-infra">
                <div class="tabs__wrap tabs__wrap__slide swiper-wrapper">
                    <? foreach ($model->cabinGroups as $cabinGroup) {?>
                    <div class="tabs__item swiper-slide"><?=$cabinGroup->name?></div>
                    <?}?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <div class="tabs__content tabs__content--infra">
                <? if($model->cabinGroups && count($model->cabinGroups)){
                    foreach ($model->cabinGroups as $cabinGroup) {?>
                        <div class="tabs__content__item">
                            <div class="tabs__cabin__slider liner__slider__flex">
                                <div class="lineri__left">
                                    <? if(@$cabinGroup->imageList && count($cabinGroup->imageList) ) { ?>
                                        <div class="kruiz__company__slider">
                                            <?if(count($cabinGroup->imageList) > 1) {?>
                                                <div class="cart__slider__top--ship kruiz__company__slider__for">
                                                    <?foreach($cabinGroup->imageList as $image) {?>
                                                        <div class="cart__slider__bottom__item">
                                                            <img src="<?=$image->src?>" alt="">
                                                        </div>
                                                    <? } ?>
                                                </div>
                                                <div class="cart__slider__bottom--ship kruiz__company__slider__nav">
                                                    <?foreach($cabinGroup->imageList as $image) {?>
                                                        <div class="cart__slider__bottom__item">
                                                            <img src="<?=$image->src?>" alt="">
                                                        </div>
                                                    <?}?>
                                                </div>
                                            <?} elseif($cabinGroup->image) {?>
                                                <div>
                                                    <div class="cart__slider__bottom__item">
                                                        <img src="<?=$cabinGroup->image->src?>" alt="">
                                                    </div>
                                                </div>
                                            <?}?>
                                        </div>
                                    <?}?>
                                </div>
                                <div class="lineri__right">
                                    <div class="cabina__info">
                                        <h3><?=$cabinGroup->name?></h3>
                                        <?=$cabinGroup->info?>
                                        <hr>
                                        <? foreach($cabinGroup->cabins as $cabin) {?>
                                            <strong><?=$cabin->code?> <?=$cabin->name?></strong>
                                            <?=$cabin->info?$cabin->info:"<p></p>"?>
                                        <?}?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?}
                }?>
                <? foreach ($model->cabins as $cabin) {?>
                    <div class="tabs__content__item">
                        <div class="tabs__cabin__slider block__flex">
                            <div class="cart-2">
                                <? if(@$cabin->gallery && $cabin->gallery->images ) { ?>
                                <div class="kruiz__company__slider">
                                    <div class="cart__slider__top--ship kruiz__company__slider__for">
                                        <? foreach($cabin->gallery->images as $image) {?>
                                            <div class="cart__slider__bottom__item" style="background-image: url('<?=$image->src?>');"></div>
                                        <?}?>
                                    </div>
                                    <div class="cart__slider__bottom--ship kruiz__company__slider__nav">
                                        <? foreach($cabin->gallery->images as $image) {?>
                                            <div class="cart__slider__bottom__item" style="background-image: url('<?=$image->src?>';"></div>
                                        <?}?>
                                    </div>
                                </div>
                                <? } elseif($cabin->image) {?>
                                    <img src="<?=$cabin->image->src?>">
                                <? } ?>
                            </div>
                            <div class="cart-2">
                                <div class="cabina__info">
                                    <h3>Каюта <?=$cabin->code?></h3>
                                    <h4 class="cart-5__right__title"><?=$cabin->name?></h4>
                                    <?=$cabin->info?$cabin->info:"<p></p>"?>
                                </div>
                            </div>
                        </div>
                    </div>
                <? } ?>
            </div>
        </div>
    </div>
</section>
<?}?>
<? if($model->decks) { ?>
<section class="infra kruiz__title">
    <div class="wrap">
        <a name="decks"></a>
        <h2>Палубы</h2>
        <div class="cabina__wrap">
            <div class="cabina__wrap__left">
                <div class="cabina__wrap__left__top">
                    <div class="cabina__wrap__left__inner">
                        <div class="cabina__wrap__left__inner__bottom">
                            <div class="cabina__wrap__left__img">
                                <div class="cabina__wrap__left__img__wrap" style="background-image: url(/images/lainer/paluba.png);"></div>
                                <div class="cabina__wrap__left__table"></div>
                            </div>
                            <div class="cabina__tabs cabina__wrap__left__select">
                                <div class="cabina__tabs__top">
                                    <div class="cabina__tabs__name">
                                        <? foreach ($model->decks as $deck) {?>
                                            <div class="cabina__tabs__title"><span><?=$deck->name?></span></div>
                                        <? break;}?>
                                        <div class="cabina__tabs__wrap cabina__input__select">
                                            <? foreach ($model->decks as $key => $deck) {?>
                                                <div class="cabina__tabs__item" data-item="<?=$key?>"><?=$deck->name?></div>
                                            <?}?>
                                        </div>
                                    </div>
                                    <a href="" class="cabina__pdf">Посмотреть все палубы</a>
                                    <div class="cabina__detail">Детальный просмотр палуб</div>
                                </div>
                                <div class="cabina__tabs__content cabina__wrap__left__bottom">
                                    <div class="cabina__tabs__content__item">
                                        <div class="cabina__wrap__left__inner">
                                            <div class="cabina__wrap__left__bottom__bottom">
                                                <div class="cabina__wrap__left__bottom__item">
                                                    <div class="cabina__wrap__left__bottom__item__left">Тип каюты</div>
                                                    <div class="cabina__wrap__left__bottom__item__right">Категории</div>
                                                </div>
                                                <div class="cabina__wrap__left__bottom__item">
                                                    <div class="cabina__wrap__left__bottom__item__left">Внутренняя каюта</div>
                                                    <div class="cabina__wrap__left__bottom__item__right">
                                                        <ul class="cabina__wrap__left__bottom__list">
                                                            <li style="background-color:#DCE2ED;">IA</li>
                                                            <li style="background-color:#FFCB05;">IB</li>
                                                            <li style="background-color:#B6B2D8;">IE</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="cabina__wrap__left__bottom__item">
                                                    <div class="cabina__wrap__left__bottom__item__left">Каюта с балконом</div>
                                                    <div class="cabina__wrap__left__bottom__item__right">
                                                        <ul class="cabina__wrap__left__bottom__list">
                                                            <li style="background-color:#D2B675;">O5</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="cabina__wrap__left__bottom__item">
                                                    <div class="cabina__wrap__left__bottom__item__left">Каюта с окном</div>
                                                    <div class="cabina__wrap__left__bottom__item__right">
                                                        <ul class="cabina__wrap__left__bottom__list">
                                                            <li style="background-color:#DE6D28;">B4</li>
                                                            <li style="background-color:#B6CA77;">B5</li>
                                                            <li style="background-color:#FFF200;">BA</li>
                                                            <li style="background-color:#CC8B96;">BB</li>
                                                            <li style="background-color:#90A79D;">BD</li>
                                                            <li style="background-color:#00AEEF;">BE</li>
                                                            <li style="background-color:#DD9317;">BX</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="cabina__wrap__left__bottom__item">
                                                    <div class="cabina__wrap__left__bottom__item__left">Сьют</div>
                                                    <div class="cabina__wrap__left__bottom__item__right">
                                                        <ul class="cabina__wrap__left__bottom__list">
                                                            <li style="background-color:#BC9AC8;">S2</li>
                                                            <li style="background-color:#C84B9B;">S3</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cabina__wrap__left__bottom__top">
                                                <h3>Каюты</h3>
                                                <div class="cabina__wrap__left__bottom__text">
                                                    <div class="cabina__wrap__left__bottom__text__item invalid">Каюта доступна для инвалидов</div>
                                                    <div class="cabina__wrap__left__bottom__text__item unit">Соедененая каюта</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cabina__tabs__content__item">
                                        <div class="cabina__wrap__left__inner">
                                            <div class="cabina__wrap__left__bottom__top">
                                                <h3>Каюты</h3>
                                                <div class="cabina__wrap__left__bottom__text">
                                                    <div class="cabina__wrap__left__bottom__text__item invalid">Каюта доступна для инвалидов</div>
                                                    <div class="cabina__wrap__left__bottom__text__item unit">Соедененая каюта</div>
                                                </div>
                                            </div>
                                            <div class="cabina__wrap__left__bottom__bottom">
                                                <div class="cabina__wrap__left__bottom__item">
                                                    <div class="cabina__wrap__left__bottom__item__left">Тип каюты</div>
                                                    <div class="cabina__wrap__left__bottom__item__right">Категории</div>
                                                </div>
                                                <div class="cabina__wrap__left__bottom__item">
                                                    <div class="cabina__wrap__left__bottom__item__left">Внутренняя каюта</div>
                                                    <div class="cabina__wrap__left__bottom__item__right">
                                                        <ul class="cabina__wrap__left__bottom__list">
                                                            <li style="background-color:#DCE2ED;">IA</li>
                                                            <li style="background-color:#FFCB05;">IB</li>
                                                            <li style="background-color:#B6B2D8;">IE</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="cabina__wrap__left__bottom__item">
                                                    <div class="cabina__wrap__left__bottom__item__left">Каюта с балконом</div>
                                                    <div class="cabina__wrap__left__bottom__item__right">
                                                        <ul class="cabina__wrap__left__bottom__list">
                                                            <li style="background-color:#D2B675;">O5</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="cabina__wrap__left__bottom__item">
                                                    <div class="cabina__wrap__left__bottom__item__left">Каюта с окном</div>
                                                    <div class="cabina__wrap__left__bottom__item__right">
                                                        <ul class="cabina__wrap__left__bottom__list">
                                                            <li style="background-color:#DE6D28;">B4</li>
                                                            <li style="background-color:#B6CA77;">B5</li>
                                                            <li style="background-color:#FFF200;">BA</li>
                                                            <li style="background-color:#CC8B96;">BB</li>
                                                            <li style="background-color:#90A79D;">BD</li>
                                                            <li style="background-color:#00AEEF;">BE</li>
                                                            <li style="background-color:#DD9317;">BX</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="cabina__wrap__left__bottom__item">
                                                    <div class="cabina__wrap__left__bottom__item__left">Сьют</div>
                                                    <div class="cabina__wrap__left__bottom__item__right">
                                                        <ul class="cabina__wrap__left__bottom__list">
                                                            <li style="background-color:#BC9AC8;">S2</li>
                                                            <li style="background-color:#C84B9B;">S3</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cabina__tabs__content__item">
                                        <div class="cabina__wrap__left__inner">
                                            <div class="cabina__wrap__left__bottom__top">
                                                <h3>Каюты</h3>
                                                <div class="cabina__wrap__left__bottom__text">
                                                    <div class="cabina__wrap__left__bottom__text__item invalid">Каюта доступна для инвалидов</div>
                                                    <div class="cabina__wrap__left__bottom__text__item unit">Соедененая каюта</div>
                                                </div>
                                            </div>
                                            <div class="cabina__wrap__left__bottom__bottom">
                                                <div class="cabina__wrap__left__bottom__item">
                                                    <div class="cabina__wrap__left__bottom__item__left">Тип каюты</div>
                                                    <div class="cabina__wrap__left__bottom__item__right">Категории</div>
                                                </div>
                                                <div class="cabina__wrap__left__bottom__item">
                                                    <div class="cabina__wrap__left__bottom__item__left">Внутренняя каюта</div>
                                                    <div class="cabina__wrap__left__bottom__item__right">
                                                        <ul class="cabina__wrap__left__bottom__list">
                                                            <li style="background-color:#DCE2ED;">IA</li>
                                                            <li style="background-color:#FFCB05;">IB</li>
                                                            <li style="background-color:#B6B2D8;">IE</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="cabina__wrap__left__bottom__item">
                                                    <div class="cabina__wrap__left__bottom__item__left">Каюта с балконом</div>
                                                    <div class="cabina__wrap__left__bottom__item__right">
                                                        <ul class="cabina__wrap__left__bottom__list">
                                                            <li style="background-color:#D2B675;">O5</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="cabina__wrap__left__bottom__item">
                                                    <div class="cabina__wrap__left__bottom__item__left">Каюта с окном</div>
                                                    <div class="cabina__wrap__left__bottom__item__right">
                                                        <ul class="cabina__wrap__left__bottom__list">
                                                            <li style="background-color:#DE6D28;">B4</li>
                                                            <li style="background-color:#B6CA77;">B5</li>
                                                            <li style="background-color:#FFF200;">BA</li>
                                                            <li style="background-color:#CC8B96;">BB</li>
                                                            <li style="background-color:#90A79D;">BD</li>
                                                            <li style="background-color:#00AEEF;">BE</li>
                                                            <li style="background-color:#DD9317;">BX</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="cabina__wrap__left__bottom__item">
                                                    <div class="cabina__wrap__left__bottom__item__left">Сьют</div>
                                                    <div class="cabina__wrap__left__bottom__item__right">
                                                        <ul class="cabina__wrap__left__bottom__list">
                                                            <li style="background-color:#BC9AC8;">S2</li>
                                                            <li style="background-color:#C84B9B;">S3</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cabina__tabs__content__item">
                                        <div class="cabina__wrap__left__inner">
                                            <div class="cabina__wrap__left__bottom__top">
                                                <h3>Каюты</h3>
                                                <div class="cabina__wrap__left__bottom__text">
                                                    <div class="cabina__wrap__left__bottom__text__item invalid">Каюта доступна для инвалидов</div>
                                                    <div class="cabina__wrap__left__bottom__text__item unit">Соедененая каюта</div>
                                                </div>
                                            </div>
                                            <div class="cabina__wrap__left__bottom__bottom">
                                                <div class="cabina__wrap__left__bottom__item">
                                                    <div class="cabina__wrap__left__bottom__item__left">Тип каюты</div>
                                                    <div class="cabina__wrap__left__bottom__item__right">Категории</div>
                                                </div>
                                                <div class="cabina__wrap__left__bottom__item">
                                                    <div class="cabina__wrap__left__bottom__item__left">Внутренняя каюта</div>
                                                    <div class="cabina__wrap__left__bottom__item__right">
                                                        <ul class="cabina__wrap__left__bottom__list">
                                                            <li style="background-color:#DCE2ED;">IA</li>
                                                            <li style="background-color:#FFCB05;">IB</li>
                                                            <li style="background-color:#B6B2D8;">IE</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="cabina__wrap__left__bottom__item">
                                                    <div class="cabina__wrap__left__bottom__item__left">Каюта с балконом</div>
                                                    <div class="cabina__wrap__left__bottom__item__right">
                                                        <ul class="cabina__wrap__left__bottom__list">
                                                            <li style="background-color:#D2B675;">O5</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="cabina__wrap__left__bottom__item">
                                                    <div class="cabina__wrap__left__bottom__item__left">Каюта с окном</div>
                                                    <div class="cabina__wrap__left__bottom__item__right">
                                                        <ul class="cabina__wrap__left__bottom__list">
                                                            <li style="background-color:#DE6D28;">B4</li>
                                                            <li style="background-color:#B6CA77;">B5</li>
                                                            <li style="background-color:#FFF200;">BA</li>
                                                            <li style="background-color:#CC8B96;">BB</li>
                                                            <li style="background-color:#90A79D;">BD</li>
                                                            <li style="background-color:#00AEEF;">BE</li>
                                                            <li style="background-color:#DD9317;">BX</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="cabina__wrap__left__bottom__item">
                                                    <div class="cabina__wrap__left__bottom__item__left">Сьют</div>
                                                    <div class="cabina__wrap__left__bottom__item__right">
                                                        <ul class="cabina__wrap__left__bottom__list">
                                                            <li style="background-color:#BC9AC8;">S2</li>
                                                            <li style="background-color:#C84B9B;">S3</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cabina__wrap__right">
                <div class="cabina__wrap__right__close"></div>
                <!--<div class="cabina__wrap__right__select__mobile">
                    <div class="cabina__tabs__name cabina__wrap__right__select__mobile__select">
                        <div class="cabina__tabs__title"><span>Выбрать палубу</span></div>
                        <div class="cabina__tabs__wrap cabina__input__select">
                            <div class="cabina__tabs__item">Палуба 1</div>
                            <div class="cabina__tabs__item">Палуба 2</div>
                            <div class="cabina__tabs__item">Палуба 3</div>
                            <div class="cabina__tabs__item">нижняя палуба</div>
                        </div>
                    </div>
                </div>-->
                <div class="tabs__content__right">
                    <div class="tabs__content__right__item">
                        <div class="cabina__wrap__right__slider">
                            <div class="cabina__wrap__right__slider__item">
                                <div class="cabina__wrap__right__slider__item__text">
                                    <span>Космическая палуба </span>
                                    <span>№ 7</span>
                                </div>
                                <a href="images/lainer/liner.png" data-fancybox>
                                    <img src="images/lainer/liner.png" alt="">
                                </a>
                            </div>
                            <div class="cabina__wrap__right__slider__item">
                                <div class="cabina__wrap__right__slider__item__text">
                                    <span>Космическая палуба </span>
                                    <span>№ 625</span>
                                </div>
                                <a href="images/lainer/liner.png" data-fancybox>
                                    <img src="images/lainer/liner.png" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="tabs__content__right__item">
                        <div class="cabina__wrap__right__slider">
                            <div class="cabina__wrap__right__slider__item">
                                <div class="cabina__wrap__right__slider__item__text">
                                    <span>Космическая палуба </span>
                                    <span>№ 2</span>
                                </div>
                                <a href="images/lainer/liner.png" data-fancybox>
                                    <img src="images/lainer/liner.png" alt="">
                                </a>
                            </div>
                            <div class="cabina__wrap__right__slider__item">
                                <div class="cabina__wrap__right__slider__item__text">
                                    <span>Космическая палуба </span>
                                    <span>№ 625</span>
                                </div>
                                <a href="images/lainer/liner.png" data-fancybox>
                                    <img src="images/lainer/liner.png" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="tabs__content__right__item">
                        <div class="cabina__wrap__right__slider">
                            <div class="cabina__wrap__right__slider__item">
                                <div class="cabina__wrap__right__slider__item__text">
                                    <span>Космическая палуба </span>
                                    <span>№ 3</span>
                                </div>
                                <a href="images/lainer/liner.png" data-fancybox>
                                    <img src="images/lainer/liner.png" alt="">
                                </a>
                            </div>
                            <div class="cabina__wrap__right__slider__item">
                                <div class="cabina__wrap__right__slider__item__text">
                                    <span>Космическая палуба </span>
                                    <span>№ 625</span>
                                </div>
                                <a href="images/lainer/liner.png" data-fancybox>
                                    <img src="images/lainer/liner.png" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="tabs__content__right__item">
                        <div class="cabina__wrap__right__slider">
                            <div class="cabina__wrap__right__slider__item">
                                <div class="cabina__wrap__right__slider__item__text">
                                    <span>Нижняя палуба </span>
                                    <span>№ 4</span>
                                </div>
                                <a href="images/lainer/liner.png" data-fancybox>
                                    <img src="images/lainer/liner.png" alt="">
                                </a>
                            </div>
                            <div class="cabina__wrap__right__slider__item">
                                <div class="cabina__wrap__right__slider__item__text">
                                    <span>Космическая палуба </span>
                                    <span>№ 625</span>
                                </div>
                                <a href="images/lainer/liner.png" data-fancybox>
                                    <img src="images/lainer/liner.png" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?}?>
<? if($model->actions) { ?>
<section class="kruiz__action liner__action">
    <div class="wrap">
        <a name="actions"></a>
        <div class="sale__main block__flex">
            <div class="cart-2 kruiz__action__predl">
                <h2>Спецпредложения и акции</h2>
                <ul class="sale__list">
                    <li class="sale__item clear">
                        <div class="sale__popular"><span>%</span></div>
                        <div class="sale__social">
                            <a href="" class="sale__social__item sale__social__item--active"></a>
                            <a href="" class="sale__social__item sale__social__item--active"></a>
                            <a href="" class="sale__social__item sale__social__item--active"></a>
                        </div>
                        <div class="sale__date__cal">11.11.2018 - 25.11.2018 15 ночей</div>  <div class="sale__title">Лучезарный вояж, MAASDAM - премиум, Holland America Line</div>
                        <div class="sale__item__component">
                            <div class="sale__item__left">
                                <div class="sale__img">
                                    <div class="sale__img__wrap" style="background-image: url(/images/251d2b42e31a5f104383829d8130cb9e-min.jpg);"></div>
                                    <div class="sale__img__sale">-40%</div>
                                </div>
                                <div class="form__result__item__bottom sale__bottom__result">
                                    <ul class="form__result__item__bottom__wrap__list">
                                        <li class="form__result__item__bottom__list">
                                            <img src="/images/ship.svg" alt="">
                                            <div class="form__result__item__bottom__popup">Полный пансион</div>
                                        </li>
                                        <li class="form__result__item__bottom__list">
                                            <img src="/images/ship.svg" alt="">
                                            <div class="form__result__item__bottom__popup">Завтраки</div>
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
                                    <div class="form__result__item__button">
                                        <a href="" target="_blank">Отзывы</a>
                                        <a href="" target="_blank">Скачать PDF</a>
                                    </div>
                                </div>
                            </div>
                            <div class="sale__item__right">
                                <div class="sale__text">
                                    <div class="sale__title__wrap">
                                        <div class="sale__tur">Хельсинки — Стогкольм — Хельсинки — Хельсинки ... </div>
                                    </div>
                                    <div class="form__result__item__text__list__wrap block__flex">
                                        <div class="form__result__item__text__list sale__date__name">Посмотреть на карте</div>
                                        <div class="form__result__item__text__list sale__date__history">История, Архетектура</div>
                                        <div class="form__result__item__text__list sale__date__map">Средиземное море</div>
                                    </div>
                                    <div class="sale__bottom clear">
                                        <div class="sale__price">
                                            <div class="sale__price__wrap">
                                                <span>от 6 000 000 руб</span>
                                                <span>от 6 000 000 $</span>
                                            </div>
                                            <div class="button sale__price--button">Подробнее</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="sale__item clear">
                        <div class="sale__popular"><img src="/images/new/gift.svg" alt=""></div>
                        <div class="sale__social">
                            <a href="" class="sale__social__item"></a>
                            <a href="" class="sale__social__item"></a>
                            <a href="" class="sale__social__item"></a>
                        </div>
                        <div class="sale__date__cal">11.11.2018 - 25.11.2018 15 дней</div>  <div class="sale__title">Лучезарный вояж, 15 дн. MAASDAM - премиум, Holland America Line</div>
                        <div class="sale__item__component">
                            <div class="sale__item__left">
                                <div class="sale__img">
                                    <div class="sale__img__wrap" style="background-image: url(/images/251d2b42e31a5f104383829d8130cb9e-min.jpg);"></div>
                                    <div class="sale__img__sale">Подарок</div>
                                </div>
                                <div class="form__result__item__bottom">
                                    <ul class="form__result__item__bottom__wrap__list">
                                        <li class="form__result__item__bottom__list">
                                            <img src="/images/ship.svg" alt="">
                                            <div class="form__result__item__bottom__popup">Полный пансион</div>
                                        </li>
                                        <li class="form__result__item__bottom__list">
                                            <img src="/images/ship.svg" alt="">
                                            <div class="form__result__item__bottom__popup">Завтраки</div>
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
                                    <div class="form__result__item__button">
                                        <a href="" target="_blank">Отзывы</a>
                                        <a href="" target="_blank">Скачать PDF</a>
                                    </div>
                                </div>
                            </div>
                            <div class="sale__item__right">
                                <div class="sale__text">
                                    <div class="sale__title__wrap">
                                        <div class="sale__tur">Хельсинки — Стогкольм — Хельсинки — Хельсинки ... </div>
                                    </div>
                                    <div class="form__result__item__text__list__wrap block__flex">
                                        <div class="form__result__item__text__list sale__date__name">Посмотреть на карте</div>
                                        <div class="form__result__item__text__list sale__date__history">История, Архетектура</div>
                                        <div class="form__result__item__text__list sale__date__map">Средиземное море</div>
                                    </div>
                                    <div class="sale__bottom clear">
                                        <div class="sale__price">
                                            <div class="sale__price__wrap">
                                                <span>от 6 000 000 руб</span>
                                                <span>от 6 000 000 $</span>
                                            </div>
                                            <div class="button sale__price--button">Подробнее</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="sale__item clear">
                        <div class="sale__popular"><img src="/images/new/star-w.svg" alt=""></div>
                        <div class="sale__social">
                            <a href="" class="sale__social__item"></a>
                            <a href="" class="sale__social__item"></a>
                            <a href="" class="sale__social__item"></a>
                        </div>
                        <div class="sale__date__cal">11.11.2018 - 25.11.2018 15 дней</div>  <div class="sale__title">Лучезарный вояж, 15 дн. MAASDAM - премиум, Holland America Line</div>
                        <div class="sale__item__component">
                            <div class="sale__item__left">
                                <div class="sale__img">
                                    <div class="sale__img__wrap" style="background-image: url(/images/251d2b42e31a5f104383829d8130cb9e-min.jpg);"></div>
                                    <div class="sale__img__sale">Акция</div>
                                </div>
                                <div class="form__result__item__bottom">
                                    <ul class="form__result__item__bottom__wrap__list">
                                        <li class="form__result__item__bottom__list">
                                            <img src="/images/ship.svg" alt="">
                                            <div class="form__result__item__bottom__popup">Полный пансион</div>
                                        </li>
                                        <li class="form__result__item__bottom__list">
                                            <img src="/images/ship.svg" alt="">
                                            <div class="form__result__item__bottom__popup">Завтраки</div>
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
                                    <div class="form__result__item__button">
                                        <a href="" target="_blank">Отзывы</a>
                                        <a href="" target="_blank">Скачать PDF</a>
                                    </div>
                                </div>
                            </div>
                            <div class="sale__item__right">
                                <div class="sale__text">
                                    <div class="sale__title__wrap">
                                        <div class="sale__tur">Хельсинки — Стогкольм — Хельсинки — Хельсинки ... </div>
                                    </div>
                                    <div class="form__result__item__text__list__wrap block__flex">
                                        <div class="form__result__item__text__list sale__date__name">Посмотреть на карте</div>
                                        <div class="form__result__item__text__list sale__date__history">История, Архетектура</div>
                                        <div class="form__result__item__text__list sale__date__map">Средиземное море</div>
                                    </div>
                                    <div class="sale__bottom clear">
                                        <div class="sale__price">
                                            <div class="sale__price__wrap">
                                                <span>от 6 000 000 руб</span>
                                                <span>от 6 000 000 $</span>
                                            </div>
                                            <div class="button sale__price--button">Подробнее</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <a href="" class="sale__more">Смотреть все варианты</a>
            </div>
            <div class="cart-2 kruiz__action__otziv">
                <div class="news__main__title"><h2>Отзывы</h2><a href="" class="news__main__title__link news__main__title__link--kruiz">все отзывы</a><span class="news__main__title__link news__main__title__link--otziv otziv__popup">оставить отзыв +</span></div>
                <div class="otziv__main__slide">
                    <div class="otziv__main__slide__item">
                        <ul class="otziv__main__list">
                            <li class="otziv__main__item clear">
                                <div class="otziv__main__link">
                                    <div class="otziv__main__text">
                                        <div class="otziv__main__text__top">
                                            <div class="otziv__main__img" style="background-image: url(/images/251d2b42e31a5f104383829d8130cb9e-min.jpg);"></div>
                                            <div class="otziv__main__text__title">Имя Фамилия</div>
                                            <ul class="star__wrap">
                                                <li class="star__item"><img src="/images/new/star-y.svg" alt=""></li>
                                                <li class="star__item"><img src="/images/new/star-y.svg" alt=""></li>
                                                <li class="star__item"><img src="/images/new/star-y.svg" alt=""></li>
                                                <li class="star__item"><img src="/images/new/star-y.svg" alt=""></li>
                                                <li class="star__item"><img src="/images/new/star-y.svg" alt=""></li>
                                            </ul>
                                        </div>
                                        <div class="otziv__main__desc">
                                            <div class="otziv__main__desc__item">
                                                <span>Название корабля:</span> Великий Корабль Названывич Второй
                                            </div>
                                            <div class="otziv__main__desc__item">
                                                <span>Даты круиза:</span> 11.2018 - 11.2018
                                            </div>
                                            <div class="otziv__main__desc__item">
                                                <span>Маршрут:</span> Хельсинки — Стогкольм — Хельсинки...
                                            </div>
                                        </div>
                                        <div class="otziv__main__text__descr">Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому .  используют потому...</div>
                                    </div>
                                </div>
                                <div class="otziv__popup"></div>
                            </li>
                            <li class="otziv__main__item clear">
                                <div class="otziv__main__link">
                                    <div class="otziv__main__text">
                                        <div class="otziv__main__text__top">
                                            <div class="otziv__main__img" style="background-image: url(/images/251d2b42e31a5f104383829d8130cb9e-min.jpg);"></div>
                                            <div class="otziv__main__text__title">Имя Фамилия</div>
                                            <ul class="star__wrap">
                                                <li class="star__item"><img src="/images/new/star-y.svg" alt=""></li>
                                                <li class="star__item"><img src="/images/new/star-y.svg" alt=""></li>
                                                <li class="star__item"><img src="/images/new/star-y.svg" alt=""></li>
                                                <li class="star__item"><img src="/images/new/star-y.svg" alt=""></li>
                                                <li class="star__item"><img src="/images/new/star-y.svg" alt=""></li>
                                            </ul>
                                        </div>
                                        <div class="otziv__main__desc">
                                            <div class="otziv__main__desc__item">
                                                <span>Название корабля:</span> Великий Корабль Названывич Второй
                                            </div>
                                            <div class="otziv__main__desc__item">
                                                <span>Даты круиза:</span> 11.2018 - 11.2018
                                            </div>
                                            <div class="otziv__main__desc__item">
                                                <span>Маршрут:</span> Хельсинки — Стогкольм — Хельсинки...
                                            </div>
                                        </div>
                                        <div class="otziv__main__text__descr">Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому .  используют потому...</div>
                                    </div>
                                </div>
                                <div class="otziv__popup"></div>
                            </li>
                            <li class="otziv__main__item clear">
                                <div class="otziv__main__link">
                                    <div class="otziv__main__text">
                                        <div class="otziv__main__text__top">
                                            <div class="otziv__main__img" style="background-image: url(/images/251d2b42e31a5f104383829d8130cb9e-min.jpg);"></div>
                                            <div class="otziv__main__text__title">Имя Фамилия</div>
                                            <ul class="star__wrap">
                                                <li class="star__item"><img src="/images/new/star-y.svg" alt=""></li>
                                                <li class="star__item"><img src="/images/new/star-y.svg" alt=""></li>
                                                <li class="star__item"><img src="/images/new/star-y.svg" alt=""></li>
                                                <li class="star__item"><img src="/images/new/star-y.svg" alt=""></li>
                                                <li class="star__item"><img src="/images/new/star-y.svg" alt=""></li>
                                            </ul>
                                        </div>
                                        <div class="otziv__main__desc">
                                            <div class="otziv__main__desc__item">
                                                <span>Название корабля:</span> Великий Корабль Названывич Второй
                                            </div>
                                            <div class="otziv__main__desc__item">
                                                <span>Даты круиза:</span> 11.2018 - 11.2018
                                            </div>
                                            <div class="otziv__main__desc__item">
                                                <span>Маршрут:</span> Хельсинки — Стогкольм — Хельсинки...
                                            </div>
                                        </div>
                                        <div class="otziv__main__text__descr">Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому .  используют потому...</div>
                                    </div>
                                </div>
                                <div class="otziv__popup"></div>
                            </li>

                        </ul>
                    </div>
                    <div class="otziv__main__slide__item">
                        <ul class="otziv__main__list">
                            <li class="otziv__main__item clear">
                                <div class="otziv__main__link">
                                    <div class="otziv__main__text">
                                        <div class="otziv__main__text__top">
                                            <div class="otziv__main__img" style="background-image: url(/images/251d2b42e31a5f104383829d8130cb9e-min.jpg);"></div>
                                            <div class="otziv__main__text__title">Имя Фамилия</div>
                                            <ul class="star__wrap">
                                                <li class="star__item"><img src="/images/new/star-y.svg" alt=""></li>
                                                <li class="star__item"><img src="/images/new/star-y.svg" alt=""></li>
                                                <li class="star__item"><img src="/images/new/star-y.svg" alt=""></li>
                                                <li class="star__item"><img src="/images/new/star-y.svg" alt=""></li>
                                                <li class="star__item"><img src="/images/new/star-y.svg" alt=""></li>
                                            </ul>
                                        </div>
                                        <div class="otziv__main__desc">
                                            <div class="otziv__main__desc__item">
                                                <span>Название корабля:</span> Великий Корабль Названывич Второй
                                            </div>
                                            <div class="otziv__main__desc__item">
                                                <span>Даты круиза:</span> 11.2018 - 11.2018
                                            </div>
                                            <div class="otziv__main__desc__item">
                                                <span>Маршрут:</span> Хельсинки — Стогкольм — Хельсинки...
                                            </div>
                                        </div>
                                        <div class="otziv__main__text__descr">Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому .  используют потому...</div>
                                    </div>
                                </div>
                                <div class="otziv__popup"></div>
                            </li>
                            <li class="otziv__main__item clear">
                                <div class="otziv__main__link">
                                    <div class="otziv__main__text">
                                        <div class="otziv__main__text__top">
                                            <div class="otziv__main__img" style="background-image: url(/images/251d2b42e31a5f104383829d8130cb9e-min.jpg);"></div>
                                            <div class="otziv__main__text__title">Имя Фамилия</div>
                                            <ul class="star__wrap">
                                                <li class="star__item"><img src="/images/new/star-y.svg" alt=""></li>
                                                <li class="star__item"><img src="/images/new/star-y.svg" alt=""></li>
                                                <li class="star__item"><img src="/images/new/star-y.svg" alt=""></li>
                                                <li class="star__item"><img src="/images/new/star-y.svg" alt=""></li>
                                                <li class="star__item"><img src="/images/new/star-y.svg" alt=""></li>
                                            </ul>
                                        </div>
                                        <div class="otziv__main__desc">
                                            <div class="otziv__main__desc__item">
                                                <span>Название корабля:</span> Великий Корабль Названывич Второй
                                            </div>
                                            <div class="otziv__main__desc__item">
                                                <span>Даты круиза:</span> 11.2018 - 11.2018
                                            </div>
                                            <div class="otziv__main__desc__item">
                                                <span>Маршрут:</span> Хельсинки — Стогкольм — Хельсинки...
                                            </div>
                                        </div>
                                        <div class="otziv__main__text__descr">Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому .  используют потому...</div>
                                    </div>
                                </div>
                                <div class="otziv__popup"></div>
                            </li>
                            <li class="otziv__main__item clear">
                                <div class="otziv__main__link">
                                    <div class="otziv__main__text">
                                        <div class="otziv__main__text__top">
                                            <div class="otziv__main__img" style="background-image: url(/images/251d2b42e31a5f104383829d8130cb9e-min.jpg);"></div>
                                            <div class="otziv__main__text__title">Имя Фамилия</div>
                                            <ul class="star__wrap">
                                                <li class="star__item"><img src="/images/new/star-y.svg" alt=""></li>
                                                <li class="star__item"><img src="/images/new/star-y.svg" alt=""></li>
                                                <li class="star__item"><img src="/images/new/star-y.svg" alt=""></li>
                                                <li class="star__item"><img src="/images/new/star-y.svg" alt=""></li>
                                                <li class="star__item"><img src="/images/new/star-y.svg" alt=""></li>
                                            </ul>
                                        </div>
                                        <div class="otziv__main__desc">
                                            <div class="otziv__main__desc__item">
                                                <span>Название корабля:</span> Великий Корабль Названывич Второй
                                            </div>
                                            <div class="otziv__main__desc__item">
                                                <span>Даты круиза:</span> 11.2018 - 11.2018
                                            </div>
                                            <div class="otziv__main__desc__item">
                                                <span>Маршрут:</span> Хельсинки — Стогкольм — Хельсинки...
                                            </div>
                                        </div>
                                        <div class="otziv__main__text__descr">Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому .  используют потому...</div>
                                    </div>
                                </div>
                                <div class="otziv__popup"></div>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?}?>