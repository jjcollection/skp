<?php

use app\models\Formulir;
use app\models\Jenisunsur;
use app\models\Unsur;
use app\models\User;
use kartik\icons\Icon;
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
    <?php
    if ($model->hasErrors()) {
        echo CHtml::errorSummary($model);
    }
    ?>

    <div class="col-lg-12">
        <?php //echo $form->textField($model, 'kodeBarang', array('size' => 60, 'maxlength' => 255, 'value' => (($model->isNewRecord) ? $model->generateKode() : $model->kodeBarang), 'readonly' => true)); ?>
        <?=
        $form->field(($model->isNewRecord) ? $model : $model->idUnsur, 'IdJenisUnsur')->label('Jenis Unsur')->dropDownList(
                ArrayHelper::map(Jenisunsur::find()->all(), 'IdJenisUnsur', 'NamaUnsur'), [
            'prompt' => 'Pilih',
            'onchange' => '
                    $.post( "../unsur/lists?id=' . '"+$(this).val(), function( data ) {
                        $("select#formulir-idunsur" ).html( data );
                    });',
            'style' => 'height:auto;width:auto;'
        ]);
        ?>
    </div>
    <div class="col-lg-12">
        <?php
        echo $form->field($model, 'IdUnsur')->label('Unsur')->dropDownList(
                ArrayHelper::map(Unsur::find()->all(), 'IdUnsur', 'NamaUnsur'), [
            'prompt' => '--Pilih Jenis Unsur--',
            'onchange' => '
                        $.post("../unsur/nilai?id=' . '"+$(this).val(), function(data) {
                            $("#formulir-nilai" ).val(data);
                        });',
                //'class' =>'col-xs-12',
        ]);
        ?>  


        <?php
        echo $form->field($model, 'nilai')->hiddenInput(['readonly' => true, 'value' => 0])->label(false);
        ?>
    </div>
    <div class="col-lg-2">
        <?=
        $form->field($model, 'Waktu')->label('Waktu/Bulan')->dropDownList(range(0, 12), [
            'prompt' => '--Pilih--',
            'onchange' => '
            $.post("../unsur/nilai2?id=' . '"+$(this).val(), function(data) {
                $("#formulir-ak" ).val(data);
            });',
        ])
        ?>
        <?php
//        $form->field($model, 'Kuantitas', ['options' =>
//            [
//            //'onchange' => "DateComparisionJavascriptFun()"
//            ]
//        ])->label('Kuantitas')->textInput(['value' => 0])
        ?>
        <?= $form->field($model, 'Kuantitas')->textInput(['maxlength' => true]) ?>

    </div>
    <div class="col-lg-3">
        <?= $form->field($model, 'Output')->dropDownList(Formulir::getOutput(), ['prompt' => '--Pilih--']) ?>
        <?= $form->field($model, 'Biaya')->textInput(['value' => 0]) ?>
    </div>
    <div class="col-lg-2">
        <?php
        $range=range(50, 100);
        $a= array_combine($range, $range);
        echo $form->field($model, 'Mutu')->label('Mutu (%)')->dropDownList($a,['prompt' => '--Pilih--']) ?>
        <?= $form->field($model, 'AK')->label('Angka Kredit')->textInput(['readonly' => true]) ?>
    </div>
    <div class="col-lg-12">

        <div class="form-group">

            <?php
            $rolename = User::getRoleName();
            if ($rolename == 'kasek') {
                echo Html::submitButton(Icon::show('pencil') . 'Simpan', ['formulir/createks', 'class' => 'btn btn-primary']);
            } else {
                echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Simpan') : Yii::t('app', 'Ubah'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
            }
            ?>
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