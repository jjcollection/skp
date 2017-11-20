<?php

use app\assets\AppAsset;
use app\models\FormulirMaster;
use app\models\User;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;

AppAsset::register($this);
// Initialize framework as per <code>icon-framework</code> param in Yii config
Icon::map($this);
// Initialize a specific framework - e.g. Web Hosting Hub Glyphs 
Icon::map($this, Icon::WHHG);
/**
 * @var $this \yii\base\View
 * @var $content string
 */
// $this->registerAssetBundle('app');
?>
<?php $this->beginPage(); ?>

<html>
    <head>
        <!--Import materialize.css-->
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>

    <body class="belakang">
        <?php $this->beginBody() ?>
        <div class="container bg-white">

            <!-- Navbar goes here -->

            <nav>
                <div class="nav-wrapper cyan darken-3">
                  <!--<a href="#" class="brand-logo right"><?php // echo Html::encode(\Yii::$app->name);   ?></a>-->
                    <?php
                    $menuItems = [
                        ['label' => 'Home', 'url' => ['/site/index']],
                        ['label' => 'Profile', 'url' => ['/site/about']],
                    ];
                    if (Yii::$app->user->isGuest) {
                      //  $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
                    } else {
                        // Yii::$app->session->remove('idFB');
                        //        $model =new FormulirMaster();
//                         $role = Yii::$app->user->identity->role;
//                         echo $role;
//                         exit();
                        $rolename = User::getRoleName();
                       
                        $idUser = Yii::$app->user->getId();
                        $cekformulirMaster = Yii::$app->db->createCommand("select count(*) from formulir_master where idUser=" . $idUser . " and tahun=" . date('Y') . "")->queryScalar();
                        $ListformulirMaster = Yii::$app->db->createCommand("select * from formulir_master where idUser=" . $idUser . " and tahun=" . date('Y') . "")->queryOne();
                        $cekformulir = Yii::$app->db->createCommand("select count(*) from formulir where idFormulirMaster='" . $ListformulirMaster['idFormulirMaster'] . "'")->queryScalar();
                        if ($rolename == 'kasek') {
                            $menuItems[] = ['label' => 'Formulir Pegawai', 'url' => ['/formulir-master/kasek']];
                        }else if($rolename == 'admin'){
                             $menuItems[] = ['label' => 'Input Pegawai', 'url' => ['/site/signup']];
                        } 
                        else if (($cekformulir == 0) && ($cekformulirMaster == 1)) {
                            $menuItems[] = ['label' => 'Formulir', 'url' => ['/formulir/index']];
                        } else if (($cekformulir >= 1) && ($cekformulirMaster == 1)) {
                            $menuItems[] = ['label' => 'Formulir', 'url' => ['/formulir-master/index']];
                        } else {
                            $menuItems[] = ['label' => 'Formulir Baru', 'url' => ['/formulir-master/create']];
                        }
                        $menuItems[] = array('url' => '#', 'template' =>
                            Html::beginForm(array('site/logout'))
                            . Html::submitButton('Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-default brand-logo right cyan darken-3'])
                            . Html::endForm());
                    }

                    echo Menu::widget([
                        'options' => [
                            "id" => "nav-mobile",
                            "class" => "left side-nav"
                        ],
                        'items' => $menuItems,
                    ]);
                    ?>
                    <a class="button-collapse" href="#" data-activates="nav-mobile"><i class="mdi-navigation-menu"></i></a>
                </div>
            </nav>

            <!-- Page Layout here -->
            <div class="row">



                <div class="left col-sm-2"> <!-- Note that "m4 l3" was added -->
                    <div class="card">
                        <div class="card-image">
                            <?= Html::img(Yii::getAlias('@web') . '/themes/tf-blue/images/smpn8.jpg'); ?>
                        </div>
                        <div class="card-content">
                            <div class="text-center">
                                <p align="center">UNGGUL DALAM IPTEK, BERAKHLAK MULIA, BERWAWASAN LINGKUNGAN DAN MENJUNJUNG TINGGI BUDAYA DAERAH</p>
                            </div>

                        </div>
                        <div class="card-action">
                            <p align="center"><a href="http://smpn8tpi.sch.id">Website Resmi</a></p>
                        </div>
                    </div>
                </div>

                <div class="right col s12 m10 24"> <!-- Note that "m8 l9" was added -->
                    <br/>
                    <?=
                    Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ])
                    ?>
                    <?php // Alert::widget()  ?>

                    <p>
                        <?php
//                        if (Yii::$app->session['idFB'] != "") {
//                            $rata = FormulirMaster::akrata(Yii::$app->session['idFB'],'FG');
//                            if ($rata == "") {
//                                $rata = 0;
//                            }
//                            $idKriteria = FormulirMaster::pilihid(Yii::$app->session['idFB']);
//                            $namaKriteria = FormulirMaster::namakriteria($idKriteria);
//                            $totalrata = "Jumlah Angka Kredit : $rata";
//                            echo "<h4>Kriteria Pilihan adalah : <strong>$namaKriteria</strong>, ";
//                            echo $totalrata;
//                            echo "</h4>";
//                        } else {
//                            $pilihanKriteria = "Kriteria Belum Dipilih";
//                        }
                        echo $content;
                        ?>
                    </p>
                </div>
            </div>

            <footer class="page-footer cyan darken-3">
                <div class="container">
                    <div class="row">
                        <div class="col l6 s12">
                            <h5 class="white-text">SMP 8 Tanjungpinang</h5>
                            <p class="white-text text-lighten-1">Sistem Informasi Penilaian Sasaran Kerja Pegawai</p>
                        </div>
                        <div class="col l4 offset-l2 s12">
                            <h5 class="white-text">Links</h5>
                            <li><a class="white-text" href="https://www.kepriprov.go.id/">Pemprov Kepri</a></li>
                            <li><a class="white-text" href="http://tanjungpinangkota.go.id/home/">Pemko Tanjungpinang</a></li>
                            <li><a class="white-text" href="http://tanjungpinang.siap.web.id/">Dinas Pendidikan</a></li>
                            <li><a class="white-text" href="http://11000423.siap-sekolah.com/sekolah-profil/">SMPN 8 Tanjungpinang</a></li>
                        </div>
                    </div>
                </div>
                <div class="footer-copyright">
                    <div class="container white-text center">
                        &copy; 2017 SMPN 8 Tanjugpinang
                        <?php
//                echo Nav::widget([
//                    'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id)
//                ]);
                        ?>
                    </div>
                </div>
            </footer>

        </div>
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->theme->baseUrl ?>/js/materialize.min.js"></script>
        <script type="text/javascript">
            $(function () {
                $(".button-collapse").sideNav();
            });
        </script>
        <?php $this->endBody(); ?>
    </body>
</html>
<?php $this->endPage(); ?>