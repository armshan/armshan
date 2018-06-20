<?php
/**
 * Created by PhpStorm.
 * User: armshan
 * Date: 2018.5.25
 * Time: 14:50
 */

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>


                <?php $form = ActiveForm::begin();?>

                    <?=$form->field($model,'UserName')?>
                    <?=$form->field($model,'Password')?>
                    <?=$form->field($model,'Status')?>
                     <button><a href="<?=Url::toRoute('index')?>"></a>注册<button>
                    <button><a href="<?=Url::toRoute('register')?>">登录</a></button>

                <?php ActiveForm::end(); ?>





