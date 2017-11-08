<?php

use yii\bootstrap\Modal;
use yii\data\SqlDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

?>

<h1>Berikut adalah indikator Disiplin : </h1>
<?php
$dataProvider1 = new SqlDataProvider([
    'sql' => 'select * from indikator where idAspek=4'
]);
echo GridView::widget([
    'dataProvider' => $dataProvider1,
    
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'namaIndikator',
    ],
]); 
?>

<?= Html::button('Tambah', ['value' => Url::to('disiplin'), 'class' => 'btn btn-primary right', 'id' => 'modalButtonDisiplin']) ?>
<h1>Indikator yang sudah diisi : </h1>
    <?php
    Modal::begin([
        'header' => '<h4>Aspek Disiplin</h4>',
        'id' => 'Disiplin',
        'size' => 'modal-dialog modal-lg',
    ]);

    echo "<div id='modalContentDisiplin'></div>";

    Modal::end();
    ?>
    <?php Pjax::begin(['id' => 'branchesGridDisiplin']); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProviderDisiplin,
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
