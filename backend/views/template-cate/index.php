<?php  
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;
?>


<div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">

<p>模块类别展示</p>

<p><a href="<?=Url::toRoute(['add'])?>"> <button class="btn btn-success">增加新模块</button></a></p>
<table border="3" width='700' align="left" height='40' class="table table-striped">
	<tr >
		<th>Id</th>
		<th >模块类别</th>
		<th>状态</th>
		<th >创建时间</th>
		<th>操作</th>	
	</tr>
	<?php  foreach($temps as $temp): ?>
	<tr>
		<td><?=Html::encode($temp->ID) ?></td>
		<td><?=Html::encode($temp->CateName) ?></td>
		<td><?=Html::encode($temp->IsShow) ?></td>
		<td><?=Html::encode($temp->CreateTime) ?></td>
		<td>
			<a href="<?=Url::toRoute(['del','id'=>Html::encode($temp->ID)])?>" class="btn btn-danger btn-primary"
			   data-confirm='请确认是否要删除该分类？'
			   data-method='post'>删除</a>
			<a href="<?=Url::toRoute(['edit','id'=>Html::encode($temp->ID)])?>" class="btn btn-info btn-primary"
			>修改</a>
		</td>
	</tr>
	<?php endforeach; ?>
</table>



				</div>
            </div>
        </div>
    </div>
<?= LinkPager::widget(['pagination'=>$pagination]) ?>
