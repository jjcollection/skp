<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\KreditSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kredit-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'No') ?>

    <?= $form->field($model, 'Kode') ?>

    <?= $form->field($model, 'Kegiatan') ?>

    <?= $form->field($model, 'Keterangan') ?>

    <?= $form->field($model, 'NIlai') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
