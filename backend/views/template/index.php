<?php 
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;
?>
<div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
						<p>模块数据展示</p>
						<a href="<?=Url::toRoute(['create'])?>"><button class='btn  btn-success btn-primary'>增添数据</button><a/>
						<table border="3" width='900' align="left" height='40'  class="table table-striped">
							<tr >
								<th>Id</th>
								<th >模板名称</th>	
								<th>每年价格</th>
								<th>每月价格</th>
								<th >上架时间</th>
								<th>操作</th>	
							</tr>
							<?php  foreach($temps as $temp): ?>
							<tr>
								<td><?=Html::encode($temp->ID) ?></td>
								<td><?=Html::encode($temp->TemplateName) ?></td>
								<td><?=Html::encode($temp->Price) ?></td>
								<td><?=Html::encode($temp->PriceMonth) ?></td>
								<td><?=Html::encode($temp->CreateTime) ?></td>
								<td>
									<a href="<?=Url::toRoute(['view','id'=>Html::encode($temp->ID)])?>" class="btn btn-info">详情</a>
									<?= Html::a('删除',Url::toRoute(['del','id'=>Html::encode($temp->ID)]), [
										'aria-label'=>'删除',
										'role'=>"button",
										'class' => 'btn  btn-danger btn-primary',
										'data-confirm'=>'请确认是否要删除该问题？',
										'data-method'=>'post',
									])?>
									<a href="<?=Url::toRoute(['update','id'=>Html::encode($temp->ID)])?>" class="btn btn-success">修改</a>
								</td>
							</tr>
							<?php endforeach; ?>
						</table>
					</div>
				</div>
            </div>
        </div>
	<?= LinkPager::widget(['pagination'=>$pagination]) ?>
</div>
