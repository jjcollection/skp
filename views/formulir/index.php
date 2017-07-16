<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FormulirSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Formulirs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="formulir-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Formulir'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'IdFormulir',
            'Kuantitas',
            'Output',
            'Mutu',
            // 'Waktu',
            // 'Biaya',
            // 'AK',
            // 'IdUnsur',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
