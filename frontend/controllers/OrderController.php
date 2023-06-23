<?php

/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 02.06.2019
 * Time: 14:03
 */

namespace frontend\controllers;

use Yii;
use common\models\Order;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;


class OrderController extends Controller
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
                        'allow' => true,
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
        $model = new Order();

        if ($model->load(Yii::$app->request->post())) {
            if ($ads = Yii::$app->request->post("ads")) {
                $model->commet .= " Взрослые: " . $ads;
            }
            if ($model->save()) {
                Yii::$app->session->setFlash('success', "Благодарим за запрос! Мы ответим в самое ближайшее время!");

                $subject = 'Новый заказ';

                $body = '<b>Внимание новый заказ № ' . $model->ID . '</b><br/>
                <a href="http://tst.astartagroup.ru/admin/order/index">Смотреть</a><br/><br/>
                <b>Круиз: </b>' . $model->cabin . '<br/>
                <b>Имя: </b>' . $model->fio . '<br/>
                <b>Телефон: </b>' . $model->phone . '<br/>
                <b>Email: </b>' . $model->email . '<br/>
                <b>Взрослые/дети:</b> взрослые: ' . Yii::$app->request->post("ads") . '<br/>
                <b>Комментарий: </b>' . $model->comment . '<br/>
                <b>Регион: </b>' . $model->address . '<br/>
                ';

                $headers = "From: site_message@astartagroup.ru\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=utf-8\r\n";
                $subject = '=?UTF-8?B?' . base64_encode($subject) . '?=';

                if (mail("Info@astartagroup.ru,Visa@astartagroup.ru,asta-2011@yandex.ru", $subject, $body, $headers)) {
                    echo 'Отправлено';
                } else {
                    echo 'Не отправлено';
                }

                // return $this->redirect(['cruise/detail', 'id' => $model->cruise_id]);
            }
        }
        // Yii::$app->session->setFlash('error', "Ошибка! Попробуйте позже!");
        // return $this->redirect(['cruise/detail', 'id' => Yii::$app->request->post('Order')["cruise_id"]]);
    }

    public function actionSend()
    {
        $body_fields = [];
        $post = Yii::$app->request->post();

        $lables = [
            'name' => 'Имя',
            'phone' => 'Телефон',
            'email' => 'Email',
            'adult' => 'Взрослые',
            'child_1' => 'Дети (0-2 года)',
            'child_2' => 'Дети (2-12 лет)',
            'child_3' => 'Дети (12-18 лет)',
            'comment' => 'Комментарий'
        ];

        foreach ($post as $key => $value) {
            if (strlen($value) == 0) {
                $value = ' ------ ';
            }
            $body_fields[] = '<tr><td>' . $lables[$key] . '</td><td>' . $value . '</td></tr>';
        }

        $subject = 'Запрос подбора похожего круиза';
        $body = '<table>' . implode("", $body_fields) . '</table>';

        $headers = "From: site_message@astartagroup.ru\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=utf-8\r\n";
        $subject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
        //Info@astartagroup.ru,Visa@astartagroup.ru,asta-2011@yandex.ru
        if (mail("Info@astartagroup.ru,Visa@astartagroup.ru,asta-2011@yandex.ru", $subject, $body, $headers)) {
            echo 'Отправлено';
        } else {
            echo 'Не отправлено';
        }

        // Yii::$app->mailer->compose()
        //     ->setFrom('site_message@astartagroup.ru')
        //     ->setTo('Info@astartagroup.ru')
        //     ->setTo('Visa@astartagroup.ru')
        //     ->setTo('asta-2011@yandex.ru')
        //     ->setTo('admin@webpure.ru')
        //     ->setSubject('Запрос подбора похожего круиза')
        //     ->setHtmlBody($body)
        //     ->send();
    }

    /**
     * Finds the Cruise model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cruise the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
