<?php

namespace backend\controllers;

use common\models\Gallery;
use Yii;
use common\models\CompanyType;
use common\models\CompanyTypeSearch;
use common\models\Meta;
use common\models\Image;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CompanyTypeController implements the CRUD actions for CompanyType model.
 */
class CompanyTypeController extends Controller
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
     * Lists all CompanyType models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompanyTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CompanyType model.
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
     * Creates a new CompanyType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CompanyType();
        $model->populateRelation('meta', new Meta());
        $model->populateRelation('image', new Image());
        $model->populateRelation('gallery', new Gallery());
        $meta = $model->meta;
        if ( $meta->load(Yii::$app->request->post()) ) {
            $meta->save();
            $model->meta_id = $meta->ID;
        }
        if ($model->load(Yii::$app->request->post())) {
            $image = new Image();
            $image->image = UploadedFile::getInstance($image, 'image');
            $dir = "/i_logo";
            if ($image->upload($dir)) {
                $model->link('image', $image);
            }
        }
        if ( $meta->load(Yii::$app->request->post()) ) {
            $meta->save();
            $model->meta_id = $meta->ID;
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CompanyType model.
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
        if(!$model->meta){
            $model->populateRelation('meta', new Meta());
        }
        if(!$model->gallery){
            $model->populateRelation('gallery', new Gallery());
        }
        $meta = $model->meta;
        $image = $model->image;

        if($image->image = UploadedFile::getInstance($image, 'image')){
            $dir="/i_logo";
            if($image->upload($dir)){
                $model->link( 'image', $image );
            }
        }
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
     * Deletes an existing CompanyType model.
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
     * Finds the CompanyType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CompanyType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CompanyType::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionUpload($id) {
        if($id) {
            $model = $this->findModel($id);
        }
        else {
            $model = new CompanyType();
        }
        if(!$model->gallery) {
            $model->populateRelation('gallery', new Gallery());
            $model->gallery->name = "Фото типа круиза ".$model->name;
        }
        $image = new Image();
        $image->image = UploadedFile::getInstance($model, 'gallery');
        $dir = "/companytypes";
        if ($image->upload($dir)) {
            $model->gallery->save();
            $image->link('gallery', $model->gallery);
            $image->save();
            $model->link('gallery', $model->gallery);
            $model->save();
            return \yii\helpers\Json::encode([
                'files' => [
                    [
                        'name' => $image->name,
                        'size' => $image->file_size,
                        'url' => $image->subdir."/".$image->name,
                        'thumbnailUrl' => $image->subdir."/".$image->name,
                        'deleteUrl' => 'image-delete?id=' . $image->ID,
                        'deleteType' => 'POST',
                    ],
                ],
            ]);
        }
        return '0';
    }
    public function actionImageDelete($id,$return=false)
    {
        $obImage = Image::findOne($id);
        $directory = $obImage->subdir;
        $name = $obImage->name;
        if (is_file($directory . DIRECTORY_SEPARATOR . $name)) {
            unlink($directory . DIRECTORY_SEPARATOR . $name);
        }
        $output = [];
        foreach ($obImage->gallery->images as $file) {
            $fileName = $file->name;
            $path = $file->subdir . DIRECTORY_SEPARATOR . $file->name;
            $output['files'][] = [
                'name' => $fileName,
                'size' => $file->file_size,
                'url' => $path,
                'thumbnailUrl' => $path,
                'deleteUrl' => 'image-delete?name=' . $fileName,
                'deleteType' => 'POST',
            ];
        }
        $obImage->delete();
        if($return) {
            $arReturn = explode(":",$return);
            return $this->redirect([$arReturn[0],"id"=>$arReturn[1]]);
        }
        else {
            return \yii\helpers\Json::encode($output);
        }
    }
}
