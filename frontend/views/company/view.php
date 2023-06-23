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
            <a href="/" class="breadcrumbs__link">Компании</a>
            <span class="breadcrumbs__sep">></span>
        </li>
        <li class="breadcrumbs__item">
            <?=$model->name?>
        </li>
    </ul>
</section>
<section class="page__menu">
    <div class="wrap">
        <div class="page__menu__wrap">
            <h1 class="page__menu__title"><?=$model->name?></h1>
        </div>
    </div>
</section>
<section class="company__slider">
    <div class="wrap">
        <div class="block__flex">
            <? if($model->gallery && count($model->gallery->images)) {?>
            <div class="cart-2 company__slider__left">
                <div class="kruiz__company__slider">
                    <div class="cart__slider__top--ship kruiz__company__slider__for">
                        <? foreach ($model->gallery->images as $image) { ?>
                        <div class="cart__slider__bottom__item" style="background-image: url(<?=$image->src?>);"></div>
                        <?}?>
                    </div>
                    <div class="cart__slider__bottom--ship kruiz__company__slider__nav">
                        <? foreach ($model->gallery->images as $image) { ?>
                        <div class="cart__slider__bottom__item" style="background-image: url(<?=$image->src?>);"></div>
                        <?}?>
                    </div>
                </div>
            </div>
            <? } elseif($model->shipGallery && count($model->shipGallery)){ ?>
	            <div class="cart-2 company__slider__left">
		            <div class="kruiz__company__slider">
			            <div class="cart__slider__top--ship kruiz__company__slider__for">
							<? foreach ($model->shipGallery as $image) { ?>
					            <div class="cart__slider__bottom__item" style="background-image: url('<?=$image->src?>');"></div>
							<?}?>
			            </div>
			            <div class="cart__slider__bottom--ship kruiz__company__slider__nav">
							<? foreach ($model->shipGallery as $image) { ?>
					            <div class="cart__slider__bottom__item" style="background-image: url('<?=$image->src?>');"></div>
							<?}?>
			            </div>
		            </div>
	            </div>
			<? } elseif($model->image->src) {?>
            <div class="cart-2 company__slider__left">
                <img src="<?=$model->image->src?>">
            </div>
            <?}?>
	        <?
	        $arInfoBlocks = [
                1=>"description",
                2=>"flot_info",
		        3=>"food_info",
		        4=>"activity_info",
		        5=>"dress_info",
		        6=>"kids_info",
		        7=>"celebration_info",
		        8=>"rus_info",
		        9=>"loyalty_info",
		        10=>"villa_info",
		        11=>"age_limit",
		        12=>"booking_info",
	        ];
	        ?>
            <div class="cart-2 company__slider__right">
                <ul class="accordion cart__accordion">
	                <? $first=true; foreach($arInfoBlocks as $key => $block){
	                	if($model->{$block}){?>
                    <li class="accordion__item" data-tab="<?=$key?>">
                        <div class="accordion__tittle accordion__tittle--cabina <?if(!$first){ print " open-active";}?>"><span>+</span><?=$model->getAttributeLabel($block)?></div>
                        <div class="accordion__content" <?if(!$first){ ?> style="display: none"<?}?>>
                            <div class="company__inner__descr__wrap">
                                <?=$model->{$block}?>
                            </div>
                        </div>
                    </li>
					<?  $first=false; }
                    }?>
                </ul>
                <a href="/search/?companies[]=<?=$model->ID?>" target="_blank" class="company__inner__all">Все круизы компании</a>
            </div>
        </div>
    </div>
</section>
<section class="company__liner kruiz__title">
    <div class="wrap">
        <h2>Лайнеры</h2>
        <ul class="list__flex company__liner__list">
            <? foreach ($model->ships as $ship) {?>
            <li class="list__flex__4  company__liner__list__item">
                <div class="lainer__list__item__bottom">
                    <h3><?=$ship->name?></h3>
                </div>
                <div class="lainer__list__item__bottom__list">
                    <?foreach($ship->options as $option) {?>
                    <div class="ship__block__tech__item">
                        <div class="ship__block__tech__item__title"><?=$option->title?></div>
                        <div class="ship__block__tech__item__text"><?=$option->value?></div>
                    </div>
                    <?}?>

                    <div class="ship__block__tech__item">
                        <div class="ship__block__tech__item__title">Категория корабля</div>
                        <div class="ship__block__tech__item__text">
                            <ul class="star__wrap__liner">
                                <li class="star__item"><img src="/images/cart/Star.png" alt=""></li>
                                <li class="star__item"><img src="/images/cart/Star.png" alt=""></li>
                                <li class="star__item"><img src="/images/cart/Star.png" alt=""></li>
                                <li class="star__item"><img src="/images/cart/Star.png" alt=""></li>
                                <li class="star__item"><img src="/images/lainer/Star.svg" alt=""></li>
                            </ul>
                        </div>
                    </div>
                    <a href="/ship/<?=$ship->ID?>/" class="lainer__list__item__bottom__link">Подробнее</a>
                    <a href="/search/" class="lainer__list__item__bottom__button">Все круизы на этом лайнере</a>
                </div>
            </li>
            <? } ?>
        </ul>
    </div>
</section>