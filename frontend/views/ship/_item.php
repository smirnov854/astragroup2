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
if($model->company->image && $model->company->image->src) {
    $imageSrc = $model->company->image->src;
}
else {
    $imageSrc = "/images/lainer/MSC.png";
}
?>
<li class="list__flex__3 lainer__list__item">
    <div class="lainer__list__item__top">
        <div class="lainer__list__item__top__icon" style="background-image: url('<?=$model->logo?>');"></div>
        <div class="lainer__list__item__top__name"><?=$model->company->name?></div>
    </div>
    <div class="lainer__list__item__bottom">
        <h3><?=$model->name?></h3>
    </div>
    <div class="lainer__list__item__bottom__list">
        <? foreach ($model->options as $option) {?>
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
        <a href="/ship/<?=$model->ID?>/" class="lainer__list__item__bottom__link">Подробнее</a>
        <a href="/search/" class="lainer__list__item__bottom__button">Все круизы на этом лайнере</a>
    </div>
</li>