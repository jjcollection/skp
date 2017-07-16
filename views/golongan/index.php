<?php

use app\models\GolonganSearch;
use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $searchModel GolonganSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = Yii::t('app', 'Golongan');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="golongan-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //echo Icon::show('user');?>
        <?php // Icon::show('music', [], Icon::BSG) ?>
        <?= Html::a(Yii::t('app', Icon::show('send', [], Icon::BSG).'Tambah Golongan'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'KodeGolongan',
            'NamaGolongan',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
