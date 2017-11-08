<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\IndikatorNilai */

$this->title = 'Update Indikator Nilai: ' . $model->idIndikatorNilai;
$this->params['breadcrumbs'][] = ['label' => 'Indikator Nilais', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idIndikatorNilai, 'url' => ['view', 'id' => $model->idIndikatorNilai]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="indikator-nilai-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
