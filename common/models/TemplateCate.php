<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "jw_TemplateCate".
 *
 * @property integer $ID
 * @property string $CateName
 * @property integer $IsShow
 * @property integer $Sort
 * @property string $CreateTime
 */
class TemplateCate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jw_TemplateCate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CateName'], 'string'],
            [['IsShow', 'Sort'], 'integer'],
            [['CreateTime'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'CateName' => '分类名称',
            'IsShow' => '是否显示',
            'Sort' => 'Sort',
            'CreateTime' => 'Create Time',
        ];
    }

    // 获取分类下的模板信息
    public function getTemplate()
    {
        return $this->hasMany(Template::className(),['ID','TemplateId'])->viaTable(RelationTemplateTemplateCate::tableName(),['TemplateCateId' => 'ID']);
    }

    
    
    // 获取所有的模板分类及其模板
    public static function allCateAndTemplate()
    {
        $cate = self::find()->where(['IsShow'=>true])->asArray()->all();

        $data = [];
        foreach ($cate as $k=>$v) {
            $templates = RelationTemplateTemplateCate::findAll(['TemplateCateId'=>$v['ID']]);
            $_temp = $v;
            $_temp['Templates'] = Template::find()->where(['ID'=>ArrayHelper::getColumn($templates,'TemplateId')])->asArray()->all();
            $data[$k] = $_temp;
        }
        return $data;
    }
    //获取分类键值对
    public  static function finds()
    {
        $res = TemplateCate::find()->all();
        $one = array();
        foreach ($res as $key => $value) {
            $one[$value['ID']] = $value['CateName'];
        }
        return $one;
    }
}
