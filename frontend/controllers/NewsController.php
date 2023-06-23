<?php

namespace frontend\controllers;

use common\models\BannerSearch;
use common\models\Company;
use common\models\CompanyType;
use common\models\Country;
use common\models\Cruise;
use common\models\CruiseSearch;
use common\models\News;
use common\models\NewsSearch;
use common\models\Page;
use common\models\Port;
use common\models\Region;
use common\models\ReviewSearch;
use common\models\CompanyTypeSearch;
use common\models\Ship;
use common\models\Special;
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
use yii\web\NotFoundHttpException;

/**
 * CruiseController implements the CRUD actions for Cruise model.
 */
class NewsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
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
        $modelCruise = new CruiseSearch();
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(null);
		$dataProvider->setSort([
			'attributes' => [
				'ID' => [
					'asc' => ['ID' => SORT_ASC],
					'desc' => ['ID' => SORT_DESC],
					'label' => 'ID',
					'default' => SORT_DESC
				]
			],
			'defaultOrder' => ['ID' => SORT_DESC]
		]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelCruise' => $modelCruise,
            'arSpecials' => Special::find()->asArray()->all(),
            'cruiseTypes' => CompanyType::find()->asArray()->all(),
            'regions' => Region::find()->asArray()->all(),
        ]);
    }


    /**
     * Displays a single Cruise model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDetail ($id)
    {
        $model = $this->findModel($id);
        $arCompanies=ArrayHelper::map(Company::find()->asArray()->all(),"ID","name");
        $arCountries = ArrayHelper::map(Country::find()->asArray()->all(),"ID","name");
        $arPorts = ArrayHelper::map(Port::find()->asArray()->all(),"ID","name");
        $arShips = ArrayHelper::map(Ship::find()->asArray()->all(),"ID","name");
        $countCruise = Cruise::find()->count();
        $modelCruise = new CruiseSearch();
        $modelCruise->load(Yii::$app->request->get());
        return $this->render('view', [
            'model' => $model,
            'types' => ArrayHelper::map(CompanyType::find()->asArray()->all(),"ID","name"),
            'arRegions' => ArrayHelper::map(Region::find()->asArray()->all(),"ID","name"),
            'arPorts' => $arPorts,
            'arShips' => $arShips,
            'arCountries' => $arCountries,
            'arCompanies' => $arCompanies,
            'cruiseTypes' => CompanyType::find()->asArray()->all(),
            'modelCruise' => $modelCruise,
            'cntCruise' => $countCruise,
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
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
