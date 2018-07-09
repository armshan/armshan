<?php 
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;
?>

	<div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
 
					<a href="<?=Url::toRoute(['create'])?>" class="btn  btn-success btn-primary" role="button">添加分类</a>
		<table border="3" width='900' align="left" height='40'  class="table table-striped">
			<tr >
				<th >分类编号</th>
				<th>分类名称</th>
				<th >分类排序</th>
				<th>操作</th>
			</tr>
		<?php  foreach($cates as $cate): ?>
			<tr>
				<td><?=Html::encode($cate->ID) ?></td>
				<td><?=Html::encode($cate->CateName) ?></td>
				<td><?=Html::encode($cate->Sort) ?></td>
				<td>
					<a href="<?=Url::toRoute(['edit','id'=>$cate->ID])?>" class="btn  btn-info btn-primary" role="button">编辑</a>
		
					<?= Html::a('删除',Url::toRoute(['del','id'=>$cate->ID]), [
                                                    'aria-label'=>'删除',
                                                    'role'=>"button",
                                                    'class' => 'btn  btn-danger btn-primary',
                                                    'data-confirm'=>'请确认该问题分类下，没有问题,在进行删除操作？',
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