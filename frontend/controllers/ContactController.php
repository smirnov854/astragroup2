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
class ContactController extends Controller
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
        $obOfices = Ofice::find()->all();
        $obCommand = Command::find()->all();
        $obText = Page::findOne(1);
        $this->view->params["breadcrumbs"]=[
            [
                'label' => 'Контакты',  // required
                'class'=>'breadcrumbs__link'
            ]
        ];
        return $this->render('index', [
            'ofices' => $obOfices,
            'command' => $obCommand,
            'text' => $obText
        ]);
    }

}
