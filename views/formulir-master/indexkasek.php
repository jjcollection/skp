<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel yii\models\FormulirMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('yii', 'Formulir Master');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12">
    <div class="row">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="col-lg-6">
            <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
    </div>
   
    <div class="row">
        <p>
        <?= Html::a(Yii::t('yii', \kartik\icons\Icon::show('plus').'Tambah Formulir Baru'), ['create'], ['class' => 'btn btn-success']) ?>
        <a href="index.php"></a>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'tanggalBuat',
                'label' => 'Tanggal Pembuatan',
                'contentOptions' => ['class' => 'col-lg-4'],
                //'format'=>['decimal',2]
            ],
            [
                'attribute'=>'idUser0.Nama',
                'label' => 'Nama',
                'contentOptions' => ['class' => 'col-lg-5'],
                //'format'=>['decimal',2]
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
    
</div>
