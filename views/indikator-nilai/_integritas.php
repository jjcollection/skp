<?php

use yii\bootstrap\Modal;
use yii\data\SqlDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

?>

<h1>Berikut adalah indikator Integritas : </h1>
<?php
$dataProvider1 = new SqlDataProvider([
    'sql' => 'select * from indikator where idAspek=2'
]);
echo GridView::widget([
    'dataProvider' => $dataProvider1,
    
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'namaIndikator',
    ],
]); 
?>

<?= Html::button('Tambah', ['value' => Url::to('integritas'), 'class' => 'btn btn-primary right', 'id' => 'modalButtonIntegritas']) ?>
<h1>Indikator yang sudah diisi : </h1>
    <?php
    Modal::begin([
        'header' => '<h4>Aspek Integritas</h4>',
        'id' => 'Integritas',
        'size' => 'modal-dialog modal-lg',
    ]);

    echo "<div id='modalContentIntegritas'></div>";

    Modal::end();
    ?>
    <?php Pjax::begin(['id' => 'branchesGridIntegritas']); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProviderIntegritas,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'idIndikator0.namaIndikator',
            [
                'attribute' => 'nilai',
                'headerOptions' => ['style' => 'width:5%','class'=>'center'],
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
