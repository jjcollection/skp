<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Indikator */

$this->title = $model->idIndikator;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Indikators'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="indikator-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->idIndikator], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->idIndikator], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idIndikator',
            'namaIndikator:ntext',
            'idAspek',
        ],
    ]) ?>

</div>
