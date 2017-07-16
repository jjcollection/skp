<?php

use app\assets\AppAsset;
use app\models\FormulirMaster;
use app\models\User;
//use kartik\alert\Alert;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;

AppAsset::register($this);
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
        <meta name="robots" content="all">
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
                        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
                    } else {
                        // Yii::$app->session->remove('idFB');
                        //        $model =new FormulirMaster();
                        $rolename = User::getRoleName();
                        if ($rolename == 'kasek') {
                            $menuItems[] = ['label' => 'Formulir Pegawai', 'url' => ['/formulir-master/kasek']];
                        } else {
                            $idUser = Yii::$app->user->getId();
                            $cekformulirMaster = Yii::$app->db->createCommand("select count(*) from formulir_master where idUser=" . $idUser . " and tahun=" . date('Y') . "")->queryScalar();
                            $ListformulirMaster = Yii::$app->db->createCommand("select * from formulir_master where idUser=" . $idUser . " and tahun=" . date('Y') . "")->queryOne();
                            $sqlCek="select count(*) from formulir where idFormulirMaster=" . $ListformulirMaster['idFormulirMaster'] . "";
                            //print_r($sqlCek);
                            //exit();
                            $cekformulir = Yii::$app->db->createCommand($sqlCek)->queryScalar();
                            if (($cekformulir == 0) && ($cekformulirMaster == 1)) {
                                $menuItems[] = ['label' => 'Isi Formulir', 'url' => ['/formulir/create']];
                            } else if (($cekformulir >= 1) && ($cekformulirMaster == 1)) {
                                $menuItems[] = ['label' => 'Formulir', 'url' => ['/formulir-master/index']];
                            } else {
                                $menuItems[] = ['label' => 'Formulir Baru', 'url' => ['/formulir-master/create']];
                            }
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

                <div class="right col-lg-12"> <!-- Note that "m8 l9" was added -->
                    <br/>
                    <?=
                    Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ])
                    ?>
                    <?php // Alert::widget() ?>

                    <?php
                    if (Yii::$app->session['idFB'] != "") {
                        $rata = FormulirMaster::akrata(Yii::$app->session['idFB'],'FG');
                        if ($rata == "") {
                            $rata = 0;
                        }
                        $idKriteria = FormulirMaster::pilihid(Yii::$app->session['idFB']);
                        $namaKriteria = FormulirMaster::namakriteria($idKriteria);
                        $totalrata = "Jumlah Angka Kredit : $rata";
                        echo "<h4>Kriteria Pilihan anda adalah : <strong>$namaKriteria</strong>, ";
                        echo $totalrata;
                        echo "</h4>";
                    } else {
                        $pilihanKriteria = "Kriteria Belum Dipilih";
                    }
                    echo $content;
                    ?>
                </div>
            </div>

            <footer class="page-footer cyan darken-3">
                <div class="container">
                    <div class="row">
                        <div class="col l6 s12">
                            <h5 class="white-text">Footer Content</h5>
                            <p class="white-text text-lighten-1">You can use rows and columns here to organize your footer content.</p>
                        </div>
                        <div class="col l4 offset-l2 s12">
                            <h5 class="white-text">Links</h5>
                            <li><a class="white-text" href="#!">Link 1</a></li>
                            <li><a class="white-text" href="#!">Link 2</a></li>
                            <li><a class="white-text" href="#!">Link 3</a></li>
                            <li><a class="white-text" href="#!">Link 4</a></li>
                        </div>
                    </div>
                </div>
                <div class="footer-copyright">
                    <div class="container white-text center">
                        &copy; 2015 ThemeFactory.net
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