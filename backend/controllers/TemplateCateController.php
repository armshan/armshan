<?php  
namespace backend\controllers;


use Codeception\Util\Template;
use yii;
use yii\db\Connection;
use common\models\TemplateCate;
use yii\data\Pagination;


class TemplateCateController extends BaseController
{
    public function actionIndex()
    {
        $query = TemplateCate::find();
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);
        $temps= $query->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('index', ['temps' => $temps, 'pagination' => $pagination]);

        /*$query=TemplateCate::find();
       $temps=$query->limit('5')->all();
       return $this->render('index',['temps'=>$temps]);*/
    }

    public function actionAdd()
    {
        $model = new TemplateCate();
        if ($model->load(yii::$app->request->post()) && $model->validate()) {
            $model->CreateTime = date("Y-m-d H:i", time());
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('add', ['model' => $model]);
        }
    }

    public function actionEdit($id)
    {
        $model=TemplateCate::findOne($id);
        if($model->load(yii::$app->request->post()) && $model->validate())
        {
            $model->save();
            return $this->redirect(['index']);
        }
        return $this->render('edit',['model'=>$model]);
    }

	 public function actionDel($id)
	 {
        TemplateCate::findOne($id)->delete();
	 	return $this->redirect(['index']);
	 }






}