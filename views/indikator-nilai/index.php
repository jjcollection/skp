<?php

use app\models\IndikatorNilaiSearch;
use kartik\tabs\TabsX;
use yii\data\ActiveDataProvider;
use yii\jui\Tabs;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $searchModel IndikatorNilaiSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Indikator Nilai';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
echo TabsX::widget([
    'position' => TabsX::POS_ABOVE,
    'align' => TabsX::ALIGN_LEFT,
    'items' => [
        [
            'label' => 'Pelayanan',
            'content' => $this->render('_pelayanan', ['dataProviderPelayanan' => $dataProviderPelayanan, 'searchModel' => $searchModel,'idaktif'=>1]),
            'active' => true
        ],
        [
            'label' => 'Integritas',
            'content' =>  $this->render('_integritas', ['dataProviderIntegritas' => $dataProviderIntegritas, 'searchModel' => $searchModel,'idaktif'=>2]),
            'headerOptions' => ['style' => 'font-weight:bold'],
           // 'options' => ['id' => 'myveryownID'],
        ],
        [
            'label' => 'Komitmen',
            'content' =>  $this->render('_komitmen', ['dataProviderKomitmen' => $dataProviderKomitmen, 'searchModel' => $searchModel,'idaktif'=>3]),
            'headerOptions' => ['style' => 'font-weight:bold'],
           // 'options' => ['id' => 'myveryownID'],
        ],
        [
            'label' => 'Disiplin',
            'content' =>  $this->render('_disiplin', ['dataProviderDisiplin' => $dataProviderDisiplin, 'searchModel' => $searchModel,'idaktif'=>4]),
            'headerOptions' => ['style' => 'font-weight:bold'],
           // 'options' => ['id' => 'myveryownID'],
        ],
        [
            'label' => 'Kerjasama',
            'content' =>  $this->render('_kerjasama', ['dataProviderKerjasama' => $dataProviderKerjasama, 'searchModel' => $searchModel,'idaktif'=>5]),
            'headerOptions' => ['style' => 'font-weight:bold'],
           // 'options' => ['id' => 'myveryownID'],
        ],
        [
            'label' => 'Kepemimpinan',
            'content' =>  $this->render('_kepemimpinan', ['dataProviderKepemimpinan' => $dataProviderKepemimpinan, 'searchModel' => $searchModel,'idaktif'=>6]),
            'headerOptions' => ['style' => 'font-weight:bold'],
           // 'options' => ['id' => 'myveryownID'],
        ],
    ],
]);
?>

</div>
