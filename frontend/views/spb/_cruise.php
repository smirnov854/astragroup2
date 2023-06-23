<?php
/**
 * Created by PhpStorm.
 * User: a.serebryakov
 * Date: 05.03.2019
 * Time: 10:38
 */
?>
<div class="spb__kruiz__item__wrap">
    <div class="spb__kruiz__item__title">
        <div class="spb__kruiz__item__title__date"><?=$model->name?></div>
        <div class="spb__kruiz__item__title__name"><?=$model->ancor?$model->ancor:$model->name?></div>
    </div>
    <div class="spb__kruiz__item__descr">
		<?=$model->itinerary?>
    </div>
    <div class="spb__kruiz__item__name">
        <div class="form__result__item__text__list sale__date__name">Посмотреть на карте</div>
        <div class="form__result__item__text__list sale__date__map"><?=$model->regionName?></div>
    </div>
    <div class="spb__kruiz__item__icon">
        <ul class="form__result__item__bottom__wrap__list">
			<?foreach($model->icons as $icon) {?>
		        <li class="form__result__item__bottom__list">
			        <img src="<?=$icon->src?>" alt="<?=$icon->name?>">
			        <div class="form__result__item__bottom__popup"><?=preg_replace('/(\s)/', '&nbsp;', $icon->name);?></div>
		        </li>
			<?}?>
        </ul>
        <div class="spb__kruiz__item__icon__social">
            <a href="" class="sale__social__item"></a>
            <a href="" class="sale__social__item"></a>
            <a href="" class="sale__social__item"></a>
        </div>
    </div>
    <div class="spb__kruiz__item__price">
        <div class="spb__kruiz__item__price__left">
            <div class="spb__kruiz__item__price__rub">от <?=$model->price_rub?> руб</div>
            <div class="spb__kruiz__item__price__rub">от <?=$model->printPrice?></div>
        </div>
        <div class="spb__kruiz__item__button">Подробнее</div>
    </div>
</div>
