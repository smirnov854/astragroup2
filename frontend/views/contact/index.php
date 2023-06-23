<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\ListView;
$this->title = 'Контакты';
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
<section class="spb__kruiz kruiz__title">
    <div class="wrap">
        <h2><?=$this->title?></h2>
        <div class="contact__wrap">
            <div class="contact__wrap__left">
                <ul class="contact__wrap__tel">
                    <li class="contact__wrap__tel__item">
                        <a href="tel:<?=preg_replace("/[^0-9]/", '', Yii::$app->options->header_spbphone);?>" class="contact__wrap__tel__link">
                            <?=Yii::$app->options->header_spbphone?>
                        </a>
                        <span><?=Yii::$app->options->header_spbaddr?></span>
                    </li>
                    <!--
                    <li class="contact__wrap__tel__item">
                        <a href="tel:<?=preg_replace("/[^0-9]/", '', Yii::$app->options->header_mskphone);?>" class="contact__wrap__tel__link">
                            <?=Yii::$app->options->header_mskphone?>
                        </a>
                        <span><?=Yii::$app->options->header_mskaddr?></span>
                    </li>
                    -->
                    <li class="contact__wrap__tel__item">
                        <a href="tel:<?=preg_replace("/[^0-9]/", '', Yii::$app->options->header_800phone);?>" class="contact__wrap__tel__link">
                            <?=Yii::$app->options->header_800phone?>
                        </a>
                        <span>Звонок для регионов бесплатный</span>
                    </li>
                </ul>
                <div class="contact__pay">
                    <h3>Способ оплаты</h3>
                    <div class="contact__pay_text">
                        <?=$text->description?>
                    </div>
                </div>
                <div class="contact__form" style="display: none">
                    <div class="contact__form__title">Форма для экстренной связи</div>
                    <form action="">
                        <input type="text" placeholder="Имя и Фамилия" class="contact__input">
                        <input type="tel" placeholder="Номер телефона" class="contact__input">
                        <div class="cart__textarea cart__textarea--contact">
                            <!-- label for="text">Заголовок</label -->
                            <textarea name="" id="text" cols="30" rows="10" placeholder="Добавьте свой комментарий"></textarea>
                        </div>
                        <input type="submit" value="Отправить" class="form__button__contact">
                    </form>
                </div>
            </div>
            <div class="contact__wrap__right">
                <?
                foreach($ofices as $ofice) { ?>
                    <div class="contact__wrap__right__top">
                        <div class="contact__wrap__right__title"><?=$ofice->name?></div>
	                    <?if($ofice->ID == 2){?>
		                    <span>только по предварительной договорённости</span>
	                    <?}?>
                        <div class="contact__wrap__right__wrap">
                            <div class="contact__wrap__right__wrap__adress">
                                <div class="contact__wrap__right__item">
                                    <h3>График работы офиса:</h3>
                                    <?=$ofice->time?>
                                </div>
                                <div class="contact__wrap__right__item">
                                    <h3>Адрес офиса:</h3>
                                    <?=$ofice->addr?>
                                </div>
                            </div>
                            <div class="contact__map">
                                <script type="text/javascript" charset="utf-8" async src="<?=$ofice->map?>"></script>
                            </div>
                        </div>
                    </div>
                <?}?>
            </div>
        </div>
        <div class="contact__bottom">
            <h2>Наше руководство</h2>
            <div class="person">
                <div class="person__item">
                    <? $cnt = count($command)-2; foreach($command as $key => $member) { ?>
                        <div class="person__item__text">
                            <span><?=$member->name?></span> - <?=$member->role?>,<br>
                            <?=$member->contact?>
                        </div>
                        <? if ($key<$cnt && $key%2) {?>
                </div>
                <div class="person__item">
                        <?}?>
                    <?}?>
                </div>
            </div>
        </div>
    </div>
</section>
