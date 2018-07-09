<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
  		
				<h1>添加分类</h1>
					<?php $form = ActiveForm::begin();?>
	
  
						<?=$form->field($model,'CateName')?>

						<?=$form->field($model,'Sort')?>


						<button>提交</button>
		

					<?php ActiveForm::end(); ?>
				</div>
			</div>
		</div>
	</div>



