<?php
/**
 * Created by PhpStorm.
 * User: mayunfeng
 * Date: 2017/12/19
 * Time: 20:48
 */

namespace backend\controllers;


use common\enum\EWidgetType;
use frontend\lib\CommonFun;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;


class BaseController extends Controller
{
    public function beforeAction($action)
    {
        // 检测登录
        if (Yii::$app->getUser()->getIsGuest()) {
           Yii::$app->user->setReturnUrl(Yii::$app->request->getUrl());//设置跳转url
            return $this->redirect(Url::toRoute(['/site/login']))->send();
        }

        return parent::beforeAction($action);
    }
}