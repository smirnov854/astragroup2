<?php

namespace app\modules\adminer\controllers;

use yii\web\Controller;
// session_start();
class AdminerController extends Controller
{
    public $enableCsrfValidation = false;
    public $layout = false;
    public $defaultAction = 'adminer';

    public function actionAdminer()
    {
        return $this->render('adminer');
    }
}
