<?php

/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 19.11.2018
 * Time: 10:56
 */

namespace frontend\controllers;

use common\models\Company;
use common\models\Country;
use common\models\Cruise;
use common\models\Port;
use common\models\PortSearch;
use common\models\Ship;
use Yii;
use yii\base\InvalidParamException;
use yii\data\ActiveDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\CruiseSearch;
use common\models\CompanyType;
use common\models\Region;
use Faker\Provider\ar_JO\Person;
use yii\helpers\ArrayHelper;

class SearchController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        $searchModel = new CruiseSearch();
        $searchParams = Yii::$app->request->get();
        $cruiseProvider = $searchModel->search($searchParams);
        $cruiseProvider->query->count();
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
            //			[
            //				'class' => 'yii\filters\PageCache',
            //				'only' => ['index'],
            //				'duration' => 60,
            //				'variations' => [
            //					\Yii::$app->language,
            //				],
            //				'dependency' => [
            //					'class' => 'yii\caching\DbDependency',
            //					'sql' => $cruiseProvider->query->createCommand()->rawSql,
            //				],
            //			],
        ];
    }

    public function actionIndex()
    {
        // echo 2;
        $searchModel = new CruiseSearch();
        $searchParams = Yii::$app->request->get();
        $dateRequired = false;


        // echo '<pre style="display: block; position: absolute; top: 5px; width: 100%; background: gray;">';
        // print_r($searchParams);
        // echo '</pre>';

        if (
            @$searchParams["date_from"] == '' ||
            @$searchParams["date_to"] == ''
        ) {
            //$dateRequired = true;
            //$searchParams["date_from"] = date("Y-m-d", strtotime(date("Y-m-d") . ' +1 days'));
            //$searchParams["date_to"] = date("Y-m-d", strtotime(date("Y-m-d") . ' + 5 years'));
            // $searchParams["date_to"] = date("Y-m-d", strtotime(date("Y-m-d") . ' + 5 days'));
        } else {
            $dateRequired = true;
        }

        // echo '<pre>';
        // print_r($searchParams);
        // echo '<pre>';

        $dataProvider = $searchModel->search($searchParams);
        $searchModel1 = new CruiseSearch();
        $arCompanies = $searchModel1->companies($searchParams);
        $searchModel2 = new CruiseSearch();
        $arCountries = $searchModel2->countries($searchParams);
        $searchModel3 = new CruiseSearch();
        $arRtPorts = $searchModel3->route_ports($searchParams);
        $searchModel4 = new CruiseSearch();
        $arDpPorts = $searchModel4->deprt_ports($searchParams);
        $searchModel5 = new CruiseSearch();
        $arShips = $searchModel5->ships($searchParams);
        $searchModel6 = new CruiseSearch();
        $arTypes = $searchModel6->companyTypes($searchParams);

        $searchParamsRegionHack = $searchParams;
        unset($searchParamsRegionHack['regions']);
        $searchModel7 = new CruiseSearch();
        $arRegions = $searchModel7->regions($searchParamsRegionHack);
        // $arRegions = $searchModel7->regions($searchParams);


        $searchModel8 = new CruiseSearch();
        $arDates = $searchModel8->dates($searchParams);
        $searchModel9 = new CruiseSearch();
        $arLengs = $searchModel9->lengs($searchParams);
        $searchMode20 = new CruiseSearch();
        $arPrices = $searchMode20->prices($searchParams);
        $searchMode21 = new CruiseSearch();
        $Spec = $searchMode21->specials($searchParams);

        $modelCruise = new CruiseSearch();
        $modelCruise->load(Yii::$app->request->get());
        $this->view->params["breadcrumbs"] = [
            [
                'label' => 'Поиск круизов',  // required
                'class' => 'breadcrumbs__link'
            ]
        ];

        return $this->render('index', [
            'short' => (count($searchParams) == 0 ? true : false),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'types' => $arTypes,
            'arRegions' => $arRegions,
            'arRtPorts' => $arRtPorts,
            'arDpPorts' => $arDpPorts,
            'arShips' => $arShips,
            'arCountries' => $arCountries,
            'arCompanies' => $arCompanies,
            'modelCruise' => $modelCruise,
            'arDates' => $arDates,
            'arLengs' => $arLengs,
            'arPrices' => $arPrices,
            'spec' => $Spec,
            'dateReq' => $dateRequired
        ]);
    }
    public function actionLists($column)
    {
        $where = Yii::$app->request->post("CruiseSearch");
        $obCruise = Cruise::find()->select([$column])->where($where)->asArray->all();
        return ArrayHelper::map($obCruise, "ID", "name");
    }
}
