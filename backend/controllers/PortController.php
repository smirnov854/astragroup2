<?php

namespace backend\controllers;

use Yii;
use common\models\Port;
use common\models\Meta;
use common\models\PortSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
/**
 * PortController implements the CRUD actions for Port model.
 */
class PortController extends Controller
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
     * Lists all Port models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PortSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Port model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $arCruises = \backend\models\CruisePort::find()->select(['cruise_id'])->distinct()->where(['port_id'=>$id])->asArray()->all();
        $newCruises = [];
        foreach($arCruises as $cruise){
            $newCruises[] = $cruise["cruise_id"];
        };
        $dataProvider = new ActiveDataProvider([
            'query' => \backend\models\Cruise::find()->where(['in','ID',$newCruises])->orderBy('ID ASC'),
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider

        ]);
    }

    /**
     * Creates a new Port model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Port();
        $model->populateRelation('meta', new Meta());

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Port model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if(!$model->meta){
            $model->populateRelation('meta', new Meta());
        }
        $meta = $model->meta;
        if ( $meta->load(Yii::$app->request->post()) ) {
            $meta->save();
            $model->meta_id = $meta->ID;
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Port model.
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

    public function actionChecking($id) {
        $obPort = $this->findModel($id);
        $obPort->check = 1;
        $obPort->save();
        return $this->redirect(['view', 'id' => $id]);
    }
    public function actionChange($id) {
        $newId = Yii::$app->request->post("new_id");
        // print $newId; die;
        $obPort = $this->findModel($id);
        if ($obPort->changePortId($newId)) {
            return $this->redirect(['view', 'id' => $newId]);
        }
        return $this->render('view', [
            'model' => $obPort,
        ]);
    }
    /**
     * Finds the Port model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Port the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Port::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
