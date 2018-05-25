<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Arms Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="arms-user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Arms User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'UserName',
            'Password',
            'Access-Token',
            'Status',
            //'CreateTime',
            //'UpdateTime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
