<?php

use app\models\Kriteria;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
    <?php $form = ActiveForm::begin(); ?>
<div class="col-lg-6">
    <?=
    $form->field($model, 'tanggalBuat')->widget(DatePicker::className(), [
        'name' => 'pilih tanggal',
        'value' => date('Y-M-d', strtotime('+2 days')),
        'options' =>
        [
            'placeholder' => 'Pilih Tanggal ...',
            'onchange' => 'alert(this.val("Y"))',
        ],
        'pluginOptions' =>
        [
            'format' => 'yyyy-m-d',
            'todayHighlight' => true
        ]
    ]);
    ?>
    <?=
    $form->field($model, 'idKriteria')->label('Pilih Kriteria')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Kriteria::find()->all(), 'IdKriteria', 'NamaKriteria'),
        'language' => 'en',
        'options' =>
        [
            'placeholder' => 'Pilih Kriteria',
            'onchange' => '$.post( "../formulir-master/pilih?id=' . '"+$(this).val(), function( data ) {
                        $("#lbPilihan" ).html(data);
                    });',
        ],
        'pluginOptions' =>
        [
            'allowClear' => true
        ],
    ]);
    ?>
    <label>Kriteria Pilihan anda</label>
    <label class="form-control alert-danger" id="lbPilihan"><?= Yii::$app->session['nama'] ?></label>
    <div class="form-group">
<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Simpan') : Yii::t('app', 'Ubah'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
</div>
<div class="col-lg-6">
</div>
<?php ActiveForm::end(); ?>
