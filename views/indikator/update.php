<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Indikator */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Indikator',
]) . $model->idIndikator;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Indikators'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idIndikator, 'url' => ['view', 'id' => $model->idIndikator]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="indikator-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
