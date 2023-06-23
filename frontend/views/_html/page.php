<?include('header.php')?>
<section class="breadcrumbs">
	<ul class="wrap breadcrumbs__list">
		<li class="breadcrumbs__item">
			<a href="/" class="breadcrumbs__link">Главная</a>
			<span class="breadcrumbs__sep">></span>
		</li>
		<li class="breadcrumbs__item">
			Поиск круизов
		</li>
	</ul>
</section>
<section class="page">
	<div class="wrap clear">
		<div class="sidebar">
			<div class="sidebar__close"></div>
			<form action="" class="main__cruise">
				<div class="main__cruise__top clear">
					<div class="main__cruise__title">Подобрать круиз из 1200 вариантов</div>
				</div>
				<div class="main__cruise__sidebar">
					<div class="main__cruise__sidebar__title">Тип круиза</div>
					<div class="main__cruise__sidebar__wrap">
						<div class="main__cruise__drop__block">	
							<label>
								<input class="checkbox" type="checkbox" name="checkbox-test">
								<span class="checkbox-custom"></span>
								<span class="label">Морской</span>
							</label>
						</div>
						<div class="main__cruise__drop__block">	
							<label>
								<input class="checkbox" type="checkbox" name="checkbox-test">
								<span class="checkbox-custom"></span>
								<span class="label">Реки России</span>
							</label>
						</div>
						<div class="main__cruise__drop__block">	
							<label>
								<input class="checkbox" type="checkbox" name="checkbox-test">
								<span class="checkbox-custom"></span>
								<span class="label">Автобус+паром</span>
							</label>
						</div>
						<div class="main__cruise__drop__block">	
							<label>
								<input class="checkbox" type="checkbox" name="checkbox-test">
								<span class="checkbox-custom"></span>
								<span class="label">Реки Европы</span>
							</label>
						</div>
					</div>
				</div>
				<div class="main__cruise__drop">
					<div class="main__cruise__drop__title">Регион плавания</div>
					<div class="main__cruise__drop__wrap main__cruise__drop__wrap-region">
						<div class="scrollbar-inner">
							<div class="main__cruise__drop__region label__main">	
								<label>
									<input class="checkbox" type="checkbox" name="checkbox-test">
									<span class="checkbox-custom"></span>
									<span class="label">Австралия и Океания 
										<span class="label__num">(306)</span>
									</span>
								</label>
							</div>
							<div class="main__cruise__drop__region">	
								<label>
									<input class="checkbox" type="checkbox" name="checkbox-test">
									<span class="checkbox-custom"></span>
									<span class="label">Новая зеландия  
										<span class="label__num">(146)</span>
									</span>
								</label>
							</div>
							<div class="main__cruise__drop__region">	
								<label>
									<input class="checkbox" type="checkbox" name="checkbox-test">
									<span class="checkbox-custom"></span>
									<span class="label">Французкая полинезия  
										<span class="label__num">(86)</span>
									</span>
								</label>
							</div>
							<div class="main__cruise__drop__region label__main">	
								<label>
									<input class="checkbox" type="checkbox" name="checkbox-test">
									<span class="checkbox-custom"></span>
									<span class="label">Азия 
										<span class="label__num">(616)</span>
									</span>
								</label>
							</div>
							<div class="main__cruise__drop__region">	
								<label>
									<input class="checkbox" type="checkbox" name="checkbox-test">
									<span class="checkbox-custom"></span>
									<span class="label">Юго-Восточная Азия  
										<span class="label__num">(405)</span>
									</span>
								</label>
							</div>
							<div class="main__cruise__drop__region">	
								<label>
									<input class="checkbox" type="checkbox" name="checkbox-test">
									<span class="checkbox-custom"></span>
									<span class="label">Япония  
										<span class="label__num">(244)</span>
									</span>
								</label>
							</div>
							<div class="main__cruise__drop__region label__main">	
								<label>
									<input class="checkbox" type="checkbox" name="checkbox-test">
									<span class="checkbox-custom"></span>
									<span class="label">Америка 
										<span class="label__num">(3987)</span>
									</span>
								</label>
							</div>
							<div class="main__cruise__drop__region">	
								<label>
									<input class="checkbox" type="checkbox" name="checkbox-test">
									<span class="checkbox-custom"></span>
									<span class="label">Северная Америка 
										<span class="label__num">(3332)</span>
									</span>
								</label>
							</div>
							<div class="main__cruise__drop__region">	
								<label>
									<input class="checkbox" type="checkbox" name="checkbox-test">
									<span class="checkbox-custom"></span>
									<span class="label">Аляска
										<span class="label__num">(265)</span>
									</span>
								</label>
							</div>
							<div class="main__cruise__drop__region">	
								<label>
									<input class="checkbox" type="checkbox" name="checkbox-test">
									<span class="checkbox-custom"></span>
									<span class="label">Мексиканская ривьера 
										<span class="label__num">(1030)</span>
									</span>
								</label>
							</div>
							<div class="main__cruise__drop__region">	
								<label>
									<input class="checkbox" type="checkbox" name="checkbox-test">
									<span class="checkbox-custom"></span>
									<span class="label">США и Канада 
										<span class="label__num">(3329)</span>
									</span>
								</label>
							</div>
							<div class="main__cruise__drop__region">	
								<label>
									<input class="checkbox" type="checkbox" name="checkbox-test">
									<span class="checkbox-custom"></span>
									<span class="label">Центральная Америка и Панамский канал 
										<span class="label__num">(528)</span>
									</span>
								</label>
							</div>
							<div class="main__cruise__drop__region">	
								<label>
									<input class="checkbox" type="checkbox" name="checkbox-test">
									<span class="checkbox-custom"></span>
									<span class="label">Северная Америка 
										<span class="label__num">(3332)</span>
									</span>
								</label>
							</div>
						</div>
					</div>
				</div>
				<div class="main__cruise__date">
					<div class="main__cruise__date__title clock main__cruise__date__title-sidebar">Продолжительность дней</div>
					<div class="main__cruise__input">
						<input type="number" class="sliderValue_1 minValue sliderValue__all" data-index="0" value="10" disabled="disabled">
						<span class="sliderValue__all__line"></span>
						<input type="number" class="sliderValue_1 maxValue sliderValue__all" data-index="1" value="70" disabled="disabled">
						<div id="slider_1"></div>
					</div>
				</div> 
				<div class="main__cruise__date">
					<div class="main__cruise__date__title calendar main__cruise__date__title-sidebar">Даты круиза</div>
					<div class="main__cruise__input">
						<input type="date" class="main__cruise__date__start sliderValue__all"  value="2018.07.07">
						<span class="sliderValue__all__line"></span>
						<input type="date" class="main__cruise__date__end sliderValue__all"  value="2018.08.08">
					</div>
				</div>
				<div class="main__cruise__date">
					<div class="main__cruise__date__title ruble main__cruise__date__title-sidebar">Стоимость от и до <span>за одного человека при размещении в двухместной каюте</span></div>
					<div class="main__cruise__input">
						<input type="number" class="sliderValue minValue sliderValue__all" data-index="0" value="40000" disabled="disabled">
						<span class="sliderValue__all__line"></span>
						<input type="number" class="sliderValue maxValue sliderValue__all" data-index="1" value="10000000" disabled="disabled">
						<div id="slider"></div>
					</div>
				</div>
				<div class="main__cruise__drop">
					<div class="main__cruise__drop__title">Порт отправления</div>
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
				<div class="main__cruise__drop">
					<div class="main__cruise__drop__title">Страна посещения</div>
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
				<div class="main__cruise__drop">
					<div class="main__cruise__drop__title">Порты захода</div>
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
					<div class="main__cruise__date__title temper main__cruise__date__title-sidebar">Температурный режим</div>
					<div class="main__cruise__input">
						<input type="text" class="sliderValue_2 minValue sliderValue__all" data-index="0" value="-25" disabled="disabled">
						<span class="sliderValue__all__line"></span>
						<input type="text" class="sliderValue_2 maxValue sliderValue__all" data-index="1" value="+25" disabled="disabled">
						<div id="slider_2"></div>
					</div>
				</div>
				<div class="main__cruise__sidebar">
					<div class="main__cruise__sidebar__title">Пассажиры</div>
					<div class="main__cruise__sidebar__select block__flex">
						<div class="main__cruise__sidebar__select__label">Взрослые</div>
						<div class="custom-select">
							<select>
								<option value="">1</option>
								<option value="">2</option>
								<option value="">3</option>
							</select>
						</div>
					</div>
					<div class="main__cruise__sidebar__select block__flex">
						<div class="main__cruise__sidebar__select__label">Подростки (13 - 18 лет)</div>
						<div class="custom-select">
							<select>
								<option value="">1</option>
								<option value="">2</option>
								<option value="">3</option>
							</select>
						</div>
					</div>
					<div class="main__cruise__sidebar__select block__flex">
						<div class="main__cruise__sidebar__select__label">Дети (6 месяцев - 12 лет)</div>
						<div class="custom-select">
							<select>
								<option value="">1</option>
								<option value="">2</option>
								<option value="">3</option>
							</select>
						</div>
					</div>
				</div>
				<div class="main__cruise__sidebar">
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
					<div class="main__cruise__drop__title">Круизные компании</div>
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
				<div class="main__cruise__drop">
					<div class="main__cruise__drop__title">Лайнеры</div>
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
					<div class="main__cruise__date__title main__cruise__date__title-img">Тоннаж</div>
					<div class="main__cruise__input">
						<input type="text" class="sliderValue_3 minValue sliderValue__all" data-index="0" value="25000" disabled="disabled">
						<span class="sliderValue__all__line"></span>
						<input type="text" class="sliderValue_3 maxValue sliderValue__all" data-index="1" value="200000" disabled="disabled">
						<div id="slider_3"></div>
					</div>
				</div>
				<div class="main__cruise__date">
					<div class="main__cruise__date__title main__cruise__date__title-img">Количество человек</div>
					<div class="main__cruise__input">
						<input type="text" class="sliderValue_4 minValue sliderValue__all" data-index="0" value="100" disabled="disabled">
						<span class="sliderValue__all__line"></span>
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
						<div class="main__cruise__drop__block main__cruise__drop__block-1">	
							<label>
								<input class="checkbox" type="checkbox" name="checkbox-test">
								<span class="checkbox-custom"></span>
								<span class="label">Дети бесплатно</span>
							</label>
						</div>
						<div class="main__cruise__drop__block main__cruise__drop__block-1">	
							<label>
								<input class="checkbox" type="checkbox" name="checkbox-test">
								<span class="checkbox-custom"></span>
								<span class="label">Русские группы</span>
							</label>
						</div>
						<div class="main__cruise__drop__block main__cruise__drop__block-1">	
							<label>
								<input class="checkbox" type="checkbox" name="checkbox-test">
								<span class="checkbox-custom"></span>
								<span class="label">Безвизовый круиз</span>
							</label>
						</div>
						<div class="main__cruise__drop__block main__cruise__drop__block-1">	
							<label>
								<input class="checkbox" type="checkbox" name="checkbox-test">
								<span class="checkbox-custom"></span>
								<span class="label">Карибы без виз США</span>
							</label>
						</div>
						<div class="main__cruise__drop__block main__cruise__drop__block-1">	
							<label>
								<input class="checkbox" type="checkbox" name="checkbox-test">
								<span class="checkbox-custom"></span>
								<span class="label">Новый год</span>
							</label>
						</div>
						<div class="main__cruise__drop__block main__cruise__drop__block-1">	
							<label>
								<input class="checkbox" type="checkbox" name="checkbox-test">
								<span class="checkbox-custom"></span>
								<span class="label">Майские праздники</span>
							</label>
						</div>
						<div class="main__cruise__drop__block main__cruise__drop__block-1">	
							<label>
								<input class="checkbox" type="checkbox" name="checkbox-test">
								<span class="checkbox-custom"></span>
								<span class="label">Весенник каникулы</span>
							</label>
						</div>
						<div class="main__cruise__drop__block main__cruise__drop__block-1">	
							<label>
								<input class="checkbox" type="checkbox" name="checkbox-test">
								<span class="checkbox-custom"></span>
								<span class="label">Ноябрьские праздники</span>
							</label>
						</div>
					</div>
				</div>
				<div class="main__cruise__bottom">
					<button class="main__cruise__button main__cruise-podbor">Подобрать круиз</button>
					<button class="main__cruise__button main__cruise-filtr">Сбросить фильтр</button>
				</div>
			</form>
		</div>
		<div class="page__content">
			<h1>Текстовая страница</h1>
			<div class="page__content__button form__result__button--mobile"></div>
			<div class="page__slider">
				<div class="page__slider__for">
					<div class="page__slider__for__item">
						<img src="/images/page/slide.jpg" alt="">
					</div>
					<div class="page__slider__for__item">
						<img src="/images/page/slide.jpg" alt="">
					</div>
				</div>
				<div class="page__slider__nav">
					<div class="page__slider__nav__item" style="background-image: url(/images/page/slide.jpg);">
					</div>
					<div class="page__slider__nav__item" style="background-image: url(/images/page/slide.jpg);">
					</div>
				</div>
			</div>
			<div class="user__content">
				<h3>Заголовок H3</h3>
				<p>Шикарное предложение от Celebrity Cruises - при бронировании круиза продолжительностью от 5 дней с 3 по 30 мая 2018 Вы получаете до 4 бонусов в подарок, скидку 50% на 3 и 4 гостя в каюте, а также скидку до $400 на человека на избранных направлениях. Акция распространяется на все маршруты с датами отправления с 1 июня 2018 по 30 апреля 2019, кроме репозиционных и трансокеанских круизов, а также круизов по Галапагосским островам.</p>

				<p>Акция распространяется на все круизы компании, кроме репозиционных и трансокеанских маршрутов, а также круизов по Галапагосским островам, с датами отправления с 1 сентября 2018 года по 30 апреля 2020.
				</p>
				<div class="accordion">
					<div class="accordion__item">
						<div class="accordion__title">h3 заголовок спойлера</div>
						<div class="accordion__content">
							<p>Шикарное предложение от Celebrity Cruises - при бронировании круиза продолжительностью от 5 дней с 3 по 30 мая 2018 Вы получаете до 4 бонусов в подарок, скидку 50% на 3 и 4 гостя в каюте, а также скидку до $400 на человека на избранных направлениях. Акция распространяется на все маршруты с датами отправления с 1 июня 2018 по 30 апреля 2019, кроме репозиционных и трансокеанских круизов, а также круизов по Галапагосским островам.</p>

							<p>Акция распространяется на все круизы компании, кроме репозиционных и трансокеанских маршрутов, а также круизов по Галапагосским островам, с датами отправления с 1 сентября 2018 года по 30 апреля 2020.
							</p>
						</div>
					</div>
					<div class="accordion__item">
						<div class="accordion__title">h3 заголовок спойлера</div>
						<div class="accordion__content">
							<p>Шикарное предложение от Celebrity Cruises - при бронировании круиза продолжительностью от 5 дней с 3 по 30 мая 2018 Вы получаете до 4 бонусов в подарок, скидку 50% на 3 и 4 гостя в каюте, а также скидку до $400 на человека на избранных направлениях. Акция распространяется на все маршруты с датами отправления с 1 июня 2018 по 30 апреля 2019, кроме репозиционных и трансокеанских круизов, а также круизов по Галапагосским островам.</p>

							<p>Акция распространяется на все круизы компании, кроме репозиционных и трансокеанских маршрутов, а также круизов по Галапагосским островам, с датами отправления с 1 сентября 2018 года по 30 апреля 2020.
							</p>
						</div>
					</div>
				</div>
			<ul>
				<li>Кофе американо, чай, вода и холодный чай во время завтрака, обеда и ужина в основном ресторане и в ресторане-буфет (шведский стол) - для кают всех категорий.</li>
				<li>Для гостей старше 21 года: широкий выбор алкогольных напитков, пиво в бутылках и на розлив, вино в бокалах и коктейли стоимостью до 15$. А так же безалкогольные напитки и соки (кроме свежевыжатых) - кроме кают категории IX, OX, BX, MX.</li>
			</ul>
			<ol>
				<li>Кофе американо, чай, вода и холодный чай во время завтрака, обеда и ужина в основном ресторане и в ресторане-буфет (шведский стол) - для кают всех категорий.</li>
				<li>Для гостей старше 21 года: широкий выбор алкогольных напитков, пиво в бутылках и на розлив, вино в бокалах и коктейли стоимостью до 15$. А так же безалкогольные напитки и соки (кроме свежевыжатых) - кроме кают категории IX, OX, BX, MX.</li>
			</ol>
			<table>
				<tr>
					<td>Таблица</td>
					<td>Таблица</td>
					<td>Таблица</td>
					<td>Таблица</td>
				</tr>
				<tr>
					<td>Таблица</td>
					<td>Таблица</td>
					<td>Таблица</td>
					<td>Таблица</td>
				</tr>
			</table>
			<div class="block__space">
				<div class="content__photo">
					<img src="/images/page/slide.jpg" alt="">
					<h3>Заголовок под фото</h3>
					<p>Текст под фото</p>
				</div>
				<div class="content__photo">
					<img src="/images/page/slide.jpg" alt="">
					<h3>Заголовок под фото</h3>
					<p>Текст под фото</p>
				</div>
			</div>
			</div>
		</div>
	</div>
</section>
<?include('footer.php')?>