<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AturanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aturan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'IdAturan') ?>

    <?= $form->field($model, 'IdGolongan') ?>

    <?= $form->field($model, 'IdKriteria') ?>

    <?= $form->field($model, 'AK') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
