<?php

namespace backend\controllers;

use common\models\CabinGroup;
use common\models\Gallery;
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
class CabinGroupController extends Controller
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
        if(!$model->image){
            $model->populateRelation('image', new Image());
        }
        if(!$model->gallery){
            $gallery =  new Gallery();
            $gallery->name = "Фото группы кают ".$model->name;
            if($gallery->save()) {
                $model->populateRelation('gallery', $gallery);
            }
        }
        else{
            $gallery = $model->gallery;
        }
        $model->link('gallery', $gallery);
        $image = $model->image;
        if( $model->load(Yii::$app->request->post()) ) {
            if ($image->image = UploadedFile::getInstance($model, 'image')) {
                $dir = "/i_categories";
                $image->crop_info = Yii::$app->request->post('CabinGroup')['crop_info'];
                if ($image->upload($dir)) {
                    $model->link('image', $image);
                }
            }
            if ($model->imageIds) {
                foreach ($model->imageIds as $imageId) {
                    $newImage = Image::findOne($imageId);
                    $newImage->link('gallery', $gallery);
                    $newImage->save();
                }
            }
            if ($model->save()) {
                Yii::$app->session->setFlash("sucsess", "Данные сохранены" );
                return $this->redirect(['ship/categories', 'id' => $model->ship_id]);
            }
        }
        Yii::$app->session->setFlash("warning", "Данные не сохранены" );
        return $this->redirect(['ship/categories', 'id' => $model->ship_id]);
    }
    public function actionCreate() {
        $model = new CabinGroup();
        if(!$model->image){
            $model->populateRelation('image', new Image());
        }
        if(!$model->gallery){
            $gallery =  new Gallery();
            $gallery->name = "Фото группы кают ".$model->name;
            if($gallery->save()) {
                $model->populateRelation('gallery', $gallery);
            }
        }
        else{
            $gallery = $model->gallery;
        }
        $image = $model->image;
        if( $model->load(Yii::$app->request->post()) ) {
            if ($image->image = UploadedFile::getInstance($model, 'image')) {
                $dir = "/i_categories";
                $image->crop_info = Yii::$app->request->post('CabinGroup')['crop_info'];
                if ($image->upload($dir)) {
                    $model->link('image', $image);
                }
            }
            if ($model->imageIds) {
                foreach ($model->imageIds as $imageId) {
                    $newImage = Image::findOne($imageId);
                    $newImage->link('gallery', $gallery);
                    $newImage->save();
                }
            }
            if ($model->save()) {
                $model->link('gallery', $gallery);
                return $this->redirect(['ship/categories', 'id' => $model->ship_id]);
            }
        }
        return true;
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
        $ship_id = $model->ship_id;
        $model->delete();
        return $this->redirect(['ship/categories', 'id' => $ship_id]);
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
        if (($model = CabinGroup::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
