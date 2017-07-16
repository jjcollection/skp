<?php

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model app\models\Formulir */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Formulir',
]) . $model->IdFormulir;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Formulirs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->IdFormulir, 'url' => ['view', 'id' => $model->IdFormulir]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="formulir-update">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="col-lg-12 alert alert-info text-center">
        <h3><strong>Selamat Datang</strong></h3>
        <h4><strong>Berikut ini adalah halaman pengisian formulir SKP</strong></h4>
    </div>
    <div class="col-lg-6">
        
    </div>

    <div class="col-lg-6">
        
    </div>

    <div class="col-lg-12">
        <h5 class="alert alert-success"><strong>TARGET PENCAPAIAN</strong></h5>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
