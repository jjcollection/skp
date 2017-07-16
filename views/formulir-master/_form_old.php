<?php

use common\models\Jenisunsur;
use common\models\Unsur;
use frontend\models\Formulir;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Formulir */
/* @var $form ActiveForm */
?>

<div class="formulir-form">

    <?php $form = ActiveForm::begin(); ?>
   
        <div class="col-lg-12">
            <?= $form->field($model,'IdJenisUnsur')->label('Jenis Unsur')->dropDownList(
            ArrayHelper::map(Jenisunsur::find()->all(), 'IdJenisUnsur', 'NamaUnsur'),
            [
                'prompt'=>'--Pilih Jenis Unsur--',
                'onchange'=>'
                    $.post( "../unsur/lists?id='.'"+$(this).val(), function( data ) {
                        $("select#formulir-idunsur" ).html( data );
                    });',
                'style'=>'height:auto;width:auto;'
            ]); ?>
        </div>
        <div class="col-lg-10">
            <?php 
                echo $form->field($model,'IdUnsur')->label('Unsur')->dropDownList(
                ArrayHelper::map(Unsur::find()->all(), 'IdUnsur', 'NamaUnsur'),
                [
                    'prompt'=>'--Pilih Jenis Unsur--',
                    'onchange'=>'
                        $.post("../unsur/nilai?id='.'"+$(this).val(), function(data) {
                            $("#formulir-nilai" ).val(data);
                        });',
                      //'class' =>'col-xs-12',
                ]); 
            ?>  
    </div>
    <div class="col-lg-2">
        <?php 
            echo $form->field($model,'nilai')->label('Nilai')->textInput(['readonly'=>true,'value'=>0]);
        ?>
    </div>
    <div class="col-lg-2">
        <?=$form->field($model, 'Waktu')->label('Waktu/Bulan')->dropDownList(range(0,12),
        [
            'prompt'=>'--Pilih--',
            'onchange'=>'
            $.post("../unsur/nilai2?id='.'"+$(this).val(), function(data) {
                $("#formulir-ak" ).val(data);
            });',

        ]) ?>
        <?= $form->field($model, 'Kuantitas', 
                ['options' => 
                    [
                        //'onchange' => "DateComparisionJavascriptFun()"
                    ]
                ])->label('Kuantitas')->textInput(['value'=>0]) 
        ?>
        
    </div>
    <div class="col-lg-2">
        <?= $form->field($model, 'Output')->dropDownList(Formulir::getOutput(),['prompt'=>'--Pilih--']) ?>
        <?= $form->field($model, 'Biaya')->textInput(['value'=>0]) ?>
    </div>
    <div class="col-lg-2">
        <?= $form->field($model, 'Mutu')->label('Mutu (%)')->dropDownList(range(0, 100),['prompt'=>'--Pilih--']) ?>
        <?= $form->field($model, 'AK')->label('Angka Kredit')->textInput(['readonly'=>true,'value'=>0]) ?>
    </div>
    <div class="col-lg-12">
 
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Simpan') : Yii::t('app', 'Ubah'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Cetak Ke PDF',['export-pdf'],['class'=>'btn btn-danger']) ?>
    </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>



<?php
//$script = <<< JS
//    alert("Hi");
//    
//JS;
//$this->registerJs($script);
?>