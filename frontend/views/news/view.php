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
            Новости
        </li>
    </ul>
</section>
<section class="page">
    <div class="wrap clear">
        <div class="sidebar">
            <div class="sidebar__close"></div>

            <? $form = ActiveForm::begin([
                'method' => 'get',
                'action' => ['/search'],
                'options' => [
                    'class' => 'main__cruise',
                    'enctype' => 'multipart/form-data'
                ],
            ]); ?>
            <div class="main__cruise__top clear">
                <div class="main__cruise__title">Подобрать круиз из <?=$cntCruise?> вариантов</div>
            </div>
            <div class="main__cruise__sidebar">
                <div class="main__cruise__sidebar__title tip">Тип круиза</div>
                <div class="main__cruise__sidebar__wrap">
                    <?= $form->field($modelCruise, 'types', ['enableLabel' => false])
                        ->checkboxList($types, [
                            'tag' => false,
                            'item' => function ($index, $label, $name, $checked, $value) {
                                $checked = $checked ? 'checked' : '';
                                return "<div class=\"main__cruise__drop__block \">	
                                            <label>
                                                <input class=\"checkbox\" $checked type=\"checkbox\" name=\"{$name}\" value='{$value}'>
                                                <span class=\"checkbox-custom\"></span>
                                                <span class=\"label\">{$label}</span>
                                            </label>
                                        </div>";
                            }
                        ]);
                    ?>
                </div>
            </div>
            <div class="main__cruise__drop">
                <input type="search" class="main__cruise__drop__title" placeholder="Регион плавания">
                <div class="main__cruise__drop__wrap main__cruise__drop__wrap-region">
                    <div class="scrollbar-inner">
                        <?= $form->field($modelCruise, 'regions', ['enableLabel' => false])
                            ->checkboxList($arRegions, [
                                'tag' => false,
                                'item' => function ($index, $label, $name, $checked, $value) {
                                    $checked = $checked ? 'checked' : '';
                                    return "<div class=\"main__cruise__drop__region \">	
                                                <label>
                                                    <input class=\"checkbox\" $checked type=\"checkbox\" name=\"{$name}\" value='{$value}'>
                                                    <span class=\"checkbox-custom\"></span>
                                                    <span class=\"label\">{$label}<span class=\"label__num\"></span></span>
                                                </label>
                                            </div>";
                                }
                            ]); ?>
                    </div>
                </div>
            </div>
            <div class="main__cruise__date">
                <div class="main__cruise__date__title clock main__cruise__date__title-sidebar">Продолжительность дней
                </div>
                <div class="main__cruise__input">
                    <input type="number" class="sliderValue_1 minValue sliderValue__all" data-index="0"
                           name="leng_from"
                           value="<?= $modelCruise->leng_from ? $modelCruise->leng_from : "10" ?>" readonly="">
                    <span class="sliderValue__all__line"></span>
                    <input type="number" class="sliderValue_1 maxValue sliderValue__all" data-index="1"
                           name="leng_to"
                           value="<?= $modelCruise->leng_to ? $modelCruise->leng_to : "70" ?>" readonly="">
                    <div id="slider_1"></div>
                </div>
            </div>
            <div class="main__cruise__date">
                <div class="main__cruise__date__title calendar main__cruise__date__title-sidebar">Даты круиза</div>
                <div class="main__cruise__input">
                    <input type="date" class="main__cruise__date__start sliderValue__all" name="date_from"
                           value="<?= $modelCruise->date_from ? $modelCruise->date_from : "" ?>">
                    <span class="sliderValue__all__line"></span>
                    <input type="date" class="main__cruise__date__end sliderValue__all" name="date_to"
                           value="<?= $modelCruise->date_to ? $modelCruise->date_to : "" ?>">
                </div>
            </div>
            <div class="main__cruise__date">
                <div class="main__cruise__date__title ruble main__cruise__date__title-sidebar">Стоимость от и до <span>за одного человека при размещении в двухместной каюте</span>
                </div>
                <div class="main__cruise__input">
                    <input type="number" class="sliderValue minValue sliderValue__all" data-index="0"
                           name="price_from"
                           value="<?= $modelCruise->price_from ? $modelCruise->price_from : "40000" ?>" readonly="">
                    <span class="sliderValue__all__line"></span>
                    <input type="number" class="sliderValue maxValue sliderValue__all" data-index="1"
                           name="price_to"
                           value="<?= $modelCruise->price_to ? $modelCruise->price_to : "10000000" ?>" readonly="">
                    <div id="slider"></div>
                </div>
            </div>
            <div class="main__cruise__drop">
                <input type="search" class="main__cruise__drop__title" placeholder="Порт отправления">
                <div class="main__cruise__drop__wrap main__cruise__drop__wrap-region">
                    <div class="scrollbar-inner">
                        <?= $form->field($modelCruise, 'ports', ['enableLabel' => false])
                            ->checkboxList($arPorts, [
                                'tag' => false,
                                'item' => function ($index, $label, $name, $checked, $value) {
                                    $checked = $checked ? 'checked' : '';
                                    return "<div class=\"main__cruise__drop__region \">	
                                                    <label>
                                                        <input class=\"checkbox\" $checked type=\"checkbox\" name=\"{$name}\" value='{$value}'>
                                                        <span class=\"checkbox-custom\"></span>
                                                        <span class=\"label\">{$label}<span class=\"label__num\"></span></span>
                                                    </label>
                                                </div>";
                                }
                            ]); ?>
                    </div>
                </div>
            </div>
            <div class="main__cruise__drop">
                <input type="search" class="main__cruise__drop__title" placeholder="Страна посещения">
                <div class="main__cruise__drop__wrap main__cruise__drop__wrap-region">
                    <div class="scrollbar-inner">
                        <?= $form->field($modelCruise, 'countries', ['enableLabel' => false])
                            ->checkboxList($arCountries, [
                                'tag' => false,
                                'item' => function ($index, $label, $name, $checked, $value) {
                                    $checked = $checked ? 'checked' : '';
                                    return "<div class=\"main__cruise__drop__region \">	
                                                    <label>
                                                        <input class=\"checkbox\" $checked type=\"checkbox\" name=\"{$name}\" value='{$value}'>
                                                        <span class=\"checkbox-custom\"></span>
                                                        <span class=\"label\">{$label}<span class=\"label__num\"></span></span>
                                                    </label>
                                                </div>";
                                }
                            ]); ?>
                    </div>
                </div>
            </div>
            <div class="main__cruise__drop">
                <input type="search" class="main__cruise__drop__title" placeholder="Порты захода">
                <div class="main__cruise__drop__wrap main__cruise__drop__wrap-region">
                    <div class="scrollbar-inner">
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
            </div>
            <div class="main__cruise__date" style="display: none;">
                <div class="main__cruise__date__title temper main__cruise__date__title-sidebar">Температурный режим
                </div>
                <div class="main__cruise__input">
                    <input type="text" class="sliderValue_2 minValue sliderValue__all" data-index="0" value="-25"
                           disabled="disabled">
                    <input type="text" class="sliderValue_2 maxValue sliderValue__all" data-index="1" value="+25"
                           disabled="disabled">
                    <div id="slider_2"></div>
                </div>
            </div>
            <div class="main__cruise__sidebar" style="display: none">
                <div class="main__cruise__sidebar__title">Уровень комфорта</div>
                <div class="main__cruise__sidebar__wrap">
                    <div class="main__cruise__drop__block main__cruise__drop__block-3">
                        <label>
                            <input class="checkbox" type="checkbox" name="checkbox-test">
                            <span class="checkbox-custom"></span>
                            <span class="label">Стандарт</span>
                        </label>
                    </div>
                    <div class="main__cruise__drop__block main__cruise__drop__block-3">
                        <label>
                            <input class="checkbox" type="checkbox" name="checkbox-test">
                            <span class="checkbox-custom"></span>
                            <span class="label">Премиум</span>
                        </label>
                    </div>
                    <div class="main__cruise__drop__block main__cruise__drop__block-3">
                        <label>
                            <input class="checkbox" type="checkbox" name="checkbox-test">
                            <span class="checkbox-custom"></span>
                            <span class="label">Люкс</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="main__cruise__drop">
                <input type="search" class="main__cruise__drop__title" placeholder="Круизные компании">
                <div class="main__cruise__drop__wrap main__cruise__drop__wrap-region">
                    <div class="scrollbar-inner">
                        <?= $form->field($modelCruise, 'companies', ['enableLabel' => false])
                            ->checkboxList($arCompanies, [
                                'tag' => false,
                                'item' => function ($index, $label, $name, $checked, $value) {
                                    $checked = $checked ? 'checked' : '';
                                    return "<div class=\"main__cruise__drop__region \">	
                                                    <label>
                                                        <input class=\"checkbox\" $checked type=\"checkbox\" name=\"{$name}\" value='{$value}'>
                                                        <span class=\"checkbox-custom\"></span>
                                                        <span class=\"label\">{$label}<span class=\"label__num\"></span></span>
                                                    </label>
                                                </div>";
                                }
                            ]); ?>
                    </div>
                </div>
            </div>
            <div class="main__cruise__drop">
                <input type="search" class="main__cruise__drop__title" placeholder="Лайнеры">
                <div class="main__cruise__drop__wrap main__cruise__drop__wrap-region">
                    <div class="scrollbar-inner">
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
            </div>
            <? /* ?>
            <div class="main__cruise__drop">
                <div class="main__cruise__drop__title">Год постройки</div>
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
            <div class="main__cruise__date">
                <div class="main__cruise__date__title main__cruise__date__title-sidebar main__cruise__date__title-img">
                    Тоннаж
                </div>
                <div class="main__cruise__input">
                    <input type="text" class="sliderValue_3 minValue sliderValue__all" data-index="0" value="25000"
                           disabled="disabled">
                    <input type="text" class="sliderValue_3 maxValue sliderValue__all" data-index="1" value="200000"
                           disabled="disabled">
                    <div id="slider_3"></div>
                </div>
            </div>
            <div class="main__cruise__date">
                <div class="main__cruise__date__title main__cruise__date__title-sidebar main__cruise__date__title-img">
                    Количество человек
                </div>
                <div class="main__cruise__input">
                    <input type="text" class="sliderValue_4 minValue sliderValue__all" data-index="0" value="100"
                           disabled="disabled">
                    <input type="text" class="sliderValue_4 maxValue sliderValue__all" data-index="1" value="2000"
                           disabled="disabled">
                    <div id="slider_4"></div>
                </div>
            </div>
            <div class="main__cruise__drop">
                <div class="main__cruise__drop__title">Уровень пространства</div>
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
            <? */ ?>
            <div class="main__cruise__sidebar">
                <div class="main__cruise__sidebar__title">Особенности круиза</div>
                <div class="main__cruise__sidebar__wrap">
                    <div class="main__cruise__drop__block">
                        <label>
                            <input class="checkbox" type="checkbox" name="checkbox-test">
                            <span class="checkbox-custom"></span>
                            <span class="label">Архетектура</span>
                        </label>
                    </div>
                    <div class="main__cruise__drop__block">
                        <label>
                            <input class="checkbox" type="checkbox" name="checkbox-test">
                            <span class="checkbox-custom"></span>
                            <span class="label">История</span>
                        </label>
                    </div>
                    <div class="main__cruise__drop__block">
                        <label>
                            <input class="checkbox" type="checkbox" name="checkbox-test">
                            <span class="checkbox-custom"></span>
                            <span class="label">Дни в море</span>
                        </label>
                    </div>
                    <div class="main__cruise__drop__block">
                        <label>
                            <input class="checkbox" type="checkbox" name="checkbox-test">
                            <span class="checkbox-custom"></span>
                            <span class="label">Пляж</span>
                        </label>
                    </div>
                    <div class="main__cruise__drop__block">
                        <label>
                            <input class="checkbox" type="checkbox" name="checkbox-test">
                            <span class="checkbox-custom"></span>
                            <span class="label">Природа</span>
                        </label>
                    </div>
                    <div class="main__cruise__drop__block">
                        <label>
                            <input class="checkbox" type="checkbox" name="checkbox-test">
                            <span class="checkbox-custom"></span>
                            <span class="label">Этника</span>
                        </label>
                    </div>
                    <div class="main__cruise__drop__block main__cruise__drop__block-1">
                        <label>
                            <input class="checkbox" type="checkbox" name="checkbox-test">
                            <span class="checkbox-custom"></span>
                            <span class="label">Только спецпредложения</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="main__cruise__bottom">
                <button class="main__cruise__button main__cruise-podbor">Подобрать круиз</button>
                <button class="main__cruise__button main__cruise-filtr">Сбросить фильтр</button>
            </div>
            <? ActiveForm::end(); ?>
        </div>
        <div class="page__content">
            <h1><?=$model->title?></h1>
            <div class="page__content__button form__result__button--mobile"></div>
            <? if($model->image && $model->image->name) { ?>
            <div class="preview__picture">
                <img src="<?=$model->image->subdir?>/<?=$model->image->name?>" alt="">
            </div>
            <? } ?>
            <div class="user__content">
                <?=$model->detail?>
            </div>
        </div>
    </div>
</section>