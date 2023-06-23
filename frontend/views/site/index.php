<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\ListView;

$this->title = 'Круизы от Астарта Групп';
?>
<section class="banner">
    <?= ListView::widget([
        'dataProvider' => $bannerProvider,
        'options' => [
            'tag' => 'div',
            'class' => 'banner__wrap'
        ],
        'itemOptions' => [
            'tag' => false
        ],
        'itemView' => '_banner',
        'layout' => "{items}",
    ]); ?>
    <? /* div class="banner__wrap">
            <div class="banner__item" style="background-image:url('/images/img__banner__home.jpg')">
                <div class="wrap clear">
                    <div class="banner__right">
                        <div class="banner__left__slick">
                            <div class="banner__left__slick__item">
                                <div class="banner__title">Заголовок один</div>
                                <div class="banner__text">Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому...</div>
                                <div class="button banner__button">Подробнее</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="banner__item" style="background-image:url('/images/img__banner__home.jpg')">
                <div class="wrap clear">
                    <div class="banner__right">
                        <div class="banner__left__slick">
                            <div class="banner__left__slick__item">
                                <div class="banner__title">Заголовок два</div>
                                <div class="banner__text">Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому...</div>
                                <div class="button banner__button">Подробнее</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div*/ ?>
    <div class="banner__left">
        <div class="banner__right__form">
            <? $form = ActiveForm::begin([
                'method' => 'get',
                'action' => ['/search'],
                'options' => [
                    'class' => 'main__cruise',
                    'enctype' => 'multipart/form-data'
                ],
            ]); ?>
            <div class="main__cruise__top clear">
                <div class="main__cruise__title">Выбрать из <span><?= $modelCruise->count([]) ?></span> круизов</div>
            </div>
            <div class="main__cruise__drop">
                <div class="main__cruise__drop__title">Тип круиза</div>
                <div class="main__cruise__drop__wrap main__cruise__drop__wrap-region">
                    <?= $form->field($modelCruise, 'types', ['enableLabel' => false])
                        ->checkboxList($arTypes, [
                            'tag' => false,
                            'item' => function ($index, $label, $name, $checked, $value) {
                                $checked = $checked ? 'checked' : '';
                                return "<div class=\"main__cruise__drop__block \">	
                                            <label>
                                                <input class=\"checkbox\" type=\"checkbox\" name=\"{$name}\" value='{$value}'>
                                                <span class=\"checkbox-custom\"></span>
                                                <span class=\"label\">{$label}</span>
                                            </label>
                                        </div>";
                            }
                        ]); ?>
                </div>
            </div>
            <div class="main__cruise__drop">
                <div class="main__cruise__drop__title">Регион плавания</div>
                <div class="main__cruise__drop__wrap main__cruise__drop__wrap-region">
                    <?= $form->field($modelCruise, 'regions', ['enableLabel' => false])
                        ->checkboxList($arRegions, [
                            'tag' => false,
                            'item' => function ($index, $label, $name, $checked, $value) {
                                $checked = $checked ? 'checked' : '';
                                return "<div class=\"main__cruise__drop__region \">	
                                            <label>
                                                <input class=\"checkbox\" type=\"checkbox\" name=\"{$name}\" value='{$value}'>
                                                <span class=\"checkbox-custom\"></span>
                                                <span class=\"label\">{$label}</span>
                                            </label>
                                        </div>";
                            }
                        ]); ?>

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
                    <input type="number" class="sliderValue_1 minValue sliderValue__all" data-index="0" name="leng_from" value="<?= $modelCruise->leng_from ? $modelCruise->leng_from : $arLengs["leng_from"] ?>">
                    <span class="sliderValue__all__line"></span>
                    <input type="number" class="sliderValue_1 maxValue sliderValue__all" data-index="1" name="leng_to" value="<?= $modelCruise->leng_to ? $modelCruise->leng_to : $arLengs["leng_to"] ?>">
                    <div id="slider_1" data-min="<?= $arLengs["leng_from"] ?>" data-max="<?= $arLengs["leng_to"] ?>" data-val1="<?= $modelCruise->leng_from ? (($modelCruise->leng_from > $arLengs["leng_from"]) ? $modelCruise->leng_from : $arLengs["leng_from"]) : $arLengs["leng_from"] ?>" data-val2="<?= $modelCruise->leng_to ? (($modelCruise->leng_to < $arLengs["leng_to"]) ? $modelCruise->leng_to : $arLengs["leng_to"]) : $arLengs["leng_to"] ?>"></div>
                </div>
            </div>
            <div class="main__cruise__date">
                <div class="main__cruise__date__title calendar">Даты круиза <span class='error-information'> - укажите даты</span></div>
                <div class="main__cruise__input">
                    <input type="date" class="main__cruise__date__start sliderValue__all" name="date_from" min="<?= date("Y-m-d") ?>">

                    <span class="sliderValue__all__line"></span>
                    <input type="date" class="main__cruise__date__end sliderValue__all" name="date_to" min="<?= date("Y-m-d") ?>">

                </div>
            </div>
            <div class="main__cruise__date">
                <div class="main__cruise__date__title ruble">Стоимость от и до</div>
                <div class="main__cruise__input">
                    <input type="number" class="sliderValue minValue sliderValue__all" data-index="0" name="price_from" value="<?= $modelCruise->price_from ? $modelCruise->price_from : $arPrices["price_from"] ?>">
                    <span class="sliderValue__all__line"></span>
                    <input type="number" class="sliderValue maxValue sliderValue__all" data-index="1" name="price_to" value="<?= $modelCruise->price_to ? $modelCruise->price_to : $arPrices["price_to"] ?>">
                    <div id="slider" data-min="<?= $arPrices["price_from"] ?>" data-max="<?= $arPrices["price_to"] ?>" data-val1="<?= ($modelCruise->price_from & $modelCruise->price_from > $arPrices["price_from"]) ? $modelCruise->price_from : $arPrices["price_from"] ?>" data-val2="<?= ($modelCruise->price_to & $modelCruise->price_to < $arPrices["price_to"]) ? $modelCruise->price_to : $arPrices["price_to"] ?>"></div>
                </div>
            </div>
            <div class="main__cruise__bottom" style="text-align: center">
                <!-- <a href="/search/" class="main__cruise__button main__cruise-more">Расширеный поиск</a> -->
                <button class="main__cruise__button main__cruise-search">Поиск</button>
            </div>
            <? ActiveForm::end(); ?>
        </div>
    </div>
</section>
<section class="main__cart">
    <div class="wrap">
        <?= ListView::widget([
            'dataProvider' => $typesProvider,
            'options' => [
                'tag' => 'ul',
                'class' => 'cart block__flex'
            ],
            'itemOptions' => [
                'tag' => 'li',
                'class' => 'cart__item cart-4',
                'id' => false
            ],
            'itemView' => '_cruisetype',
            'layout' => "{items}",
        ]); ?>
        <?= ListView::widget([
            'dataProvider' => $iconsProvider,
            'options' => [
                'tag' => 'ul',
                'class' => 'cartblock'
            ],
            'itemOptions' => [
                'tag' => 'li',
                'class' => 'cartblock__item',
                'id' => false
            ],
            'itemView' => '_icon',
            'layout' => "{items}",
        ]) ?>
    </div>
</section>
<section class="main main__news">
    <div class="wrap">
        <div class="news__main block__flex">
            <div class="cart-2">
                <div class="news__main__title">
                    <h2>Новости и акции</h2>
                    <? if ($newsProvider->getTotalCount() > 3) { ?>
                        <a href="/news/" class="news__main__title__link">все новости</a>
                    <? } ?>
                </div>
                <?
                $newsProvider->setSort([
                    'attributes' => [
                        'ID' => [
                            'asc' => ['ID' => SORT_ASC],
                            'desc' => ['ID' => SORT_DESC],
                            'label' => 'ID',
                            'default' => SORT_DESC
                        ]
                    ],
                    'defaultOrder' => ['ID' => SORT_DESC]
                ]);
                ?>
                <?= ListView::widget([
                    'dataProvider' => $newsProvider,
                    'options' => [
                        'tag' => 'ul',
                        'class' => 'news__main__list'
                    ],
                    'itemOptions' => [
                        'tag' => 'li',
                        'class' => 'news__main__item clear',
                        'id' => false
                    ],
                    'itemView' => '_newsitem',
                    'layout' => "{items}",
                ]) ?>
            </div>
            <div class="cart-2">
                <div class="news__main__title">
                    <h2>Отзывы</h2>
                    <? if ($reviewsProvider->getTotalCount() > 3) { ?>
                        <a href="/reviews" class="news__main__title__link">все отзывы</a>
                    <? } ?>
                    <span style="display: none" class="news__main__title__link news__main__title__link--otziv otziv__popup">оставить отзыв +</span>
                </div>
                <div class="otziv__main__slide">
                    <div class="otziv__main__slide__item">
                        <?= ListView::widget([
                            'dataProvider' => $reviewsProvider,
                            'options' => [
                                'tag' => 'ul',
                                'class' => 'otziv__main__list'
                            ],
                            'itemOptions' => [
                                'tag' => 'li',
                                'class' => 'otziv__main__item clear',
                                'id' => false
                            ],
                            'itemView' => '_review',
                            'layout' => "{items}",
                        ]) ?>
                        <? /* ul class="otziv__main__list">
                                <li class="otziv__main__item clear">
                                    <div class="otziv__main__link">
                                        <div class="otziv__main__img" style="background-image: url(images/251d2b42e31a5f104383829d8130cb9e-min.jpg);"></div>
                                        <div class="otziv__main__text">
                                            <div class="otziv__main__text__title">Имя Фамилия</div>
                                            <div class="otziv__main__text__descr">Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому .  используют потому...</div>
                                        </div>
                                    </div>
                                </li>
                                <li class="otziv__main__item clear">
                                    <div class="otziv__main__link">
                                        <div class="otziv__main__img" style="background-image: url(images/251d2b42e31a5f104383829d8130cb9e-min.jpg);"></div>
                                        <div class="otziv__main__text">
                                            <div class="otziv__main__text__title">Имя Фамилия</div>
                                            <div class="otziv__main__text__descr">Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому .  используют потому...</div>
                                        </div>
                                    </div>
                                    <div class="otziv__popup"></div>
                                </li>
                                <li class="otziv__main__item clear">
                                    <div class="otziv__main__link">
                                        <div class="otziv__main__img" style="background-image: url(images/251d2b42e31a5f104383829d8130cb9e-min.jpg);"></div>
                                        <div class="otziv__main__text">
                                            <div class="otziv__main__text__title">Имя Фамилия</div>
                                            <div class="otziv__main__text__descr">Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому .  используют потому...</div>
                                        </div>
                                    </div>
                                </li>
                            </ul */ ?>
                    </div>
                    <!--div class="otziv__main__slide__item">
                            <ul class="otziv__main__list">
                                <li class="otziv__main__item clear">
                                    <a href="" class="otziv__main__link">
                                        <div class="otziv__main__img" style="background-image: url(images/251d2b42e31a5f104383829d8130cb9e-min.jpg);"></div>
                                        <div class="otziv__main__text">
                                            <div class="otziv__main__text__title">Имя Фамилия</div>
                                            <div class="otziv__main__text__descr">Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому .  используют потому...</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="otziv__main__item clear">
                                    <a href="" class="otziv__main__link">
                                        <div class="otziv__main__img" style="background-image: url(images/251d2b42e31a5f104383829d8130cb9e-min.jpg);"></div>
                                        <div class="otziv__main__text">
                                            <div class="otziv__main__text__title">Имя Фамилия</div>
                                            <div class="otziv__main__text__descr">Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому .  используют потому...</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="otziv__main__item clear">
                                    <a href="" class="otziv__main__link">
                                        <div class="otziv__main__img" style="background-image: url(images/251d2b42e31a5f104383829d8130cb9e-min.jpg);"></div>
                                        <div class="otziv__main__text">
                                            <div class="otziv__main__text__title">Имя Фамилия</div>
                                            <div class="otziv__main__text__descr">Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому .  используют потому...</div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div-->
                </div>
            </div>
        </div>
    </div>
</section>
<? /* section class="main main__map">
        <div class="wrap">
            <div class="map">
                <h2>Выбрать регион круиза</h2>
                <div class="map__wrap">

                </div>
            </div>
        </div>
    </section */ ?>
<section class="main main__sale">
    <div class="wrap">
        <div class="sale__main block__flex">
            <div class="cart-2">
                <h2>Горящие акции и спецпредложения на круизы</h2>
                <div class="tabs tabs--sale">
                    <div class="tabs__mobile"></div>
                    <div class="tabs__wrap">
                        <div class="tabs__item">
                            Морские круизы
                        </div>
                        <div class="tabs__item" style="display: none">
                            Речные круизы по России
                        </div>
                        <div class="tabs__item" style="display: none">
                            Речные круизы по Миру
                        </div>
                        <div class="tabs__item" style="display: none">
                            Паромные туры
                        </div>
                    </div>
                    <div class="tabs__content">
                        <div class="tabs__content__item">
                            <div class="tabs__slider">
                                <div class="tabs__slider__item">
                                    <?= ListView::widget([
                                        'dataProvider' => $hotCruises,
                                        'options' => [
                                            'tag' => 'ul',
                                            'class' => 'sale__list'
                                        ],
                                        'itemOptions' => [
                                            'tag' => 'li',
                                            'class' => 'sale__item clear',
                                            'id' => false
                                        ],
                                        'itemView' => '_hotCruise',
                                        'layout' => "{items}",
                                    ]) ?>
                                    <a href="/search/?types[]=1&specials=on" class="sale__more">Смотреть все варианты</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cart-2">
                <div class="kviz">
                    <div class="kviz__gradient"></div>
                    <div class="kviz-title">
                        <span>Подберите</span>
                        подходящий вам круиз за 3 минуты
                    </div>
                    <div class="kviz-wrap">
                        <div class="kviz-1">
                            <div class="kviz-block">
                                <div class="kviz-block__text">
                                    Ответьте на 5 вопросов и получите идеально<br> подходящий вам круиз
                                </div>
                            </div>
                            <div class="kviz-start kviz-button">Начать подбор</div>
                        </div>
                        <div class="kviz-form__wrap">
                            <form action="" class="form__valculator">
                                <div class="kviz-item" data-page="0">
                                    <div class="kviz-text">
                                        Выберите даты своей поездки или укажите примерный диапазон и длительность поездки
                                    </div>
                                    <div class="tabs">
                                        <ul class="tabs__wrap">
                                            <li class="tabs__item">
                                                Примерные даты
                                            </li>
                                            <li class="tabs__item">
                                                Знаю даты поездки
                                            </li>
                                        </ul>
                                        <div class="tabs__content">
                                            <div class="tabs__content__item clear">
                                                <div class="kviz-date">
                                                    <div class="kviz-amount">
                                                        <div class="minus form__result__price__button"><span tabindex="0"></span></div>
                                                        <input value="2018" type="text" class="kviz-rezult rezult-count" disabled="disabled">
                                                        <div class="plus form__result__price__button"><span tabindex="0"></span></div>
                                                    </div>
                                                    <ul class="kviz-calendar">
                                                        <li class="kviz-calendar__item">
                                                            <label class="kviz-calendar__label">
                                                                <input type="radio" name="date" class="radio">
                                                                <span class="kviz-calendar__radio">Янв</span>
                                                            </label>
                                                        </li>
                                                        <li class="kviz-calendar__item">
                                                            <label class="kviz-calendar__label">
                                                                <input type="radio" name="date" class="radio">
                                                                <span class="kviz-calendar__radio">Фев</span>
                                                            </label>
                                                        </li>
                                                        <li class="kviz-calendar__item">
                                                            <label class="kviz-calendar__label">
                                                                <input type="radio" name="date" class="radio">
                                                                <span class="kviz-calendar__radio">Мар</span>
                                                            </label>
                                                        </li>
                                                        <li class="kviz-calendar__item">
                                                            <label class="kviz-calendar__label">
                                                                <input type="radio" name="date" class="radio">
                                                                <span class="kviz-calendar__radio">Апр</span>
                                                            </label>
                                                        </li>
                                                        <li class="kviz-calendar__item">
                                                            <label class="kviz-calendar__label">
                                                                <input type="radio" name="date" class="radio">
                                                                <span class="kviz-calendar__radio">Май</span>
                                                            </label>
                                                        </li>
                                                        <li class="kviz-calendar__item">
                                                            <label class="kviz-calendar__label">
                                                                <input type="radio" name="date" class="radio">
                                                                <span class="kviz-calendar__radio">Июн</span>
                                                            </label>
                                                        </li>
                                                        <li class="kviz-calendar__item">
                                                            <label class="kviz-calendar__label">
                                                                <input type="radio" name="date" class="radio">
                                                                <span class="kviz-calendar__radio">Июл</span>
                                                            </label>
                                                        </li>
                                                        <li class="kviz-calendar__item">
                                                            <label class="kviz-calendar__label">
                                                                <input type="radio" name="date" class="radio">
                                                                <span class="kviz-calendar__radio">Авг</span>
                                                            </label>
                                                        </li>
                                                        <li class="kviz-calendar__item">
                                                            <label class="kviz-calendar__label">
                                                                <input type="radio" name="date" class="radio">
                                                                <span class="kviz-calendar__radio">Сен</span>
                                                            </label>
                                                        </li>
                                                        <li class="kviz-calendar__item">
                                                            <label class="kviz-calendar__label">
                                                                <input type="radio" name="date" class="radio">
                                                                <span class="kviz-calendar__radio">Окт</span>
                                                            </label>
                                                        </li>
                                                        <li class="kviz-calendar__item">
                                                            <label class="kviz-calendar__label">
                                                                <input type="radio" name="date" class="radio">
                                                                <span class="kviz-calendar__radio">Ноя</span>
                                                            </label>
                                                        </li>
                                                        <li class="kviz-calendar__item">
                                                            <label class="kviz-calendar__label">
                                                                <input type="radio" name="date" class="radio">
                                                                <span class="kviz-calendar__radio">Дек</span>
                                                            </label>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="kviz-days">
                                                    <div class="kviz-days__title">Длительность поездки</div>
                                                    <div class="kviz-days_slide">
                                                        <input type="number" class="kviz-sliderValue minValue sliderValue__all" data-index="0" value="10" disabled="disabled">
                                                        <span class="sliderValue__all__line"></span>
                                                        <input type="number" class="kviz-sliderValue maxValue sliderValue__all" data-index="1" value="70" disabled="disabled">
                                                        <div id="kviz-slider"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tabs__content__item">
                                                <div class="kviz-days__title">Когда вы планируете поездку</div>
                                                <div class="kviz-days_slide">
                                                    <input type="date" class="main__cruise__date__start sliderValue__all" value="2018.07.07">
                                                    <span class="sliderValue__all__line"></span>
                                                    <input type="date" class="main__cruise__date__end sliderValue__all" value="2018.08.08">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kviz-button__wrap">
                                        <div class="kviz-button kviz-button__next" data-direction="next">Следующий шаг</div>
                                    </div>
                                </div>
                                <div class="kviz-item" data-page="1">
                                    <div class="kviz-days__title">Кто поедит</div>
                                    <div class="kviz-men">
                                        <div class="kviz-men__left">
                                            <div class="kviz-men__title">Взрослые</div>
                                            <div class="kviz-amount_1 kviz-amount__item">
                                                <div class="minus form__result__price__button">
                                                    <span tabindex="0"></span>
                                                </div>
                                                <input value="1" type="text" class="kviz-rezult_1 rezult-count" disabled="disabled">
                                                <div class="plus form__result__price__button">
                                                    <span tabindex="0"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kviz-men__right">
                                            <div class="kviz-men__title">Дети</div>
                                            <div class="kviz-amount_2 kviz-amount__item">
                                                <div class="minus form__result__price__button">
                                                    <span tabindex="0"></span>
                                                </div>
                                                <input value="1" type="text" class="kviz-rezult_2 rezult-count" disabled="disabled">
                                                <div class="plus form__result__price__button">
                                                    <span tabindex="0"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kviz-old">
                                        <div class="kviz-men__title">Возраст детей на текущий момент</div>
                                        <div class="kviz-old__wrap">
                                            <input type="text" placeholder="5 лет">
                                            <input type="text">
                                            <input type="text">
                                        </div>
                                    </div>
                                    <div class="kviz-button__wrap">
                                        <div class="kviz-button kviz-button__prev" data-direction="prev">Предыдущий шаг</div>
                                        <div class="kviz-button kviz-button__next kviz-button__next-page" data-direction="next">Следующий шаг</div>
                                    </div>
                                </div>
                                <div class="kviz-item" data-page="2">
                                    <div class="kviz-men__title">Какую сумму планируете потратить в рублях на взрослых <span class="kviz-old__rezult kviz-old__adult">1</span> и детей <span class="kviz-old__rezult kviz-old__child">3</span>
                                    </div>
                                    <div class="kviz-price">
                                        <label class="kviz-price__label">
                                            <input type="radio" name="price" class="radio">
                                            <span class="kviz-price__radio">до 20 тыс</span>
                                        </label>
                                        <label class="kviz-price__label">
                                            <input type="radio" name="price" class="radio">
                                            <span class="kviz-price__radio">до 100 тыс</span>
                                        </label>
                                        <label class="kviz-price__label">
                                            <input type="radio" name="price" class="radio">
                                            <span class="kviz-price__radio">до 300 тыс</span>
                                        </label>
                                    </div>
                                    <div class="kviz-button__wrap">
                                        <div class="kviz-button kviz-button__prev" data-direction="prev">Предыдущий шаг</div>
                                        <div class="kviz-button kviz-button__next kviz-button__next-page" data-direction="next">Следующий шаг</div>
                                    </div>
                                </div>
                                <div class="kviz-item" data-page="3">
                                    <div class="kviz-days__title">Какой тип круиза вы предпочитаете:</div>
                                    <div class="kviz-kruis block__flex">
                                        <label class="kviz-kruis__label cart-4">
                                            <input type="radio" name="kruis" class="radio">
                                            <span class="kviz-kruis__radio">
                                                <span class="kviz-kruis__img" style="background-image: url('/images/kviz-1.jpg');"></span>
                                                <span class="kviz-kruis__text">
                                                    Морской круиз на круизном лайнере
                                                </span>
                                                <span class="kviz-kruis__gr"></span>
                                            </span>
                                        </label>
                                        <label class="kviz-kruis__label cart-4">
                                            <input type="radio" name="kruis" class="radio">
                                            <span class="kviz-kruis__radio">
                                                <span class="kviz-kruis__img" style="background-image: url('/images/kviz-2.jpg');"></span>
                                                <span class="kviz-kruis__text">
                                                    Морской круиз на круизном лайнере
                                                </span>
                                                <span class="kviz-kruis__gr"></span>
                                            </span>
                                        </label>
                                        <label class="kviz-kruis__label cart-4">
                                            <input type="radio" name="kruis" class="radio">
                                            <span class="kviz-kruis__radio">
                                                <span class="kviz-kruis__img" style="background-image: url('/images/kviz-3.jpg');"></span>
                                                <span class="kviz-kruis__text">
                                                    Морской круиз на круизном лайнере
                                                </span>
                                                <span class="kviz-kruis__gr"></span>
                                            </span>
                                        </label>
                                        <label class="kviz-kruis__label cart-4">
                                            <input type="radio" name="kruis" class="radio">
                                            <span class="kviz-kruis__radio">
                                                <span class="kviz-kruis__img" style="background-image: url('/images/kviz-1.jpg');"></span>
                                                <span class="kviz-kruis__text">
                                                    Морской круиз на круизном лайнере
                                                </span>
                                                <span class="kviz-kruis__gr"></span>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="kviz-button__wrap">
                                        <div class="kviz-button kviz-button__prev" data-direction="prev">Предыдущий шаг</div>
                                        <div class="kviz-button kviz-button__next kviz-button__next-page" data-direction="next">Следующий шаг</div>
                                    </div>
                                </div>
                                <div class="kviz-item" data-page="4">
                                    <div class="kviz-days__title">Что вы цените в путешествии ?</div>
                                    <div class="kviz-adv">
                                        <label>
                                            <input class="checkbox" type="checkbox" name="checkbox-test">
                                            <span class="checkbox-custom"></span>
                                            <span class="label">Архитектуру</span>
                                        </label>
                                        <label>
                                            <input class="checkbox" type="checkbox" name="checkbox-test">
                                            <span class="checkbox-custom"></span>
                                            <span class="label">Теплый климат</span>
                                        </label>
                                        <label>
                                            <input class="checkbox" type="checkbox" name="checkbox-test">
                                            <span class="checkbox-custom"></span>
                                            <span class="label">Природа</span>
                                        </label>
                                        <label>
                                            <input class="checkbox" type="checkbox" name="checkbox-test">
                                            <span class="checkbox-custom"></span>
                                            <span class="label">Экзотика</span>
                                        </label>
                                        <label>
                                            <input class="checkbox" type="checkbox" name="checkbox-test">
                                            <span class="checkbox-custom"></span>
                                            <span class="label">Специальные программы для детей</span>
                                        </label>
                                    </div>
                                    <div class="kviz-button__wrap">
                                        <div class="kviz-button kviz-button__prev" data-direction="prev">Предыдущий шаг</div>
                                        <div class="kviz-button kviz-button__next kviz-button__next-page" data-direction="next">Следующий шаг</div>
                                    </div>
                                </div>
                                <div class="kviz-item kviz-last" data-page="5">
                                    <div class="kviz-last__title">Мы подобрали подходящие Вам<br> варианты круиза.</div>
                                    <div class="kviz-submit">
                                        <input type="email" placeholder="Ваш e-mail" required="required" class="kviz-submit-mail">
                                        <input type="submit" value="Отправить себе на email" class="kviz-submit-button">
                                    </div>
                                    <div class="kviz-submit__last">или</div>
                                    <a href="/" class="kviz-button kviz-button__more">Посмотреть подборку</a>
                                    <div class="kviz-last__bottom">
                                        <div class="kviz-button kviz-button__last">Начать заново</div>
                                    </div>
                                </div>
                                <ul class="val-pages">
                                    <li class="val-pages__item" data-list="0"></li>
                                    <li class="val-pages__item" data-list="1"></li>
                                    <li class="val-pages__item" data-list="2"></li>
                                    <li class="val-pages__item" data-list="3"></li>
                                    <li class="val-pages__item" data-list="4"></li>
                                    <li class="val-pages__item val-last" data-list="5"></li>
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>