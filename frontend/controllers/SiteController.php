<?php
namespace frontend\controllers;

use common\models\BannerSearch;
use common\models\CompanyType;
use common\models\Cruise;
use common\models\CruiseSearch;
use common\models\MainIcons;
use common\models\MainIconsSearch;
use common\models\NewsSearch;
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
 * Site controller
 */
class SiteController extends Controller
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
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {

        $searchBanner = new BannerSearch();
        $bannerProvider = $searchBanner->search(["is","page_id",new \yii\db\Expression('null')]);

        $searchModel6 = new CruiseSearch();
        $arTypes = $searchModel6->companyTypes([]);
        $searchModel7 = new CruiseSearch();
        $arRegions = $searchModel7->regions([]);
        $searchModel8 = new CruiseSearch();
        $arDates = $searchModel8->dates([]);
        $searchModel9 = new CruiseSearch();
        $arLengs = $searchModel9->lengs([]);
        $searchMode20 = new CruiseSearch();
        $arPrices = $searchMode20->prices([]);

        $searchSpecial = new CruiseSearch();
        $specialQuery = $searchSpecial->silver_query([]);
        $specialQuery->joinWith("special", true, "RIGHT JOIN")->joinWith(['company' => function ($q) {
            $q->where('company.company_type_id = 1');
        }]);
        $specialQuery->orderBy("departure_date");
        $specialProvider = new ActiveDataProvider([
            'query' => $specialQuery,
            'pagination' => [
                'pageSize' => 3,
            ]
        ]);
		$specialQuery2 = $searchSpecial->silver_query(['types'=>[1]]);
		$specialQuery2->orderBy("min_price");
		if(!$specialProvider->getTotalCount()) {
			$specialProvider = new ActiveDataProvider([
				'query' => $specialQuery2,
				'pagination' => [
					'pageSize' => 3,
				]
			]);
		}



        $searchTypes = new CompanyTypeSearch();
        $typesProvider = $searchTypes->search(null);
        $searchNews = new NewsSearch();
		// $searchNews->orderBy('ID DESC');
        $newsProvider = $searchNews->search(null,3);

        $searchReviews = new ReviewSearch();
        $reviewsProvider = $searchReviews->search(null);
        $searchIcons = new MainIconsSearch();
        $iconsProvider = $searchIcons->search(null);
        $modelCruise = new CruiseSearch();






        return $this->render('index', [
            'bannerProvider' => $bannerProvider,
            'arTypes' => $arTypes,
            'arRegions' => $arRegions,
            'arDates' => $arDates,
            'arLengs' => $arLengs,
            'arPrices' => $arPrices,
            'typesProvider' => $typesProvider,
            'newsProvider' => $newsProvider,
            'reviewsProvider' => $reviewsProvider,
            'iconsProvider' => $iconsProvider,
            'modelCruise' => $modelCruise,
            'cruiseTypes' => CompanyType::find()->asArray()->all(),
            'arRegions' => $arRegions,
            'hotCruises' => $specialProvider
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
