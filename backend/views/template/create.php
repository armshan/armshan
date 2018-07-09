<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-body">
                            <?php $form = ActiveForm::begin([
                                 'options' => ['enctype' => 'multipart/form-data']
                                ]);?>
                                    <?=$form->field($model,'TemplateName')?>
                                    <?=$form->field($model,'TemplateId')?>
                                    <?= $form->field($model,'FunctionIntro')->widget(\kucha\ueditor\UEditor::className(),[
                                                'clientOptions' => [
                                                    //编辑区域大小
                                                    'initialFrameHeight' => '200',
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
                                            ]) ?>
                                    <?=$form->field($model,'FuncInfo')?>
                                    <?=$form->field($model,'Price')?>
                                    <?=$form->field($model,'PriceMonth')?>
                                    <?=$form->field($model,'Remark')?>
                                    <?=$form->field($model,'ThumbUrl[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])  ?>
                                    <?=$form->field($model,'QRCode[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])  ?>
                                    <button>提交</button>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>



