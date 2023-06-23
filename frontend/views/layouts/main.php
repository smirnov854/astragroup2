<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\assets\Module;
use frontend\assets\JqueryAsset;
use common\widgets\Alert;

$arAutoJqControllers = [
    "search",
    "cruise"
];
if (!in_array(Yii::$app->controller->id, $arAutoJqControllers)) {
    //    print Yii::$app->controller->id;
    JqueryAsset::register($this);
}
AppAsset::register($this);



?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <!--link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,500,700,900&amp;subset=cyrillic-ext" rel="stylesheet"-->
    <?php $this->head() ?>
    <link rel="stylesheet" href="/upd/scss/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <link rel="stylesheet" href="/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/css/owl.theme.default.min.css">
    <?=Module::module("head", "cabin")?>
</head>

<body>
    <?php $this->beginBody() ?>
    <div class="overlay"></div>
    <header>
        <section class="header__top">
            <div class="wrap">
                <div class="header__top__list">
                    <div class="header__top__item header__top__burger">
                        <div class="burger__item"></div>
                        <div class="burger__item"></div>
                        <div class="burger__item"></div>
                    </div>
                    <a class="header__top__item header__top__logo" href="/">
                        <img src="/images/i_special/logo.svg" alt="Лого">
                    </a>
                    <div class="header__top__item header__phone__spb">
                        <div class="header__top__mobile">
                            <a href="tel:<?= preg_replace("/[^0-9]/", '', Yii::$app->options->header_spbphone); ?>" class="drop__phone">
                                <span><?= Yii::$app->options->header_spbphone ?></span>
                                <span class="header__top__mobile__drop"></span>
                            </a>
                            <ul class="phone__list">
                                <li class="phone__list__close form__close"></li>
                                <li>
                                    <a href="tel:<?= preg_replace("/[^0-9]/", '', Yii::$app->options->header_spbphone); ?>">
                                        <?= Yii::$app->options->header_spbphone ?>
                                    </a>
                                    <div class="header__address"><?= Yii::$app->options->header_spbaddr ?></div>
                                </li>
                                <!--li>
                                    <a href="tel:<?= preg_replace("/[^0-9]/", '', Yii::$app->options->header_mskphone); ?>">
                                        <?= Yii::$app->options->header_mskphone ?>
                                    </a>
                                    <div class="header__address"><?= Yii::$app->options->header_mskaddr ?></div>
                                </li-->
                                <li>
                                    <a href="tel:<?= preg_replace("/[^0-9]/", '', Yii::$app->options->header_800phone); ?>">
                                        <?= Yii::$app->options->header_800phone ?></a>
                                    <div class="header__address">Звонок для регионов бесплатный</div>
                                </li>
                            </ul>
                        </div>
                        <div class="header__address"><?= Yii::$app->options->header_spbaddr ?></div>
                    </div>
                    <!--div class="header__top__item header__phone__spb">
                        <a href="tel:<?= preg_replace("/[^0-9]/", '', Yii::$app->options->header_mskphone); ?>">
                            <?= Yii::$app->options->header_mskphone ?></a>
                        <div class="header__address"><?= Yii::$app->options->header_mskaddr ?></div>
                    </div-->
                    <div class="header__top__item header__phone__spb">
                        <a href="tel:<?= preg_replace("/[^0-9]/", '', Yii::$app->options->header_800phone); ?>">
                            <?= Yii::$app->options->header_800phone ?></a>
                        <div class="header__address">Звонок для регионов бесплатный</div>
                    </div>
                    <div class="header__top__item header__phone__spb header__phone__spb-address">
                        <div class="header__phone__work header__phone__work-mobile">
                            Режим работы <span class="header__top__mobile__drop header__top__mobile__drop-address footer__drop"></span>
                        </div>
                        <div class="header__address header__address__work">
                            <?= Yii::$app->options->header_time ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <? // =Yii::$app->request->pathInfo?>
        <section class="header__bottom clear">
            <div class="wrap">
                <div class="header__bottom__left">
                    <ul class="header__bottom__menu">
                        <li class="header__bottom__item">
                            <a href="/search/" class="header__bottom__link<?= (Yii::$app->request->pathInfo == "search/" ? " active" : "") ?>">Поиск
                                круизов</a>
                        </li>
                        <li class="header__bottom__item">
                            <a href="#" class="header__bottom__link header__bottom__link-drop block__hidden block__visible">Направления</a>
                            <ul class="header__bottom__drop__menu">
                                <li class="header__bottom__drop__item">
                                    <a href="/cruise/" class="header__bottom__drop__link<?= (Yii::$app->request->pathInfo == "cruise/" ? " active" : "") ?>">Морские
                                        круизы</a>
                                </li>
                                <li class="header__bottom__drop__item">
                                    <a href="/river/" class="header__bottom__drop__link<?= (Yii::$app->request->pathInfo == "river/" ? " active" : "") ?>">Реки
                                        России</a>
                                </li>
                                <!--li class="header__bottom__drop__item">
                                    <a href="/world-river/" class="header__bottom__drop__link<?= (Yii::$app->request->pathInfo == "world-river/" ? " active" : "") ?>">Реки Европы</a>
                                </li-->
                                <!--li class="header__bottom__drop__item">
                                    <a href="/paroms/" class="header__bottom__drop__link<?= (Yii::$app->request->pathInfo == "paroms/" ? " active" : "") ?>">Паромные
                                        туры</a>
                                </li-->
                                <!li class="header__bottom__drop__item">
				    <a href="/fraht/" class="header__bottom__drop__link<?= (Yii::$app->request->pathInfo == "fraht/" ? " active" : "") ?>">Фрахт теплоходов</a>
				</li>
                            </ul>
                        </li>
                        <!-- li class="header__bottom__item" >
                                <a href="/special/" class="header__bottom__link<?= (Yii::$app->request->pathInfo == "special/" ? " active" : "") ?>">Организация мероприятий</a>
                            </li -->
                    </ul>
                    <style>
                        .header__bottom__menu li.header__bottom__item li.header__bottom__drop__item:last-child::before {
                            display: none;
                        }
                    </style>
                </div>
                <div class="header__bottom__right">
                    <a href="/compare/" class="header__bottom__right__sr" style="display: none">
                        <div class="header__bottom__right__i__block header__bottom__right__i__block-sr"><span>1</span></div>
                        <div class="header__bottom__right__i__text">Сравнить</div>
                    </a>
                    <a href="/wishlist/" class="header__bottom__right__i">
                        <div class="header__bottom__right__i__block"><span id="countWishlist">?</span></div>
                        <div class="header__bottom__right__i__text">Избранное</div>
                    </a>
                    <a href="/admin/" class="header__bottom__right__log" style="display: none">
                        <div class="header__bottom__right__log__block"></div>
                        <div class="header__bottom__right__i__text">Войти</div>
                    </a>
                </div>
            </div>
        </section>
    </header>
    
    <?= $content ?>
    
    <footer>
        <div id="loading">
            <svg width="763.79" height="763.79" fill-rule="evenodd" image-rendering="optimizeQuality" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" viewBox="0 0 8487 8487" xmlns="http://www.w3.org/2000/svg">
                <path d="m4532 1379v229c516 56 987 260 1370 568l171-171c65-138 172-289 311-430 327-330 711-481 857-336s-1 530-328 860c-144 146-300 256-441 322l-162 162c308 384 512 855 568 1370h241c144-52 326-83 524-84 465-2 842 163 843 368 1 206-375 374-840 376-205 1-393-31-539-84h-229c-56 516-260 987-568 1370l171 171c138 65 289 172 430 311 330 327 481 711 336 857s-530-1-860-328c-146-144-256-300-322-441l-162-162c-384 308-855 512-1370 568v241c52 144 83 326 84 524 2 465-163 842-368 843-206 1-374-375-376-840-1-205 31-393 84-539v-229c-516-56-987-260-1370-568l-171 171c-65 138-172 289-311 430-327 330-711 481-857 336s1-530 328-860c144-146 300-256 441-322l162-162c-308-384-512-855-568-1370h-241c-144 52-326 83-524 84-465 2-842-163-843-368-1-206 375-374 840-376 205-1 393 31 539 84h229c56-516 260-987 568-1370l-171-171c-138-65-289-172-430-311-330-327-481-711-336-857s530 1 860 328c146 144 256 300 322 441l162 162c384-308 855-512 1370-568v-241c-52-144-83-326-84-524-2-465 163-842 368-843 206-1 374 375 376 840 1 205-31 393-84 539zm-289 359c1384 0 2506 1122 2506 2506s-1122 2506-2506 2506-2506-1122-2506-2506 1122-2506 2506-2506zm0 94c1332 0 2412 1080 2412 2412s-1080 2412-2412 2412-2412-1080-2412-2412 1080-2412 2412-2412zm289 543v903c67 20 131 46 191 79l638-638c-240-176-522-297-829-344zm1237 752-638 638c33 60 59 124 79 191h903c-47-307-168-589-344-829zm344 1406h-903c-20 67-46 131-79 191l638 638c176-240 297-522 344-829zm-752 1237-638-638c-60 33-124 59-191 79v903c307-47 589-168 829-344zm-1406 344v-903c-67-20-131-46-191-79l-638 638c240 176 522 297 829 344zm-1237-752 638-638c-33-60-59-124-79-191h-903c47 307 168 589 344 829zm-344-1406h903c20-67 46-131 79-191l-638-638c-176 240-297 522-344 829zm752-1237 638 638c60-33 124-59 191-79v-903c-307 47-589 168-829 344zm1117 760c423 0 766 343 766 766s-343 766-766 766-766-343-766-766 343-766 766-766zm0 115c360 0 652 292 652 652s-292 652-652 652-652-292-652-652 292-652 652-652z" />
            </svg>
        </div>
        <div class="footer__form clear">
            <script type="text/javascript">
                var PS_ErrPref = 'Поля не заполнены или заполнены неверно: \n';
            </script>
            <script type="text/javascript" src="https://sendsay.ru/account/js/formCheck.js?20170516"></script>
            <div class="subpro_forma wrap">
                <form id="sendsay_form" name="form_226" action="https://sendsay.ru/form/astarta/1" method="post" onsubmit="javascript:if(typeof sendsay_check_form === 'function'){ if($('#q257_0').is(':checked')) {return sendsay_check_form(this);} else {$('#dialog-errorAgree').dialog({autoOpen: true,modal: true});return false;} }" accept-charset="utf-8">
                    <div class="footer__form__title">
                        Подпишись на рассылку и получайте лучшие спецпредложения круизных компаний каждую неделю<br>
                        <input id="q257_0" type="checkbox" value="1" name="q257" data-group="q257" data-type="nm" class="pro_mustbe" /><label for="q257_0" style="font-size: 11px">Даю согласие на обработку моих персональных
                            данных в соответствии с 152-ФЗ &quot;О персональных данных&quot; и хочу получать новости
                            на указанный e-mail</label>
                    </div>
                    <div class="footer__form__wrap">
                        <div id="_member_email" class="subpro_clear sendsayFieldItem" style="padding-top:5px; padding-bottom:10px;">
                            <div class="subpro_right">
                                <input type="text" class="footer__form__input subpro_input pro_mustbe" style="padding-left:3px;" data-type="email" name="_member_email" value="" size="" placeholder="Email...">
                                <input class="subpro_btn footer__form__button" type="submit" name="bt_save" value="Подписаться" />
                            </div>
                        </div>
                    </div>
                    <!-- form action="" class="footer__form__wrap">
                            <input type="text" class="footer__form__input">
                            <input type="submit" class="footer__form__button" value="Подписаться">
                        </form -->
                </form>
            </div>
        </div>
        <div class="footer__center">
            <div class="wrap footer__list">
                <a class="header__top__item footer__top__logo" href="/">
                    <img src="/images/i_special/logo.svg" alt="Лого">
                </a>
                <div class="header__top__item header__phone__spb">
                    <div class="header__top__mobile header__top__mobile-footer">
                        <a href="tel:<?= preg_replace("/[^0-9]/", '', Yii::$app->options->header_spbphone); ?>" class="drop__phone">
                            <?= Yii::$app->options->header_spbphone ?><span class="header__top__mobile__drop"></span></a>
                        <ul class="phone__list">
                            <li>
                                <a href="tel:<?= preg_replace("/[^0-9]/", '', Yii::$app->options->header_spbphone); ?>">
                                    <?= Yii::$app->options->header_spbphone ?></a>
                                <div class="header__address"><?= Yii::$app->options->header_spbaddr ?></div>
                            </li>
                            <!--li>
                                <a href="tel:<?= preg_replace("/[^0-9]/", '', Yii::$app->options->header_mskphone); ?>">
                                    <?= Yii::$app->options->header_mskphone ?></a>
                                <div class="header__address"><?= Yii::$app->options->header_mskaddr ?></div>
                            </li-->
                            <li>
                                <a href="tel:<?= preg_replace("/[^0-9]/", '', Yii::$app->options->header_800phone); ?>">
                                    <?= Yii::$app->options->header_800phone ?></a>
                                <div class="header__address">Звонок для регионов бесплатный</div>
                            </li>
                        </ul>
                    </div>
                    <div class="header__address footer__address"><?= Yii::$app->options->header_spbaddr ?></div>
                </div>
                <!--div class="header__top__item header__phone__spb">
                    <a href="tel:<?= preg_replace("/[^0-9]/", '', Yii::$app->options->header_mskphone); ?>">
                        <?= Yii::$app->options->header_mskphone ?></a>
                    <div class="header__address"><?= Yii::$app->options->header_mskaddr ?></div>
                </div-->
                <div class="header__top__item header__phone__spb">
                    <a href="tel:<?= preg_replace("/[^0-9]/", '', Yii::$app->options->header_800phone); ?>">
                        <?= Yii::$app->options->header_800phone ?></a>
                    <div class="header__address">Звонок для регионов бесплатный</div>
                </div>
                <div class="header__top__item footer__phone__spb footer__phone__spb-address">
                    <div class="header__phone__work">Режим работы<span class="header__top__mobile__drop header__top__mobile__drop-address footer__drop"></span></div>
                    <div class="header__address footer__address__work">
                        <?= Yii::$app->options->header_time ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__bottom clear">
            <div class="wrap">
                <div class="footer__button">
                    <div class="footer__button__wrap" style="opacity: 0">Форма экстренной связи</div>
                </div>
                <div class="copyriaght">
                    © «Астарта Групп», 2009-<?= date("Y") ?>
                </div>
                <ul class="footer__nav">
                    <li class="footer__nav__item">
                        <a href="/about/" class="footer__nav__link">О компании</a>
                    </li>
                    <li class="footer__nav__item">
                        <a href="/agentam/" class="footer__nav__link">Агентствам</a>
                    </li>
                    <li class="footer__nav__item">
                        <a href="/contacts/" class="footer__nav__link">Контакты</a>
                    </li>
                </ul>
                <div class="footer__faq">
                    faq
                </div>
                <div class="footer__social" style="display: none">
                    <a href="" class="social__item instagramm"></a>
                    <a href="" class="social__item vk"></a>
                    <a href="" class="social__item f"></a>
                </div>
                <div class="copyriaght">Справочно-информационный сайт, не является рекламой и офертой</div>
            </div>
        </div>
    </footer>
    <div class="mobile__menu">
        <div class="mobile__menu__top">
            <div class="mobile__menu__close"></div>
            <a href="/compare" class="mobile__menu__top__link" style="display: none">
                <div class="header__bottom__right__i__block header__bottom__right__i__block-sr"><span>1</span></div>
                <div class="header__bottom__right__i__text">Сравнить</div>
            </a>
            <a href="/favourites" class="mobile__menu__top__link" style="display: none">
                <div class="header__bottom__right__i__block"><span>2</span></div>
                <div class="header__bottom__right__i__text">Избранное</div>
            </a>
            <a href="/admin" class="mobile__menu__top__link" style="display: none">
                <div class="header__bottom__right__log__block"></div>
                <div class="header__bottom__right__i__text">Войти</div>
            </a>
        </div>
        <ul class="mobile__menu__nav">
            <li class="mobile__menu__nav__item">
                <a href="/search/" class="mobile__menu__nav__link">Поиск круизов</a>
            </li>
            <li class="mobile__menu__nav__item">
                <a href="/cruise/" class="mobile__menu__nav__link">Морские круизы</a>
            </li>
            <li class="mobile__menu__nav__item">
                <a href="/river/" class="mobile__menu__nav__link">Реки России </a>
            </li>
            <li class="mobile__menu__nav__item">
                <a href="/world-river/" class="mobile__menu__nav__link">Реки Европы </a>
            </li>
            <!--
            <li class="mobile__menu__nav__item">
                <a href="/paroms/" class="mobile__menu__nav__link">Паромные туры</a>
            </li>
            -->
            <!--
            <li class="mobile__menu__nav__item">
                <a href="/special/" class="mobile__menu__nav__link">Организация мероприятий</a>
            </li>
            -->
            <li class="mobile__menu__nav__item">
                <a href="/fraht/" class="mobile__menu__nav__link">Фрахт теплоходов</a>
            </li>
        </ul>
        <ul class="mobile__menu__contacts">
            <li class="mobile__menu__contacts__item">
                <a href="tel:<?= preg_replace("/[^0-9]/", '', Yii::$app->options->header_spbphone); ?>">
                    <?= Yii::$app->options->header_spbphone ?></a>
                <div class="mobile__menu__address"><?= Yii::$app->options->header_spbaddr ?></div>
            </li>
            <!--li class="mobile__menu__contacts__item">
                <a href="tel:<?= preg_replace("/[^0-9]/", '', Yii::$app->options->header_mskphone); ?>">
                    <?= Yii::$app->options->header_mskphone ?></a>
                <div class="mobile__menu__addresss"><?= Yii::$app->options->header_mskaddr ?></div>
            </li-->
            <li class="mobile__menu__contacts__item">
                <a href="tel:<?= preg_replace("/[^0-9]/", '', Yii::$app->options->header_800phone); ?>">
                    <?= Yii::$app->options->header_800phone ?></a>
                <div class="mobile__menu__addresss">Звонок для регионов бесплатный</div>
            </li>
            <li class="mobile__menu__contacts__item">
                <a href="#" class="work">Режим работы</a>
                <div class="mobile__menu__addresss"><?= Yii::$app->options->header_time ?></div>
            </li>
        </ul>
    </div>
    <div class="form contact-form">
        <div class="form__title">Форма для экстренной связи</div>
        <div class="form__close contact-form__close"></div>
        <form action="">
            <div class="form__input">
                <input type="text" placeholder="Имя и Фамилия">
            </div>
            <div class="form__input">
                <input type="tel" placeholder="+7 (___) ___-__-__">
            </div>
            <div class="form__textarea">
                <textarea name="" id="" cols="30" rows="10" placeholder="Коментарий..."></textarea>
            </div>
            <div class="form__button button__fill">
                <input type="submit">
                <span class="button__fill__rest"></span>
            </div>
        </form>
    </div>
    <div class="form login-form">
        <div class="form__title">Авторизация</div>
        <div class="form__close login-form__close"></div>
        <form action="">
            <div class="form__input">
                <input type="text" placeholder="Имя и Фамилия">
            </div>
            <div class="form__input">
                <input type="text" placeholder="Пароль">
            </div>
            <div class="form__button button__fill">
                <input type="submit" value="Войти">
                <span class="button__fill__rest"></span>
            </div>
        </form>
        <div class="login-form__bottom">
            <div class="login-form__bottom__mes">Забыли пароль?</div>
            <div class="login-form__wrap">
                <div class="form__title">Восстановление пароля</div>
                <div class="form__close login-form__close"></div>
                <form action="">
                    <div class="form__input">
                        <input type="email" placeholder="Напишите Вашу почту">
                    </div>
                    <div class="form__button button__fill">
                        <input type="submit" value="Отправить">
                        <span class="button__fill__rest"></span>
                    </div>
                </form>
            </div>
            <div class="login-form__bottom__reg">Регистрация</div>
        </div>
    </div>
    <div class="form otziv-form">
        <div class="form__title">Форма для отзыва</div>
        <div class="form__close otziv-form__close"></div>
        <form action="">
            <div class="otziv-form__wrap">
                <div class="otziv-form__left">
                    <div class="otziv-form__title">Основная информация</div>
                    <div class="form__input">
                        <input type="text" placeholder="Направление">
                    </div>
                    <div class="form__input">
                        <input type="text" placeholder="Имя и Фамилия">
                    </div>
                    <div class="form__file">
                        <span class="form__file__wrap">Добавить фотографии
                            <input class="files" type="file" name="eskiz" id="change" multiple="">
                            <input type="text" id="filename" class="filename" disabled="" placeholder="">
                        </span>
                    </div>
                </div>
                <div class="otziv-form__right">
                    <div class="otziv-form__title">Оценка качества</div>
                    <div class="otziv-form__star__wrap">
                        <div class="otziv-form__star">
                            <div class="otziv-form__star__title">Обслуживание на борту</div>
                            <div class="otziv-form__input__wrap">
                                <label class="otziv-form__input">
                                    <input type="checkbox">
                                    <span class="star"></span>
                                </label>
                                <label class="otziv-form__input">
                                    <input type="checkbox">
                                    <span class="star"></span>
                                </label>
                                <label class="otziv-form__input">
                                    <input type="checkbox">
                                    <span class="star"></span>
                                </label>
                                <label class="otziv-form__input">
                                    <input type="checkbox">
                                    <span class="star"></span>
                                </label>
                                <label class="otziv-form__input">
                                    <input type="checkbox">
                                    <span class="star"></span>
                                </label>
                            </div>
                        </div>
                        <div class="otziv-form__star">
                            <div class="otziv-form__star__title">Развлекательные программы</div>
                            <div class="otziv-form__input__wrap">
                                <label class="otziv-form__input">
                                    <input type="checkbox">
                                    <span class="star"></span>
                                </label>
                                <label class="otziv-form__input">
                                    <input type="checkbox">
                                    <span class="star"></span>
                                </label>
                                <label class="otziv-form__input">
                                    <input type="checkbox">
                                    <span class="star"></span>
                                </label>
                                <label class="otziv-form__input">
                                    <input type="checkbox">
                                    <span class="star"></span>
                                </label>
                                <label class="otziv-form__input">
                                    <input type="checkbox">
                                    <span class="star"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="otziv-form__star__wrap">
                        <div class="otziv-form__star">
                            <div class="otziv-form__star__title">Лайнер</div>
                            <div class="otziv-form__input__wrap">
                                <label class="otziv-form__input">
                                    <input type="checkbox">
                                    <span class="star"></span>
                                </label>
                                <label class="otziv-form__input">
                                    <input type="checkbox">
                                    <span class="star"></span>
                                </label>
                                <label class="otziv-form__input">
                                    <input type="checkbox">
                                    <span class="star"></span>
                                </label>
                                <label class="otziv-form__input">
                                    <input type="checkbox">
                                    <span class="star"></span>
                                </label>
                                <label class="otziv-form__input">
                                    <input type="checkbox">
                                    <span class="star"></span>
                                </label>
                            </div>
                        </div>
                        <div class="otziv-form__star">
                            <div class="otziv-form__star__title">Питание</div>
                            <div class="otziv-form__input__wrap">
                                <label class="otziv-form__input">
                                    <input type="checkbox">
                                    <span class="star"></span>
                                </label>
                                <label class="otziv-form__input">
                                    <input type="checkbox">
                                    <span class="star"></span>
                                </label>
                                <label class="otziv-form__input">
                                    <input type="checkbox">
                                    <span class="star"></span>
                                </label>
                                <label class="otziv-form__input">
                                    <input type="checkbox">
                                    <span class="star"></span>
                                </label>
                                <label class="otziv-form__input">
                                    <input type="checkbox">
                                    <span class="star"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="otziv-form__star__wrap">
                        <div class="otziv-form__star">
                            <div class="otziv-form__star__title">Работа офиса</div>
                            <div class="otziv-form__input__wrap">
                                <label class="otziv-form__input">
                                    <input type="checkbox">
                                    <span class="star"></span>
                                </label>
                                <label class="otziv-form__input">
                                    <input type="checkbox">
                                    <span class="star"></span>
                                </label>
                                <label class="otziv-form__input">
                                    <input type="checkbox">
                                    <span class="star"></span>
                                </label>
                                <label class="otziv-form__input">
                                    <input type="checkbox">
                                    <span class="star"></span>
                                </label>
                                <label class="otziv-form__input">
                                    <input type="checkbox">
                                    <span class="star"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="otziv-form__bottom">
                <div class="otziv-form__title">Подробное описание</div>
                <div class="form__textarea otziv-form__textarea">
                    <textarea name="" id="" cols="30" rows="10" placeholder="Напишите подробный отзыв..."></textarea>
                </div>
            </div>
            <div class="button otziv__button">
                <input type="submit" value="Добавить отзыв">
            </div>
        </form>
    </div>
    <div class="form otziv__fade">
        <div>
            <div class="form__close otziv__fade__close"></div>
            <div class="form__title form__title--big">Северная Европа,Скандинавия ,Западная Европа</div>
            <div class="otziv__fade__star">
                <div class="otziv__fade__star__num">
                    <div class="otziv__fade__star__num__text">4</div>
                    <span>Хорошо</span>
                </div>
                <div class="otziv-fade__top__star">
                    <div class="form__title">Оценка качества</div>
                    <div class="otziv-form__top__star__block">
                        <div class="otziv-form__top__star_item">
                            <div class="otziv-form__top__star__wrap">
                                <div class="otziv-form__top__star__title">Обслуживание на борту</div>
                                <ul class="star__wrap__liner">
                                    <li class="star__item"><img src="images/new/star-y.svg" alt=""></li>
                                    <li class="star__item"><img src="images/new/star-y.svg" alt=""></li>
                                    <li class="star__item"><img src="images/new/star-y.svg" alt=""></li>
                                    <li class="star__item"><img src="images/new/star-y.svg" alt=""></li>
                                    <li class="star__item"><img src="images/lainer/Star.svg" alt=""></li>
                                </ul>
                            </div>
                            <div class="otziv-form__top__star__wrap">
                                <div class="otziv-form__top__star__title">Лайнер</div>
                                <ul class="star__wrap__liner">
                                    <li class="star__item"><img src="images/new/star-y.svg" alt=""></li>
                                    <li class="star__item"><img src="images/new/star-y.svg" alt=""></li>
                                    <li class="star__item"><img src="images/new/star-y.svg" alt=""></li>
                                    <li class="star__item"><img src="images/new/star-y.svg" alt=""></li>
                                    <li class="star__item"><img src="images/lainer/Star.svg" alt=""></li>
                                </ul>
                            </div>
                            <div class="otziv-form__top__star__wrap">
                                <div class="otziv-form__top__star__title">Обслуживание на борту</div>
                                <ul class="star__wrap__liner">
                                    <li class="star__item"><img src="images/new/star-y.svg" alt=""></li>
                                    <li class="star__item"><img src="images/new/star-y.svg" alt=""></li>
                                    <li class="star__item"><img src="images/new/star-y.svg" alt=""></li>
                                    <li class="star__item"><img src="images/new/star-y.svg" alt=""></li>
                                    <li class="star__item"><img src="images/lainer/Star.svg" alt=""></li>
                                </ul>
                            </div>
                        </div>
                        <div class="otziv-form__top__star_item">
                            <div class="otziv-form__top__star__wrap">
                                <div class="otziv-form__top__star__title">Развлекательные программы</div>
                                <ul class="star__wrap__liner">
                                    <li class="star__item"><img src="images/new/star-y.svg" alt=""></li>
                                    <li class="star__item"><img src="images/new/star-y.svg" alt=""></li>
                                    <li class="star__item"><img src="images/new/star-y.svg" alt=""></li>
                                    <li class="star__item"><img src="images/new/star-y.svg" alt=""></li>
                                    <li class="star__item"><img src="images/lainer/Star.svg" alt=""></li>
                                </ul>
                            </div>
                            <div class="otziv-form__top__star__wrap">
                                <div class="otziv-form__top__star__title">Питание</div>
                                <ul class="star__wrap__liner">
                                    <li class="star__item"><img src="images/new/star-y.svg" alt=""></li>
                                    <li class="star__item"><img src="images/new/star-y.svg" alt=""></li>
                                    <li class="star__item"><img src="images/new/star-y.svg" alt=""></li>
                                    <li class="star__item"><img src="images/new/star-y.svg" alt=""></li>
                                    <li class="star__item"><img src="images/lainer/Star.svg" alt=""></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="otziv__fade__right">
                    <div class="otziv__fade__right__item">Название компании</div>
                    <div class="otziv__fade__right__item">Название региона плавания</div>
                    <div class="otziv__fade__right__item">Порт отправления</div>
                    <div class="otziv__fade__right__item">Порт прибытия</div>
                </div>
            </div>
            <div class="otziv__fade__bottom">
                <div class="otziv__fade__bottom__text">
                    <div class="otziv__fade__name">Имя Фамилия</div>
                    <div class="otziv__fade__text"></div>
                    <div class="otziv__fade__img block__flex">
                        <div class="otziv__fade__img__wrap" style="background-image: url(images/251d2b42e31a5f104383829d8130cb9e-2-min.jpg);"></div>
                        <div class="otziv__fade__img__wrap" style="background-image: url(images/251d2b42e31a5f104383829d8130cb9e-min.jpg);"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="modal text-center" id="orderSuccess" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title text-center">Заявка на круиз отправлена.</h2>
                </div>
                <div class="modal-body text-center">
                    <p>Мы свяжемся с вами в ближайшее время.</p>
                </div>
                <div class="modal-footer" style="text-align: center;">
                    <!-- <a href="/app" class="btn btn-lahta-gradient btn-md"></a> -->
                    <a href="#close-modal" class="btn btn-secondary" rel="modal:close" class="close-modal ">Закрыть</a>
                </div>
            </div>
        </div>
    </div>

    <div id="dialog-errorAgree" style="display: none; text-align: center;">
        <p><b>Персональные данные.</b></p>

        <p>Требуется согласие на обработку персональных данных в соответствии с 152-ФЗ "О персональных данных"</p>
    </div>

    <?php $this->endBody() ?>


    <!-- Include metrics, counters and chat -->
    <?php  include "./counters.html" ?>
        
    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <style>
        .blocker {
            z-index: 999;
        }
    </style>
    <script src="/js/owl.carousel.min.js"></script>
    <script src="/upd/js/script.js?v2"></script>
</body>

</html>
<?php $this->endPage() ?>