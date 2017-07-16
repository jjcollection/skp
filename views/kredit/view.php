<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Kredit */

$this->title = $model->No;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kredits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kredit-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->No], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->No], [
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
            'No',
            'Kode',
            'Kegiatan:ntext',
            'Keterangan',
            'NIlai',
        ],
    ]) ?>

</div>
