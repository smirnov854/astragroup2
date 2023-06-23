<?php

namespace backend\controllers;

use common\models\Gallery;
use Yii;
use common\models\Page;
use common\models\PageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PageController implements the CRUD actions for Page model.
 */
class PageController extends Controller
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
     * Lists all Page models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Page model.
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
     * Creates a new Page model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Page();
        $model->populateRelation('gallery', new Gallery());
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Page model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        }
        if(!$model->gallery){
            $model->populateRelation('gallery', new Gallery());
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Page model.
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
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Page::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionUpload($id) {
        if($id) {
            $model = $this->findModel($id);
        }
        else {
            $model = new Page();
        }
        if(!$model->gallery) {
            $model->populateRelation('gallery', new Gallery());
            $model->gallery->name = "Фото страницы ".$model->name;
        }
        $image = new Image();
        $image->image = UploadedFile::getInstance($model, 'gallery');
        $dir = "/i_pages";

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
