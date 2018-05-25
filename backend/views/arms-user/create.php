<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ArmsUser */

$this->title = 'Create Arms User';
$this->params['breadcrumbs'][] = ['label' => 'Arms Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="arms-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
