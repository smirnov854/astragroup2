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
                Лайнеры
            </li>
        </ul>
    </section>
    <section class="page__menu">
        <div class="wrap">
            <div class="page__menu__wrap">
                <h1 class="page__menu__title">Лайнеры</h1>
                <div class="form__result__button__liner form__result__button--mobile"></div>
            </div>
        </div>
    </section>
    <section class="page page__liner">
        <div class="wrap clear">
            <div class="sidebar">
                <div class="sidebar__close"></div>
                <form action="" class="filtr__lainer">
                    <div class="filtr__lainer__title">Фильтр круизных лайнеров</div>
                    <div class="filtr__lainer__category">
                        <div class="filtr__lainer__category__title">Категория корабля</div>
                        <div class="filtr__lainer__category__star">
                            <label>
                                <input type="checkbox" class="input__check">
                                <span class="label__check"></span>
                            </label>
                            <label>
                                <input type="checkbox" class="input__check">
                                <span class="label__check"></span>
                            </label>
                            <label>
                                <input type="checkbox" class="input__check">
                                <span class="label__check"></span>
                            </label>
                            <label>
                                <input type="checkbox" class="input__check">
                                <span class="label__check"></span>
                            </label>
                            <label>
                                <input type="checkbox" class="input__check">
                                <span class="label__check"></span>
                            </label>
                        </div>
                    </div>
                    <div class="main__cruise__drop">
                        <div class="main__cruise__drop__title">Тип корабля</div>
                        <div class="main__cruise__drop__wrap main__cruise__drop__wrap-region">
                            <div class="main__cruise__drop__region label__main">
                                <label>
                                    <input class="checkbox" type="checkbox" name="checkbox-test">
                                    <span class="checkbox-custom"></span>
                                    <span class="label">Лайнер
								</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="main__cruise__drop">
                        <div class="main__cruise__drop__title">Круизная компания</div>
                        <div class="main__cruise__drop__wrap main__cruise__drop__wrap-region">
                            <div class="main__cruise__drop__region label__main">
                                <label>
                                    <input class="checkbox" type="checkbox" name="checkbox-test">
                                    <span class="checkbox-custom"></span>
                                    <span class="label">Новая компания
								</span>
                                </label>
                            </div>
                            <div class="main__cruise__drop__region">
                                <label>
                                    <input class="checkbox" type="checkbox" name="checkbox-test">
                                    <span class="checkbox-custom"></span>
                                    <span class="label">Старая компания
								</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="main__cruise__drop">
                        <div class="main__cruise__drop__title">Название корабля</div>
                        <div class="main__cruise__drop__wrap main__cruise__drop__wrap-region">
                            <div class="main__cruise__drop__region label__main">
                                <label>
                                    <input class="checkbox" type="checkbox" name="checkbox-test">
                                    <span class="checkbox-custom"></span>
                                    <span class="label">Австралия и Океания
								</span>
                                </label>
                            </div>
                            <div class="main__cruise__drop__region">
                                <label>
                                    <input class="checkbox" type="checkbox" name="checkbox-test">
                                    <span class="checkbox-custom"></span>
                                    <span class="label">Новая зеландия
								</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="main__cruise__sidebar main__cruise__sidebar--lainer">
                        <div class="main__cruise__sidebar__title age">Возраст лайнера</div>
                        <div class="main__cruise__sidebar__wrap">
                            <div class="main__cruise__drop__block">
                                <label>
                                    <input class="checkbox" type="checkbox" name="checkbox-test">
                                    <span class="checkbox-custom"></span>
                                    <span class="label">Новый</span>
                                </label>
                            </div>
                            <div class="main__cruise__drop__block">
                                <label>
                                    <input class="checkbox" type="checkbox" name="checkbox-test">
                                    <span class="checkbox-custom"></span>
                                    <span class="label">До 3 лет</span>
                                </label>
                            </div>
                            <div class="main__cruise__drop__block">
                                <label>
                                    <input class="checkbox" type="checkbox" name="checkbox-test">
                                    <span class="checkbox-custom"></span>
                                    <span class="label">До 5 лет</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="main__cruise__sidebar">
                        <div class="main__cruise__sidebar__title prostor">Просторность</div>
                        <div class="main__cruise__drop main__cruise__drop--m">
                            <div class="main__cruise__drop__title">Уровень просторности</div>
                            <div class="main__cruise__drop__wrap main__cruise__drop__wrap-region">
                                <div class="main__cruise__drop__region label__main">
                                    <label>
                                        <input class="checkbox" type="checkbox" name="checkbox-test">
                                        <span class="checkbox-custom"></span>
                                        <span class="label">Много места
									</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="main__cruise__date">
                        <div class="main__cruise__date__title main__cruise__date__title-sidebar tonn">Тоннаж</div>
                        <div class="main__cruise__input">
                            <input type="text" class="sliderValue_3 minValue sliderValue__all" data-index="0" value="25000" disabled="disabled">
                            <span class="sliderValue__all__line"></span>
                            <input type="text" class="sliderValue_3 maxValue sliderValue__all" data-index="1" value="200000" disabled="disabled">
                            <div id="slider_3"></div>
                        </div>
                    </div>
                    <div class="main__cruise__date">
                        <div class="main__cruise__date__title main__cruise__date__title-sidebar people">Количество человек</div>
                        <div class="main__cruise__input">
                            <input type="text" class="sliderValue_4 minValue sliderValue__all" data-index="0" value="100" disabled="disabled">
                            <span class="sliderValue__all__line"></span>
                            <input type="text" class="sliderValue_4 maxValue sliderValue__all" data-index="1" value="2000" disabled="disabled">
                            <div id="slider_4"></div>
                        </div>
                    </div>
                    <div class="main__cruise__date">
                        <div class="main__cruise__date__title main__cruise__date__title-sidebar people">Количество палуб</div>
                        <div class="main__cruise__input">
                            <input type="text" class="sliderValue_5 minValue sliderValue__all" data-index="0" value="3" disabled="disabled">
                            <span class="sliderValue__all__line"></span>
                            <input type="text" class="sliderValue_5 maxValue sliderValue__all" data-index="1" value="20" disabled="disabled">
                            <div id="slider_5"></div>
                        </div>
                    </div>
                    <div class="main__cruise__date">
                        <div class="main__cruise__date__title main__cruise__date__title-sidebar people">Не старше</div>
                        <div class="main__cruise__input">
                            <input type="text" class="sliderValue_6 minValue sliderValue__all" data-index="0" value="1" disabled="disabled">
                            <input type="text" class="sliderValue_6 maxValue sliderValue__all" data-index="1" value="40 лет" disabled="disabled">
                            <div id="slider_6"></div>
                        </div>
                    </div>
                    <div class="main__cruise__sidebar main__cruise__sidebar--lainer main__cruise__sidebar--lainer__bottom">
                        <div class="main__cruise__sidebar__wrap">
                            <div class="main__cruise__drop__block">
                                <label>
                                    <input class="checkbox" type="checkbox" name="checkbox-test">
                                    <span class="checkbox-custom"></span>
                                    <span class="label">Аквапарк</span>
                                </label>
                            </div>
                            <div class="main__cruise__drop__block">
                                <label>
                                    <input class="checkbox" type="checkbox" name="checkbox-test">
                                    <span class="checkbox-custom"></span>
                                    <span class="label">Закрытая зона для сьютов</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="main__cruise__bottom">
                        <button class="main__cruise__button main__cruise-podbor">Поиск</button>
                        <button class="main__cruise__button main__cruise-filtr">Сбросить фильтр</button>
                    </div>
                </form>
            </div>
            <div class="search__result">
                <form class="form__result__liner">
                    <?= ListView::widget([
                        'dataProvider' => $dataProvider,
                        'options' => [
                            'tag' => 'form',
                            'class' => 'form__result__liner',
                        ],
                        'itemOptions' => [
                            'tag' => false,
                        ],
                        'itemView' => '_item',
                        'layout' => "<ul class=\"list__flex lainer__list\">{items}</ul>{pager}",
                        'pager' => [
                            'options' => [
                                "class" => "main__cruise__button__liner"
                            ],
                            'class' => 'mranger\load_more_pager\LoadMorePager',
                            'id' => 'ship-list-pagination',
                            'buttonText' => 'Показать еще',
                            'contentSelector' => 'ul.list__flex.lainer__list',
                            'contentItemSelector' => 'li.list__flex__3.lainer__list__item',
                            'includeCssStyles'    => true,
                            'template' => '<div class="liner__cruise__button">{button}</div>',
                        ],
                    ]) ?>
            </form>
        </div>
    </section>