<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 25.11.2018
 * Time: 15:57
 */
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="otziv__main" onclick="javascript: return false;">
	<?if(@$model->image->src) {?>
        <div class="otziv__main__img" style="background-image: url(<?=$model->image->src?>);"></div>
	<?}?>
    <div class="otziv__main__text">
        <div class="otziv__main__text__title"><?=@$model->user->username?$model->user->username:$model->title?></div>
        <div class="otziv__main__text__descr"><?=$model->description?></div>
    </div>
</div>
