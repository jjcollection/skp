<?php

use kartik\icons\Icon;
use yii\helpers\Html;
use app\models\User;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model yii\models\FormulirMaster */

$this->title = $model->idFormulirMaster;
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Formulir Master'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="formulir-master-view">
    <p>

        <?php
        $rolename = User::getRoleName();
        if ($rolename == 'kasek') {
            echo Html::a(Yii::t('yii', Icon::show('wrench') . 'Pengukuran SKP'), ['formulir/createold', 'id' => $model->idFormulirMaster], ['class' => 'btn btn-primary right']);
            echo Html::a(Yii::t('yii', Icon::show('user') . 'Indikator'), ['indikator-nilai/index', 'id' => $model->idFormulirMaster], ['class' => 'btn btn-danger right']);
        } else {
            echo Html::a(Yii::t('yii', Icon::show('plus') . Yii::t('yii', 'Isi Form')), ['/formulir/create', 'id' => $model->idFormulirMaster], ['class' => 'btn btn-info']);
            echo Html::a(Yii::t('yii', Icon::show('print') . Yii::t('yii', 'Target')), ['formulir/export-target-excel', 'id' => $model->idFormulirMaster], ['class' => 'btn btn-primary']);
            echo Html::a(Yii::t('yii', Icon::show('print') . Yii::t('yii', 'Pengukuran')), ['formulir/export-excel-hitung-target', 'id' => $model->idFormulirMaster], ['class' => 'btn btn-success']);
        }
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'tanggalBuat',
                'label' => 'Tanggal Pembuatan',
                'contentOptions' => ['class' => 'col-lg-9'],
            //'format'=>['decimal',2]
            ],
        ],
    ])
    ?>
    <div class="col-lg-6">
        <?=
        DetailView::widget([
            'model' => $modelUser,
            'attributes' =>
            [
                [
                    'attribute' => 'NamaGolongan',
                    'label' => 'Golongan',
                    'contentOptions' => ['class' => 'col-lg-8'],
                // 'format'=>['decimal',2]
                ],
                'UnitKerja',
                [
                    'attribute' => 'NamaJabatan',
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
                    <?php
                    if ($rolename == 'guru') {
                        echo "<td class=\"text-center\">Aksi</td>";
                    }
                    ?>

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

                // $rolename = User::getRoleName();
                if ($rolename == 'guru') {
                    echo "<td class='text-center'>";
                    echo Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['formulir/update', 'id' => $form['IdFormulir']]);
                    echo Html::a('<i class="glyphicon glyphicon-trash"></i>', ['formulir/delete', 'id' => $form['IdFormulir']], ['onclick' => 'return(confirm("Apakah mau dihapus?")?true:false);']);
                    echo "</td>";
                }
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
                    <?php
                    if ($rolename == 'guru') {
                        echo "<td class=\"text-center\">Aksi</td>";
                    }
                    ?>
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

                if ($rolename == 'guru') {
                    echo "<td class='text-center'>";
                    echo Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['formulir/update', 'id' => $form['IdFormulir']]);
                    echo Html::a('<i class="glyphicon glyphicon-trash"></i>', ['formulir/delete', 'id' => $form['IdFormulir']], ['onclick' => 'return(confirm("apakah mau dihapus?")?true:false);', 'data-method' => 'post']);
                    echo "</td>";
                }
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</div>
