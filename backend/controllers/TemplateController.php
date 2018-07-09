<?php

namespace backend\controllers;

use common\models\RelationTemplateTemplateMenuCate;
use common\models\TemplateMenu;
use common\models\TemplateMenuCate;
use Yii;
use common\models\Template;
use common\models\TemplateCate;
use common\models\RelationTemplateTemplateCate;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use backend\controllers\BaseController;
/**
 * TemplateController implements the CRUD actions for Template model.
 */
class TemplateController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
                'config' => [
                    "imageUrlPrefix"  => "http://static.xiaolutuiguang.com",//图片访问路径前缀
                    "imagePathFormat" => "/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}", //上传保存路径*/
                    "imageRoot" => Yii::getAlias("@webroot"),
                    'imageManagerListPath' => Yii::getAlias('@webroot')
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        $query=Template::find();
        $pagination=new Pagination([
            'defaultPageSize'=>5,
            'totalCount'=>$query->count(),
        ]);
        $temps=$query->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('index',['temps'=>$temps,'pagination'=>$pagination]);
    }


     public function actionCreate()
     {
        $model = new Template();
        //分类数据键值对
        $cate=TemplateCate::finds();
        if ($model->load(Yii::$app->request->post()))
        {
            //模块入库
            if ($model->store($model))
            {
                Yii::$app->getSession()->setFlash('success','操作成功');
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('create', ['model' => $model,'cate'=>$cate,]);
        }
    }
    public  function actionDel($id)
    {
        Template::deleteAll('id ='.$id);
        return $this->redirect(['index']);
    }

    public function actionUpdate($id)
    {
        $model=Template::findOne($id);
        if($model->load(Yii::$app->request->post()))
        {
                //模块数据入库
            $model->UpdateTime=date("Y-m-d H:i",time());
            if ($model->store($model))
            {
                Yii::$app->getSession()->setFlash('success','操作成功');
            }
                return $this->redirect(['index']);
        }else{
                //获取对应的分类,获取分类总信息的键值对
                $opt=Template::opt($id);
                $cate=TemplateCate::finds();
                //获取对应的菜单分类，获取菜单分类总信息的键值对
                $model=Template::findOne($id);
                return $this->render('update',['model'=>$model,'cate'=>$cate,]);
        }
    }

    public function actionView($id)
    {
        $temp=Template::findOne($id);
        //获取分类Id信息
        $TemplateCateId=RelationTemplateTemplateCate::find()->where(['TemplateId'=>"$id"])->asArray()->all();
        $content=array();
        $one=array();
        foreach ($TemplateCateId as $key => $value) {
                foreach ($value as $ke => $valu) {
                    if($ke=="TemplateCateId"){
                        $content[]=TemplateCate::find()->where(['ID'=>$valu])->asArray()->all();
                    }
                }
        }
        foreach ($content as $key => $value) {
            foreach ($value as $ke => $val) {
                foreach ($val as $k => $v) {
                    if($k=='CateName'){
                        $one[]=$v;
                    }
                }
            }
        }
        $ThumbUrl=explode(",",$temp->ThumbUrl );
        $QRCode=explode(",",$temp->QRCode );
        foreach($ThumbUrl as $key=>$value){
            if($value==''){
                array_pop($ThumbUrl);
            }
        }
        foreach($QRCode as $key=>$value){
            if($value==''){
                array_pop($QRCode);
            }
        }
        return $this->render('view',['temp'=>$temp,'ThumbUrl'=>$ThumbUrl,'QRCode'=>$QRCode,'one'=>$one,]);
    }
}




