<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
  <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <?php $form = ActiveForm::begin(); ?>

                        <?=$form->field($model,'CateName')->textInput()?>

                        <?=$form->field($model,'Sort')->textInput()?>
      
                        <?= Html::submitButton('修改', ['class' => 'btn btn-success']) ?>
                    <?php ActiveForm::end(); ?>
              </div>
          </div>
      </div>
  </div>


