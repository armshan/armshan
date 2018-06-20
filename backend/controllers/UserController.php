<?php

namespace backend\controllers;

use Yii;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArmsUserController implements the CRUD actions for ArmsUser model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $model=new User();
        if($model->load(Yii::$app->getRequest()->post())  && $model->validate()){
                $model->save();
        }

        return $this->render('index',compact('model'));
    }

    public function actionRegister()
    {
        $model=new User();
        var_dump(Yii::$app->getRequest()->getBodyParams());
       return $this->render('register',compact('model'));
    }

}
