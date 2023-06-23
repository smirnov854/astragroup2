<?php

/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 19.11.2018
 * Time: 11:00
 * @property \yii\data\ActiveDataProvider $dataProvider
 */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\widgets\ListView;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;

?>
<section class="breadcrumbs">
	<!--    <ul class="wrap breadcrumbs__list">-->
	<!--        <li class="breadcrumbs__item">-->
	<!--            <a href="/" class="breadcrumbs__link">Главная</a>-->
	<!--            <span class="breadcrumbs__sep">></span>-->
	<!--        </li>-->
	<!--        <li class="breadcrumbs__item">-->
	<!--            Поиск круизов-->
	<!--        </li>-->
	<!--    </ul>-->
	<?= Breadcrumbs::widget([
		'tag' => 'ul',
		'options' => [
			'class' => 'wrap breadcrumbs__list'
		],
		'itemTemplate' => "
<li class=\"breadcrumbs__item\">{link}
<span class=\"breadcrumbs__sep\">></span>
</li>
",
		'activeItemTemplate' => "<li class=\"breadcrumbs__item\">{link}</li>",
		'homeLink' => [
			'label' => 'Главная',  // required
			'url' => '/',      // optional, will be processed by Url::to()
			'class' => 'breadcrumbs__link',
			//        'template' => 'own template of the item', // optional, if not set $this->itemTemplate will be used
		],
		'links' => $this->params['breadcrumbs']
	]) ?>
</section>
<section class="page">
	<div class="wrap clear">
		<?php Pjax::begin([
			"timeout" => 5000
		]);

		$id = serialize(Yii::$app->request->get());
		//		if ($this->beginCache($id, ['duration' => 3600])) {
		?>
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
				<div class="main__cruise__title">Подобрать круиз из <?= ($dataProvider == null) ? '' : $dataProvider->getTotalCount() ?>
					вариантов
				</div>
			</div>
			<?
			//                $types = [];
			//                foreach($cruiseTypes as $type) {
			//                    $types[$type["ID"]] = $type["name"];
			//                } 
			?>
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
				<div class="main__cruise__date__title clock main__cruise__date__title-sidebar">Продолжительность
					дней
				</div>
				<?
				// переопределяем текущее значение если оно не валидно
				if ($arLengs["leng_from"] && $arLengs["leng_from"] > $modelCruise->leng_from) {
					$modelCruise->leng_from = $modelCruise->leng_from ;
				}
				if ($arLengs["leng_to"] && $arLengs["leng_to"] < $modelCruise->leng_to) {
					$modelCruise->leng_to = $modelCruise->leng_to;
				}
				?>
				<div class="main__cruise__input">
					<input type="number" class="sliderValue_1 minValue sliderValue__all" data-index="0" name="leng_from" value="<?= $modelCruise->leng_from ? $modelCruise->leng_from : $arLengs["leng_from"] ?>">
					<span class="sliderValue__all__line"></span>
					<input type="number" class="sliderValue_1 maxValue sliderValue__all" data-index="1" name="leng_to" value="<?= $modelCruise->leng_to ? $modelCruise->leng_to : $arLengs["leng_to"] ?>">
					<div id="slider_1" data-min="<?= $arLengs["leng_from"] ?>" data-max="<?= $arLengs["leng_to"] ?>" data-val1="<?= $modelCruise->leng_from ? (($modelCruise->leng_from > $arLengs["leng_from"]) ? $modelCruise->leng_from : $arLengs["leng_from"]) : $arLengs["leng_from"] ?>" data-val2="<?= $modelCruise->leng_to ? (($modelCruise->leng_to < $arLengs["leng_to"]) ? $modelCruise->leng_to : $arLengs["leng_to"]) : $arLengs["leng_to"] ?>"></div>
				</div>
			</div>
			<div class="main__cruise__date">
				<div class="main__cruise__date__title calendar main__cruise__date__title-sidebar">Даты круиза <span class='error-information'> - укажите даты</span></div>
				<div class="main__cruise__input">
					<input type="date" class="main__cruise__date__start sliderValue__all" name="date_from" min="<?= date("Y-m-d") ?>" value="<?= $modelCruise->date_from ? $modelCruise->date_from : '' ?>">
					<span class="sliderValue__all__line"></span>
					<input type="date" <? if ($dateReq) { ?> required<? } ?> class="main__cruise__date__end sliderValue__all" name="date_to" min="<?= isset($modelCruise->date_from) ? $modelCruise->date_from : date("Y-m-d") ?>" value="<?= $modelCruise->date_to ? $modelCruise->date_to : '' ?>">
				</div>
			</div>
			<div class="main__cruise__date">
				<div class="main__cruise__date__title ruble main__cruise__date__title-sidebar">Стоимость от и до
					<span>за одного человека при размещении в двухместной каюте</span>
				</div>
				<div class="main__cruise__input">
					<input type="number" class="sliderValue minValue sliderValue__all" data-index="0" name="price_from" value="<?= $modelCruise->price_from ? $modelCruise->price_from : $arPrices["price_from"] ?>">
					<span class="sliderValue__all__line"></span>
					<input type="number" class="sliderValue maxValue sliderValue__all" data-index="1" name="price_to" value="<?= $modelCruise->price_to ? $modelCruise->price_to : $arPrices["price_to"] ?>">
					<div id="slider" data-min="<?= $arPrices["price_from"] ?>" data-max="<?= $arPrices["price_to"] ?>" data-val1="<?= ($modelCruise->price_from & $modelCruise->price_from > $arPrices["price_from"]) ? $modelCruise->price_from : $arPrices["price_from"] ?>" data-val2="<?= ($modelCruise->price_to & $modelCruise->price_to < $arPrices["price_to"]) ? $modelCruise->price_to : $arPrices["price_to"] ?>"></div>
				</div>
			</div>
			<? if (!$short) { ?>
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
			<? } ?>

			<? if (@$spec) { ?>
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
			<?
			} ?>
			<div class="main__cruise__bottom">
				<a href="/search/" class="main__cruise__button main__cruise-filtr">Сбросить фильтр</a>
				<input type="submit" class="main__cruise__button main__cruise-podbor" value="Подобрать круиз" />
			</div>
			<? ActiveForm::end(); ?>
		</div>
		<div class="search__result">
			<?
			$lastPage = false;

			if (!$short) {

				if ($dataProvider->getTotalCount()) {
					$lastPage = ceil(($dataProvider->getTotalCount() / $dataProvider->pagination->pageSize));
					if ($lastPage < 4) $lastPage = false;
				}
			?>
				<?= ListView::widget([
					'dataProvider' => $dataProvider,
					'options' => [
						'tag' => false
					],
					'itemOptions' => [
						'tag' => false
					],
					'itemView' => '_cruise',
					'layout' => "<div class=\"search__result__top block__flex block__flex--space\">
                    <h1>Поиск круизов</h1>
                    <form class=\"form__result\" id='sort-form'>
                        <div class=\"form__result__wrap\">
                            <div class=\"form__result__item form__result__num\">{summary}</div>
                            <div class=\"form__result__item form__result__pagin\">{pager}</div>
                            <div class=\"form__result__item form__result__sort\">
								<span class=\"form__result__name\">Сортировать:</span>
								<div class=\"custom-select\">
								{sorter}
								</div>
							</div>
							<button class=\"form__result__button\" style='display: none'>Сбросить фильтр</button>
							<a href=\"\" class=\"form__result__star--mobile\"></a>
							<div class=\"form__result__button--mobile\"></div>
                        </div>
                    </form>
                    </div>
                    <ul class=\"form__result__list__wrap\">{items}</ul>
                    {pager}
                        ",
					'sorter' => [
						'id' => 'sorter1'
					],
					'pager' => [
						'firstPageLabel' => '<span class="pagin__right"><<</span>',
						'lastPageLabel' => '<span class="pagin__left">>></span>',
						'nextPageLabel' => '<span class="pagin__right">></span>',
						'prevPageLabel' => '<span class="pagin__left"><</span>',
						'pageCssClass' => 'pagin__item',
						'firstPageCssClass' => 'pagin__item',
						'lastPageCssClass' => 'pagin__item',
						'nextPageCssClass' => 'pagin__item',
						'prevPageCssClass' => 'pagin__item',
						'options' => ['class' => 'pagin__list'],
						'maxButtonCount' => 3,
						'pagination' => [
							'pageSize' => 10, // <=== HAS NOT EFFECT
						]
					],
					'summary' => "<span class=\"form__result__name\">Найдено:</span>
								<span class=\"form__result__q\">{totalCount}</span> круизов"
				]); ?>
		</div>
	<?php
				//			$this->endCache();
				//		}
				Pjax::end();
			} else {
				echo '<div class="form__result__empty"><span>Укажите даты</span> и остальные <span>параметры поиска</span></div><div class="form__result__button--mobile"></div>';
			}
	?>
	</div>
</section>

<?
//									<select name='sort' id='sorter'>
//									    <option>дате</option>
//										<option><a href='?sort=departure_date'>дате</a></option>
//										<option><a href='?sort=price_rub'>цене</a></option>
//									</select>
?>