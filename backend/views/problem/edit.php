<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpres\Url;
?>
   <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                <?php $form = ActiveForm::begin([
                    'options' => ['enctype' => 'multipart/form-data']]); ?>
                <?= $form->field($model,'ProblemName')->textInput() ?>
                <?= $form->field($model, 'ProblemId')->dropDownList($res, ['prompt'=>'请选择','style'=>'width:120px'])?>
                <?= $form->field($model,'Sort')->textInput() ?>
                <?= $form->field($model,'ProblemAnswer')->widget(\kucha\ueditor\UEditor::className(),[
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
                      ])->label('问题答案') ?>
                    <?=$form->field($model,'Img')->fileInput(['multiple' => true, 'accept' => 'image/*'])  ?>
                    <?=$form->field($model,'IsHot')->radioList(['1'=>'是','0'=>'否'])?>

                <div class="form-group">
                    <?= Html::submitButton('修改', ['class' => 'btn btn-success']) ?>

                </div>

                <?php ActiveForm::end(); ?>
              </div>
            </div>
        </div>
    </div>


