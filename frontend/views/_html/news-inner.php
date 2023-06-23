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
	<section class="page page__inner">
		<div class="wrap clear">
			<div class="sidebar sidebar__page sidebar__page--action">
				<button class="sidebar__button news__button">Подписаться на новости</button>
				<div class="sidebar__page__wrap">
					<form action="" class="filtr__lainer">
						<div class="filtr__lainer__title">Выберите круизы по акциям
						и спецпредложениям</div>
						<div class="main__cruise__drop">
							<div class="main__cruise__drop__title">
								<span class="main__cruise__drop__title__main">Выбрать акцию</span>
								<span class="main__cruise__drop__title__1"></span>
								<span class="main__cruise__drop__title__2"></span>
							</div>
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
								<span class="main__cruise__drop__title__close"></span>
								<span class="main__cruise__drop__title__change">Выбрать</span>
							</div>
						</div>
						<div class="main__cruise__drop">
							<div class="main__cruise__drop__title">
								<span class="main__cruise__drop__title__main">Тип круиза</span>
								<span class="main__cruise__drop__title__1"></span>
								<span class="main__cruise__drop__title__2"></span>
							</div>
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
								<span class="main__cruise__drop__title__close"></span>
								<span class="main__cruise__drop__title__change">Выбрать</span>
							</div>
						</div>
						<div class="main__cruise__drop">
							<div class="main__cruise__drop__title">
								<span class="main__cruise__drop__title__main">Регион плавания</span>
								<span class="main__cruise__drop__title__1"></span>
								<span class="main__cruise__drop__title__2"></span>
							</div>
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
								<span class="main__cruise__drop__title__close"></span>
								<span class="main__cruise__drop__title__change">Выбрать</span>
							</div>
						</div>
						<div class="main__cruise__date">
							<div class="main__cruise__date__title clock main__cruise__date__title-sidebar">Продолжительность ночей</div>
							<div class="main__cruise__input">
								<input type="number" class="sliderValue_7 minValue sliderValue__all" data-index="0" value="7" disabled="disabled">
								<span class="sliderValue__all__line"></span>
								<input type="number" class="sliderValue_7 maxValue sliderValue__all" data-index="1" value="30" disabled="disabled">
								<div id="slider_7" class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"><div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 0%; width: 100%;"></div><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 100%;"></span></div>
							</div>
						</div>
						<div class="main__cruise__date">
							<div class="main__cruise__date__title calendar main__cruise__date__title-sidebar">Даты круиза</div>
							<div class="main__cruise__input">
								<input type="date" class="main__cruise__date__start sliderValue__all" value="2018.07.07">
								<span class="sliderValue__all__line"></span>
								<input type="date" class="main__cruise__date__end sliderValue__all" value="2018.08.08">
							</div>
						</div>
						<div class="main__cruise__date">
							<div class="main__cruise__date__title ruble main__cruise__date__title-sidebar">Стоимость на человека в DBL руб.</div>
							<div class="main__cruise__input">
								<input type="number" class="sliderValue minValue sliderValue__all" data-index="0" value="40000" disabled="disabled">
								<span class="sliderValue__all__line"></span>
								<input type="number" class="sliderValue maxValue sliderValue__all" data-index="1" value="10000000" disabled="disabled">
								<div id="slider" class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"><div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 0%; width: 100%;"></div><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 100%;"></span></div>
							</div>
						</div>
						<div class="main__cruise__bottom">
							<button class="main__cruise__button main__cruise-podbor">Поиск</button>
							<a href="/search.php" class="main__cruise__button main__cruise-more">Расширеный поиск</a>
						</div> 
					</form>
				</div>
				<div class="sidebar__action">
					<h3>Популярные акции</h3>
					<div class="sidebar__action__slide">
						<ul class="otziv__main__slide otziv__main__slide--sidebar">
							<li class="sidebar__action__item" style="background-image: url(images/cart/cart.jpg)"></li>
							<li class="sidebar__action__item slick-slide" style="background-image: url(images/cart/cart.jpg);"></li>
							</ul>
						</div>
					</div>
				</div>
			<div class="page__content">
				<h1>Какой-то огромный заголовок h1 для новости, с кучей букв, большим названием и тому
				подобным.</h1>
				<div class="page__content__button form__result__button--mobile"></div>
				<div class="page__slider__wrap">
					<div class="page__slider">
						<div class="cart__slider__top--ship kruiz__company__slider__for">
							<div class="cart__slider__bottom__item">
								<img src="images/cart/slide-1.jpg" alt="">
							</div>
							<div class="cart__slider__bottom__item">
								<img src="images/cart/slide-1.jpg" alt="">
							</div>
							<div class="cart__slider__bottom__item">
								<img src="images/cart/slide-1.jpg" alt="">
							</div>
							<div class="cart__slider__bottom__item">
								<img src="images/cart/slide-1.jpg" alt="">
							</div>
						</div>
						<div class="cart__slider__bottom--ship kruiz__company__slider__nav">
							<div class="cart__slider__bottom__item">
								<img src="images/cart/slide-1.jpg" alt="">
							</div> 
							<div class="cart__slider__bottom__item">
								<img src="images/cart/slide-1.jpg" alt="">
							</div>
							<div class="cart__slider__bottom__item">
								<img src="images/cart/slide-1.jpg" alt="">
							</div>
							<div class="cart__slider__bottom__item">
								<img src="images/cart/slide-1.jpg" alt="">
							</div>
						</div>
					</div>
					<div class="page__slider__text">
						Какой-то текст
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
			<div class="scrollbar-vertical">
			<table>
				<caption>Таблица</caption>
				<tr>
					<th>День</th>
					<th>Дата</th>
					<th>Страна</th>
					<th>Экскурсии</th>
					<th>Событие</th>
					<th>Прибытие - отправление</th>
				</tr>
				<tr>
					<td>1</td>
					<td>01.02.2019</td>
					<td>США</td>
					<td>Форт-Лодердейл (Майами)	</td>
					<td>Какое-то событие, происходящее где-то и чтобы в 2 строчки.</td>
					<td>24:00</td>
				</tr>
				<tr>
					<td>2</td>
					<td>02.02.2019</td>
					<td>Багамские о-ва	</td>
					<td>Нассау, о. Нью-Провиденс</td>
					<td>Какое-то событие, происходящее где-то</td>
					<td>12:00 — 18:00</td>
				</tr>
			</table>
		</div>
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
			</div>
		</div>
		</div>
	</section>
	<?include('footer.php')?>
