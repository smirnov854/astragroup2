<?php

namespace backend\controllers;

use common\models\CabinGroup;
use common\models\Gallery;
use common\models\GroupCategory;
use common\models\GroupCompany;
use common\models\Image;
use Yii;
use common\models\Order;
use common\models\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class GroupCompanyController extends Controller
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
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if( $model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash("sucsess", "Данные сохранены" );
            return $this->redirect(['company/categories', 'id' => $model->company_id]);
        }
        Yii::$app->session->setFlash("warning", "Данные не сохранены" );
        return $this->redirect(['company/categories', 'id' => $model->company_id]);
    }
    public function actionCreate() {
        $model = new GroupCompany();
        if( $model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['company/categories', 'id' => $model->company_id]);
        }
        return true;
    }
    public function actionOrder () {
        $post = Yii::$app->request->post();
        if (isset( $post['key'], $post['pos'] ))   {
            print GroupCategory::findOne($post['key'])->order( $post['pos'] );
        }
    }
    /**
     * Deletes an existing Cabin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $company_id = $model->company_id;
        $model->delete();
        return $this->redirect(['company/categories', 'id' => $company_id]);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GroupCompany::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
