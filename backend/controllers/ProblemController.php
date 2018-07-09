<?php  
namespace backend\controllers;


use InsideAPI\Models\Permission\Pro;
use yii;
use yii\web\UploadedFile;
use yii\db\Connection;
use yii\web\Controller;
use common\models\Problem;
use common\models\ProblemCate;
use yii\data\Pagination;
use yii\helpers\Url;
use yii\base\Exception;
use yii\web\UnprocessableEntityHttpException;
use common\library\upload\NewUpload;

class ProblemController extends BaseController
{

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
    	$query=Problem::find();
	 	$res=ProblemCate::finds();
		$pagination=new Pagination([
		    'defaultPageSize'=>2,
		    'totalCount'=>$query->count(),
			]);

    	//搜索选项入口
    	if(isset($_POST['token']))
    	{
		    if($_POST['Cate']=='-1'){

	 		}else{
				
	 			$query->where(["ProblemId"=>$_POST['Cate']]);
	 		}
	 		if($_POST['Hot']=='-1'){

	 		}else{
	 			$query->andWhere(['IsHot'=>$_POST['Hot']]);
	 		}
			$problems=$query->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
			//构建问题所属分类信息
			foreach ($problems as $key => $value) {
					 $problems[$key]['CateName']=ProblemCate::find()->where(['ID'=>$value['ProblemId']])->asArray()->one();
			}
	 	}else{
	 		$problems=$query->asArray()->offset($pagination->offset)->limit($pagination->limit)->all();
			//构建问题所属分类信息
			foreach ($problems as $key => $value) {
					 $problems[$key]['CateName']=ProblemCate::find('CateName')->where(['ID'=>$value['ProblemId']])->asArray()->one();
			}
	 	}
		return $this->render('index',['problems'=>$problems,'pagination'=>$pagination,'res'=>$res]);


    }


	 public function actionCreate()
     {
         $model = new Problem();

         $res = ProblemCate::finds();

         if ($model->load(yii::$app->request->post()) && $model->validate()) {
             empty($model->ProblemName) ? :Yii::$app->session->setFlash('error', '后台管理地址格式不对,请重新设置');
             $model->Click = 0;
             $model->save();
             return $this->redirect(['index']);
         } else {
             return $this->render('get', ['model' => $model, 'res' => $res]);
         }
     }

	 public function actionEdit($id)
     {
         $model=Problem::findOne($id);
         $res=ProblemCate::finds();
         if($model->load(yii::$app->request->post()) && $model->validate()){

             $baidu= new NewUpload();
             $files = UploadedFile::getInstances($model,'Img');
             if(empty($files)){
                 $model->Img=$model->getOldAttribute('Img');
             }else {
                 foreach ($files as $file) {
                     $res[] = $baidu->Upload($file, NewUpload::bucketA);
                 }
             }
             $model->save();
             return $this->redirect('index');
         }
         return $this->render('edit',['model'=>$model,'res'=>$res]);
     }

	 public function actionDel($id)
	 {
         Problem::findOne($id)->delete();
	 	return $this->redirect(['index']);
	 }



	 public function actionTest()
     {

         $model=new NewUpload();
         ///返回当前库图片列表
         $response=$model->listObjects();
//         ///返回当前库列表
//         $response=$model->listBuckets();
//         /// //库是否存在
      //   $response=$model->doesBucketExist('xltg-look');
         echo "<pre>";
         var_dump($response);
         exit;

     }
}
