<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ArmsUser */

$this->title = 'Update Arms User: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Arms Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="arms-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
