<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 25.11.2018
 * Time: 15:50
 */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;
if($model->image && $model->image->name) {
    $imageSrc = $model->image->subdir . "/" . $model->image->name;
}
else {
    //$imageSrc = "/images/cart/cart.jpg";
    $imageSrc = "/images/i_special/logo_news.png";
}
?>
<a href="/news/<?=$model->ID?>/" class="action__page__item__link">
    <div class="action__page__img" style="background-image: url('<?=$imageSrc?>')"></div>
    <div class="action__page__text">
        <div class="action__page__title"><?=$model->title?></div>
        <div class="action__page__descr"><?=$model->preview?>...</div>
        <? if($model->dates) {?>
        <div class="action__page__date">
            <?=$model->dates?>
        </div>
        <?}?>
    </div>
</a>