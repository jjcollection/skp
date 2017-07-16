<?php

use app\models\Jenisunsur;
use app\models\Unsur;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Unsur */
/* @var $form ActiveForm */
?>

<div class="unsur-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NamaUnsur')->textarea() ?>

   
    
     <?= $form->field($model,'IdJenisUnsur')->label('Jenis Unsur')->dropDownList(
    ArrayHelper::map(Jenisunsur::find()->all(), 'IdJenisUnsur', 'NamaUnsur'),
    [
        'prompt'=>'--Pilih--',
    ]); ?>

    
    <?=$form->field($model, 'Keterangan')->dropDownList(Unsur::getKeterangan(),
[
    'prompt'=>'--Pilih--',
    'onchange'=>'if($(this).val()=="Paket"){$("#unsur-nilai").val("0")} else {$("#unsur-nilai").val("").focus()}'
]); ?>
    
     <?= $form->field($model, 'Nilai')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
