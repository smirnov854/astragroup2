<?php
namespace frontend\controllers;

use common\models\BannerSearch;
use common\models\CompanyType;
use common\models\Cruise;
use common\models\CruiseSearch;
use common\models\NewsSearch;
use common\models\Page;
use common\models\Region;
use common\models\ReviewSearch;
use common\models\CompanyTypeSearch;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Page controller
 */
class PageController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
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
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays 404 page.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index', []);
    }
    /**
     * Displays page by alias
     * or redirect to 404
     * @return mixed
     */
    public function actionView($alias) {
        $obPage = Page::findOne(["alias"=>$alias]);
        $alias == "cruise";
		switch ($alias) {
			case "cruise":
				$searchParams = ["types"=>[1]];
				break;
			case "river":
				$searchParams = ["types"=>[2]];
				break;
			case "world-river":
				$searchParams = ["types"=>[3]];
				break;
			case "paroms":
				$searchParams = ["types"=>[4]];
				break;
			default:
				$searchParams = false;
		}
        if($searchParams){
			$searchModel = new CruiseSearch();
			if(!@$searchParams["date_from"]) $searchParams["date_from"] = date("Y-m-d", strtotime(date("Y-m-d") . ' + 1 days'));
			$dataProvider = $searchModel->search($searchParams);
			// print $dataProvider->query->createCommand()->rawSql;
			$searchModel1 = new CruiseSearch();
			$arCompanies = $searchModel1->companies($searchParams);
//        print "<pre>";
//        print_r($arCompanies);
//        die();
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
			$searchModel7 = new CruiseSearch();
			$arRegions = $searchModel7->regions($searchParams);
			$searchModel8 = new CruiseSearch();
			$arDates = $searchModel8->dates($searchParams);
			$searchModel9 = new CruiseSearch();
			$arLengs = $searchModel9->lengs($searchParams);
			$searchMode20 = new CruiseSearch();
			$arPrices = $searchMode20->prices($searchParams);

			$modelCruise = new CruiseSearch();
			$modelCruise->load($searchParams);
            return $this->render('view', [
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
                "obPage"=>$obPage
            ]);
		}
        if(!$obPage || is_null($obPage)) {
            $obPage = Page::findOne(["alias"=>"404"]);
        }
        return $this->render('view', [
            "obPage"=>$obPage
        ]);
    }
}
