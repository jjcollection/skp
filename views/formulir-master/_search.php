<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model yii\models\FormulirMasterSearch */
/* @var $form ActiveForm */
?>

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
        <?= $form->field($model, 'tanggalBuat')->widget(DatePicker::className(),[
            'name' => 'pilih tanggal', 
            'value' => date('Y-M-d', strtotime('+2 days')),
            'options' => 
            [
                'placeholder' => 'Pilih Tanggal ...',
            ],
            'pluginOptions' => 
            [
                'format' => 'yyyy-m-d',
                'todayHighlight' => true
            ]
        ]);
        ?>
        <?= Html::submitButton(Yii::t('yii', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('yii', 'Reset'), ['class' => 'btn btn-default']) ?>
    <?php ActiveForm::end(); ?>
