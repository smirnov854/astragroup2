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
?>
<a href="/news/<?=$model->ID?>/" class="news__main__link">
    <div class="new__main__img" style="background-image: url('<?=@$model->image->src?>');"></div>
    <div class="news__main__text">
        <div class="news__main__text__title"><?=$model->title?></div>
        <div class="news__main__text__descr">
            <?=$model->preview?>...
        </div>
    </div>
</a>