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
            Новости и акции
        </li>
    </ul>
</section>
<section class="page__menu page__menu__otziv">
    <div class="wrap">
        <div class="page__menu__wrap clear">
            <h1 class="page__menu__title">Новости и акции</h1>
            <div class="form__result__button__liner form__result__button--mobile"></div>
            <button class="sidebar__button otziv__button--mobile news__button">Подписаться на новости</button>
        </div>
    </div>
</section>
<section class="page page__liner">
    <div class="wrap clear">
        <div class="sidebar sidebar__page sidebar__page--action">
            <button class="sidebar__button news__button">Подписаться на новости</button>
            <div class="sidebar__page__wrap">
                <? $form = ActiveForm::begin([
                    'action' => ['/search'],
                    'options' => [
                        'class' => 'filtr__lainer',
                        'enctype' => 'multipart/form-data'
                    ],
                ]); ?>
                    <div class="filtr__lainer__title">Выберите круизы по акциям и спецпредложениям</div>
                    <div class="main__cruise__drop">
                        <div class="main__cruise__drop__title">Выбрать акцию</div>
                        <div class="main__cruise__drop__wrap main__cruise__drop__wrap-region">
                            <? foreach($arSpecials as $special) {
                                $specials[$special["ID"]] = $special["name"];
                            }?>
                            <?=$form->field($modelCruise, 'types', [ 'enableLabel' => false])->checkboxList($specials,
                                [
                                    'tag' => false,
                                    'item' => function($index, $label, $name, $checked, $value) {
                                        $checked = $checked ? 'checked' : '';
                                        return "<div class=\"main__cruise__drop__region \">	
                                            <label>
                                                <input class=\"checkbox\" type=\"checkbox\" name=\"{$name}\" value='{$value}'>
                                                <span class=\"checkbox-custom\"></span>
                                                <span class=\"label\">{$label}</span>
                                            </label>
                                        </div>";
                                    }
                                ]
                            );?>
                        </div>
                    </div>
                    <div class="main__cruise__drop">
                        <div class="main__cruise__drop__title">Тип круиза</div>
                        <div class="main__cruise__drop__wrap main__cruise__drop__wrap-region">
                            <?
                            $types = [];
                            foreach($cruiseTypes as $type) {
                                $types[$type["ID"]] = $type["name"];
                            } ?>
                            <?=$form->field($modelCruise, 'types', [ 'enableLabel' => false])
                                ->checkboxList($types, [
                                    'tag' => false,
                                    'item' => function($index, $label, $name, $checked, $value) {
                                        $checked = $checked ? 'checked' : '';
                                        return "<div class=\"main__cruise__drop__region label__main \">	
                                            <label>
                                                <input class=\"checkbox\" type=\"checkbox\" name=\"{$name}\" value='{$value}'>
                                                <span class=\"checkbox-custom\"></span>
                                                <span class=\"label\">{$label}</span>
                                            </label>
                                        </div>";
                                    }
                                ]);?>
                        </div>
                    </div>
                    <div class="main__cruise__drop">
                        <div class="main__cruise__drop__title">Регион плавания</div>
                        <div class="main__cruise__drop__wrap main__cruise__drop__wrap-region">
                            <? $arRegions = [];
                            foreach($regions as $region) {
                                $arRegions[$region["ID"]] = $region["name"];
                            }
                            ?>
                            <?=$form->field($modelCruise, 'regions', [ 'enableLabel' => false])
                                ->checkboxList($arRegions, [
                                    'tag' => false,
                                    'item' => function($index, $label, $name, $checked, $value) {
                                        $checked = $checked ? 'checked' : '';
                                        return "<div class=\"main__cruise__drop__region label__main\">	
                                                <label>
                                                    <input class=\"checkbox\" type=\"checkbox\" name=\"{$name}\" value='{$value}'>
                                                    <span class=\"checkbox-custom\"></span>
                                                    <span class=\"label\">{$label}</span>
                                                </label>
                                            </div>";
                                    }
                                ]);?>

                            <?
                            /*
                             * <div class="scrollbar-inner">
                                <? foreach($regions as $region) {?>
                                    <div class="main__cruise__drop__region "> <!--label__main-->
                                        <?=$form->field($modelCruise, 'region_id', [ 'enableLabel' => false])
                                            ->checkbox([
                                                'value' => $region["ID"],
                                                'template' => "<label>{input}
                <span class=\"checkbox-custom\"></span>
                <span class=\"label\">".$region["name"].
                    "<span class=\"label__num\"></span>
                </span></label>",
                                                'class' => 'checkbox'
                                            ]);?>
                                    </div>
                                <?}?>
                            </div>
                             */
                            ?>
                        </div>
                    </div>
                    <div class="main__cruise__date">
                        <div class="main__cruise__date__title clock">Продолжительность</div>
                        <div class="main__cruise__input">
                            <input type="number" class="sliderValue_1 minValue sliderValue__all" data-index="0" name="leng_from" value="10" readonly="">
                            <span class="sliderValue__all__line"></span>
                            <input type="number" class="sliderValue_1 maxValue sliderValue__all" data-index="1" name="leng_to" value="70" readonly="">
                            <div id="slider_1"></div>
                        </div>
                    </div>
                    <div class="main__cruise__date">
                        <div class="main__cruise__date__title calendar">Даты круиза</div>
                        <div class="main__cruise__input">
                            <input type="date" class="main__cruise__date__start sliderValue__all" name="date_from" value="2018.07.07">
                            <span class="sliderValue__all__line"></span>
                            <input type="date" class="main__cruise__date__end sliderValue__all" name="date_to" value="2018.08.08">
                        </div>
                    </div>
                    <div class="main__cruise__date">
                        <div class="main__cruise__date__title ruble">Стоимость от и до</div>
                        <div class="main__cruise__input">
                            <input type="number" class="sliderValue minValue sliderValue__all" data-index="0" name="price_from" value="40000" disabled="disabled">
                            <span class="sliderValue__all__line"></span>
                            <input type="number" class="sliderValue maxValue sliderValue__all" data-index="1" name="price_to" value="10000000" disabled="disabled">
                            <div id="slider"></div>
                        </div>
                    </div>
                    <div class="main__cruise__bottom">
                        <button class="main__cruise__button main__cruise-podbor">Поиск</button>
                        <a href="/search/" class="main__cruise__button main__cruise-more">Расширеный поиск</a>
                    </div>

                <? ActiveForm::end(); ?>

            </div>
            <div class="sidebar__action" style="display: none">
                <h3>Популярные акции</h3>
                <div class="sidebar__action__slide">
                    <ul class="otziv__main__slide otziv__main__slide--sidebar">
                        <li class="sidebar__action__item" style="background-image: url(images/cart/cart.jpg)"></li>
                        <li class="sidebar__action__item" style="background-image: url(images/cart/cart.jpg);"></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="search__result">
            <?=ListView::widget([
                'dataProvider' => $dataProvider,
                'options' => [
                    'tag' => 'ul',
                    'class' => 'action__page__list'
                ],
                'itemOptions' => [
                    'tag' => 'li',
                    'class' => 'action__page__item clear',
                    'id' => false
                ],
                'itemView' => '_item',
                'layout' => "{items}
                <div class=\"pagination\">{pager}</div>",
                'pager' => [
                    'firstPageLabel' => false,
                    'lastPageLabel' => false,
                    'nextPageLabel' => '<div class="pagination__sep pagination__sep--left"><svg width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.34351 1.65649L2 8L8.3435 14.3435" stroke="#323232" stroke-width="2"/>
                    </svg>
                    <svg width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.34351 1.65649L2 8L8.3435 14.3435" stroke="#323232" stroke-width="2"/>
                    </svg>

                </div>',
                    'prevPageLabel' => '<div class="pagination__sep pagination__sep--right"><svg width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.34351 1.65649L7.68701 8L1.34351 14.3435" stroke="#323232" stroke-width="2"/>
                    </svg>
                    <svg width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.34351 1.65649L7.68701 8L1.34351 14.3435" stroke="#323232" stroke-width="2"/>
                    </svg></div>',
                    'pageCssClass' => 'pagination__list__item',
                    'firstPageCssClass' => 'pagination__list__item',
                    'lastPageCssClass' => 'pagination__list__item',
                    'nextPageCssClass' => 'pagination__list__item',
                    'prevPageCssClass' => 'pagination__list__item',
                    'options' => ['class' => 'pagination__list'],
                    'maxButtonCount' => 3,
                ],
            ])?>
        </div>
    </div>
</section>
