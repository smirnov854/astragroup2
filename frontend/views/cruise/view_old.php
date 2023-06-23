<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\widgets\ListView;
use bigpaulie\social\share\Share;
use yii\bootstrap\ActiveForm;
use \mirocow\yandexmaps\objects\Placemark;
use frontend\assets\Module;


$obShip = @$model->ship->image;
// $logoSrc = '/i_logo/Logo_Company_Infoflot.png';

$this->title = $model->title;
$this->registerMetaTag(['name' => 'description', 'content' => 'Круизы от Астарта Групп ' . $model->title]);

//echo gettype($listCabinGroup);

?>

<style>
    .ui-helper-hidden-accessible {
        display: none;
    }
</style>
<script>
    var cruise = {
        id: <?= $model->ID ?>,
        title: "<?= $model->title ?>",
        itinerary: "<?= $model->itinerary ?>",
        min_price: "<?= number_format($model->min_price, 0, '.', ' ') ?> <?= isset($model->symbol) ? $model->symbol : 'Р' ?>",
        image: "<?= @$obShip->src ? ($obShip->src) : "/i_ships/no-ship.png" ?>",
        company: "<a target='_blank' href='/company/<?= $companyModel->ID ?>/'><?= $companyModel->name ?></a>",
        ship: "<a target='_blank' href='/ship/<?= $model->ship->ID ?>/'><?= $model->ship->name ?></a>",
        listCabin: <?=json_encode($listCabin)?>,
        listCabinGroup: <?=json_encode($listCabinGroup)?>,
        listCabinTariff: <?=json_encode($listCabinTariff)?>,
        listCabinLoc: <?=json_encode($listCabinLoc)?>,
        listCabinPrice: <?=json_encode($listCabinPrice)?>,
        listCabinDiscount: <?=json_encode(array_values($listDiscount))?>,
        course: <?= $course ?>,
        cost_multiplier: <?= $cost_multiplier ?>,
        currency: "<?= $currency ?>",
        userInfo: <?=json_encode($useful_info) ?>
    }
</script>

<section class="breadcrumbs">
    <?= Breadcrumbs::widget([
        'tag' => 'ul',
        'options' => [
            'class' => 'wrap breadcrumbs__list'
        ],
        'itemTemplate' => "
			<li class=\"breadcrumbs__item\">{link}
			<span class=\"breadcrumbs__sep\"><img  src='/images/arrow-count.svg'></span>
			</li>
		",
        'activeItemTemplate' => "<li class=\"breadcrumbs__item\">{link}</li>",
        'homeLink' => [
            'label' => 'Главная',
            'url' => '/',
            'class' => 'breadcrumbs__link',
        ],
        'links' => @$this->params['breadcrumbs']
    ]) ?>
</section>

<section class="page">
    <div class="wrap clear">

        <h1 class="h1__small"><?= $model->title ?></h1>
        <?
        if ($model->fullItinerary !== $model->itinerary) { ?>
            <h2 class="h2__page tooltip" title="<?= $model->fullItinerary ?>"><?= $model->itinerary ?></h2>
        <? } else { ?>
            <h2 class="h2__page"><?= $model->itinerary ?></h2>
        <? }
        ?>

        <div class="alert alert-success alert-dismissable" style="display: none;">
            тест успех
        </div>
        <div class="alert alert-danger alert-dismissable" style="display: none;">
            тест ошибки
        </div>
        <?php if (Yii::$app->session->hasFlash('success')) : ?>
            <div class="alert alert-success alert-dismissable hidden">
                <?= Yii::$app->session->getFlash('success') ?>
            </div>
        <?php endif; ?>
        <?php if (Yii::$app->session->hasFlash('error')) : ?>
            <div class="alert alert-danger alert-dismissable hidden">
                <?= Yii::$app->session->getFlash('error') ?>
            </div>
        <?php endif; ?>
        <div class="cart__top__wrap block__flex">
            <div class="card__left">
                <div class="card__left__photo card__left__photo__text"
                     style="background-image: url('<?= @$obShip->src ? ($obShip->src) : "/i_ships/no-ship.png" ?>');">
                    <? if ($companyImage != null && $companyModel->company_type_id == 1) { ?>
                        <a class="card__left__photo__logo tooltip"
                           title='Круизная компания "<?= $companyModel->name ?>"' target="_blank"
                           href="http://loc.astartagroup.ru/company/<?= $companyModel->ID ?>"
                           style="background-image: url(<?= $companyImage ?>);"></a>
                    <? } ?>
                    <? if ($model->sale_text) { ?>
                        <div class="card__left__photo__sale">
                            <div class="card__left__photo__sale__num">
                                <?= $model->sale_text ?>
                            </div>
                        </div>
                    <? } ?>
                    <!--                    <a class="card__left__photo__znak tooltip" href="/cruise/" title="Морской круиз"-->
                    <!--                       style="background-image: url(/images/ship.svg);"></a>-->
                </div>

                <div class="card__left__botttom  block__flex" style="display: none">
                    <div class="card__right__text">
                        <? if (@$model->ship->name) { ?>
                            <div class="card__right__item card__right__title"><?= $model->ship->name ?></div>
                        <? } ?>
                        <? if (@$model->region->name) { ?>
                            <div class="card__right__item card__right__side"><?= $model->region->name ?></div>
                        <? } ?>
                        <? if (@$model->country->name) { ?>
                            <div class="card__right__item card__right__counrty"><?= $model->country->name ?></div>
                        <? } ?>
                        <? if (count($model->tags)) { ?>
                            <div class="card__right__item card__right__history"><?= @$model->tegText ?></div>
                        <? } ?>
                        <? if (@$model->actions) { ?>
                            <div class="card__right__sale"><?= $model->actions ?></div>
                        <? } ?>
                    </div>
                </div>
            </div>
            <div class="card__right">
                <div class="card__right__top block__flex">
                    <a href="#" class="card__right__top__link" onclick="javascript:addWishlist(cruise)">Избранный</a>
                    <a href="#" class="card__right__top__link" onclick="javascript:modals('share')">Поделиться</a>
                    <? Share::widget([
                        'type' => 'small',
                        'include' => ['vk', 'facebook', 'twitter', 'odnoklassniki', 'whatsapp'],
                        //                            'exclude' => ['google-plus']
                    ]); ?>
                    <a href="#" class="card__right__top__link" onclick="javascript:modals('cost')">Похожие круизы</a>
                    <a href="#" class="card__right__top__link" onclick="$('.tabs__item.swiper-slide.reviews').click();"
                       style="display: none;">Отзывы</a>
                    <a href="#" class="card__right__top__link" onclick="javascript:downloadAsPdf()">Скачать pdf</a>
                </div>
                <style>
                    @media only screen and (max-width: 767px) {
                        .d-sm-none {
                            display: none;
                        }
                    }
                </style>
                <form action="" class="d-sm-none">
                    <div>
                        <div style="display: none">стоимость на человека при двухместном размещении
                            <?
                            if ($model->min_price) {
                                ?>: от <?= $model->price_rub / 2 ?><strike>P</strike>
                                <?
                            }
                            ?>
                            <br>
                            <br>
                        </div>
                        <div class="card__right__bottom block__flex" style="display: none">
                            <div class="cart__select block__flex">
                                <div class="cart__label">Взрослые</div>
                                <div class="custom-select">
                                    <select>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                        <option value="">3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="cart__select block__flex">
                                <div class="cart__label">Дети 0-12 лет <span>Бесплатно</span></div>
                                <div class="custom-select">
                                    <select>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                        <option value="">3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="cart__select block__flex">
                                <div class="cart__label">Дети 13-18 лет</div>
                                <div class="custom-select">
                                    <select>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                        <option value="">3</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card__right__tur block__flex" style="margin-top: 20px;">
                            <? foreach ($listLoc as $loc): ?>
                                <a href="#" style="color: #8f1416;" onclick="document.location.href='#loc-<?= $loc['Cabin_Loc_ID'] ?>'"
                                   class="card__right__tur__item cart-2 block__flex">
                                    <div class="card__right__tur__item__wrap block__flex">
                                        <div class="card__right__tur__item__img"
                                             style="background-image: url(<?= $loc['Image_Cabin_Group'] ? $loc['Image_Cabin_Group'] : '/apps/cabin/img/noimage.af01d7d3.jpg' ?>)"></div>
                                        <div class="card__right__tur__item__text">
                                            <div class="card__right__tur__item__title" style="overflow: auto;">
                                                <?= $loc['Name_Cabin_Loc'] ?>
                                            </div>
                                            <div>
                                                от <?= $loc['value'] . ' ' . $loc['currency'] ?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            <? endforeach; ?>
                        </div>

                </form>

                <div class="card__right__grafic" style="display: none">
                    <div class="card__right__grafic__top block__flex">
                        <ul class="card__right__grafic__price">
                            <li class="card__right__grafic__price__item">
                                60430 &#8381;
                            </li>
                            <li class="card__right__grafic__price__item">
                                60530 &#8381;
                            </li>
                        </ul>
                        <div class="card__right__grafic__dinamic scrollbar-inner">
                            <div class="scrollbar-vertical__wrap">
                                <div class="card__right__grafic__dinamic__pole">
                                    <div class="card__right__grafic__dinamic__pole__item"></div>
                                    <div class="card__right__grafic__dinamic__pole__item"></div>
                                    <div class="card__right__grafic__dinamic__pole__item"></div>
                                    <div class="card__right__grafic__dinamic__pole__item"></div>
                                </div>
                                <ul class="card__right__grafic__dinamic__date">
                                    <li class="card__right__grafic__dinamic__item h-1 active">
                                        <div class="card__right__grafic__dinamic__h"></div>
                                        <div class="card__right__grafic__dinamic__d">1</div>
                                        <div class="card__right__grafic__dinamic__w">сб</div>
                                    </li>
                                    <li class="card__right__grafic__dinamic__item h-2">
                                        <div class="card__right__grafic__dinamic__h"></div>
                                        <div class="card__right__grafic__dinamic__d">2</div>
                                        <div class="card__right__grafic__dinamic__w">вс</div>
                                    </li>
                                    <li class="card__right__grafic__dinamic__item h-3">
                                        <div class="card__right__grafic__dinamic__h"></div>
                                        <div class="card__right__grafic__dinamic__d">3</div>
                                        <div class="card__right__grafic__dinamic__w">пн</div>
                                    </li>
                                    <li class="card__right__grafic__dinamic__item h-4">
                                        <div class="card__right__grafic__dinamic__h"></div>
                                        <div class="card__right__grafic__dinamic__d">4</div>
                                        <div class="card__right__grafic__dinamic__w">вт</div>
                                    </li>
                                    <li class="card__right__grafic__dinamic__item h-5">
                                        <div class="card__right__grafic__dinamic__h"></div>
                                        <div class="card__right__grafic__dinamic__d">5</div>
                                        <div class="card__right__grafic__dinamic__w">ср</div>
                                    </li>
                                    <li class="card__right__grafic__dinamic__item h-6">
                                        <div class="card__right__grafic__dinamic__h"></div>
                                        <div class="card__right__grafic__dinamic__d">6</div>
                                        <div class="card__right__grafic__dinamic__w">чт</div>
                                    </li>
                                    <li class="card__right__grafic__dinamic__item h-7">
                                        <div class="card__right__grafic__dinamic__h"></div>
                                        <div class="card__right__grafic__dinamic__d">7</div>
                                        <div class="card__right__grafic__dinamic__w">пт</div>
                                    </li>
                                    <li class="card__right__grafic__dinamic__item h-8">
                                        <div class="card__right__grafic__dinamic__h"></div>
                                        <div class="card__right__grafic__dinamic__d">8</div>
                                        <div class="card__right__grafic__dinamic__w">сб</div>
                                    </li>
                                    <li class="card__right__grafic__dinamic__item h-9">
                                        <div class="card__right__grafic__dinamic__h"></div>
                                        <div class="card__right__grafic__dinamic__d">9</div>
                                        <div class="card__right__grafic__dinamic__w">вс</div>
                                    </li>
                                    <li class="card__right__grafic__dinamic__item h-10">
                                        <div class="card__right__grafic__dinamic__h"></div>
                                        <div class="card__right__grafic__dinamic__d">10</div>
                                        <div class="card__right__grafic__dinamic__w">пн</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card__right__grafic__bottom">
                        <div class="scrollbar-inner">
                            <div class="card__right__grafic__bottom__wrap">
                                <label for="" class="card__right__grafic__bottom__label">
                                    <input type="radio" name="1" class="radio">
                                    <span class="card__right__grafic__bottom__title">Марсель</span>
                                </label>
                                <label for="" class="card__right__grafic__bottom__label">
                                    <input type="radio" name="1" class="radio">
                                    <span class="card__right__grafic__bottom__title">Барселона</span>
                                </label>
                                <label for="" class="card__right__grafic__bottom__label">
                                    <input type="radio" name="1" class="radio">
                                    <span class="card__right__grafic__bottom__title">Пальма-де-Майорка</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--        <div id="app"></div>-->

        <div class="tabs cart__tabs" style="width: 100%;">
            <div class="swiper">
                <div class="tabs__wrap tabs__wrap__slide swiper-wrapper">
                    <? if ($model->ship->cabinGroups) { ?>
                        <div class="tabs__item swiper-slide" id="tab6">Каюты</div>
                    <? } ?>
                    <? if ($routeProvider && $routeProvider->getTotalCount()) { ?>
                        <div class="tabs__item swiper-slide">Маршрут</div>
                    <? } ?>
                    <div class="tabs__item swiper-slide" id="map_tab">Карта</div>
                    <? if ($model->ship) { ?>
                        <div class="tabs__item swiper-slide">Теплоход</div>
                    <? } ?>
                    <? if ($model->company->detail) { ?>
                        <div class="tabs__item swiper-slide">Круизная компания</div>
                    <? } ?>
                    <? if ($companyModel && $companyModel->ship_info) { ?>
                        <div class="tabs__item swiper-slide">Что включено</div>
                    <? } ?>
                    <? if ($companyModel && $companyModel->penalty_info) { ?>
                        <div class="tabs__item swiper-slide">Условия бронирования</div>
                    <? } ?>
                    <? if ($model->visa) { ?>
                        <div class="tabs__item swiper-slide" style="display: none">Визы</div>
                    <? } ?>


                    <? if ($model->ship->decks) { ?>
                        <div class="tabs__item swiper-slide">Палубы</div>
                    <? } ?>

                    <? if ($model->ports && 0 === 1) { ?>
                        <div class="tabs__item swiper-slide">Порты круиза</div>
                    <? } ?>
                    <? if ($model->reviews) { ?>
                        <div class="tabs__item swiper-slide reviews">Отзывы</div>
                    <? } ?>
                    <? if ($model->actions) { ?>
                        <div class="tabs__item swiper-slide">Акции</div>
                    <? } ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <div class="tabs__content ">

                <? if ($model->ship->cabinGroups) { ?>
                    <div class="tabs__content__item" id="tabtext6" style="width: 100%; min-height: 200px">
                        <div id="app"></div>
                        <?= Module::module("body", "cabin"); ?>
                    </div>
                <? } ?>


                <? if ($routeProvider && $routeProvider->getTotalCount()) {
                    $routeProvider->pagination->pageSize = -1;
                    ?>
                    <div class="tabs__content__item">
                        <div class="tabs__content__item__table scrollbar-inner">
                            <?= \yii\grid\GridView::widget([
                                'dataProvider' => $routeProvider,
                                'layout' => "{items}",
                                'tableOptions' => [
                                    'class' => 'road'
                                ],
                                'columns' => [
                                    [
                                        'attribute' => 'day',
                                        'label' => 'День',
                                    ],
                                    [
                                        'attribute' => 'date',
                                        'label' => 'Дата',
                                    ],
                                    [
                                        'attribute' => 'port.name',
                                        'label' => 'Порт захода'
                                    ],
                                    [
                                        'attribute' => 'country.name',
                                        'label' => 'Страна'
                                    ],
                                    [
                                        'attribute' => 'info',
                                        'label' => 'События',
                                        'visible' => $rInfoVisible
                                    ],
                                    [
                                        'attribute' => 'arrival',
                                        'label' => 'Прибытие',
                                        'value' => function ($data) {
                                            return ($data->arrival ? substr($data->arrival, 0, 5) : '');
//                                     		return substr($data->arrival, 0, 5) . " - " . substr(
//                                     			$data->departure,
//                                     			0,
//                                     			5
//                                     		);
                                        }
                                    ],
                                    [
                                        'attribute' => 'departure',
                                        'label' => 'Отправление',
                                        'value' => function ($data) {
                                            return ($data->departure ? substr($data->departure, 0, 5) : '');
//                                     		return substr($data->arrival, 0, 5) . " - " . substr(
//                                     			$data->departure,
//                                     			0,
//                                     			5
//                                     		);
                                        }
                                    ],

                                ],
                                'rowOptions' => [
                                    'class' => false,
                                ]
                            ]); ?>
                        </div>
                    </div>
                    <div class="tabs__content__item" style="width: 100%;">

                        <?
                        $x1 = $y1 = $x2 = $y2 = 0;
                        $items = [];

                        foreach ($model->cruisePorts as $obPort) {
                            $port = $obPort->port;

                            $x = (float)trim($port->lat);
                            $y = (float)trim($port->lon);
                            if ($x + $y != 0) {
                                $items[] = [
                                    'latitude' => $port->lat,
                                    'longitude' => $port->lon,
                                    'options' => [
                                        [
                                            'hintContent' => $port->name,
                                            'balloonContentHeader' => $port->name,
                                            'iconCaption' => (count($items) + 1) . ' - ' . $port->name
                                        ],
                                        [
                                            'preset' => 'islands#icon',
                                            'iconColor' => '#841214'
                                        ]
                                    ]
                                ];
                                if (!$x1 || $x1 < $x) {
                                    $x1 = $x;
                                }
                                if (!$x2 || $x2 > $x) {
                                    $x2 = $x;
                                }
                                if (!$y1 || $y1 < $y) {
                                    $y1 = $y;
                                }
                                if (!$y2 || $y2 > $y) {
                                    $y2 = $y;
                                }
                            }
                        }

                        $items = array_reverse($items, true);

                        if ($items) {
                            ?>
                            <div class="card__right__map">
                                <?= \phpnt\yandexMap\YandexMaps::widget([
                                    'myPlacemarks' => $items,
                                    'mapOptions' => [
                                        'center' => [($x2 + $x1) / 2, ($y2 + $y1) / 2],
                                        // центр карты
                                        'zoom' => 13,
                                    ],
                                    'disableScroll' => true,
                                    // отключить скролл колесиком мыши (по умолчанию true)
                                    'windowWidth' => '100%',
                                    // длинна карты (по умолчанию 100%)
                                    'windowHeight' => '436px',
                                    // высота карты (по умолчанию 400px)
                                ]); ?>
                            </div>
                            <?

                        }


                        /*
                    if($placemarks) {
//                        print "map!!!!";
                    $map = new \mirocow\yandexmaps\Map('yandex_map', [
                        'center' => [($x2 + $x1) / 2, ($y2 + $y1) / 2],
                        'zoom' => 5,
                        // Enable zoom with mouse scroll
                        'behaviors' => array(
                            'drag', 'dblClickZoom'
                        ),
                        'type' => "yandex#map",
                        'controls' => [
//                                'new ymaps.control.ZoomControl({options: {size: "small"}})',
                            'new ymaps.control.FullscreenControl({options: {size: "small"}})'
                        ],
                    ],
                        [
                            // Permit zoom only fro 9 to 11
                            'minZoom' => 4,
                            'maxZoom' => 8,
                        ]
                    );
                    $map->setObjects($placemarks);
                    ?>
                    <div class="card__right__map" data-fancybox>
                        <?= \mirocow\yandexmaps\Canvas::widget([
                            'htmlOptions' => [
                                'style' => 'height: 236px;',
                            ],
                            'map' => $map,
                        ]); ?>
                    </div>
                    <?}*/ ?>
                    </div>
                <? } ?>

                <? if ($model->ship) { ?>
                    <div class="tabs__content__item">
                        <div class="ship__block">
                            <div class="ship__block__left">
                                <? if (@$model->ship->gallery->images && count(@$model->ship->gallery->images) > 1) { ?>
                                    <div class="cart__slider__top--ship">
                                        <? foreach ($model->ship->gallery->images as $image) { ?>
                                            <div class="cart__slider__top__item">
                                                <img src="<?= $image->subdir . DIRECTORY_SEPARATOR . $image->name ?>"
                                                     alt="">
                                            </div>
                                        <? } ?>
                                    </div>
                                    <div class="cart__slider__bottom--ship">
                                        <? foreach ($model->ship->gallery->images as $image) { ?>
                                            <div class="cart__slider__bottom__item">
                                                <img src="<?= $image->subdir . DIRECTORY_SEPARATOR . $image->name ?>"
                                                     alt="">
                                            </div>
                                        <? } ?>
                                    </div>
                                <? } else { ?>
                                    <img src="<?= @$obShip->name ? ($obShip->subdir . "/" . $obShip->name) : "/images/cart/cart.jpg" ?>"
                                         style="width: 500px;height: auto;">
                                <? } ?>
                            </div>
                            <div class="ship__block__right">
                                <h4>Описание теплохода</h4>
                                <ul class="include__accordion">
                                    <? if ($model->ship->bars_info) { ?>
                                        <li class="include__accordion__item" data-tab="1">
                                            <div class="include__list__accordion__tittle include__list__accordion__tittle--l">
                                                <span>+</span>Бары
                                            </div>
                                            <div class="include__list__accordion__content include__list__accordion__content-l">
                                                <div class="company__inner__descr__wrap">
                                                    <?= $model->ship->bars_info ?>
                                                </div>
                                            </div>
                                        </li>
                                    <? } ?>
                                    <? if ($model->ship->food_info) { ?>
                                        <li class="include__accordion__item" data-tab="1">
                                            <div class="include__list__accordion__tittle include__list__accordion__tittle--l">
                                                <span>+</span>Рестораны
                                            </div>
                                            <div class="include__list__accordion__content include__list__accordion__content-l">
                                                <div class="company__inner__descr__wrap">
                                                    <?= $model->ship->food_info ?>
                                                </div>
                                            </div>
                                        </li>
                                    <? } ?>
                                    <? if ($model->ship->cazino_info) { ?>
                                        <li class="include__accordion__item" data-tab="1">
                                            <div class="include__list__accordion__tittle include__list__accordion__tittle--l">
                                                <span>+</span>Казино
                                            </div>
                                            <div class="include__list__accordion__content include__list__accordion__content-l">
                                                <div class="company__inner__descr__wrap">
                                                    <?= $model->ship->cazino_info ?>
                                                </div>
                                            </div>
                                        </li>
                                    <? } ?>
                                    <? if ($model->ship->pool_info) { ?>
                                        <li class="include__accordion__item" data-tab="1">
                                            <div class="include__list__accordion__tittle include__list__accordion__tittle--l">
                                                <span>+</span>Басейны
                                            </div>
                                            <div class="include__list__accordion__content include__list__accordion__content-l">
                                                <div class="company__inner__descr__wrap">
                                                    <?= $model->ship->pool_info ?>
                                                </div>
                                            </div>
                                        </li>
                                    <? } ?>
                                    <? if ($model->ship->cinima_info) { ?>
                                        <li class="include__accordion__item" data-tab="1">
                                            <div class="include__list__accordion__tittle include__list__accordion__tittle--l">
                                                <span>+</span>Кинотеатры
                                            </div>
                                            <div class="include__list__accordion__content include__list__accordion__content-l">
                                                <div class="company__inner__descr__wrap">
                                                    <?= $model->ship->cinima_info ?>
                                                </div>
                                            </div>
                                        </li>
                                    <? } ?>
                                    <? if ($model->ship->map_info) { ?>
                                        <li class="include__accordion__item" data-tab="1">
                                            <div class="include__list__accordion__tittle include__list__accordion__tittle--l">
                                                <span>+</span>Развлечения
                                            </div>
                                            <div class="include__list__accordion__content include__list__accordion__content-l">
                                                <div class="company__inner__descr__wrap">
                                                    <?= $model->ship->map_info ?>
                                                </div>
                                            </div>
                                        </li>
                                    <? } ?>
                                </ul>
                                <?= $model->ship->preview ? $model->ship->preview : $model->ship->detail ?>
                            </div>
                            <div class="ship__block__tech">
                                <? if ($model->ship->options) { ?>
                                    <div class="ship__block__tech__item">
                                        <h3>Технические характеристики</h3>
                                    </div>
                                    <div class="ship__block__tech__wrap scrollbar-inner">
                                        <? foreach ($model->ship->options as $option) {
                                            if ($option->value) { ?>
                                                <div class="ship__block__tech__item">
                                                    <div class="ship__block__tech__item__title"><?= $option->title ?></div>
                                                    <div class="ship__block__tech__item__text"><?= $option->value ?></div>
                                                </div>
                                            <? }
                                        } ?>
                                    </div>
                                <? } ?>
                            </div>
                        </div>
                    </div>
                <? } ?>

                <? if ($model->company->detail && 1 == 1) { ?>
                    <div class="tabs__content__item">
                        <div class="tabs__company__name">
                            <? if (isset($logoSrc) && $logoSrc) { ?>
                                <span class="tabs__company__name__img"
                                      style="background-image: url('<?= $logoSrc ?>')"></span>
                            <? } else { ?>
                                <span class="tabs__company__name__img"
                                      style="background-image: url('/images/cart/Norwegian.svg')"></span>
                            <? } ?>
                            <h2><?= $model->company->name ?></h2>
                        </div>
                        <div class="tabs__company__text">
                            <?= $model->company->detail ?>
                        </div>
                        <div class="tabs__company__accordeon" style="display: none">
                            <ul class="accordion cart__accordion">
                                <li class="accordion__item">
                                    <div class="accordion__tittle accordion__tittle__text">
                                        <span>+</span>
                                        Характеристика флота круизной компании
                                    </div>
                                    <div class="accordion__content accordion__content--text">
                                        <?= $model->company->ship_info ?>
                                    </div>
                                </li>
                                <li class="accordion__item" style="display: none">
                                    <div class="accordion__tittle accordion__tittle__text">
                                        <span>+</span>
                                        Питание в морских круизах Costa Cruises.
                                    </div>
                                    <div class="accordion__content accordion__content--text">
                                        <?= $model->company->ship_info ?>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                <? } ?>

                <? if ($companyModel && $companyModel->ship_info) { ?>
                    <div class="tabs__content__item user__content">
                        <?= $companyModel->ship_info ?>
                        <ul class="accordion include__accordion" style="display:none;">
                            <li class="include__accordion__item" data-tab="1">
                                <div class="accordion__tittle"><span></span>В стоимость круиза включено:</div>
                                <div class="accordion__content accordion__content--include">
                                    <ul class="include__list">
                                        <li>Проживание в каюте с услугами по выбранной категории</li>
                                        <li>питание «24 часа», включая алкогольные напитки премиум (premium) класса. В
                                            каютах категории IX, OX, BX, MX напитки не включены в стоимость.
                                        </li>
                                        <li>чаевые персоналу</li>
                                        <li>Заказ еды в каюту 24 часа “room service” ( за room service c 00:00 до 05:00
                                            взимается дополнительная плата за доставку).
                                        </li>
                                        <li>Для гостей старше 21 года: широкий выбор алкогольных напитков, пиво в
                                            бутылках и на розлив, вино в бокалах и коктейли стоимостью до 15$. А так же
                                            безалкогольные напитки и соки (кроме свежевыжатых) - кроме кают категории
                                            IX, OX, BX, MX.
                                        </li>
                                        <li>Проживание в каюте выбранной категории в течение всего круиза (ТВ, телефон,
                                            душ / ванна, фен, кондиционер).
                                        </li>
                                        <li class="include__list__accordion">
                                            <div class="include__list__accordion__tittle"><span></span>Напитки</div>
                                        </li>
                                        <li class="include__list__accordion">
                                            <div class="include__list__accordion__tittle"><span></span>Специальные
                                                возможности для пассажиров сьютов
                                            </div>
                                            <ul class="include__list__accordion__content">
                                                <li><span>Специальные возможности для пассажиров минисьютов.</span>
                                                    Удобное расположение, континентальный завтрак, 24-часовой
                                                    рум-сервис, выбор сены питания.
                                                </li>
                                                <li><span>Специальные возможности для пассажиров минисьютов.</span> Все
                                                    привилегии кают класса “премиум”, а также: безлимитный доступ в
                                                    спа-центр; ресторана здорового питания Samsara Restaurant (Столик и
                                                    время ужина не фиксируются); консультации специалиста и разработка
                                                    программы оздоровления.
                                                </li>
                                            </ul>
                                        </li>
                                        <li>Питание по системе Ультра Все Включено по программе FreeStyle – свободное
                                            время питания.
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="include__accordion__item" data-tab="1">
                                <div class="accordion__tittle"><span></span>Дополнительно оплачивается при бронировании:
                                </div>
                                <div class="accordion__content accordion__content--include">
                                    <ul class="include__list">
                                        <li>Проживание в каюте с услугами по выбранной категории</li>
                                        <li>питание «24 часа», включая алкогольные напитки премиум (premium) класса. В
                                            каютах категории IX, OX, BX, MX напитки не включены в стоимость.
                                        </li>
                                        <li>чаевые персоналу</li>
                                        <li>Заказ еды в каюту 24 часа “room service” ( за room service c 00:00 до 05:00
                                            взимается дополнительная плата за доставку).
                                        </li>
                                        <li>Для гостей старше 21 года: широкий выбор алкогольных напитков, пиво в
                                            бутылках и на розлив, вино в бокалах и коктейли стоимостью до 15$. А так же
                                            безалкогольные напитки и соки (кроме свежевыжатых) - кроме кают категории
                                            IX, OX, BX, MX.
                                        </li>
                                        <li>Проживание в каюте выбранной категории в течение всего круиза (ТВ, телефон,
                                            душ / ванна, фен, кондиционер).
                                        </li>
                                        <li class="include__list__accordion">
                                            <div class="include__list__accordion__tittle"><span></span>Кофе американо,
                                                чай, вода и холодный чай во время завтрака, обеда и ужина в основном
                                                ресторане и в ресторане-буфет (шведский стол) - для кают всех категорий.
                                            </div>
                                            <ul class="include__list__accordion__content">
                                                <li><span>Специальные возможности для пассажиров минисьютов.</span>
                                                    Удобное расположение, континентальный завтрак, 24-часовой
                                                    рум-сервис, выбор сены питания.
                                                </li>
                                                <li><span>Специальные возможности для пассажиров минисьютов.</span> Все
                                                    привилегии кают класса “премиум”, а также: безлимитный доступ в
                                                    спа-центр; ресторана здорового питания Samsara Restaurant (Столик и
                                                    время ужина не фиксируются); консультации специалиста и разработка
                                                    программы оздоровления.
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="include__accordion__item" data-tab="1">
                                <div class="accordion__tittle"><span></span>Дополнительно оплачивается на лайнере</div>
                                <div class="accordion__content accordion__content--include">
                                    <ul class="include__list">
                                        <li>Проживание в каюте с услугами по выбранной категории</li>
                                        <li>питание «24 часа», включая алкогольные напитки премиум (premium) класса. В
                                            каютах категории IX, OX, BX, MX напитки не включены в стоимость.
                                        </li>
                                        <li>чаевые персоналу</li>
                                    </ul>
                                </div>
                            </li>
                            <li class="include__accordion__item" data-tab="1">
                                <div class="accordion__tittle"><span></span>Дополнительные услуги на борту</div>
                                <div class="accordion__content accordion__content--include">
                                    <ul class="include__list">
                                        <li>Проживание в каюте с услугами по выбранной категории</li>
                                        <li>питание «24 часа», включая алкогольные напитки премиум (premium) класса. В
                                            каютах категории IX, OX, BX, MX напитки не включены в стоимость.
                                        </li>
                                        <li>чаевые персоналу</li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                <? } ?>
                <? if ($companyModel && $companyModel->penalty_info) { ?>
                    <div class="tabs__content__item user__content">
                        <?= $companyModel->penalty_info ?>
                        <div class="tabs__content__item__table scrollbar-inner">
                            <table class="road road__content" style="display: none">
                                <tr>
                                    <th>При заявлении об отказе от круиза в срок</th>
                                    <th>Размер ожидаемых фактических потерь</th>
                                </tr>
                                <tr>
                                    <td>Более 66 дней до начала круиза</td>
                                    <td>40 евро с человека</td>
                                </tr>
                                <tr>
                                    <td>За 65 - 47 дня до начала круиза</td>
                                    <td>20% от стоимости круиза</td>
                                </tr>
                                <tr>
                                    <td>За 46 - 34 дней до начала круиза</td>
                                    <td>35% от стоимости круиза</td>
                                </tr>
                                <tr>
                                    <td>За 33 – 20 дней до начала круиза</td>
                                    <td>55% от стоимости круиза</td>
                                </tr>
                                <tr>
                                    <td>За 19 – 6 дней до начала круиза</td>
                                    <td>85% от стоимости круиза</td>
                                </tr>
                                <tr>
                                    <td>Менее 5 дней до начала круиза</td>
                                    <td>100% от стоимости круиза</td>
                                </tr>
                            </table>
                        </div>
                        <ul class="include__list include__list__tabs" style="display: none">
                            <li>Стоимость одноместного размещения – от 80% до 100% в зависимости от категории каюты.
                            </li>
                            <li>Стоимость 3-го и 4-го взрослого пассажира в каюте запрашивается дополнительно.</li>
                            <li>Стоимость 3-го и 4-го ребёнка до 18 лет в каюте – бесплатно, оплачиваются только
                                портовые сборы и таксы.
                            </li>
                            <li>Депозит: 20% от стоимости каюты (при бронировании не позднее, чем за 65 дней до начала
                                круиза).
                            </li>
                        </ul>
                    </div>
                <? } ?>
                <? if ($model->visa) { ?>
                    <div class="tabs__content__item">
                        <div class="viza__title__wrap clear">
                            <h3 class="viza__title">Для путешествия по данному маршруты для граждан России необходимо
                                оформление следующих виз:</h3>
                            <a href="" class="viza__pdf">PDF Опросник</a>
                        </div>
                        <ul class="accordion viza__accordion">
                            <li class="viza__accordion__item" data-tab="1">
                                <div class="accordion__tittle">
                                    <div class="viza__accordion__icon"
                                         style="background-image: url(/images/cart/uk.png)"></div>
                                    <span class="viza__accordion__sep">+</span><span class="viza__accordion__title">Мульти Шенген (Великобритания)</span>
                                    <span class="viza__accordion__title__mobile">Великобритания</span>
                                </div>
                                <div class="accordion__content">
                                    <h4 class="accordion__content__title">Стоимость визы: 3 000 руб.</h4>
                                    <p>Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает
                                        сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или
                                        менее стандартное заполнение шаблона, а также реальное распределение букв и
                                        пробелов в абзацах, которое не получается при простой дубликации "Здесь ваш
                                        текст.. Здесь ваш текст.. Здесь ваш текст.."
                                        Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает
                                        сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или
                                        менее стандартное заполнение шаблона, а также реальное распределение букв и
                                        пробелов в абзацах, которое не получается при простой дубликации "Здесь ваш
                                        текст.. Здесь ваш текст.. Здесь ваш текст.."
                                        Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает
                                        сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или
                                        менее стандартное заполнение шаблона, а также реальное распределение букв и
                                        пробелов в абзацах, которое не получается при простой дубликации "Здесь ваш
                                        текст.. Здесь ваш текст.. Здесь ваш текст.." </p>
                                </div>
                            </li>
                            <li class="viza__accordion__item" data-tab="1">
                                <div class="accordion__tittle">
                                    <div class="viza__accordion__icon"
                                         style="background-image: url('/images/cart/flag.png')"></div>
                                    <span class="viza__accordion__sep">+</span><span class="viza__accordion__title">Мульти Шенген (Франция)</span>
                                    <span class="viza__accordion__title__mobile">Франция</span>
                                </div>
                                <div class="accordion__content">
                                    <h4 class="accordion__content__title">Стоимость визы: 3 000 руб.</h4>
                                    <p>Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает
                                        сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или
                                        менее стандартное заполнение шаблона, а также реальное распределение букв и
                                        пробелов в абзацах, которое не получается при простой дубликации "Здесь ваш
                                        текст.. Здесь ваш текст.. Здесь ваш текст.."
                                        Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает
                                        сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или
                                        менее стандартное заполнение шаблона, а также реальное распределение букв и
                                        пробелов в абзацах, которое не получается при простой дубликации "Здесь ваш
                                        текст.. Здесь ваш текст.. Здесь ваш текст.."
                                        Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает
                                        сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или
                                        менее стандартное заполнение шаблона, а также реальное распределение букв и
                                        пробелов в абзацах, которое не получается при простой дубликации "Здесь ваш
                                        текст.. Здесь ваш текст.. Здесь ваш текст.." </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                <? } ?>


                <? if ($model->ship->decks) { ?>
                    <div class="tabs__content__item">
                        <div class="cabina__wrap">
                            <div class="cabina__wrap__left">
                                <div class="cabina__wrap__left__top">
                                    <div class="cabina__wrap__left__inner">
                                        <div class="cabina__wrap__left__inner__top">
                                            <input type="text" placeholder="# Каюта" class="cabina__input">
                                            <input type="submit" value="Найти" class="cabina__button">
                                        </div>
                                        <div class="cabina__wrap__left__inner__bottom">
                                            <div class="cabina__wrap__left__img">
                                                <a href="/images/lainer/cabina.png" data-fancybox>
                                                    <div class="cabina__wrap__left__img__wrap"
                                                         style="background-image: url(/images/lainer/cabina.png);"></div>
                                                </a>
                                            </div>
                                            <div class="cabina__wrap__left__select">
                                                <div class="cabina__input__select">
                                                    <div class="custom-select">
                                                        <select>
                                                            <option value="">Выбрать палубу</option>
                                                            <option value="">Палуба 1</option>
                                                            <option value="">Палуба 2</option>
                                                            <option value="">Палуба 3</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <a href="" class="cabina__pdf">Посмотреть все палубы</a>
                                                <div class="cabina__detail">Детальный просмотр палуб</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cabina__wrap__left__bottom">
                                    <div class="cabina__wrap__left__inner">
                                        <div class="cabina__wrap__left__bottom__top">
                                            <h3>Каюты</h3>
                                            <div class="cabina__wrap__left__bottom__text">
                                                <div class="cabina__wrap__left__bottom__text__item invalid">Каюта
                                                    доступна для инвалидов
                                                </div>
                                                <div class="cabina__wrap__left__bottom__text__item unit">Соедененая
                                                    каюта
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cabina__wrap__left__bottom__bottom">
                                            <div class="cabina__wrap__left__bottom__item">
                                                <div class="cabina__wrap__left__bottom__item__left">Тип каюты</div>
                                                <div class="cabina__wrap__left__bottom__item__right">Категории</div>
                                            </div>
                                            <div class="cabina__wrap__left__bottom__item">
                                                <div class="cabina__wrap__left__bottom__item__left">Внутренняя каюта
                                                </div>
                                                <div class="cabina__wrap__left__bottom__item__right">
                                                    <ul class="cabina__wrap__left__bottom__list">
                                                        <li style="background-color:#DCE2ED;">IA</li>
                                                        <li style="background-color:#FFCB05;">IB</li>
                                                        <li style="background-color:#B6B2D8;">IE</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="cabina__wrap__left__bottom__item">
                                                <div class="cabina__wrap__left__bottom__item__left">Каюта с балконом
                                                </div>
                                                <div class="cabina__wrap__left__bottom__item__right">
                                                    <ul class="cabina__wrap__left__bottom__list">
                                                        <li style="background-color:#D2B675;">O5</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="cabina__wrap__left__bottom__item">
                                                <div class="cabina__wrap__left__bottom__item__left">Каюта с окном</div>
                                                <div class="cabina__wrap__left__bottom__item__right">
                                                    <ul class="cabina__wrap__left__bottom__list">
                                                        <li style="background-color:#DE6D28;">B4</li>
                                                        <li style="background-color:#B6CA77;">B5</li>
                                                        <li style="background-color:#FFF200;">BA</li>
                                                        <li style="background-color:#CC8B96;">BB</li>
                                                        <li style="background-color:#90A79D;">BD</li>
                                                        <li style="background-color:#00AEEF;">BE</li>
                                                        <li style="background-color:#DD9317;">BX</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="cabina__wrap__left__bottom__item">
                                                <div class="cabina__wrap__left__bottom__item__left">Сьют</div>
                                                <div class="cabina__wrap__left__bottom__item__right">
                                                    <ul class="cabina__wrap__left__bottom__list">
                                                        <li style="background-color:#BC9AC8;">S2</li>
                                                        <li style="background-color:#C84B9B;">S3</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="cabina__wrap__right">
                                <div class="cabina__wrap__right__close"></div>
                                <div class="cabina__wrap__right__select__mobile">
                                    <div class="cabina__wrap__right__select__mobile__select">
                                        <div class="custom-select">
                                            <select>
                                                <option value="">Выбрать палубу</option>
                                                <option value="">Палуба 1</option>
                                                <option value="">Палуба 2</option>
                                                <option value="">Палуба 3</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="cabina__wrap__right__slider">
                                    <div class="cabina__wrap__right__slider__item">
                                        <div class="cabina__wrap__right__slider__item__text">
                                            <span>Космическая палуба </span>
                                            <span>№ 625</span>
                                        </div>
                                        <img src="/images/lainer/liner.png" alt="">
                                    </div>
                                    <div class="cabina__wrap__right__slider__item">
                                        <div class="cabina__wrap__right__slider__item__text">
                                            <span>Космическая палуба </span>
                                            <span>№ 625</span>
                                        </div>
                                        <img src="/images/lainer/liner.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <? } ?>

                <? if ($model->ports && 0 == 1) { ?>
                    <div class="tabs__content__item">
                        <? foreach ($model->ports as $obPort) { ?>
                            <div class="port__title">
                                <h2><?= $obPort->name ?></h2>
                                <? if ($obPort->tagsText) { ?>
                                    <div class="port__title__text">
                                        <span style="background-image: url(/images/cart/history.svg);"></span><?= $obPort->tagsText ?>
                                    </div>
                                <? } ?>
                            </div>
                            <? if ($obPort->info || $obPort->excursion || $obPort->places || $obPort->gallery) ?>
                                <div class="port__content">
                            <? if ($obPort->gallery) { ?>
                                <div class="port__content__left">
                                    <div class="port__content__slider sticky-block">
                                        <div class="port__slider__top">
                                            <div class="cart__slider__top__item"><img src="/images/cart/slide-1.jpg"
                                                                                      alt=""></div>
                                            <div class="cart__slider__top__item"><img src="/images/cart/slide-1.jpg"
                                                                                      alt=""></div>
                                            <div class="cart__slider__top__item"><img src="/images/cart/slide-1.jpg"
                                                                                      alt=""></div>
                                            <div class="cart__slider__top__item"><img src="/images/cart/slide-1.jpg"
                                                                                      alt=""></div>
                                        </div>
                                        <div class="port__slider__bottom">
                                            <div class="cart__slider__bottom__item"><img src="/images/cart/slide-1.jpg"
                                                                                         alt=""></div>
                                            <div class="cart__slider__bottom__item"><img src="/images/cart/slide-1.jpg"
                                                                                         alt=""></div>
                                            <div class="cart__slider__bottom__item"><img src="/images/cart/slide-1.jpg"
                                                                                         alt=""></div>
                                            <div class="cart__slider__bottom__item"><img src="/images/cart/slide-1.jpg"
                                                                                         alt=""></div>
                                        </div>
                                    </div>
                                </div>
                            <? } ?>
                            <div class="port__content__right__more"><span></span></div>
                            <div class="port__content__right">
                                <?= $obPort->info ?>
                                <? if ($obPort->excursion || $obPort->places) { ?>
                                    <div class="port__accordion">
                                        <ul class="accordion cart__accordion">
                                            <? if ($obPort->excursion) { ?>
                                                <li class="accordion__item">
                                                    <div class="accordion__tittle">
                                                        <span>+</span>
                                                        Экскурсии
                                                    </div>
                                                    <div class="accordion__content">
                                                        <?= $obPort->excursion ?>
                                                    </div>
                                                </li>
                                            <? }
                                            if ($obPort->places) { ?>
                                                <li class="accordion__item">
                                                    <div class="accordion__tittle">
                                                        <span>+</span>
                                                        Достопримечательности
                                                    </div>
                                                    <div class="accordion__content">
                                                        <?= $obPort->places ?>
                                                    </div>
                                                </li>
                                            <? } ?>
                                        </ul>
                                    </div>
                                <? } ?>
                            </div>
                            </div>
                        <? } ?>
                    </div>
                <? } ?>
                <? if ($model->reviews) { ?>
                    <div class="tabs__content__item">
                        <div class="cart__otziv__title">
                            <h2>Отзывы</h2>
                            <div class="cart__otziv__sort">
                                <span class="cart__otziv__sort__name">Сортировка:</span>
                                <div class="custom-select">
                                    <select>
                                        <option value="">Сортировка</option>
                                        <option value="">Отзывы по этому же маршруту</option>
                                        <option value="">Отзывы по этому же маршруту</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="cart__otziv__slide">
                            <div class="otziv__main__slide">
                                <div class="otziv__main__slide__item">
                                    <div class="cart__otziv__slide__wrap">
                                        <ul class="otziv__main__list">
                                            <li class="otziv__main__item clear">
                                                <div class="otziv__main__link">
                                                    <div class="otziv__main__text">
                                                        <div class="otziv__main__text__top">
                                                            <div class="otziv__main__img"
                                                                 style="background-image: url(images/251d2b42e31a5f104383829d8130cb9e-min.jpg);"></div>
                                                            <div class="otziv__main__text__title">Имя Фамилия</div>
                                                            <ul class="star__wrap">
                                                                <li class="star__item"><img src="images/new/star-y.svg"
                                                                                            alt=""></li>
                                                                <li class="star__item"><img src="images/new/star-y.svg"
                                                                                            alt=""></li>
                                                                <li class="star__item"><img src="images/new/star-y.svg"
                                                                                            alt=""></li>
                                                                <li class="star__item"><img src="images/new/star-y.svg"
                                                                                            alt=""></li>
                                                                <li class="star__item"><img src="images/new/star-y.svg"
                                                                                            alt=""></li>
                                                            </ul>
                                                        </div>
                                                        <div class="otziv__main__desc">
                                                            <div class="otziv__main__desc__item">
                                                                <span>Название корабля:</span> Великий Корабль
                                                                Названывич Второй
                                                            </div>
                                                            <div class="otziv__main__desc__item">
                                                                <span>Даты круиза:</span> 11.2018 - 11.2018
                                                            </div>
                                                            <div class="otziv__main__desc__item">
                                                                <span>Маршрут:</span> Хельсинки — Стогкольм —
                                                                Хельсинки...
                                                            </div>
                                                        </div>
                                                        <div class="otziv__main__text__descr">Давно выяснено, что при
                                                            оценке дизайна и композиции читаемый текст мешает
                                                            сосредоточиться. Lorem Ipsum используют потому . используют
                                                            потому...
                                                        </div>
                                                        <span class="otziv__main__text__link">Читать полностью</span>
                                                    </div>
                                                </div>
                                                <div class="otziv__popup"></div>
                                            </li>
                                            <li class="otziv__main__item clear">
                                                <div class="otziv__main__link">
                                                    <div class="otziv__main__text">
                                                        <div class="otziv__main__text__top">
                                                            <div class="otziv__main__img"
                                                                 style="background-image: url(images/251d2b42e31a5f104383829d8130cb9e-min.jpg);"></div>
                                                            <div class="otziv__main__text__title">Имя Фамилия</div>
                                                            <ul class="star__wrap">
                                                                <li class="star__item"><img src="images/new/star-y.svg"
                                                                                            alt=""></li>
                                                                <li class="star__item"><img src="images/new/star-y.svg"
                                                                                            alt=""></li>
                                                                <li class="star__item"><img src="images/new/star-y.svg"
                                                                                            alt=""></li>
                                                                <li class="star__item"><img src="images/new/star-y.svg"
                                                                                            alt=""></li>
                                                                <li class="star__item"><img src="images/new/star-y.svg"
                                                                                            alt=""></li>
                                                            </ul>
                                                        </div>
                                                        <div class="otziv__main__desc">
                                                            <div class="otziv__main__desc__item">
                                                                <span>Название корабля:</span> Великий Корабль
                                                                Названывич Второй
                                                            </div>
                                                            <div class="otziv__main__desc__item">
                                                                <span>Даты круиза:</span> 11.2018 - 11.2018
                                                            </div>
                                                            <div class="otziv__main__desc__item">
                                                                <span>Маршрут:</span> Хельсинки — Стогкольм —
                                                                Хельсинки...
                                                            </div>
                                                        </div>
                                                        <div class="otziv__main__text__descr">Давно выяснено, что при
                                                            оценке дизайна и композиции читаемый текст мешает
                                                            сосредоточиться. Lorem Ipsum используют потому . используют
                                                            потому...
                                                        </div>
                                                        <span class="otziv__main__text__link">Читать полностью</span>
                                                    </div>
                                                </div>
                                                <div class="otziv__popup"></div>
                                            </li>
                                        </ul>
                                        <ul class="otziv__main__list">
                                            <li class="otziv__main__item clear">
                                                <div class="otziv__main__link">
                                                    <div class="otziv__main__text">
                                                        <div class="otziv__main__text__top">
                                                            <div class="otziv__main__img"
                                                                 style="background-image: url(images/251d2b42e31a5f104383829d8130cb9e-min.jpg);"></div>
                                                            <div class="otziv__main__text__title">Имя Фамилия</div>
                                                            <ul class="star__wrap">
                                                                <li class="star__item"><img src="images/new/star-y.svg"
                                                                                            alt=""></li>
                                                                <li class="star__item"><img src="images/new/star-y.svg"
                                                                                            alt=""></li>
                                                                <li class="star__item"><img src="images/new/star-y.svg"
                                                                                            alt=""></li>
                                                                <li class="star__item"><img src="images/new/star-y.svg"
                                                                                            alt=""></li>
                                                                <li class="star__item"><img src="images/new/star-y.svg"
                                                                                            alt=""></li>
                                                            </ul>
                                                        </div>
                                                        <div class="otziv__main__desc">
                                                            <div class="otziv__main__desc__item">
                                                                <span>Название корабля:</span> Великий Корабль
                                                                Названывич Второй
                                                            </div>
                                                            <div class="otziv__main__desc__item">
                                                                <span>Даты круиза:</span> 11.2018 - 11.2018
                                                            </div>
                                                            <div class="otziv__main__desc__item">
                                                                <span>Маршрут:</span> Хельсинки — Стогкольм —
                                                                Хельсинки...
                                                            </div>
                                                        </div>
                                                        <div class="otziv__main__text__descr">Давно выяснено, что при
                                                            оценке дизайна и композиции читаемый текст мешает
                                                            сосредоточиться. Lorem Ipsum используют потому . используют
                                                            потому...
                                                        </div>
                                                        <span class="otziv__main__text__link">Читать полностью</span>
                                                    </div>
                                                </div>
                                                <div class="otziv__popup"></div>
                                            </li>
                                            <li class="otziv__main__item clear">
                                                <div class="otziv__main__link">
                                                    <div class="otziv__main__text">
                                                        <div class="otziv__main__text__top">
                                                            <div class="otziv__main__img"
                                                                 style="background-image: url(images/251d2b42e31a5f104383829d8130cb9e-min.jpg);"></div>
                                                            <div class="otziv__main__text__title">Имя Фамилия</div>
                                                            <ul class="star__wrap">
                                                                <li class="star__item"><img src="images/new/star-y.svg"
                                                                                            alt=""></li>
                                                                <li class="star__item"><img src="images/new/star-y.svg"
                                                                                            alt=""></li>
                                                                <li class="star__item"><img src="images/new/star-y.svg"
                                                                                            alt=""></li>
                                                                <li class="star__item"><img src="images/new/star-y.svg"
                                                                                            alt=""></li>
                                                                <li class="star__item"><img src="images/new/star-y.svg"
                                                                                            alt=""></li>
                                                            </ul>
                                                        </div>
                                                        <div class="otziv__main__desc">
                                                            <div class="otziv__main__desc__item">
                                                                <span>Название корабля:</span> Великий Корабль
                                                                Названывич Второй
                                                            </div>
                                                            <div class="otziv__main__desc__item">
                                                                <span>Даты круиза:</span> 11.2018 - 11.2018
                                                            </div>
                                                            <div class="otziv__main__desc__item">
                                                                <span>Маршрут:</span> Хельсинки — Стогкольм —
                                                                Хельсинки...
                                                            </div>
                                                        </div>
                                                        <div class="otziv__main__text__descr">Давно выяснено, что при
                                                            оценке дизайна и композиции читаемый текст мешает
                                                            сосредоточиться. Lorem Ipsum используют потому . используют
                                                            потому...
                                                        </div>
                                                        <span class="otziv__main__text__link">Читать полностью</span>
                                                    </div>
                                                </div>
                                                <div class="otziv__popup"></div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="otziv__main__slide__item">
                                    <div class="cart__otziv__slide__wrap">
                                        <ul class="otziv__main__list">
                                            <li class="otziv__main__item clear">
                                                <div class="otziv__main__link">
                                                    <div class="otziv__main__text">
                                                        <div class="otziv__main__text__top">
                                                            <div class="otziv__main__img"
                                                                 style="background-image: url(images/251d2b42e31a5f104383829d8130cb9e-min.jpg);"></div>
                                                            <div class="otziv__main__text__title">Имя Фамилия</div>
                                                            <ul class="star__wrap">
                                                                <li class="star__item"><img src="images/new/star-y.svg"
                                                                                            alt=""></li>
                                                                <li class="star__item"><img src="images/new/star-y.svg"
                                                                                            alt=""></li>
                                                                <li class="star__item"><img src="images/new/star-y.svg"
                                                                                            alt=""></li>
                                                                <li class="star__item"><img src="images/new/star-y.svg"
                                                                                            alt=""></li>
                                                                <li class="star__item"><img src="images/new/star-y.svg"
                                                                                            alt=""></li>
                                                            </ul>
                                                        </div>
                                                        <div class="otziv__main__desc">
                                                            <div class="otziv__main__desc__item">
                                                                <span>Название корабля:</span> Великий Корабль
                                                                Названывич Второй
                                                            </div>
                                                            <div class="otziv__main__desc__item">
                                                                <span>Даты круиза:</span> 11.2018 - 11.2018
                                                            </div>
                                                            <div class="otziv__main__desc__item">
                                                                <span>Маршрут:</span> Хельсинки — Стогкольм —
                                                                Хельсинки...
                                                            </div>
                                                        </div>
                                                        <div class="otziv__main__text__descr">Давно выяснено, что при
                                                            оценке дизайна и композиции читаемый текст мешает
                                                            сосредоточиться. Lorem Ipsum используют потому . используют
                                                            потому...
                                                        </div>
                                                        <span class="otziv__main__text__link">Читать полностью</span>
                                                    </div>
                                                </div>
                                                <div class="otziv__popup"></div>
                                            </li>
                                            <li class="otziv__main__item clear">
                                                <div class="otziv__main__link">
                                                    <div class="otziv__main__text">
                                                        <div class="otziv__main__text__top">
                                                            <div class="otziv__main__img"
                                                                 style="background-image: url(images/251d2b42e31a5f104383829d8130cb9e-min.jpg);"></div>
                                                            <div class="otziv__main__text__title">Имя Фамилия</div>
                                                            <ul class="star__wrap">
                                                                <li class="star__item"><img src="images/new/star-y.svg"
                                                                                            alt=""></li>
                                                                <li class="star__item"><img src="images/new/star-y.svg"
                                                                                            alt=""></li>
                                                                <li class="star__item"><img src="images/new/star-y.svg"
                                                                                            alt=""></li>
                                                                <li class="star__item"><img src="images/new/star-y.svg"
                                                                                            alt=""></li>
                                                                <li class="star__item"><img src="images/new/star-y.svg"
                                                                                            alt=""></li>
                                                            </ul>
                                                        </div>
                                                        <div class="otziv__main__desc">
                                                            <div class="otziv__main__desc__item">
                                                                <span>Название корабля:</span> Великий Корабль
                                                                Названывич Второй
                                                            </div>
                                                            <div class="otziv__main__desc__item">
                                                                <span>Даты круиза:</span> 11.2018 - 11.2018
                                                            </div>
                                                            <div class="otziv__main__desc__item">
                                                                <span>Маршрут:</span> Хельсинки — Стогкольм —
                                                                Хельсинки...
                                                            </div>
                                                        </div>
                                                        <div class="otziv__main__text__descr">Давно выяснено, что при
                                                            оценке дизайна и композиции читаемый текст мешает
                                                            сосредоточиться. Lorem Ipsum используют потому . используют
                                                            потому...
                                                        </div>
                                                        <span class="otziv__main__text__link">Читать полностью</span>
                                                    </div>
                                                </div>
                                                <div class="otziv__popup"></div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <? } ?>
                <? if ($model->actions) { ?>
                    <div class="tabs__content__item">
                        <div class="cart__action__slide">
                            <div class="cart__action__slide__wrap">
                                <div class="cart-2 news__main--cart">
                                    <div class="news__main__title">
                                        <h2>Новости и акции</h2><a href="" class="news__main__title__link">все
                                            новости</a>
                                    </div>
                                    <ul class="news__main__list">
                                        <li class="news__main__item clear">
                                            <a href="" class="news__main__link">
                                                <div class="new__main__img"
                                                     style="background-image: url(/images/251d2b42e31a5f104383829d8130cb9e-min.jpg);"></div>
                                                <div class="news__main__text">
                                                    <div class="news__main__text__title">Заголовок новости один</div>
                                                    <div class="news__main__text__descr">Давно выяснено, что при оценке
                                                        дизайна и композиции читаемый текст мешает сосредоточиться.
                                                        Lorem Ipsum используют потому . используют потому...
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="news__main__item clear">
                                            <a href="" class="news__main__link">
                                                <div class="new__main__img"
                                                     style="background-image: url(/images/251d2b42e31a5f104383829d8130cb9e-min.jpg);"></div>
                                                <div class="news__main__text">
                                                    <div class="news__main__text__title">Заголовок новости два</div>
                                                    <div class="news__main__text__descr">Давно выяснено, что при оценке
                                                        дизайна и композиции читаемый текст мешает сосредоточиться.
                                                        Lorem Ipsum используют потому . используют потому...
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="news__main__item clear">
                                            <a href="" class="news__main__link">
                                                <div class="new__main__img"
                                                     style="background-image: url(/images/251d2b42e31a5f104383829d8130cb9e-min.jpg);"></div>
                                                <div class="news__main__text">
                                                    <div class="news__main__text__title">Заголовок новости три</div>
                                                    <div class="news__main__text__descr">Давно выяснено, что при оценке
                                                        дизайна и композиции читаемый текст мешает сосредоточиться.
                                                        Lorem Ipsum используют потому . используют потому...
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="cart-2 news__main--cart">
                                    <ul class="news__main__list">
                                        <li class="news__main__item clear">
                                            <a href="" class="news__main__link">
                                                <div class="new__main__img"
                                                     style="background-image: url(/images/251d2b42e31a5f104383829d8130cb9e-min.jpg);"></div>
                                                <div class="news__main__text">
                                                    <div class="news__main__text__title">Заголовок новости один</div>
                                                    <div class="news__main__text__descr">Давно выяснено, что при оценке
                                                        дизайна и композиции читаемый текст мешает сосредоточиться.
                                                        Lorem Ipsum используют потому . используют потому...
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="news__main__item clear">
                                            <a href="" class="news__main__link">
                                                <div class="new__main__img"
                                                     style="background-image: url(/images/251d2b42e31a5f104383829d8130cb9e-min.jpg);"></div>
                                                <div class="news__main__text">
                                                    <div class="news__main__text__title">Заголовок новости два</div>
                                                    <div class="news__main__text__descr">Давно выяснено, что при оценке
                                                        дизайна и композиции читаемый текст мешает сосредоточиться.
                                                        Lorem Ipsum используют потому . используют потому...
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="news__main__item clear">
                                            <a href="" class="news__main__link">
                                                <div class="new__main__img"
                                                     style="background-image: url(/images/251d2b42e31a5f104383829d8130cb9e-min.jpg);"></div>
                                                <div class="news__main__text">
                                                    <div class="news__main__text__title">Заголовок новости три</div>
                                                    <div class="news__main__text__descr">Давно выяснено, что при оценке
                                                        дизайна и композиции читаемый текст мешает сосредоточиться.
                                                        Lorem Ipsum используют потому . используют потому...
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                <? } ?>
            </div>
        </div>
        <div class="tabs__order__button hidden">Оформление заказа</div>

        <? $form = \yii\widgets\ActiveForm::begin([
            'id' => 'order-form',
            'options' => ['class' => ''],
            'action' => '#'
        ]);
        $newOrder = new \common\models\Order();

        ?>
        <div class="cart__form">
            <div class="cart__form__title">
                Оставить заявку на круиз
            </div>
            <div class="block__flex clear" id="order">
                <div class="cart__form__left">
                    <div class="cart__form__left__wrap">
                        <div class="cart__form__title__small">Возраст пассажиров</div>
                        <div class="cart__form__select  block__flex">
                            <div class="cart__select  block__flex">
                                <div class="cart__label">Взрослые</div>
                                <div class="custom-select">
                                    <select name="ads" id="ads">
                                        <option value=""></option>
                                        <option value="1">1</option>
                                        <option value="2" selected="">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6 и более</option>
                                    </select>
                                </div>
                            </div>
                            <div class="cart__select block__flex">
                                <div class="cart__label">Подростки 12-18 лет</div>
                                <div class="custom-select">
                                    <select name="ch1" id="ch1">
                                        <option value="">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6 и более</option>
                                    </select>
                                </div>
                            </div>
                            <div class="cart__select block__flex">
                                <div class="cart__label">Дети (1-12 лет)</div>
                                <div class="custom-select">
                                    <select name="ch2" id="ch2">
                                        <option value="">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="cart__select block__flex">
                                <div class="cart__label">Младенцы (6 мес. - 1 год)</div>
                                <div class="custom-select">
                                    <select name="inf" id="inf">
                                        <option value="">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="cart__form__title__small cart__form__title__small--m">В комментарии оставьте Ваши
                            вопросы и пожелания
                        </div>
                        <div class="cart__textarea">
                            <label for="text">Ваш комментарий</label>
                            <? /* $form->field($newOrder, 'commet')->textarea([
                                            'placeholder' => 'Добавьте свой комментарий',
                                            'rows' => 10, 'cols' => 30])->label('Ваш комментарий'); */ ?>
                            <textarea id="comment" name="Order[commet]" id="text" cols="30" rows="10"
                                      placeholder="Добавьте свой комментарий"></textarea>
                        </div>
                        <div class="cart__button clear hidden">

                            <div class="cart__button__mobile">Предварительный расчет</div>
                        </div>
                    </div>
                </div>
                <div class="cart__form__right">
                    <div class="cart__form__left__wrap cart__form__left__wrap--right">
                        <div class="cart__check__table hidden">
                            <div class="cart__check">
                                <label>
                                    <input class="checkbox" type="checkbox" checked="checked"
                                           onclick='window.event.returnValue=false'>
                                    <span class="checkbox-custom"></span>
                                    <span class="label">Круиз <?= $model->title ?></span>
                                </label>
                            </div>
                            <div class="cart__check__price">
                                <?= $model->price_rub ?> руб.
                            </div>
                        </div>
                        <div style="display:none;" class="cart__check__table">
                            <div class="cart__check">
                                <label>
                                    <input class="checkbox" type="checkbox" checked="checked">
                                    <span class="checkbox-custom"></span>
                                    <span class="label">Перелет Петербурга - Хельсинки</span>
                                </label>
                            </div>
                            <div class="cart__check__price">
                                99000
                            </div>
                        </div>
                        <div style="display:none;" class="cart__check__table">
                            <div class="cart__check">
                                <label>
                                    <input class="checkbox" type="checkbox">
                                    <span class="checkbox-custom"></span>
                                    <span class="label">Подобрать перелет</span>
                                </label>
                            </div>
                            <div class="cart__check__price">
                                99000
                            </div>
                        </div>
                        <div style="display:none;" class="cart__check__table">
                            <div class="cart__check">
                                <label>
                                    <input class="checkbox" type="checkbox" checked="checked">
                                    <span class="checkbox-custom"></span>
                                    <span class="label">Экскурсии</span>
                                </label>
                            </div>
                            <div class="cart__check__price">
                                99000
                            </div>
                        </div>
                        <div style="display:none;" class="cart__check__table">
                            <div class="cart__check cart__check--ch">
                                <label>
                                    <input class="checkbox" type="checkbox" checked="checked">
                                    <span class="checkbox-custom"></span>
                                    <span class="label">Стокгольм обзорная</span>
                                </label>
                            </div>
                            <div class="cart__check__price">
                                99000
                            </div>
                        </div>
                        <div style="display:none;" class="cart__check__table">
                            <div class="cart__check cart__check--ch">
                                <label>
                                    <input class="checkbox" type="checkbox" checked="checked">
                                    <span class="checkbox-custom"></span>
                                    <span class="label">Таллия Тайны старого города</span>
                                </label>
                            </div>
                            <div class="cart__check__price">
                                99000
                            </div>
                        </div>
                        <div class="cart__sum hidden">
                            <div class="cart__check__table">
                                <div class="cart__sum__text">Итоговая стоимость</div>
                                <div class="cart__sum__price">
                                    <?= $model->price_rub ?> руб.
                                </div>
                            </div>
                            <!--                                    <input type="submit" class="cart__sum__button" value="Оформить заказ с помощью менеджера">-->
                        </div>

                        <div class="contact__form" style="">
                            <div class="contact__form__title">Отправить запрос</div>
                            <input type="hidden" value="" id="cabin-id" name="Order[cabin_id]">
                            <input type="text" id="fio" name="Order[fio]" placeholder="Имя и Фамилия"
                                   class="contact__input">
                            <input type="tel" id="order-form-phone" name="Order[phone]" placeholder="Номер телефона"
                                   class="contact__input">
                            <input type="email" id="order-form-email" name="Order[email]" placeholder="Email"
                                   class="contact__input">
                            <input type="hidden" id="cruise_id" name="Order[cruise_id]" value="<?= $model->ID ?>">
                            <? /* div style="display: none" class="cart__textarea cart__textarea--contact">
                                            <label for="text">Заголовок</label>
                                            <textarea name="" id="text" cols="30" rows="10" placeholder="Добавьте свой комментарий"></textarea>
                                        </div */ ?>
                            <div style="height: 20px;">
                                <span id="order-form-error" style="display: none; color: red">Заполните контактные данные</span>
                            </div>

                            <div class="politica">
                                <label>
                                    <input class="checkbox" checked required type="checkbox" id="checkPolicy">
                                    <span class="checkbox-custom"></span>
                                    <span class="label">Согласен на обработку персональных данных</span>
                                </label>
                            </div>
                            <input type="submit" onclick="yaCounter1569775.reachGoal('zakaz_button'); return true;" value="Отправить" class="form__button__contact">
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php \yii\widgets\ActiveForm::end() ?>

        <div style="width: 100%; margin-top: 60px;">
            <?= ListView::widget([
                'dataProvider' => $dataProvider_similar,
                'options' => [
                    'tag' => false
                ],
                'itemOptions' => [
                    'tag' => false
                ],
                'itemView' => '_cruise',
                'layout' => "<div class=\"search__result__top block__flex block__flex--space\" style=\"margin-bottom: 120px;\">
                    <h1 style='width: 300px'>Похожие круизы</h1>
                    
					<ul class=\"block__flex card__bottom__list owl-carousel owl-theme\">{items}</ul>
					<div style=\"margin-top: 30px; text-align: center; width: 100%;\"><a style=\"text-align: center;\" class=\"button form__result__item__right-button\" href=\"/search/?" . $link_similar . "\">Показать все</a></div>
                    ",
            ]); ?>
        </div>
</section>

<section class="page card__bottom" style="display: none">
    <div class=" wrap">
        <h2>Похожие круизы</h2>
        <ul class="block__flex card__bottom__list">
            <li class="sale__item clear">
                <div class="sale__popular"><span>%</span></div>
                <div class="sale__social">
                    <a href="" class="sale__social__item sale__social__item--active"></a>
                    <a href="" class="sale__social__item sale__social__item--active"></a>
                    <a href="" class="sale__social__item sale__social__item--active"></a>
                </div>
                <div class="sale__date__cal">11.11.2018 - 25.11.2018 15 ночей</div>
                <div class="sale__title">Лучезарный вояж, MAASDAM - премиум, Holland America Line</div>
                <div class="sale__item__component">
                    <div class="sale__item__left">
                        <div class="sale__img">
                            <div class="sale__img__wrap"
                                 style="background-image: url(/images/251d2b42e31a5f104383829d8130cb9e-min.jpg);"></div>
                            <div class="sale__img__sale">-40%</div>
                        </div>
                        <div class="form__result__item__bottom sale__bottom__result">
                            <ul class="form__result__item__bottom__wrap__list">
                                <li class="form__result__item__bottom__list">
                                    <img src="/images/ship.svg" alt="">
                                    <div class="form__result__item__bottom__popup">Полный пансион</div>
                                </li>
                                <li class="form__result__item__bottom__list">
                                    <img src="/images/ship.svg" alt="">
                                    <div class="form__result__item__bottom__popup">Завтраки</div>
                                </li>
                                <li class="form__result__item__bottom__list">
                                    <img src="/images/ship.svg" alt="">
                                </li>
                                <li class="form__result__item__bottom__list">
                                    <img src="/images/ship.svg" alt="">
                                </li>
                                <li class="form__result__item__bottom__list">
                                    <img src="/images/ship.svg" alt="">
                                </li>
                            </ul>
                            <div class="form__result__item__button">
                                <a href="" target="_blank">Отзывы</a>
                                <a href="" target="_blank">Скачать PDF</a>
                            </div>
                        </div>
                    </div>
                    <div class="sale__item__right">
                        <div class="sale__text">
                            <div class="sale__title__wrap">
                                <div class="sale__tur">Хельсинки — Стогкольм — Хельсинки — Хельсинки ... Хельсинки —
                                    Стогкольм — Хельсинки — Хельсинки ...Хельсинки — Стогкольм — Хельсинки — Хельсинки
                                    ...Хельсинки — Стогкольм — Хельсинки — Хельсинки ...
                                </div>
                            </div>
                            <div class="form__result__item__text__list__wrap block__flex">
                                <div class="form__result__item__text__list sale__date__name">Посмотреть на карте</div>
                                <div class="form__result__item__text__list sale__date__history">История, Архетектура
                                </div>
                                <div class="form__result__item__text__list sale__date__map">Средиземное море</div>
                            </div>
                            <div class="sale__bottom clear">
                                <div class="sale__price">
                                    <div class="sale__price__wrap">
                                        <span>от 6 000 000 руб</span>
                                        <span>от 6 000 000 $</span>
                                    </div>
                                    <div class="button sale__price--button">Подробнее</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="sale__item clear">
                <div class="sale__popular"><img src="/images/new/gift.svg" alt=""></div>
                <div class="sale__social">
                    <a href="" class="sale__social__item"></a>
                    <a href="" class="sale__social__item"></a>
                    <a href="" class="sale__social__item"></a>
                </div>
                <div class="sale__date__cal">11.11.2018 - 25.11.2018 15 дней</div>
                <div class="sale__title">Лучезарный вояж, 15 дн. MAASDAM - премиум, Holland America Line</div>
                <div class="sale__item__component">
                    <div class="sale__item__left">
                        <div class="sale__img">
                            <div class="sale__img__wrap"
                                 style="background-image: url(/images/251d2b42e31a5f104383829d8130cb9e-min.jpg);"></div>
                            <div class="sale__img__sale">Подарок</div>
                        </div>
                        <div class="form__result__item__bottom">
                            <ul class="form__result__item__bottom__wrap__list">
                                <li class="form__result__item__bottom__list">
                                    <img src="/images/ship.svg" alt="">
                                    <div class="form__result__item__bottom__popup">Полный пансион</div>
                                </li>
                                <li class="form__result__item__bottom__list">
                                    <img src="/images/ship.svg" alt="">
                                    <div class="form__result__item__bottom__popup">Завтраки</div>
                                </li>
                                <li class="form__result__item__bottom__list">
                                    <img src="/images/ship.svg" alt="">
                                </li>
                                <li class="form__result__item__bottom__list">
                                    <img src="/images/ship.svg" alt="">
                                </li>
                                <li class="form__result__item__bottom__list">
                                    <img src="/images/ship.svg" alt="">
                                </li>
                            </ul>
                            <div class="form__result__item__button">
                                <a href="" target="_blank">Отзывы</a>
                                <a href="" target="_blank">Скачать PDF</a>
                            </div>
                        </div>
                    </div>
                    <div class="sale__item__right">
                        <div class="sale__text">
                            <div class="sale__title__wrap">
                                <div class="sale__tur">Хельсинки — Стогкольм — Хельсинки — Хельсинки ...</div>
                            </div>
                            <div class="form__result__item__text__list__wrap block__flex">
                                <div class="form__result__item__text__list sale__date__name">Посмотреть на карте</div>
                                <div class="form__result__item__text__list sale__date__history">История, Архетектура
                                </div>
                                <div class="form__result__item__text__list sale__date__map">Средиземное море</div>
                            </div>
                            <div class="sale__bottom clear">
                                <div class="sale__price">
                                    <div class="sale__price__wrap">
                                        <span>от 6 000 000 руб</span>
                                        <span>от 6 000 000 $</span>
                                    </div>
                                    <div class="button sale__price--button">Подробнее</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</section>
<? $script = <<< JS
	$('#checkPolicy').change(function(e) {
		if(!$(this).is(":checked")) {
            // var returnVal = confirm("Are you sure?");
			// $(this).attr("checked", returnVal);
			$('.form__button__contact').attr('disabled', 'disabled')
        } else {
			$('.form__button__contact').removeAttr('disabled')
		} 
	});
	let counter = 0;
	$('#order-form').submit( function (e) {		
		e.preventDefault();

		let cruise_id = $('#cruise_id').val();
		let phone=$('#order-form-phone').val();
		let email=$('#order-form-email').val();
		let fio=$('#fio').val();
		let comment=$('#comment').val();
		
		let ads=$('#ads  option:selected').text();
		let ch1=$('#ch1  option:selected ').text();	
		let ch2=$('#ch2  option:selected ').text();
		let inf=$('#inf  option:selected ').text();

		if(!phone.length && !email.length) {
			
			$('#order-form-phone').css('border-color','red');
			$('#order-form-email').css('border-color','red');
			$('#order-form-error').show();
		}
		else {
			$('#order-form-phone').css('border-color','#D8D6BC');
			$('#order-form-email').css('border-color','#D8D6BC');
			$('#order-form-error').hide();
			
			$('.form__button__contact').attr('disabled', 'disabled')
			$('.form__button__contact').val('Отправка...')
			
			if (counter == 0) {
			$.ajax({
				method: "POST",
				url: "/order/create/",
				data: 
					{
						ads,
						ch1,
						ch2,
						inf,
						Order: {
							phone, 
							email,
							fio,
							cruise_id,
							comment
						}
					}
				})
				.done(function( msg ) {
					const md = '#orderSuccess';
					$(md).modal();	
					$('.form__button__contact').val('Заявка отправлена')				
				});			
				counter++;
			}
			// }
		}
		return false;
	});
JS;
$this->registerJs($script, yii\web\View::POS_READY); ?>
<script src="https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="https://yastatic.net/share2/share.js"></script>

<?
// $subject = "=?UTF-8?B?" . base64_encode('Мне понравился этот круиз от AstartaGroup') . "?=";
$subject = "AstartaGroup";
?>

<div id="dialog-share" style="display: none">
    <div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,twitter,viber,whatsapp,skype,telegram"
         style="display: inline-block"></div>
    <a href="mailto:?subject=<?= $subject ?>&amp;&body=https://astartagroup.ru/cruise/<?= $model->ID ?>"
       title="Share by Email" style="
    line-height: 24px;
    font-size: 24px;
    width: 24px;
    height: 24px;
    /* padding: 1px; */
    text-align: center;
    background-color: #ffffff;
    display: inline-block;
    top: 8px;
    position: relative;
    border-radius: 2px;
">
        <img src="/upd/images/email.png" style="
    width: 14px;
">
    </a>
</div>

<div id="dialog-wishlist" style="display: none; text-align: center;">
    <p><b>Круиз добавлен в избранное.</b></p>

    <p>Перейти в <a href="/wishlist/">избранное</a></p>
</div>

<div id="dialog-cost" style="display: none">
    <p class="desc_before">Оставьте пожелания, и наши менеджеры подберут для вас подходящий круиз:</p>

    <form action="" id="sendCost">
        <div class="wrap_form">

			<span class="row">
				<span class="lable">Имя:<sup>*</sup></span>
				<input type="text" id="name">
				<div id="name__err" class="error-information">Укажите имя</div>
			</span>


            <span class="row">
				<span class="lable">Email:<sup>*</sup></span>
				<input type="email" id="email">
			</span>

            <span class="row">
				<span class="lable">Tелефон:</span>
				<input type="phone" id="phone">
				<div id="email_phone__err" class="error-information">Укажите почту или телефон</div>
			</span>

            <span class="row">
				<span class="lable">Кол-во взрослых:<sup>*</sup></span>
				<input type="number" id="adult">
				<div id="adult__err" class="error-information">Укажите кол-во взрослых</div>
			</span>

            <span class="row">
				<span class="lable">Кол-во детей(0-2 года):</span>
				<input type="number" id="child_1">
			</span>
            <span class="row">
				<span class="lable">Кол-во детей(2-12 лет):</span>
				<input type="number" id="child_1">
			</span>
            <span class="row">
				<span class="lable">Кол-во детей(12-18 лет):</span>
				<input type="number" id="child_3">
			</span>
            <span class="lable">Комментарий:</span><br/>
            <textarea type="text" id="comment"></textarea><br/>

            <span class='footnote'><sup>*</sup> поля обязательные к заполнению
        </div>

        <div class="success">
            <p><b>Cпасибо, заявка отправлена!</b></p>
            <br>
            <p>Наши менеджеры свяжутся с Вами в ближайшее время.</p>
        </div>
    </form>


</div>

<div id="dialog-download" style="display: none; text-align: center;">
    <p><b>Загрузка pdf-версии круиза началась</b></p>
    <p>Ожидайте...</p>
</div>

<div class="test" style="width: 100%; height: 1px; overflow: hidden">
    <div id="pdf" style="width: 750px; height: 1240px;">
        <div style="text-align: center; padding: 40px;">
            <img src="/images/logo.svg" alt="Лого">
        </div>
        <div style="text-align: center; padding: 20px;">
            <h1 class="h1__small"><?= $model->title ?></h1>
        </div>
        <div style="padding: 20px;">
            <h2 class="h2__page" style="font-size: 18px;">Маршрут:</h2>
            <p style="font-size: 14px;"><?= $model->fullItinerary ?></p>
        </div>

        <div style="padding: 20px;">
            <h2 class="h2__page" style="font-size: 18px;">Круизная компания:</h2>
            <p style="font-size: 14px;"><?= $companyModel->name ?></p>
        </div>

        <div style="padding: 20px;">
            <h2 class="h2__page" style="font-size: 18px;">Лайнер:</h2>
            <p style="font-size: 14px;"><?= $model->ship->name ?></p>
        </div>
    </div>
</div>