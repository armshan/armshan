<?php

namespace common\models;

use Yii;
use common\models\Problem;
use backend\Behaviors\CacheClearBehaviors;


/**
 * This is the model class for table "jw_ProblemCate".
 *
 * @property integer $ID
 * @property string $CateName
 * @property integer $IsShow
 * @property integer $Sort
 */
class ProblemCate extends \yii\db\ActiveRecord
{


    public function behaviors()
    {
        return [

        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jw_ProblemCate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CateName'], 'string'],
            [['Sort'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => '分类编号',
            'CateName' => '分类名称',
            'Sort' => '分类排序',
        ];
    }

    public static function finds()
    {
        //返回分类名称和ID的对应信息
        //
        $res=self::find()->asArray()->all();

        $one=array();

        foreach($res as $key =>$value){
            $one[$value['ID']]=$value['CateName'];
            }
        return $one;
    }

     public static function allCateAndProblem()
    {
        //构建分类下所属的问题
        $res=ProblemCate::find()->asArray()->all();
        $one=$res;
        foreach ($res as $key=>$value){
            $one[$key]['son']=Problem::find()->where(['ProblemId'=>$value['ID']])->orderBy('Click DESC')->asArray()->all();

        }
        return $one;
    }
}
