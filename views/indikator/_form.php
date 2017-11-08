<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Indikator */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="indikator-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'namaIndikator')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'idAspek')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
