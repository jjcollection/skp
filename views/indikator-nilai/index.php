<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\IndikatorNilaiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Indikator Nilais');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="indikator-nilai-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Indikator Nilai'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idIndikatorNilai',
            'idFormulirMaster',
            'idIndikator',
            'nilai',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
