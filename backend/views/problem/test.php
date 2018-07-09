<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Problem */
/* @var $form ActiveForm */
?>
<div class="test">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'ProblemId') ?>
        <?= $form->field($model, 'Sort') ?>
        <?= $form->field($model, 'IsHot') ?>
        <?= $form->field($model, 'Click') ?>
        <?= $form->field($model, 'ProblemName') ?>
        <?= $form->field($model, 'ProblemAnswer') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- test -->
