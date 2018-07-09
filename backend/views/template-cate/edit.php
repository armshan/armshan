<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
  <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                  <?php $form = ActiveForm::begin(); ?>
                      <?= $form->field($model, 'CateName')->textInput() ?>
                      <?php echo $form->field($model, 'IsShow')->radioList(['1'=>'显示','0'=>'不显示']) ?>
                      <?= Html::submitButton('修改', ['class' => 'btn btn-success']) ?>
                      <a href="<?=Url::toRoute(['index'])?>" class="list-group-item " >返回主页</a>
                <?php ActiveForm::end(); ?>
  
              </div>
            </div>
        </div>
    </div>


