<?php

use yii\bootstrap\Modal;
use yii\data\SqlDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

?>

<h1>Berikut adalah indikator Komitmen : </h1>
<?php
$dataProvider1 = new SqlDataProvider([
    'sql' => 'select * from indikator where idAspek=3'
]);
echo GridView::widget([
    'dataProvider' => $dataProvider1,
    
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'namaIndikator',
    ],
]); 
?>
<?= Html::button('Tambah', ['value' => Url::to('komitmen'), 'class' => 'btn btn-primary right', 'id' => 'modalButtonKomitmen']) ?>
<h1>Indikator yang sudah diisi : </h1>
    <?php
    Modal::begin([
        'header' => '<h4>Aspek Komitmen</h4>',
        'id' => 'Komitmen',
        'size' => 'modal-dialog modal-lg',
    ]);

    echo "<div id='modalContentKomitmen'></div>";

    Modal::end();
    ?>
    <?php Pjax::begin(['id' => 'branchesGridKomitmen']); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProviderKomitmen,
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
