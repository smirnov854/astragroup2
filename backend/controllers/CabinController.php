<?php

namespace backend\controllers;

use common\models\Gallery;
use Yii;
use yii\filters\AccessControl;
use common\models\Cabin;
use common\models\CabinSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\models\Image;

/**
 * CabinController implements the CRUD actions for Cabin model.
 */
class CabinController extends Controller
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
     * Lists all Cabin models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CabinSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cabin model.
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
     * Creates a new Cabin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cabin();
        $model->populateRelation('image', new Image());
        if ($model->load(Yii::$app->request->post())) {
            $image = new Image();
            $image->image = UploadedFile::getInstance($image, 'image');
            if($image->image ) {
                $dir="/i_logo";
                if($image->upload($dir)){
                    $model->link( 'image', $image );
                }
            }
            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->ID]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Cabin model.
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
        $image = $model->image;
        if($image->image = UploadedFile::getInstance($image, 'image')){
            $dir="/i_cabin";
            $image->crop_info = Yii::$app->request->post('Cabin')['crop_info'];
//            print_r($image->crop_info); die;
            if($image->upload($dir)){
                $model->link( 'image', $image );
            }
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cabin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cabin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cabin::findOne($id)) !== null) {
            if(!$model->image){
                $model->populateRelation('image', new Image());
            }
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionUpload($id) {
        if($id) {
            $model = $this->findModel($id);
        }
        else {
            $model = new Cabin();
        }
        if(!$model->gallery) {
            $model->populateRelation('gallery', new Gallery());
            $model->gallery->name = "Фото каюты ".$model->name;
        }
        $image = new Image();
        $image->image = UploadedFile::getInstance($model, 'gallery');
        $dir = "/i_cabins";
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
