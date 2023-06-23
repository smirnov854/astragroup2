<?php

namespace backend\controllers;

use common\models\Cruise;
use common\models\SpecialCruise;
use Yii;
use common\models\Special;
use common\models\Image;
use common\models\SpecialSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;

/**
 * SpecialController implements the CRUD actions for Special model.
 */
class SpecialController extends Controller
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
                        'allow' => false,
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
     * Lists all Special models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SpecialSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Special model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Special model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Special();
        $model->populateRelation('image', new Image());
        if($arCruises = Yii::$app->request->post('selection'))
            $model->cruisesList=implode(",",$arCruises);

//        if ($model->load(Yii::$app->request->post())) {
//            $image = new Image();
//            $image->image = UploadedFile::getInstance($image, 'image');
//            $dir = "/i_logo";
//            if ($image->upload($dir)) {
//                $model->link('image', $image);
//            }
//        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($model->cruisesList) {
                foreach (explode(",",$model->cruisesList) as $cruiseId) {
                    $obCruise = Cruise::findOne($cruiseId);
                    $model->link( 'cruises', $obCruise );
                }
            }
            return $this->redirect(['view', 'id' => $model->ID]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Special model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		if ($arCruises = Yii::$app->request->post('selection')) {
			$model->cruisesList = implode(",", $arCruises);
		}
//        if(!$model->image) {
//            $model->populateRelation('image', new Image());
//        }
//        $image = $model->image;
        if( $model->load(Yii::$app->request->post()) ) {
//            if ($image->image = UploadedFile::getInstance($model, 'image')) {
//                $dir = "/i_spec";
//                $image->crop_info = Yii::$app->request->post('Special')['crop_info'];
//                if ($image->upload($dir)) {
//                    $model->link('image', $image);
//                }
//            }
//            if ($arCruises = Yii::$app->request->post('selection')) {
//                $model->cruisesList = implode(",", $arCruises);
//            }
            if ($model->save()) {
                if ($model->cruisesList ) {
                    SpecialCruise::deleteAll(["special_id" => $model->ID]);
                    foreach (explode(",", $model->cruisesList) as $cruiseId) {
                    	$specCruise = new SpecialCruise();
						$specCruise->special_id = $model->ID;
						$specCruise->cruise_id = $cruiseId;
						$specCruise->save();
                    }
                }
                return $this->redirect(['view', 'id' => $model->ID]);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Special model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Special model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Special the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $model = Special::find()->where(["ID"=>$id])->with('cruises')->One();
        if ($model != null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
