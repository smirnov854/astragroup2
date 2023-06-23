<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 25.11.2018
 * Time: 12:57
 */
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<div class="banner__item" style="background-image:url(<?=$model->image->subdir.'/'.$model->image->name?>">
    <div class="wrap clear">
        <div class="banner__right">
            <div class="banner__left__slick">
                <div class="banner__left__slick__item">
                    <div class="banner__title"><?=$model->title?></div>
                    <div class="banner__text"><?=$model->preview?>...</div>
                    <div class="button banner__button" onclick="window.location='<?=$model->link?>'">Подробнее</div>
                </div>
            </div>
        </div>
    </div>
</div>
