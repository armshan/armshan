<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">

		<?php $form = ActiveForm::begin();?>		
				<?=$form->field($model,'CateName')?>
				
				<?php echo $form->field($model, 'IsShow')->radioList(['1'=>'显示','0'=>'不显示']) ?>

				<button>提交</button>
		<?php ActiveForm::end(); ?>
			</div>
		 </div>
		</div>
	  </div>



