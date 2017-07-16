<?php

/* @var $this View */
/* @var $form ActiveForm */
/* @var $model \frontend\models\SignupForm */

use app\models\Golongan;
use app\models\Jabatan;
use app\models\Pegawai;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;

$this->title = 'Registrasi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Silahkan isi kolom dibawah untuk melakukan Registrasi:</p>

    <div class="row">
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
        <div class="col-sm-5">
            <?= $form->field($model, 'NIP')->label("NIP")->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'Nama')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
        </div>
        <div class="col-sm-5">
            <?=$form->field($model, 'Agama')->dropDownList(Pegawai::getAgama()) ?>
            <?= $form->field($model, 'Telp')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'UnitKerja')->textInput(['maxlength' => true]) ?>
            <?php $items = ArrayHelper::map(Golongan::find()->all(), 'idGolongan', 'NamaGolongan');
            echo $form->field($model, 'IdGolongan')->dropDownList($items)->label('Golongan')?>
            <?php $items = ArrayHelper::map(Jabatan::find()->all(), 'IdJabatan', 'NamaJabatan');
            echo $form->field($model, 'IdJabatan')->dropDownList($items)->label("Jabatan")?>
            <?= $form->field($model, 'Alamat')->textarea(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-10">
            <div class="form-group">
                <div class="text-center">
                    <?= Html::submitButton('<i class="icon-user"></i> Registrasi', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
