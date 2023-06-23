<?include('header.php')?>
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
							<div id="slider_7"></div>
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
						<div class="main__cruise__date__title ruble main__cruise__date__title-sidebar">Стоимость на человека в DBL руб.</div>
						<div class="main__cruise__input">
							<input type="number" class="sliderValue minValue sliderValue__all" data-index="0" value="40000" disabled="disabled">
							<span class="sliderValue__all__line"></span>
							<input type="number" class="sliderValue maxValue sliderValue__all" data-index="1" value="10000000" disabled="disabled">
							<div id="slider"></div>
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
						<li class="sidebar__action__item" style="background-image: url(images/cart/cart.jpg);"></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="search__result">
			<ul class="action__page__list">
				<li class="action__page__item">
					<a href="" class="action__page__item__link">
					<div class="action__page__img" style="background-image: url(images/cart/cart.jpg)"></div>
					<div class="action__page__text">
						<div class="action__page__title">Акция “Охота за круизом” от MSC Cruises - новые маршруты и скидки</div>
						<div class="action__page__descr">Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют</div>
						<div class="action__page__date">
							07.12.2018 - 08.01.2019
						</div>
					</div>
				</a>
				</li>
				<li class="action__page__item">
					<a href="" class="action__page__item__link">
						<div class="action__page__img" style="background-image: url(images/cart/cart.jpg)"></div>
						<div class="action__page__text">
							<div class="action__page__title">Акция “Охота за круизом” от MSC Cruises - новые маршруты и скидки</div>
							<div class="action__page__descr">Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют</div>
							<div class="action__page__date">
								07.12.2018 - 08.01.2019
							</div>
						</div>
					</a>
				</li>
				<li class="action__page__item">
					<a href="" class="action__page__item__link">
						<div class="action__page__img" style="background-image: url(images/cart/cart.jpg)"></div>
						<div class="action__page__text">
							<div class="action__page__title">Акция “Охота за круизом” от MSC Cruises - новые маршруты и скидки</div>
							<div class="action__page__descr">Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют</div>
							<div class="action__page__date">
								07.12.2018 - 08.01.2019
							</div>
						</div>
					</a>
				</li>
				<li class="action__page__item">
					<a href="" class="action__page__item__link">
						<div class="action__page__img" style="background-image: url(images/cart/cart.jpg)"></div>
						<div class="action__page__text">
							<div class="action__page__title">Акция “Охота за круизом” от MSC Cruises - новые маршруты и скидки</div>
							<div class="action__page__descr">Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют</div>
							<div class="action__page__date">
								07.12.2018 - 08.01.2019
							</div>
						</div>
					</a>
				</li>
				<li class="action__page__item">
					<a href="" class="action__page__item__link">
						<div class="action__page__img" style="background-image: url(images/cart/cart.jpg)"></div>
						<div class="action__page__text">
							<div class="action__page__title">Акция “Охота за круизом” от MSC Cruises - новые маршруты и скидки</div>
							<div class="action__page__descr">Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют</div>
							<div class="action__page__date">
								07.12.2018 - 08.01.2019
							</div>
						</div>
					</a>
				</li>
				<li class="action__page__item">
					<a href="" class="action__page__item__link">
						<div class="action__page__img" style="background-image: url(images/cart/cart.jpg)"></div>
						<div class="action__page__text">
							<div class="action__page__title">Акция “Охота за круизом” от MSC Cruises - новые маршруты и скидки</div>
							<div class="action__page__descr">Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют</div>
							<div class="action__page__date">
								07.12.2018 - 08.01.2019
							</div>
						</div>
					</a>
				</li>
			</ul>
			<div class="pagination">
				<div class="pagination__sep pagination__sep--left"><svg width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M8.34351 1.65649L2 8L8.3435 14.3435" stroke="#323232" stroke-width="2"/>
				</svg>
				<svg width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M8.34351 1.65649L2 8L8.3435 14.3435" stroke="#323232" stroke-width="2"/>
				</svg>

			</div>
				<ul class="pagination__list">
					<li class="pagination__list__item">1</li>
					<li class="pagination__list__item"><a href="">2</a></li>
					<li class="pagination__list__item"><a href="">3</a></li>
					<li class="pagination__list__item"><a href="">4</a></li>
					<li class="pagination__list__item"><span>...</span></li>
					<li class="pagination__list__item"><a href="">5</a></li>
				</ul>
				<div class="pagination__sep pagination__sep--right"><svg width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1.34351 1.65649L7.68701 8L1.34351 14.3435" stroke="#323232" stroke-width="2"/>
				</svg>
				<svg width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1.34351 1.65649L7.68701 8L1.34351 14.3435" stroke="#323232" stroke-width="2"/>
				</svg></div>
			</div>
		</div>
	</div>
</section>

<?include('footer.php')?>