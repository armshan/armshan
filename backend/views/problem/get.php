<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>


 <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">	
	<h1>添加问题</h1>
        <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data']]);?>
	
		<?=$form->field($model,'ProblemName')?>
        <?php echo $form->field($model, 'ProblemId')->dropDownList($res, ['prompt'=>'请选择','style'=>'width:120px']) ?>
		<?=$form->field($model,'Sort')?>
		<?= $form->field($model,'ProblemAnswer')->widget(\kucha\ueditor\UEditor::className(),[
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


        <?=$form->field($model,'Img')->fileInput(['multiple' => true, 'accept' => 'image/*'])  ?>
		<?=$form->field($model,'IsHot')->radioList(['1'=>'是','0'=>'否'])?>
		<button class="btn btn-primary active">立即提交</button>
        <?= Html::resetButton('重置', ['class'=>'btn btn-default active','name' =>'submit-button']) ?>
        <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>




