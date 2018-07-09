<?php

namespace common\models;

use backend\Behaviors\CacheClearBehaviors;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\UnprocessableEntityHttpException;

/**
 * This is the model class for table "jw_Problem".
 *
 * @property integer $ID
 * @property integer $ProblemId
 * @property string $ProblemName
 * @property integer $IsShow
 * @property integer $Sort
 * @property string $ProblemAnswer
 * @property integer $IsHot
 */
class Problem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jw_Problem';
    }



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ProblemId','Sort','IsHot','Click'], 'integer'],
            [['ProblemName','ProblemAnswer','Img'], 'string'],
            [['ProblemName'],'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'ProblemId' => '问题分类',
            'ProblemName' => '问题名称',
            'Sort' => '问题排序',
            'ProblemAnswer' => '问题答案',
            'IsHot' => '热门推荐',
            'Click' =>'点击',
            'Img'=>'图片'
        ];
    }

    public function gotoPort()
    {
        $this->Click+=1;
        return false;
    }

    const EVENT_TEST = 'sdfahsgfdh';


    public function init()
    {
        $this->on(self::EVENT_TEST,[$this,'testEvent']);
    }



    public function testEvent()
    {
        $this->Sort+=10;
        return $this->save();
    }


    public function test()
    {
        $events = new AllotEvent();
        $events->departmentId =1;
        $events->Status = 5;
        $this->trigger(self::EVENT_TEST, $events);
    }
}
