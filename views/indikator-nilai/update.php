<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\IndikatorNilai */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Indikator Nilai',
]) . $model->idIndikatorNilai;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Indikator Nilais'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idIndikatorNilai, 'url' => ['view', 'id' => $model->idIndikatorNilai]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="indikator-nilai-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
