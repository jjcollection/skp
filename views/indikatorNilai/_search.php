<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\IndikatorNilaiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="indikator-nilai-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idIndikatorNilai') ?>

    <?= $form->field($model, 'idFormulirMaster') ?>

    <?= $form->field($model, 'idIndikator') ?>

    <?= $form->field($model, 'nilai') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
