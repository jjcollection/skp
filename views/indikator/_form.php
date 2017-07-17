<?php

use app\models\Aspek;
use app\models\Indikator;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Indikator */
/* @var $form ActiveForm */
?>

<div class="indikator-form">

    <?php $form = ActiveForm::begin(); ?>

    

    <?=
    $form->field($model, 'idAspek')->label('Aspek')->dropDownList(
            ArrayHelper::map(Aspek::find()->all(), 'idAspek', 'namaAspek'), [
        'prompt' => '--Pilih--',
    ]);
    ?>
    <?= $form->field($model, 'namaIndikator')->textarea(['rows' => 6]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
