<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UnsurSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="unsur-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'IdUnsur') ?>

    <?= $form->field($model, 'NamaUnsur') ?>

    <?= $form->field($model, 'Nilai') ?>

    <?= $form->field($model, 'IdJenisUnsur') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
