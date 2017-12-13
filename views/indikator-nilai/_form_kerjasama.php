<?php

use app\models\Indikator;
use app\models\IndikatorNilai;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model IndikatorNilai */
/* @var $form ActiveForm */
?>

<div class="indikator-nilai-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName()]); ?>

    <h3>Penilaian Indkator</h3>
    <?php
    echo '<label class="control-label">Indikator</label>';
    echo Select2::widget([
        'model' => $model,
        'attribute' => 'idIndikator',
        'data' => ArrayHelper::map(\app\models\Indikator::findAll(['idAspek'=>5]), 'idIndikator', 'namaIndikator'),
        'options' => [
            'placeholder' => 'Pilih ...',
        //'multiple' => true
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?> 
    <?php
    echo '<label class="control-label">Nilai</label>';
    echo Select2::widget([
        'model' => $model,
        'attribute' => 'nilai',
        'data' => [0 => 0, 1 => 1, 2 => 2],
        'options' => [
            'placeholder' => 'Pilih ...',
        //'multiple' => true
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?> 
    <br/>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS

$('form#{$model->formName()}').on('beforeSubmit', function(e) 
{
   var \$form = $(this);
    $.post(
        \$form.attr("action"), // serialize Yii2 form
        \$form.serialize()
    )
        .done(function(result) {
        if(result == 1)
        {
            $(\$form).trigger("reset");
            $.pjax.reload({container:'#branchesGridKerjasama'});
        }else
        {        
            $("#message").html(result);
        }
        }).fail(function() 
        {
            console.log("server error");
        });
    return false;
});

JS;
$this->registerJs($script);
?>


