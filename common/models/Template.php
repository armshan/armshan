<?php

namespace common\models;

use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use common\library\upload\Upload;


/**
 * This is the model class for table "jw_Template".
 *
 * @property integer $ID
 * @property integer $TemplateId
 * @property string $ThumbUrl
 * @property string $TemplateName
 * @property string $FunctionIntro
 * @property string $UseExplain
 * @property string $Remark
 * @property string $QRCode
 * @property string $Price
 * @property integer $IsShow
 * @property integer $Sort
 * @property string $DetailsUrl
 * @property string $FuncInfo
 * @property string $CreateTime
 * @property string $UpdateTime
 */
class Template extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jw_Template';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TemplateId', 'IsShow', 'Sort'], 'integer'],
            [['ThumbUrl', 'TemplateName', 'FunctionIntro', 'UseExplain', 'Remark', 'QRCode', 'DetailsUrl', 'FuncInfo'], 'string'],
            [['Price','PriceMonth'], 'number'],
            [['CreateTime', 'UpdateTime'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'TemplateId' => '模板ID（腾讯）',
            'ThumbUrl' => '缩略图',
            'TemplateName' => '模板名称',
            'FunctionIntro' => '功能说明',
            'UseExplain'=>'使用说明',
            'QRCode' => '二维码',
            'PriceMonth' =>'每月价格',
            'Price' => '每年价格',
            'IsShow' => '是否展示',
            'Sort' => '排序',
            'DetailsUrl' => '模板详细图片',
            'FuncInfo' => '所需权限集',
            'Remark' => '备注',
            'CreateTime' => 'Create Time',
            'UpdateTime' => 'Update Time',
        ];
    }

    // 获取分类下的模板信息
    public function getTemplateCate()
    {
        return $this->hasMany(TemplateCate::className(),['ID','TemplateCateId'])->viaTable(RelationTemplateTemplateCate::tableName(),['TemplateId' => 'ID']);
    }

    /**
     * 获取所有的模板
     * @return static[]
     */
    public static function allTemplate()
    {
        return self::findAll(['IsShow'=>1]);
    }

    public static function opt($id)
    {
        $two=array();
        $TemplateCateId=RelationTemplateTemplateCate::find()->where(['TemplateId'=>$id])->asArray()->all();
        foreach ($TemplateCateId as $key => $value) {
            foreach ($value as $ke => $valu) {
                if($ke=="TemplateCateId"){
                    $two[]=$valu;
                }
            }
        }
        return $two;
    }
    public static function Menuopt($id)
    {
        $two=array();
        $TemplateMenuCateId=RelationTemplateTemplateMenuCate::find()->where(['TemplateId'=>$id])->asArray()->all();
        foreach ($TemplateMenuCateId as $key => $value) {
            foreach ($value as $ke => $valu) {
                if($ke=="TemplateMenuCateId"){
                    $two[]=$valu;
                }
            }
        }
        return $two;
    }



    public static function optionForForm()
    {
        $all = self::allTemplate();
        return ArrayHelper::map($all,'ID','TemplateName');
    }
    //增加时用的方法
    public function store($model)
    {

        $files = UploadedFile::getInstances($this,'ThumbUrl');
        if(empty($files)){
            $this->ThumbUrl=$this->getOldAttribute('ThumbUrl');
        }else{
            $img = [];
            foreach ($files as $file) {
                $img[] = Upload::uploadImg($file);
            }
            $this->ThumbUrl= implode(',',$img);
        }

        $files = UploadedFile::getInstances($this,'QRCode');
        if(empty($files))
        {
            $this->QRCode=$this->getOldAttribute('QRCode');
        }else{
            $img1 = [];
            foreach ($files as $file) {
                $img1[] = Upload::uploadImg($file);
            }
            $this->QRCode = implode(',',$img1);
        }

        return $this->save();

    }

    // 是否有tabBar
    public function hasTabBar()
    {
        return TemplateTabBarList::find()->where(['TemplateId'=>$this->ID])->exists();
    }

}
