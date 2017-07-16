<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FormulirSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="formulir-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'IdFormulir') ?>

    <?= $form->field($model, 'IdUser') ?>

    <?= $form->field($model, 'Kuantitas') ?>

    <?= $form->field($model, 'Output') ?>

    <?= $form->field($model, 'Mutu') ?>

    <?php // echo $form->field($model, 'Waktu') ?>

    <?php // echo $form->field($model, 'Biaya') ?>

    <?php // echo $form->field($model, 'AK') ?>

    <?php // echo $form->field($model, 'IdUnsur') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
