<?php
/**
 * Created by PhpStorm.
 * User: a.serebryakov
 * Date: 07.11.2018
 * Time: 17:25
 */

namespace common\components;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use \backend\models\Config;

class OptionsComponent extends Component
{
    private $_attributes;

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();
        $this->_attributes = ArrayHelper::map(Config::find()->all(), 'name', 'val');
    }

    public function __get($name) {
        if (array_key_exists($name, $this->_attributes))
            return $this->_attributes[$name];
        return parent::__get($name);
    }

    public function __set($name, $value) {
        if (array_key_exists($name, $this->_attributes)) {
            $model = Config::find()->where(['name'=>$name])->one();
        } else {
            $model = new Config();
        }
        $model->name = $name;
        $model->val = $value;
        print $model->save();
    }
}