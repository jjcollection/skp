<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\IndikatorNilai */

$this->title = $model->idIndikatorNilai;
$this->params['breadcrumbs'][] = ['label' => 'Indikator Nilais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="indikator-nilai-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idIndikatorNilai], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idIndikatorNilai], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idIndikatorNilai',
            'idFormulirMaster',
            'idIndikator',
            'nilai',
        ],
    ]) ?>

</div>
