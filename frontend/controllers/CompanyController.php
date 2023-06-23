<?php
namespace frontend\controllers;

use common\models\BannerSearch;
use common\models\Company;
use common\models\CompanyGroup;
use common\models\CompanySearch;
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
use yii\helpers\VarDumper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class CompanyController extends Controller
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
        $companyGroup = CompanyGroup::find()->asArray()->all();
        $arCompanies = [];
        $searchModel = new CompanySearch();
//        VarDumper::dump($compGr);

        $arGroups=[];
        foreach ($companyGroup as $compGr) {
            $arGroups[$compGr["ID"]] = $compGr["name"];
            $arCompanies[$compGr["ID"]] = $searchModel->search(null,$compGr["ID"]);
        }
        return $this->render('index', [
            'arDataProvider' => $arCompanies,
            'arGroups' => $arGroups
        ]);
    }
    /**
     * Displays page by alias
     * or redirect to 404
     * @return mixed
     */
    public function actionDetail($id) {
        $obCompany = $this->findModel($id);
        return $this->render('view', [
            'model' => $obCompany,
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
        if (($model = Company::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
