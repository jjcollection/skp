<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Golongan */

$this->title = $model->idGolongan;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Golongans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="golongan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->idGolongan], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->idGolongan], [
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
            'idGolongan',
            'KodeGolongan',
            'NamaGolongan',
        ],
    ]) ?>

</div>
