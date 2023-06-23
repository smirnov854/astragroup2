<?php
/**
 * Created by PhpStorm.
 * User: a.serebryakov
 * Date: 16.11.2018
 * Time: 8:35
 */

namespace backend\controllers;


class AjaxController extends Controller
{
    public function actionSearchUser($term)
    {
        if (Yii::$app->request->isAjax) {

            $results = [];

            if (is_numeric($term)) {
                /** @var Tag $model */
                $model = Port::findOne(['id' => $term]);

                if ($model) {
                    $results[] = [
                        'id' => $model['id'],
                        'label' => $model['name'] . ' (port id: ' . $model['id'] . ')',
                    ];
                }
            } else {

                $q = addslashes($term);

                foreach(Port::find()->where("(`name` like '%{$q}%')")->all() as $model) {
                    $results[] = [
                        'id' => $model['id'],
                        'label' => $model['name'] . ' (port id: ' . $model['id'] . ')',
                    ];
                }
            }

            echo Json::encode($results);
        }
    }
}