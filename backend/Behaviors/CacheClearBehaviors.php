<?php
/**
 * Created by PhpStorm.
 * User: mayunfeng
 * Date: 2018/1/25
 * Time: 18:45
 */

namespace backend\Behaviors;


use yii\base\Behavior;
use yii\db\ActiveRecord;

/**
 * 清空缓存
 * Class CacheClearBehaviors
 * @package backend\Behaviors
 */
class CacheClearBehaviors extends Behavior
{

    public $key;

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_DELETE => 'clear',
            ActiveRecord::EVENT_AFTER_INSERT => 'clear',
            ActiveRecord::EVENT_AFTER_UPDATE => 'clear',
        ];
    }

    public function clear()
    {
        if (!is_array($this->key)) {
            $this->key = [$this->key];
        }

        foreach ($this->key as $value) {
            \Yii::$app->getCache()->delete($value);
        }

    }

}