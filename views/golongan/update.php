<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Golongan */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Golongan',
]) . ' ' . $model->idGolongan;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Golongans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idGolongan, 'url' => ['view', 'id' => $model->idGolongan]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="golongan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
