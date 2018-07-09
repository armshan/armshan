<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;


?>
 <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">

                <?php $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data']]); ?>
                <?=$form->field($model, 'TemplateName')->textInput()?>

                <?=$form->field($model,'TemplateId')->textInput(['readonly' => 'true'])?>
                 <?= $form->field($model,'FunctionIntro')->widget(\kucha\ueditor\UEditor::className(),[
                          'clientOptions' => [
                              //编辑区域大小
                              'initialFrameHeight' => '300',
                              //设置语言
                              'lang' =>'zh-cn', //中文为 zh-cn
                              //定制菜单
                              'toolbars' => [
                                  [
                                      'fullscreen', 'source', 'undo', 'redo', '|',
                                      'fontsize',
                                      'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'removeformat',
                                      'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|',
                                      'forecolor', 'backcolor', '|',
                                      'lineheight', '|',
                                      'indent', '|',
                                      'simpleupload', '|',//单图上传
                                      'insertimage','|',
                                  ],
                              ]
                          ]
                      ])->label('产品详情：') ?>
                <?=$form->field($model, 'Remark')->textInput() ?>
                <?=$form->field($model, 'Price')->textInput() ?>
                <?=$form->field($model,'PriceMonth')->textInput()?>
                <?=$form->field($model,'FuncInfo')->textInput() ?>
                <?=$form->field($model,'ThumbUrl[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])  ?>
                <?=$form->field($model,'QRCode[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])  ?>
                <?=$form->field($model,'IsShow')->checkbox() ?>
                <div class="form-group">
                    <?= Html::submitButton('修改', ['class' => 'btn btn-success']) ?>
                   <a href="<?= \yii\helpers\Url::toRoute(['index'])?>" class="list-group-item " >返回主页</a>
                </div>

                <?php ActiveForm::end(); ?>
                </div>


