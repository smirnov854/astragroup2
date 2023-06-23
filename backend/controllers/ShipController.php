<?php

namespace backend\controllers;

use common\models\Cabin;
use common\models\CabinGroup;
use common\models\CabinLoc;
use common\models\Gallery;
use common\models\ShipOption;
use Yii;
use common\models\Ship;
use common\models\ShipSearch;
use common\models\Meta;
use common\models\Image;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
/**
 * ShipController implements the CRUD actions for Ship model.
 */
class ShipController extends Controller
{
    public $crop_info;
    public $crop_infos;
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
     * Lists all Ship models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ShipSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ship model.
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
     * Creates a new Ship model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ship();
        $model->populateRelation('meta', new Meta());
        $model->populateRelation('image', new Image());
        $model->populateRelation('gallery', new Gallery());
        $meta = $model->meta;

        if ( $meta->load(Yii::$app->request->post()) ) {
            $meta->save();
            $model->meta_id = $meta->ID;
        }
        if ($model->load(Yii::$app->request->post())) {

            if($model->name) {
                $gallery = new Gallery();
                $gallery->name = "Фото лайнера ".$model->name;
                $gallery->save();
                $model->link("gallery",$gallery);
            }
            $image = new Image();
            $image->image = UploadedFile::getInstance($image, 'image');
            $dir = "/i_ships";
            if ($image->image && $image->upload($dir)) {
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

    public function actionUpload($id) {
        if($id) {
            $model = $this->findModel($id);
        }
        else {
            $model = new Ship();
        }
        if(!$model->gallery) {
            $gallery = new Gallery();
            $gallery->name = "Фото лайнера ".$model->name;
            $gallery->save();
        }
        else{
            $gallery = $model->gallery;
        }
        $image = new Image();
        $image->image = UploadedFile::getInstance($model, 'gallery');
        $dir = "/i_ships";
        $crop=[
            'width'=>735,'height'=>287,
            'x'=>0,'y'=>0
        ];
        if ($image->upload($dir,$crop)) {
            $model->gallery->save();
            $image->link('gallery', $model->gallery);
            $image->save();
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
        /*
        $imageFile = UploadedFile::getInstance($model, 'gallery');
        $directory = Yii::getAlias('@frontend/web/images/galleries') . DIRECTORY_SEPARATOR . Yii::$app->session->id . DIRECTORY_SEPARATOR;
        if (!is_dir($directory)) {
            FileHelper::createDirectory($directory);
        }
        if ($imageFile) {
            $uid = uniqid(time(), true);
            $fileName = $uid . '.' . $imageFile->extension;
            $filePath = $directory . $fileName;
            if ($imageFile->saveAs($filePath)) {
                $path = '/images/gallery/' . Yii::$app->session->id . DIRECTORY_SEPARATOR . $fileName;

            }
            else return '1';
        }
        */
        return '0';
    }
    /**
     * Updates an existing Ship model.
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
            $gallery->name = "Фото лайнера ".$model->name;
            if($gallery->save()) {
                $model->populateRelation('gallery', $gallery);
            }
        }
        else{
            $gallery = $model->gallery;
        }
        $model->link('gallery', $gallery);
        if(!$model->meta){
            $model->populateRelation('meta', new Meta());
        }
        $meta = $model->meta;
        $image = $model->image;

        if( $model->load(Yii::$app->request->post()) ) {
//            Yii::$app->session->setFlash("warning", implode(",", @$model->imageIds) );
            if ($image->image = UploadedFile::getInstance($model, 'image')) {
                $dir = "/i_ships";
                $image->crop_info=Yii::$app->request->post('Ship')['crop_info'];
                if ($image->upload($dir)) {
                    $model->link('image', $image);
                }
            }
            if($model->imageIds) {
                foreach ($model->imageIds as $imageId) {
                    $newImage = Image::findOne($imageId);
                    $newImage->link('gallery', $gallery);
                    $newImage->save();
                }
//                $model->link('gallery', $gallery);
            }
//            elseif ($gallery->imageList = UploadedFile::getInstances($model, 'images')) {
//                $gallery->save();
//                $dir = "/i_ships";
//                $gallery->crops = Yii::$app->request->post('Image')['crop_infos'];
//                if($gallery->upload($dir)) {
//                    $model->link('gallery', $gallery);
//                }
//            }
            if ($meta->load(Yii::$app->request->post())) {
                $meta->save();
                $model->meta_id = $meta->ID;
            }
            if ($model->save()) {
                if (Yii::$app->request->post('Ship')['options'] && $model->ID) {
                    ShipOption::deleteAll(["ship_id" => $model->ID]);
                    foreach (Yii::$app->request->post('Ship')['options'] as $option) {
                        $shipOption = new ShipOption();
                        $shipOption->title = $option["title"];
                        $shipOption->value = $option["value"];
                        $shipOption->ship_id = $model->ID;
                        $shipOption->save();
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
     * Deletes an existing Ship model.
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
     * Finds the Ship model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ship the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ship::findOne($id)) !== null) {
            if(!$model->image){
                $model->populateRelation('image', new Image());
            }
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionImageDelete($id,$return=false)
    {
        $obImage = Image::findOne($id);
        $obImage->gallery;
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

    public function actionCategories($id) {

        $obGroups = CabinGroup::find()->where(["ship_id"=>$id])->orderBy(["sort"=>SORT_ASC])->all();
        $obShip = Ship::findOne($id);
        /*
        if(!$obGroups) {
            $obLocations = $obShip->locations;

            foreach (@$obLocations as $location) {
                $newGroup = new CabinGroup();
                $newGroup->ship_id = $id;
                $newGroup->name = $location->name;
                $newGroup->sort = $location->sort;
                if(!in_array($location->ID,[36,37,39,41])){
                    $newGroup->cabin_loc_id =41;
                }
                else {
                    $newGroup->cabin_loc_id =$location->ID;
                }
                if($newGroup->save() && $obShip->cabins) {
                    foreach ($obShip->cabins as $cabin) {
                        if($cabin->cabin_loc_id == $location->ID) {
                            $cabin->link("cabinGroup",$newGroup);
                        }
                    }
                    $obGroups[]=$newGroup;
                }
            }
        }
        */
        return $this->render('categories', [
            'groups' => $obGroups,
            'model' => $obShip
        ]);
    }
}
