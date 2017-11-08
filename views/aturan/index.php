<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AturanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Aturans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aturan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Aturan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'idGolongan.KodeGolongan',
            'idGolongan.NamaGolongan',
            'idKriteria.NamaKriteria',
            'AK',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
