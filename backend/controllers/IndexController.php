<?php
namespace backend\controllers;

use common\library\models\UserLogon;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class IndexController extends BaseController
{

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        //return Yii::$app->db;
        return $this->render('index');
    }

}
