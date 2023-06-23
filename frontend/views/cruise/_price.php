<?php

/**
 * Created by PhpStorm.
 * User: a.serebryakov
 * Date: 20.02.2019
 * Time: 21:04
 */
if (@$model->cabin->cabinGroup && @$model->cabin->cabinGroup->image->src) {
    $cabinImg = $model->cabin->cabinGroup->image->src;
} elseif ($model->cabin->image && $model->cabin->image->src) {
    $cabinImg = $model->cabin->image->src;
} else {
    $cabinImg = "/images/cart/tur.jpg";
}
if ($model->value && $model->currency) {
    // $rate = Yii::$app->options->{"cbrf_".(string)$model->currency};
}

?>
<!-- <a href="#" onclick="document.location.href='#cabin<?= $model->cabin->ID ?>'" class="card__right__tur__item cart-2 block__flex"> -->
<a href="#" onclick="document.location.href='#cabins'" class="card__right__tur__item cart-2 block__flex">
    <!-- <a href="#" onclick="document.location.href='#order-form'" class="card__right__tur__item cart-2 block__flex"> -->
    <div class="card__right__tur__item__wrap block__flex">
        <div class="card__right__tur__item__img" style="background-image: url(<?= $cabinImg ?>);"></div>
        <div class="card__right__tur__item__text">
            <div class="card__right__tur__item__title">
                <?= $model->cabin->name ?>
            </div>
            <div class="card__right__tur__item__price" style="display: none;">
                <div class="card__right__tur__item__price"> <?= number_format($model->value, 0, '.', ' ') ?> <?= $model->symbol ?>
                    <?if(@$model->del){?>
                    <del><?= $model->del ?></del>
                    <?}?>
                </div>
                <?if(@$model->rub){?>
                <div class="card__right__tur__item__price__1">/ <?= number_format($model->rub, 0, '.', ' ') ?><strike>P</strike></div>
                <?}?>
            </div>
        </div>
    </div>
</a>