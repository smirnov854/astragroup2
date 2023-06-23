<?php
namespace frontend\controllers;

use common\models\BannerSearch;
use common\models\Command;
use common\models\CompanyType;
use common\models\Cruise;
use common\models\CruiseSearch;
use common\models\NewsSearch;
use common\models\Ofice;
use common\models\Page;
use common\models\Region;
use common\models\ReviewSearch;
use common\models\CompanyTypeSearch;
use Yii;
use yii\base\InvalidParamException;
use yii\data\ActiveDataProvider;
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
class SpbController extends Controller
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
        $page_id=6; // Страница по Санкт-Петербургу
        $searchBanner = new BannerSearch(); //
        $bannerProvider = $searchBanner->search(["page_id"=>$page_id]);
        $obPage = Page::findOne($page_id);
        $arBanners =$obPage->banner;
        $spbPort = 4092;
		$params = [];
		$seaCruises = new CruiseSearch();
		$query = $seaCruises->silver_query($params);
        $query->with('company');
        $query->joinWith(['company' => function ($q) {
            $q->where('company.company_type_id = 1');
        }]);
        $query->andWhere(["port_id"=>$spbPort])->orderBy("departure_date")->limit(3);

        $seaProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 3,
            ],
        ]);

		$riverCruises = new CruiseSearch();
		$query2 = $riverCruises->silver_query($params);
		$query2->with('company');
		$query2->joinWith(['company' => function ($q) {
			$q->where('company.company_type_id = 2');
		}]);
		$query2->where(["port_id"=>$spbPort])->limit(3);
		$riverProvider = new ActiveDataProvider([
			'query' => $query2,
			'pagination' => [
				'pageSize' => 3,
			],
		]);

		$paromCruises = new CruiseSearch();
		$query3 = $paromCruises->silver_query($params);
		$query3->with('company');
		$query3->joinWith(['company' => function ($q) {
			$q->where('company.company_type_id = 4');
		}]);
		$query3->where(["port_id"=>$spbPort])->limit(3);
		$paromProvider = new ActiveDataProvider([
			'query' => $query3,
			'pagination' => [
				'pageSize' => 3,
			],
		]);


//        $arObCruise["river"] = CruiseSearch::find()->where([
//            "typeId" => 2,
//            "port_id" => $spbPort
//        ])->batch(3);
//        $arObCruise["parom"] = CruiseSearch::find()->where([
//            "typeId" => 4,
//            "port_id" => $spbPort
//        ])->batch(3);
        $this->view->params["breadcrumbs"]=[
            [
                'label' => 'Круизы из Санкт-Петербурга',  // required
                'class'=>'breadcrumbs__link'
            ]
        ];
        return $this->render('index', [
            'bannerProvider' => $bannerProvider,
            'seaCruises' => $seaProvider,
            'paromProvider' => $paromProvider,
            'riverProvider' => $riverProvider,
        ]);
    }

}
