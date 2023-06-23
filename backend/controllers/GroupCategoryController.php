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
class GroupCategoryController extends Controller
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

    public function actionCreate()
    {
        $model = new GroupCategory();
        $model->sort = 100;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['company/categories', 'id' => $model->groupCompany->company_id]);
        }
        if(Yii::$app->request->get('group')) {
            $model->group_company_id = Yii::$app->request->get('group');
        }
        return $this->render('create', [
            'model' => $model
        ]);
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
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }
    public function actionDelete($id)
    {
        print $id;
        $model = $this->findModel($id);
        if($model->company_id) {
            $model->delete();
            return $this->redirect(['company/categories', 'id' => $model->company_id]);
        }
        return $this->redirect(['company/categories']);
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
        print '!';
        if (($model = GroupCategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
