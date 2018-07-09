<?php  
namespace backend\controllers;


use yii;

use yii\db\Connection;
use yii\web\Controller;
use common\models\Problem;
use common\models\ProblemCate;
use yii\data\Pagination;
use yii\web\UnprocessableEntityHttpException;


class ProblemCateController extends BaseController
{
	 public function actionIndex()
	 {	
		$query=problemCate::find();
		$pagination=new Pagination(['defaultPageSize'=>10,
		'totalCount'=>$query->count(),
		]);
		$cates=$query->offset($pagination->offset)->limit($pagination->limit)->all();
		return $this->render('index',['cates'=>$cates,'pagination'=>$pagination]);
	 }

	 public function actionCreate()
	 {
	 	$model=new problemCate();
	 	if($model->load(yii::$app->request->post()) && $model->validate())
	 	{
	 		$model->save();
	 		return $this->redirect(['index']);
	 	}else{
	 		return $this->render('get',['model'=>$model]);
	 	}
     }

	 public function actionEdit($id)
     {
        $model=ProblemCate::findOne($id);
         if($model->load(yii::$app->request->post()) && $model->validate())
         {
             $model->save();
             return $this->redirect(['index']);
         }
         return $this->render('edit',['model'=>$model]);
     }

	 public function actionDel($id)
	 {
	 	$res=Problem::find()->where(['ProblemId'=>$id])->one();
	 	if($res){
	 		 Yii::$app->getSession()->setFlash('error','该分类下存在问题,禁止删除！');
	 		 return $this->redirect(['index']);
	 	}
	 	problemCate::findOne($id)->delete();
	 	return $this->redirect(['index']);
	 }
}