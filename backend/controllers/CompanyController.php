<?php

namespace backend\controllers;

use common\models\Cabin;
use common\models\Gallery;
use common\models\GroupCategory;
use common\models\GroupCompany;
use common\models\Image;
use yii\filters\AccessControl;
use common\models\Meta;
use Yii;
use common\models\Company;
use common\models\CompanySearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\UploadImage;
use yii\web\UploadedFile;

/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends Controller
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
     * Lists all Company models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAccept($id)
    {
        $model = $this->findModel($id);
        foreach($model->ships as $ship) {
            if(!$ship->cabinGroups || !count($ship->cabinGroups)) {
                foreach ($model->groupCompanies as $group) {
                    $newGroup = new \common\models\CabinGroup();
                    $newGroup->name = $group->name;
                    $newGroup->cabin_loc_id = $group->cabin_loc_id;
                    $newGroup->sort = $group->sort;
                    $newGroup->ship_id = $ship->ID;
                    if($newGroup->save()) {
                        foreach ($group->groupCategories as $cabin) {
                            $obCabin = Cabin::find()->where([
                                "code" => $cabin->code,
                                "ship_id" => $ship->ID
                            ])->one();
                            if(!$obCabin) {
                                $obCabin = new Cabin();
                                $obCabin->ship_id = $ship->ID;
                                $obCabin->code = $cabin->code;
                            }
                            $obCabin->name = $cabin->name;
                            $obCabin->sort = $cabin->sort;
                            $obCabin->cabin_grp_id = $newGroup->ID;
                            $obCabin->save();
                        }
                    }
                }
            }
            else {
                foreach($model->ships as $ship) {
                    foreach ($model->groupCompanies as $group) {
                        foreach ($group->groupCategories as $cabin) {
                            $obCabin = Cabin::find()->where([
                                "code" => $cabin->code,
                                "ship_id" => $ship->ID
                            ])->one();
                            if($obCabin) {
                                $obCabin->sort = $cabin->sort;
                                $obCabin->save();
                            }
                        }
                    }
                }
            }
        };
        Yii::$app->session->setFlash("warning", "Настройки вкладок применены ко всем лайнерам ".$model->name);
        return $this->redirect('/admin/company/categories?id='.$model->ID);
    }
    /**
     * Displays a single Company model.
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
     * Displays a single Company model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionCategories($id)
    {
        $model = $this->findModel($id);
        $arCategoryGroups = GroupCompany::find()->where(["company_id"=>$id])->orderBy("sort")->all();
        if(!$arCategoryGroups) {
            $arCategoryGroups = [];
            if($model->categories){
                foreach(@$model->categories as $category) {
    //                print_r($category);
                    $obGroup = GroupCompany::find()->where(["name"=>$category->name])->one();
                    if(!$obGroup) {
                        $obGroup = new GroupCompany();
                        $obGroup->company_id = $id;
                        $obGroup->name = $category->name;
                        $obGroup->sort = 100;
                    }
                    if (!$obGroup->cabin_loc_id && $category->cabin_loc_id){
                        $obGroup->cabin_loc_id = $category->cabin_loc_id;
                    }
                    $obGroup->save();
                    if($obGroup && $obGroup->ID) {
                        $obCategory = GroupCategory::find()->where(["code"=>$category->code])->one();
                        if(!$obCategory) {
                            $obCategory = new GroupCategory();
                            $obCategory->group_company_id = $obGroup->ID;
                            $obCategory->name = $category->name;
                            $obCategory->code = $category->code;
                        }
                        if(!$obCategory->sort && $category->sort) {
                            $obCategory->sort = $category->sort;
                        }
                        $obCategory->save();
                    }
                }
            }
        }

        return $this->render('categories', [
            'model' => $this->findModel($id),
            'arCategories' => $arCategoryGroups
        ]);
    }

    /**
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Company();
        $model->populateRelation('image', new Image());
        $model->populateRelation('meta', new Meta());
        $model->populateRelation('gallery', new Gallery());
        $meta = $model->meta;
        if ( $meta->load(Yii::$app->request->post()) ) {
            $meta->save();
            $model->meta_id = $meta->ID;
        }
        if ($model->load(Yii::$app->request->post())) {
            $image = new Image();
            if($image && $image->image = UploadedFile::getInstance($image, 'image')) {
                // $image->image = UploadedFile::getInstance($image, 'image');
                $dir = "/i_logo";
                if ($image->upload($dir)) {
                    $model->link('image', $image);
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
     * Updates an existing Company model.
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
        if(!$model->gallery){
            $model->populateRelation('gallery', new Gallery());
        }
        if($image && $image->image = UploadedFile::getInstance($image, 'image')){
            $dir="/i_logo";
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
     * Deletes an existing Company model.
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
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Company::findOne($id)) !== null) {
            if(!$model->image){
                $model->populateRelation('image', new Image());
            }
            if(!$model->meta){
                $model->populateRelation('meta', new Meta());
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
            $model = new Company();
        }
        if(!$model->gallery) {
            $model->populateRelation('gallery', new Gallery());
            $model->gallery->name = "Фото компании ".$model->name;
        }
        $image = new Image();
        $image->image = UploadedFile::getInstance($model, 'gallery');
        $dir = "/companies";
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
