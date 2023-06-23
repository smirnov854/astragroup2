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
            Компании
        </li>
    </ul>
</section>
<section class="page__menu">
    <div class="wrap">
        <div class="page__menu__wrap">
            <h1 class="page__menu__title">Компании</h1>
        </div>
    </div>
</section>
<!--<pre>-->
<!--    --><?php //print_r($arDataProvider) ; ?>
<!--</pre>-->
<section class="company">
    <div class="wrap">
        <? foreach ($arDataProvider as $compId => $companyProvider) { ?>
            <div class="company__item">
                <h2><?=$arGroups[$compId]?></h2>
                <?=ListView::widget([
                    'dataProvider' => $companyProvider,
                    'options' => [
                        'tag' => 'ul',
                        'class' => 'list__flex company__list'
                    ],
                    'itemOptions' => [
                        'tag' => 'li',
                        'class' => 'list__flex__4 company__list__item',
                        'id' => false
                    ],
                    'itemView' => '_item',
                    'layout' => "{items}"
                ])?>
<!--                <ul class="list__flex company__list">-->
<!--                    <li class="list__flex__4 company__list__item">-->

<!--                    </li>-->
<!--                    <li class="list__flex__4 company__list__item">-->
<!--                        <div class="company__list__item__top">-->
<!--                            <div class="company__list__item__top__icon" style="background-image: url(images/lainer/MSC.png);"></div>-->
<!--                            <div class="company__list__item__top__name">MSC crociere</div>-->
<!--                        </div>-->
<!--                        <div class="company__list__item__descr">-->
<!--                            <div class="company__list__item__left">Количество кораблей</div>-->
<!--                            <div class="company__list__item__right">10</div>-->
<!--                        </div>-->
<!--                        <div class="company__list__item__descr">-->
<!--                            <div class="company__list__item__left">Категория корабля</div>-->
<!--                            <div class="company__list__item__right"><ul class="star__wrap__liner">-->
<!--                                    <li class="star__item"><img src="images/cart/Star.png" alt=""></li>-->
<!--                                    <li class="star__item"><img src="images/cart/Star.png" alt=""></li>-->
<!--                                    <li class="star__item"><img src="images/cart/Star.png" alt=""></li>-->
<!--                                    <li class="star__item"><img src="images/cart/Star.png" alt=""></li>-->
<!--                                    <li class="star__item"><img src="images/lainer/Star.svg" alt=""></li>-->
<!--                                </ul></div>-->
<!--                        </div>-->
<!--                        <div class="company__list__item__bottom">-->
<!--                            <a href="" class="company__list__item__bottom__button">Подробнее</a>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                    <li class="list__flex__4 company__list__item">-->
<!--                        <div class="company__list__item__top">-->
<!--                            <div class="company__list__item__top__icon" style="background-image: url(images/lainer/MSC.png);"></div>-->
<!--                            <div class="company__list__item__top__name">MSC crociere</div>-->
<!--                        </div>-->
<!--                        <div class="company__list__item__descr">-->
<!--                            <div class="company__list__item__left">Количество кораблей</div>-->
<!--                            <div class="company__list__item__right">10</div>-->
<!--                        </div>-->
<!--                        <div class="company__list__item__descr">-->
<!--                            <div class="company__list__item__left">Категория корабля</div>-->
<!--                            <div class="company__list__item__right"><ul class="star__wrap__liner">-->
<!--                                    <li class="star__item"><img src="images/cart/Star.png" alt=""></li>-->
<!--                                    <li class="star__item"><img src="images/cart/Star.png" alt=""></li>-->
<!--                                    <li class="star__item"><img src="images/cart/Star.png" alt=""></li>-->
<!--                                    <li class="star__item"><img src="images/cart/Star.png" alt=""></li>-->
<!--                                    <li class="star__item"><img src="images/lainer/Star.svg" alt=""></li>-->
<!--                                </ul></div>-->
<!--                        </div>-->
<!--                        <div class="company__list__item__bottom">-->
<!--                            <a href="" class="company__list__item__bottom__button">Подробнее</a>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                    <li class="list__flex__4 company__list__item">-->
<!--                        <div class="company__list__item__top">-->
<!--                            <div class="company__list__item__top__icon" style="background-image: url(images/lainer/MSC.png);"></div>-->
<!--                            <div class="company__list__item__top__name">MSC crociere</div>-->
<!--                        </div>-->
<!--                        <div class="company__list__item__descr">-->
<!--                            <div class="company__list__item__left">Количество кораблей</div>-->
<!--                            <div class="company__list__item__right">10</div>-->
<!--                        </div>-->
<!--                        <div class="company__list__item__descr">-->
<!--                            <div class="company__list__item__left">Категория корабля</div>-->
<!--                            <div class="company__list__item__right"><ul class="star__wrap__liner">-->
<!--                                    <li class="star__item"><img src="images/cart/Star.png" alt=""></li>-->
<!--                                    <li class="star__item"><img src="images/cart/Star.png" alt=""></li>-->
<!--                                    <li class="star__item"><img src="images/cart/Star.png" alt=""></li>-->
<!--                                    <li class="star__item"><img src="images/cart/Star.png" alt=""></li>-->
<!--                                    <li class="star__item"><img src="images/lainer/Star.svg" alt=""></li>-->
<!--                                </ul></div>-->
<!--                        </div>-->
<!--                        <div class="company__list__item__bottom">-->
<!--                            <a href="" class="company__list__item__bottom__button">Подробнее</a>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                </ul>-->
            </div>
        <?}?>
    </div>
</section>