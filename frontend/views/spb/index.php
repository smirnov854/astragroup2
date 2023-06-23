<?php

/* @var $this yii\web\View */
/* @var $bannerProvider */
/* @var $seaCruises */
/* @var $riverProvider */
/* @var $paromProvider */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\ListView;

$this->title = 'Круизы из Санкт-Петербурга';
?>
<section class="breadcrumbs">
    <?= \yii\widgets\Breadcrumbs::widget([
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
<section class="page__menu">
    <div class="wrap">
        <div class="page__menu__wrap">
            <h1 class="page__menu__title"><?= $this->title ?></h1>
        </div>
    </div>
</section>
<? // if () {?>

        <?= ListView::widget([
            'dataProvider' => $bannerProvider,
            'options' => [
                'tag' => 'div',
                'class' => 'banner__wrap 1'
            ],
            'itemOptions' => [
                'tag' => false
            ],
            'itemView' => '_banner',
            'emptyText' => false,
            'layout' => "<section class=\"banner banner__sbp\">
    <div class=\"banner__wrap\">{items}</div>
</section>",
        ]); ?>

<section class="spb__direction kruiz__title">
    <div class="wrap">
        <div class="spb__direction__list">
            <a href="/search/?types=&types[]=1&dep_ports[]=4092" class="spb__direction__item cart-3">
                <div class="spb__direction__title">Морские круизы из СПБ</div>
                <div class="spb__direction__img">
                    <div class="spb__direction__img__wrap" style="background-image: url(/i_spb/sea.jpg);">
                    </div>
                </div>
                <div class="spb__direction__descr">
	                Морские круизы из Петербурга по фьордам и Северной Европе на современных круизных лайнерах
                </div>
            </a>
            <a href="/search/?types=&types[]=2&dep_ports[]=4092" class="spb__direction__item cart-3">
                <div class="spb__direction__title">Речные круизы из СПБ</div>
                <div class="spb__direction__img">
                    <div class="spb__direction__img__wrap" style="background-image: url(/i_spb/river.jpg);">
                    </div>
                </div>
                <div class="spb__direction__descr">
	                Речные круизы из Петербурга по рекам России: старинные города и монастыри, удивительные пейзажи и комфортный отдых
                </div>
            </a>
            <a href="/search/?types=&types[]=4&dep_ports[]=4092" class="spb__direction__item cart-3">
                <div class="spb__direction__title">Автобус и паром из СПБ</div>
                <div class="spb__direction__img">
                    <div class="spb__direction__img__wrap" style="background-image: url(/i_spb/parom.jpg);">
                    </div>
                </div>
                <div class="spb__direction__descr">
	                Автобусно-паромные туры из Петербурга в Прибалтику и Скандинавию на паромах Viking Line, Tallink Silja и Принцесса Анастасия
                </div>
            </a>
        </div>
    </div>
</section>
<section class="spb__kruiz kruiz__title">
    <div class="wrap">
        <div class="spb__direction__list spb__kruiz__list">
            <div class="spb__kruiz__item cart-3">
                <h2>Морские круизы</h2>
                <?= ListView::widget([
                    'dataProvider' => $seaCruises,
                    'options' => [
                        'tag' => false,
                    ],
                    'itemOptions' => [
                        'tag' => false
                    ],
                    'itemView' => '_cruise',
                    'emptyText' => false,
                    'layout' => "{items}",
                ]); ?>
                <a href="/search/?types=&types[]=1&dep_ports[]=4092" class="sale__more--spb">Смотреть все варианты</a>
            </div>

            <div class="spb__kruiz__item cart-3">
                <h2>Подборка речных круизов</h2>
				<?= ListView::widget([
					'dataProvider' => $riverProvider,
					'options' => [
						'tag' => false,
					],
					'itemOptions' => [
						'tag' => false
					],
					'itemView' => '_cruise',
					'emptyText' => false,
					'layout' => "{items}",
				]); ?>
                <a href="/search/?types=&types[]=2&dep_ports[]=4092" class="sale__more--spb">Смотреть все варианты</a>
            </div>
            <div class="spb__kruiz__item cart-3">
                <h2>Подборка автобусно-паромных туров</h2>
				<?= ListView::widget([
					'dataProvider' => $paromProvider,
					'options' => [
						'tag' => false,
					],
					'itemOptions' => [
						'tag' => false
					],
					'itemView' => '_cruise',
					'emptyText' => false,
					'layout' => "{items}",
				]); ?>
                <a href="/search/?types=&types[]=4&dep_ports[]=4092" class="sale__more--spb">Смотреть все варианты</a>
            </div>
        </div>
    </div>
</section>