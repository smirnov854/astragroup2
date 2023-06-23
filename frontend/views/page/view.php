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
<section class="page">
	<div class="wrap clear">
		<h1><?= @$obPage->title ?></h1>
		<? if(@$dataProvider){?>
		<div class="sidebar">
			<div class="sidebar__close"></div>
			<? $form = ActiveForm::begin([
				'method' => 'get',
				'action' => ['/search'],
				'options' => [
					'data-pjax' => true,
					'class' => 'main__cruise',
					'enctype' => 'multipart/form-data'
				],
			]); ?>
			<div class="main__cruise__top clear">
				<div class="main__cruise__title">Подобрать круиз из <?= $dataProvider->getTotalCount() ?> вариантов</div>
			</div>
			<?
			//                $types = [];
			//                foreach($cruiseTypes as $type) {
			//                    $types[$type["ID"]] = $type["name"];
			//                } ?>
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
				<input type="search" class="main__cruise__drop__title" placeholder="Регион плавания <?= (is_array($modelCruise->regions)) ? "(" . count($modelCruise->regions) . ")" : "" ?>">
				<div class="main__cruise__drop__wrap main__cruise__drop__wrap-region">
					<div class="scrollbar-inner">
						<?= $form->field($modelCruise, 'regions', ['enableLabel' => false])
							->checkboxList($arRegions, [
								'tag' => false,
								'item' => function ($index, $label, $name, $checked, $value) {
									$checked = $checked ? 'checked' : '';
									return "<div class=\"main__cruise__drop__region \" data-id='{$value}'>	
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
					<input type="number" class="sliderValue_1 minValue sliderValue__all" data-index="0" name="leng_from" value="<?= $modelCruise->leng_from ? $modelCruise->leng_from : $arLengs["leng_from"] ?>">
					<span class="sliderValue__all__line"></span>
					<input type="number" class="sliderValue_1 maxValue sliderValue__all" data-index="1" name="leng_to" value="<?= $modelCruise->leng_to ? $modelCruise->leng_to : $arLengs["leng_to"] ?>">
					<div id="slider_1" data-min="<?= $arLengs["leng_from"] ?>" data-max="<?= $arLengs["leng_to"] ?>" data-val1="<?= $modelCruise->leng_from ? (($modelCruise->leng_from > $arLengs["leng_from"]) ? $modelCruise->leng_from : $arLengs["leng_from"]) : $arLengs["leng_from"] ?>" data-val2="<?= $modelCruise->leng_to ? (($modelCruise->leng_to < $arLengs["leng_to"]) ? $modelCruise->leng_to : $arLengs["leng_to"]) : $arLengs["leng_to"] ?>"></div>
				</div>
			</div>
			<div class="main__cruise__date">
				<div class="main__cruise__date__title calendar main__cruise__date__title-sidebar">Даты круиза</div>
				<div class="main__cruise__input">
					<input type="date" class="main__cruise__date__start sliderValue__all" name="date_from" max="<?= $arDates["date_to"] ?>" value="<?= $modelCruise->date_from ? $modelCruise->date_from : "" ?>">
					<span class="sliderValue__all__line"></span>
					<input type="date" class="main__cruise__date__end sliderValue__all" name="date_to" min="<?= $arDates["date_from"] ?>" value="<?= $modelCruise->date_to ? $modelCruise->date_to : "" ?>">
				</div>
			</div>
			<div class="main__cruise__date">
				<div class="main__cruise__date__title ruble main__cruise__date__title-sidebar">Стоимость от и до <span>за одного человека при размещении в двухместной каюте</span>
				</div>
				<div class="main__cruise__input">
					<input type="number" class="sliderValue minValue sliderValue__all" data-index="0" name="price_from" value="<?= $modelCruise->price_from ? $modelCruise->price_from : $arPrices["price_from"] ?>">
					<span class="sliderValue__all__line"></span>
					<input type="number" class="sliderValue maxValue sliderValue__all" data-index="1" name="price_to" value="<?= $modelCruise->price_to ? $modelCruise->price_to : $arPrices["price_to"] ?>">
					<div id="slider" data-min="<?= $arPrices["price_from"] ?>" data-max="<?= $arPrices["price_to"] ?>" data-val1="<?= ($modelCruise->price_from & $modelCruise->price_from > $arPrices["price_from"]) ? $modelCruise->price_from : $arPrices["price_from"] ?>" data-val2="<?= ($modelCruise->price_to & $modelCruise->price_to < $arPrices["price_to"]) ? $modelCruise->price_to : $arPrices["price_to"] ?>"></div>
				</div>
			</div>
			<div class="main__cruise__drop">
				<input type="search" class="main__cruise__drop__title" placeholder="Порт отправления <?= (is_array($modelCruise->dep_ports)) ? "(" . count($modelCruise->dep_ports) . ")" : "" ?>">
				<div class="main__cruise__drop__wrap main__cruise__drop__wrap-region">
					<div class="scrollbar-inner">
						<?= $form->field($modelCruise, 'dep_ports', ['enableLabel' => false])
							->checkboxList($arDpPorts, [
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
				<input type="search" class="main__cruise__drop__title" placeholder="Страна посещения <?= (is_array($modelCruise->countries)) ? "(" . count($modelCruise->countries) . ")" : "" ?>">
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
				<input type="search" class="main__cruise__drop__title" placeholder="Порты захода <?= (is_array($modelCruise->itn_ports)) ? "(" . count($modelCruise->itn_ports) . ")" : "" ?>">
				<div class="main__cruise__drop__wrap main__cruise__drop__wrap-region">
					<div class="scrollbar-inner">
						<?= $form->field($modelCruise, 'itn_ports', ['enableLabel' => false])
							->checkboxList($arRtPorts, [
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
			<div class="main__cruise__date" style="display: none;">
				<div class="main__cruise__date__title temper main__cruise__date__title-sidebar">Температурный режим
				</div>
				<div class="main__cruise__input">
					<input type="text" class="sliderValue_2 minValue sliderValue__all" data-index="0" value="-25" disabled="disabled">
					<input type="text" class="sliderValue_2 maxValue sliderValue__all" data-index="1" value="+25" disabled="disabled">
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
				<input type="search" class="main__cruise__drop__title" placeholder="Круизные компании <?= (is_array($modelCruise->companies)) ? "(" . count($modelCruise->companies) . ")" : "" ?>">
				<div class="main__cruise__drop__wrap main__cruise__drop__wrap-region">
					<div class="scrollbar-inner">
						<?= $form->field($modelCruise, 'companies', ['enableLabel' => false])
							->checkboxList($arCompanies, [
								'tag' => false,
								'item' => function ($index, $label, $name, $checked, $value) {
									$checked = $checked ? 'checked' : '';
									return "<div class=\"main__cruise__drop__region \">	
                                                    <label><?=?>
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
				<input type="search" class="main__cruise__drop__title" placeholder="Лайнеры <?= (is_array($modelCruise->ships)) ? "(" . count($modelCruise->ships) . ")" : "" ?>">
				<div class="main__cruise__drop__wrap main__cruise__drop__wrap-region">
					<div class="scrollbar-inner">
						<?= $form->field($modelCruise, 'ships', ['enableLabel' => false])
							->checkboxList($arShips, [
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
					<input type="text" class="sliderValue_3 minValue sliderValue__all" data-index="0" value="25000" disabled="disabled">
					<input type="text" class="sliderValue_3 maxValue sliderValue__all" data-index="1" value="200000" disabled="disabled">
					<div id="slider_3"></div>
				</div>
			</div>
			<div class="main__cruise__date">
				<div class="main__cruise__date__title main__cruise__date__title-sidebar main__cruise__date__title-img">
					Количество человек
				</div>
				<div class="main__cruise__input">
					<input type="text" class="sliderValue_4 minValue sliderValue__all" data-index="0" value="100" disabled="disabled">
					<input type="text" class="sliderValue_4 maxValue sliderValue__all" data-index="1" value="2000" disabled="disabled">
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
					<div class="main__cruise__drop__block main__cruise__drop__block-1">
						<label>
							<input class="checkbox" type="checkbox" name="specials">
							<span class="checkbox-custom"></span>
							<span class="label">Только спецпредложения</span>
						</label>
					</div>
				</div>
				<div class="main__cruise__sidebar__wrap" style="display: none">
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
				</div>
			</div>
			<div class="main__cruise__bottom">
				<a href="/search/" class="main__cruise__button main__cruise-filtr">Сбросить фильтр</a>
				<input type="submit" class="main__cruise__button main__cruise-podbor" value="Подобрать круиз" />
			</div>
			<? ActiveForm::end(); ?>
		</div>
		<?}?>
		<?= @$obPage->description ?>
	</div>
</section>
<!--pre>
<? //print_r(\common\models\Cruise::oldCruises(12)); ?>
</pre -->