<?php


namespace console\controllers;


use common\models\Cruise;
use common\models\CruiseSearch;

class TestController extends \yii\console\Controller
{
	public function actionIndex()
	{
		$obCruises = new CruiseSearch();
		$query = $obCruises->silver_query([]);
		$provider = new ArrayDataProvider([
			'allModels' => $query->all(),
			'sort' => [
				'attributes' => ['ID', 'name'],
			],
			'pagination' => [
				'pageSize' => 10,
			],
		]);
		return;
		$arCruises = $provider->getModels();
		print_r($arCruises);
	}
}