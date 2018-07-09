<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <p>模块数据展示</p>
                    <ul>
                        <li><label for="">模板编号</label>:<?=Html::encode($temp->ID) ?></li>
                        <li><label for="">模板名称</label>:<?=Html::encode($temp->TemplateName) ?></li>
                        <li><label for="">功能说明</label>:<?=$temp->FunctionIntro ?></li>
                        <li><label for="">备注</label>:<?=Html::encode($temp->Remark) ?></li>
                        <li><label for="">每年价格</label>:<?=Html::encode($temp->Price) ?></li>
                        <li><label for="">每月价格</label>:<?=Html::encode($temp->PriceMonth) ?></li>
                        <li><label for="">功能信息</label>:<?=Html::encode($temp->FuncInfo) ?></li>
                        <li><label for="">上架时间</label>:<?=Html::encode($temp->CreateTime) ?></li>
                        <li><label for="">最近更新</label>:<?=Html::encode($temp->UpdateTime) ?></li>

                        <li><label for="">缩略图</label>:
                                <?php  foreach($ThumbUrl as $ThumbUrl): ?>
                                <img src="<?=$ThumbUrl?>" alt="">
                                 <?php endforeach; ?>
                        </li>
                        <li><label for="">二维码</label>:
                               <?php  foreach($QRCode as $QRCode): ?>
                                <img src="<?=$QRCode?>" alt="">
                                <?php endforeach; ?>
                         </li>
                    </ul>
                    <a href="<?= \yii\helpers\Url::toRoute(['index'])?>" class="btn btn-success " >返回主页</a>
                </div>
            </div>
        </div>
    </div>

