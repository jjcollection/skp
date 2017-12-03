<?php

use app\models\User;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */

$this->title = 'SKP SMPN 8 TANJUNGPINANG';
?>
<div class="site-index">

    <div class="jumbotron">
        <h3 class="text-center">Selamat Datang!</h3>
        <?php
        $rolename = User::getRoleName();
        if ($rolename == 'kasek') {
            echo '<strong>Kepala Sekolah</strong>';
            echo "<p class=\"lead text-center\">Anda Telah berhasil Login</p>";
            echo '<br/>';
            echo Html::a(Yii::t('app', 'Pengukuran Kinerja Pegawai'), ['/formulir-master/kasek'], ['class' => 'btn btn-lg btn-primary text-center', 'style' => 'padding-right:10px;']);
        } else {
            echo "<p class=\"lead text-center\">Anda Telah berhasil Login</p>";
           // echo Html::a(Yii::t('app', 'Mulai Mengisi SKP'), ['/formulir-master/index'], ['class' => 'btn btn-lg btn-success text-center', 'style' => 'padding-right:10px;']);
        }
        ?>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">
                <h3>Keterangan</h3>

                <p> Unsur-Unsur Sasaran Kerja Pegawai</p>
                <ol>
                    <li>Kegiatan Tugas Jabatan
                        Mengacu pada Penetapan Kinerja/RKT. Dalam melaksanakan kegiatan tugas jabatan pada prinsipnya pekerjaan dibagi habis dari tingkat jabatan tertinggi s/d jabatan terendah secara hierarki.
                    </li>
                    <li>Angka Kredit (Fungsional/Guru)</li>
                    <li>Target,Dalam menetapkan target meliputi aspek sbb:
                        <ol type="a">
                            <li>Kuantitas (Target Output)</li>
                            <li>Kualitas (Target Kualitas)</li>
                            <li>Waktu (Target Waktu)</li>
                            <li>Biaya (Target Biaya)</li>
                        </ol>
                    </li>
                </ol>
                <p>Tata Cara Penilaian SKP</p>
                <p>Nilai capaian SKP dinyatakan dengan angka dan keterangan sbb:</p>
                <ol>
                    <li>91 – ke atas : Sangat baik</li>
                    <li>76 – 90 : Baik</li>
                    <li>61 – 75 : Cukup</li>
                    <li>51 – 60 : Kurang</li>
                    <li>50 – ke bawah : Buruk</li>
                </ol>
                <p>Penilaian SKP meliputi aspek kuantitas, kualitas, waktu, dan/atausesuai dengan karakteristik, sifat, dan jenis kegiatan pada masing-masing unit kerja.</p>
            </div>
        </div>
    </div>
</div>
