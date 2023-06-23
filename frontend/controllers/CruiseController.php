<?php

namespace frontend\controllers;

use common\models\BannerSearch;
use common\models\Company;
use common\models\CompanyType;
use common\models\Cruise;
use common\models\Image;
use common\models\CruiseSearch;
use common\models\NewsSearch;
use common\models\Page;
use common\models\Region;
use common\models\ReviewSearch;
use common\models\CompanyTypeSearch;
use Yii;
use yii\base\InvalidParamException;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
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
 * CruiseController implements the CRUD actions for Cruise model.
 */
class CruiseController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        // echo phpinfo();

        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Cruise models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CruiseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Cruise model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDetail($id)
    {
        $start = microtime(true);

        // $obRoute = new \backend\models\CruisePortSearch();
        // $dataProvider = $obRoute->search(["cruise_port"=>["cruise_id"=>$id]]);
        $routeProvider = new ActiveDataProvider([
            'query' => \common\models\CruisePort::find()->where(['cruise_id' => $id])->orderBy('day ASC'),
        ]);

        // echo '<pre>';
        // print_r($routeProvider->getModels());
        // echo '</pre>';

        $routeProvider->setSort(false);
        $arRouteInfos = ArrayHelper::map($routeProvider->query->all(), "ID", "info");
        $rInfoVisible = false;
        foreach ($arRouteInfos as $info) {
            if (!empty($info)) {
                $rInfoVisible = true;
                break;
            }
        };


        $cruiseModel = $this->findModel($id);

        $data = Yii::$app->db->createCommand("
        SELECT DISTINCT *
        FROM `price` AS PS
        LEFT JOIN `cabin_tariff` AS CT ON CT.ID = PS.tariff_id
        LEFT JOIN `cabin` AS CA ON CA.ID = CT.cabin_id
        LEFT JOIN `cabin_group` AS CG ON CG.ID = CA.cabin_grp_id
        LEFT JOIN `cabin_loc` AS CL ON CL.ID = CG.cabin_loc_id
        WHERE PS.`cruise_id` = " . $cruiseModel->ID)->queryAll();

//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';

        foreach ($data as $item) {
            $list_cabin[$item['cabin_id']] = Yii::$app->db->createCommand('SELECT * FROM cabin WHERE ID = ' . $item['cabin_id'])->queryOne();
        }

//        echo '<pre>';
//        print_r($list_cabin);
//        echo '</pre>';

        $list_cabin_group = [];
        foreach ($list_cabin as $item) {
            $cabin_group = Yii::$app->db->createCommand('SELECT * FROM cabin_group WHERE ID = ' . $item['cabin_grp_id'])->queryAll();
            $cabin_group[0]['image'] = $this->findCompanyImage($cabin_group[0]['image_id']);
            $list_cabin_group[] = $cabin_group[0];
        }

        $list_cabin_loc = [];
        foreach ($list_cabin as $item) {
            $cabin_loc = Yii::$app->db->createCommand('SELECT * FROM cabin_loc WHERE ID = ' . $item['cabin_loc_id'])->queryOne();
            $list_cabin_loc[] = $cabin_loc;
        }

        $list_cabin_tariff = [];
        foreach ($data as $item) {
//            echo $item['tariff_id'].'<br/>';
            $cabin_tariff = Yii::$app->db->createCommand('SELECT * FROM cabin_tariff WHERE ID = ' . $item['tariff_id'])->queryOne();
            $list_cabin_tariff[] = $cabin_tariff;
            $list_cabin_price[] = Yii::$app->db->createCommand('SELECT * FROM price WHERE tariff_id = ' . $cabin_tariff['ID'] . ' AND cruise_id = ' . $id)->queryOne();
        }

        $list_discount = Yii::$app->db->createCommand("
        SELECT * 
        FROM `cruise_discount` AS CD
        LEFT JOIN `discount` AS DS ON CD.discount_ID = DS.ID
            WHERE cruise_id = " . $cruiseModel->ID)->queryAll();

//        echo '<pre>';
//        print_r($list_discount);
//        print_r($list_cabin);
//        print_r($list_cabin_group);
//        print_r($list_cabin_loc);
//        print_r($list_cabin_tariff);
//        print_r($list_cabin_price);
//        echo '</pre>';

        $list_cabin = array_unique(array_values($list_cabin), SORT_REGULAR);

//        echo '<pre>';
//        print_r($list_cabin);
//        echo '</pre>';

        $list_cabin_loc = array_unique($list_cabin_loc, SORT_REGULAR);
        $list_cabin_tariff = array_unique($list_cabin_tariff, SORT_REGULAR);
        $list_cabin_group = array_unique($list_cabin_group, SORT_REGULAR);
        $list_cabin_price = array_unique($list_cabin_price, SORT_REGULAR);
        $list_discount = array_unique($list_discount, SORT_REGULAR);

        $company = Company::findOne($cruiseModel->company_id);


        $currency = Yii::$app->db->createCommand('SELECT * FROM currency')->queryAll();
        $cost_multiplier = 1;

        switch ($company->currency) {
            case 'EUR':
                $currency_label = '€';
                $cost_multiplier = $company->course * $currency[1]['value'];
                break;
            case 'USD':
                $currency_label = '＄';
                $cost_multiplier = $company->course * $currency[0]['value'];
                break;
            default:
                $currency_label = '₽';
                $cost_multiplier = 1;
        }

//        echo '<pre>';
//        print_r($company->currency);
//        print_r($company->course);
//        print_r($currency);
//        print_r($cost_multiplier);
//        echo '</pre>';

        $companyImage = $this->findCompanyImage($company->image_id);


        // $company_img = Company::getImage($cruiseModel->company_id);
        // echo 'arRouteInfos <pre>';
        // print_r($arRouteInfos);
        // echo '<pre>';
//         echo '<pre>';
//        print_r($company->course);
//         echo '<pre>';

//         echo '<pre>';
//         print_r($cruiseModel);
//         echo '<pre>';


        $cruiseModel->title = $cruiseModel->saledate;
        if ($cruiseModel->shipName) {
            $cruiseModel->title .= ", " . $cruiseModel->shipName;
        }

        switch ($company->company_type_id) {
            case 1:
                $this->view->params["breadcrumbs"] = [
                    [
                        'label' => 'Морские круизы',  // required
                        'url' => '/cruise/',
                        'class' => 'breadcrumbs__link'
                    ]
                ];
                break;
            case 2:
                $this->view->params["breadcrumbs"] = [
                    [
                        'label' => 'Реки России',  // required
                        'url' => '/river/',
                        'class' => 'breadcrumbs__link'
                    ]
                ];
                break;
            case 3:
                $this->view->params["breadcrumbs"] = [
                    [
                        'label' => 'Речные круизы по миру',  // required
                        'url' => '/world-river/',
                        'class' => 'breadcrumbs__link'
                    ]
                ];
                break;
            case 4:
                $this->view->params["breadcrumbs"] = [
                    [
                        'label' => 'Автобусно-паромные туры',  // required
                        'url' => '/paroms/',
                        'class' => 'breadcrumbs__link'
                    ]
                ];
                break;
            default:
                $this->view->params["breadcrumbs"] = [
                    [
                        'label' => 'Поиск круизов',  // required
                        'url' => '/search/',
                        'class' => 'breadcrumbs__link'
                    ]
                ];
        }

        if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], '/search')) {
            $this->view->params["breadcrumbs"][0]['url'] = $_SERVER['HTTP_REFERER'];
        }

        if ($company->name && $company->ID && $company->company_type_id == 1) {
            $this->view->params["breadcrumbs"][] = [
                'label' => $company->name,
                'url' => "/company/" . $company->ID . "/",
                'target' => '_blank',
                'title' => 'Круизная компания',
                'class' => 'breadcrumbs__link tooltip'
            ];
        };

        if ($cruiseModel->ship->name && $cruiseModel->ship->ID) {
            $this->view->params["breadcrumbs"][] = [
                'label' => $cruiseModel->ship->name,
                'url' => "/ship/" . $cruiseModel->ship->ID . "/",
                'target' => '_blank',
                'class' => 'breadcrumbs__link tooltip',
                'title' => 'Лайнер',
                'template' => "<li class=\"breadcrumbs__item\">{link}</li>"
            ];
        };

        // echo '<pre>';
        // print_r($cruiseModel);
        // echo '<pre>';

        // echo '<pre>';
        // // print_r($cruiseModel->cruise_length + 1);
        // echo '<pre>';


        $searchParams_similar = array(
            "date_from" => date("Y-m-d", (strtotime($cruiseModel->departure_date) - 86400 * 7)),
            "leng_from" => ($cruiseModel->cruise_length - 3 < 1 ? 1 : $cruiseModel->cruise_length - 3),
            "leng_to" => $cruiseModel->cruise_length + 3,
        );

        foreach ($cruiseModel->cruisePorts as $cruisePort) {
            // echo '<pre>';
            // print_r($cruisePort);
            // echo '<pre>';
            if ($cruisePort->port->ID !== 2583) {
                $searchParams_similar["itn_ports"][] = $cruisePort->port->ID;
            }
        }

        // echo '<pre>';
        // print_r($searchParams_similar["itn_ports"]);
        // echo '<pre>';


        $link_similar = http_build_query($searchParams_similar);

        $searchModel_similar = new CruiseSearch();
        $dataProvider_similar = $searchModel_similar->search_similar($searchParams_similar);

        $time = microtime(true) - $start;



        $listLoc = Yii::$app->db->createCommand("SELECT
Cabin_Loc_ID,
Name_Cabin_Loc,
Image_Cabin_Group,
value,
currency
FROM
(SELECT 
ROW_NUMBER() OVER (PARTITION BY Sort_Cabin_Loc ORDER BY value) AS Group_Num, 
CL.ID AS Cabin_Loc_ID,
CL.sort AS Sort_Cabin_Loc, 
CL.name AS Name_Cabin_Loc, 
CONCAT(IM.subdir, '/', IM.name) AS Image_Cabin_Group,
PR.value,
PR.currency
FROM price AS PR
LEFT JOIN cabin_tariff AS CT ON CT.ID = PR.tariff_id
LEFT JOIN cabin AS CA ON  CA.ID = CT.cabin_id
LEFT JOIN cabin_group AS CG ON  CG.ID = CA.cabin_grp_id
LEFT JOIN image AS IM ON  IM.ID = CG.image_id
LEFT JOIN cabin_loc AS CL ON  CL.ID = CG.cabin_loc_id
WHERE cruise_id = '$cruiseModel->ID'
    AND PR.value IS NOT NULL) AS TT
WHERE Group_Num = 1;")->queryAll();

//
//        $listLoc = Yii::$app->db->createCommand("SELECT
//Cabin_Loc_ID,
//Name_Cabin_Loc,
//Image_Cabin_Group,
//value,
//currency
//FROM
//(SELECT
//ROW_NUMBER() OVER (PARTITION BY Sort_Cabin_Loc ORDER BY value) AS Group_Num,
//CL.ID AS Cabin_Loc_ID,
//CL.sort AS Sort_Cabin_Loc,
//CL.name AS Name_Cabin_Loc,
//CG.image_id AS Image_Cabin_Group,
//PR.value,
//PR.currency
//FROM price AS PR
//LEFT JOIN cabin_tariff AS CT ON CT.ID = PR.tariff_id
//LEFT JOIN cabin AS CA ON  CA.ID = CT.cabin_id
//LEFT JOIN cabin_group AS CG ON  CG.ID = CA.cabin_grp_id
//LEFT JOIN cabin_loc AS CL ON  CL.ID = CG.cabin_loc_id
//WHERE cruise_id = '$cruiseModel->ID'
//    AND PR.value IS NOT NULL) AS TT
//WHERE Group_Num = 1;")->queryAll();

//        echo '<pre>';
//        print_r($listLoc);
//        echo '</pre>';


        return $this->render('view', [
            'listLoc' => $listLoc,
            'model' => $cruiseModel,
            'companyModel' => $company,
            'companyImage' => $companyImage,
            'routeProvider' => $routeProvider,
            'dataProvider_similar' => $dataProvider_similar,
            'link_similar' => $link_similar,
            'rInfoVisible' => $rInfoVisible,
            'listCabin' => $list_cabin,
            'listCabinGroup' => $list_cabin_group,
            'listCabinTariff' => $list_cabin_tariff,
            'listCabinLoc' => $list_cabin_loc,
            'listCabinPrice' => $list_cabin_price,
            'listDiscount' => $list_discount,
            'course' => 1,//$company->course
            'currency' => $currency_label,//$company->course
            'cost_multiplier' => $cost_multiplier, //курс * кеф
            'useful_info' => $cruiseModel->useful_info
        ]);

    }

    /**
     * Finds the Cruise model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cruise the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cruise::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findCompanyImage($id)
    {
        if ($id != null) {
            if (($image = Image::findOne($id)) !== null) {
                return $image['subdir'] . '/' . $image['name'];
            }
        }
        return null;

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findSimilarCruise()
    {
    }
}
