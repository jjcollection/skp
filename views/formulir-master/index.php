<?php

use app\models\FormulirMasterSearch;
use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $searchModel FormulirMasterSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = Yii::t('app', 'Formulir Masters');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12">
    <div class="row">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="col-lg-6">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
    </div>

    <div class="row">
        <p>
            <?= Html::a(Yii::t('app', Icon::show('plus') . 'Tambah Formulir Baru'), ['create'], ['class' => 'btn btn-success']) ?>
            <a href="index.php"></a>
        </p>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            // 'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'tanggalBuat',
                    'label' => 'Tanggal Pembuatan',
                    'contentOptions' => ['class' => 'col-lg-9'],
//                    'format'=>['decimal',2]
                ],
//            [
//                'class' => 'yii\grid\ActionColumn',
//                'template' => '{view} {update} {delete} {target} {pengukuran} {penilaian} {rekomendasi}', // the default buttons + your custom button
//                'buttons' => [
//                    'target' => function($url, $model, $key) {     // render your custom button
//                        return Html::a(' | '.Icon::show('print'),'../formulir/export-pdf',['title' => 'Cetak Target','id'=>$model->idFormulirMaster]);
//                    },
//                    'pengukuran' => function($url, $model, $key) {     // render your custom button
//                        return Html::a(' | '.Icon::show('print'),'../formulir/export-hitung-pdf',['title' => 'Cetak Pengukuran']);
//                    },
//                    'penilaian' => function($url, $model, $key) {     // render your custom button
//                        return Html::a(Icon::show('print'),'../formulir/export-hitung-pdf',['title' => 'Cetak Penilaian']);
//                    },
//                    'rekomendasi' => function($url, $model, $key) {     // render your custom button
//                        return Html::a(Icon::show('print'),'../formulir/export-hitung-pdf',['title' => 'Cetak Rekomendasi']);
//                    }
//                ],
//            ]
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        ?>
    </div>

</div>
