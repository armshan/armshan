<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\view;
 ?>


 <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
	<p>模块数据展示</p>

			<p>
			<?php $form = ActiveForm::begin(); ?>
			<a href="<?=\yii\helpers\Url::toRoute(['create'])?>" class="btn  btn-success btn-primary" role="button">添加问题</a>

				&nbsp;&nbsp;&nbsp;&nbsp;
			问题分类：<select name="Cate">
					  	<option value ="-1">不限</option>
					  	<?php
					  		foreach ($res as $key => $value){
					  			echo "<option value ='$key'>$value</option>";
					  		}
					  	?>
					</select>
				&nbsp;&nbsp;&nbsp;&nbsp;
			热门问题推荐：<select name="Hot">
					  	<option value ="-1">不限</option>
					  	<option value ="1">是</option>
					  	<option value ="0">否</option>
					</select>
					<input type="hidden" name="token" value="1">
				&nbsp;&nbsp;&nbsp;&nbsp;
				 <?= Html::submitButton('搜索', ['class' => 'btn btn-primary  active']) ?>

				 &nbsp;&nbsp;&nbsp;&nbsp;

				<a href="<?=\yii\helpers\Url::toRoute(['index'])?>" class="btn btn-default active" role="button">重置</a>

				<?php ActiveForm::end(); ?>
	        </p>
				<table border="3" width='900' align="left" height='40'  class="table table-striped">
					<tr >
						<th >问题名称</th>
						<th>问题分类</th>
						<th >热门问题推荐</th>
						<th>问题排序</th>
						<th>操作</th>
					</tr>
					<?php  foreach($problems as $problem): ?>
					<tr>
						<td><?=Html::encode($problem['ProblemName']) ?></td>
						<td><?=Html::encode($problem['CateName']['CateName']) ?></td>

						<td><?=Html::encode(\Yii::$app->formatter->asBoolean($problem['IsHot'])) ?></td>
						<td><?=Html::encode($problem['Sort']) ?></td>
						<td>
						<a href="<?=Url::toRoute(['edit','id'=>$problem['ID']])?>" class="btn  btn-info btn-primary " role="button">编辑</a>
						<?= Html::a('删除',Url::toRoute(['del','id'=>$problem['ID']]), [
				                                                    'aria-label'=>'删除',
				                                                    'role'=>"button",
				                                                    'class' => 'btn  btn-danger btn-primary',
				                                                    'data-confirm'=>'请确认是否要删除该问题？',
				                                                    'data-method'=>'post',
				                                                ])?>
								</td>
							</tr>
						<?php endforeach; ?>
					</table>
 				</div>
            </div>
        </div>
    </div>
<?= LinkPager::widget(['pagination'=>$pagination]) ?>