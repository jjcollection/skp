<?php

use app\models\Aturan;
use app\models\Golongan;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Aturan */
/* @var $form ActiveForm */
?>

<div class="aturan-form">

    <?php $form = ActiveForm::begin(); ?>


    <?php
    $items = ArrayHelper::map(Golongan::find()->all(), 'idGolongan', 'NamaGolongan');
    echo $form->field($model, 'IdGolongan')->dropDownList($items)->label('Golongan')
    ?>

    <?php
    $items = ArrayHelper::map(\app\models\Kriteria::find()->all(), 'IdKriteria', 'NamaKriteria');
    echo $form->field($model, 'IdKriteria')->dropDownList($items)->label('Kriteria')
    ?>

    <?= $form->field($model, 'AK')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
