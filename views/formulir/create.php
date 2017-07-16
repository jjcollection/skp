<?php

use app\models\Formulir;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Formulir */

$this->title = Yii::t('app', 'Formulir SKP');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Formulirs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="formulir-create">
    <div class="col-lg-12 alert alert-info text-center">
        <h3><strong>Selamat Datang</strong></h3>
        <h4><strong>Berikut ini adalah halaman pengisian formulir SKP</strong></h4>
    </div>
    <div class="col-lg-6">
        <?=
        DetailView::widget([
            'model' => $modelUser,
            'attributes' =>
            [
                [
                    'attribute' => 'idGolongan0.KodeGolongan',
                    'label' => 'Golongan',
                    'contentOptions' => ['class' => 'col-lg-8'],
                // 'format'=>['decimal',2]
                ],
                'UnitKerja',
                [
                    'attribute' => 'idJabatan.NamaJabatan',
                    'label' => 'Jabatan',
                    'contentOptions' => ['class' => 'col-lg-8'],
                ],
            ],
        ])
        ?>
    </div>

    <div class="col-lg-6">
        <?=
        DetailView::widget([
            'model' => $modelUser,
            'attributes' =>
            [
                'NIP',
                'Nama',
                'Agama',
            ],
        ])
        ?>
    </div>

    <div class="col-lg-12">
        <h5 class="alert alert-success"><strong>TARGET PENCAPAIAN</strong></h5>
    </div>

<?=
$this->render('_form', [
    'model' => $model,
])
?>


    <div class="col-lg-12">
        <div class="col-lg-12">
            <h5 class="alert alert-success"><strong>UNSUR UTAMA</strong></h5>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <td class="text-center">No</td>
                    <td class="text-center">Nama Unsur</td>
                    <td class="text-center">Angka Kredit</td>
                    <td class="text-center">Kuantitas</td>
                    <td class="text-center">Output</td>
                    <td class="text-center">Kualitas/Mutu</td>
                    <td class="text-center">Waktu</td>
                    <td class="text-center">Biaya</td>
                    <td class="text-center">Aksi</td>
                </tr>
            </thead>
            
            <?php
            $i = 1;
            foreach ($formulirUtama as $form) {
                echo "<tr>";
                echo "<td class='text-center'>" . $i++ . "</td>";
                echo "<td class='text-left'>" . $form['NamaUnsur'] . "</td>";
                echo "<td class='text-center'>" . $form['AK'] . "</td>";
                echo "<td class='text-center'>" . $form['Kuantitas'] . "</td>";
                echo "<td class='text-center'>" . $form['Output'] . "</td>";
                echo "<td class='text-center'>" . $form['Mutu'] . "</td>";
                echo "<td class='text-center'>" . $form['Waktu'] . "</td>";
                echo "<td class='text-center'>" . $form['Biaya'] . "</td>";
                echo "<td class='text-center'>";
                //echo Html::a('<i class="glyphicon glyphicon-pencil"></i>',['formulir/update','id'=>$form['IdFormulir']]);
                echo Html::a('<i class="glyphicon glyphicon-trash"></i>', ['formulir/delete', 'id' => $form['IdFormulir']], ['onclick' => 'return(confirm("apakah mau dihapus?")?true:false);', 'data-method' => 'post']);
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>

    <div class="col-lg-12">
        <div class="col-lg-12">
            <h5 class="alert alert-success"><strong>UNSUR PENUNJANG</strong></h5>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <td class="text-center">No</td>
                    <td class="text-center">Nama Unsur</td>
                    <td class="text-center">Angka Kredit</td>
                    <td class="text-center">Kuantitas</td>
                    <td class="text-center">Output</td>
                    <td class="text-center">Kualitas/Mutu</td>
                    <td class="text-center">Waktu</td>
                    <td class="text-center">Biaya</td>
                    <td class="text-center">Aksi</td>
                </tr>
            </thead>
                <?php
                $i = 1;
                foreach ($formulirPenunjang as $form) {
                    echo "<tr>";
                    echo "<td class='text-center'>" . $i++ . "</td>";
                    echo "<td class='text-left'>" . $form['NamaUnsur'] . "</td>";
                    echo "<td class='text-center'>" . $form['AK'] . "</td>";
                    echo "<td class='text-center'>" . $form['Kuantitas'] . "</td>";
                    echo "<td class='text-center'>" . $form['Output'] . "</td>";
                    echo "<td class='text-center'>" . $form['Mutu'] . "</td>";
                    echo "<td class='text-center'>" . $form['Waktu'] . "</td>";
                    echo "<td class='text-center'>" . $form['Biaya'] . "</td>";
                    echo "<td class='text-center'>";
//                echo Html::a('<i class="glyphicon glyphicon-pencil"></i>',['formulir/update','id'=>$form['IdFormulir']]);
                    echo Html::a('<i class="glyphicon glyphicon-trash"></i>', ['formulir/delete', 'id' => $form['IdFormulir']], ['onclick' => 'return(confirm("apakah mau dihapus?")?true:false);', 'data-method' => 'post']);
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
        </table>
        <?php
//            $idformulirmaster = Yii::$app->session['idFB'];
//            $jmlskp = Yii::$app->db->createCommand("SELECT AVG(AK) AS jml FROM formulir WHERE idFormulirMaster=$idformulirmaster")->queryScalar();
//            $roundJmlSKP=round($jmlskp, 2);
        ?>
<!--        <div class="col-lg-12">
            <h5 class="alert alert-info"><strong>Jumlah : <?php //$roundJmlSKP?></strong></h5>
        </div>-->
    </div>
</div>

