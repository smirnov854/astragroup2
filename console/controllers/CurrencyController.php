<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 01.12.2018
 * Time: 8:59
 */

namespace console\controllers;

use Yii;

error_reporting(0);
set_time_limit(0);

class CurrencyController extends \yii\console\Controller
{
    public function actionIndex()
    {
        $arCurrency = Yii::$app->CbRF->filter(['currency' => "USD,EUR"])->all();
        print_r($arCurrency);
        Yii::$app->options->cbrf_USD = (string)$arCurrency["USD"]["value"];
        Yii::$app->options->cbrf_EUR = (string)$arCurrency["EUR"]["value"];
        return true;
    }
}