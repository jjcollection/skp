<?php

namespace app\controllers;

use app\models\Unsur;
use app\models\UnsurSearch;
use app\models\User;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * UnsurController implements the CRUD actions for Unsur model.
 */
class UnsurController extends Controller {

    /**
     * @inheritdoc
     */
    public $idJenis;
    public $nilai;

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Unsur models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new UnsurSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Unsur model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Unsur model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Unsur();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->IdUnsur]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Unsur model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->IdUnsur]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Unsur model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Unsur model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Unsur the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Unsur::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionLists($id) {
        Yii::$app->session['idJenis'] = $id;
        $countUnsur = Unsur::find()
                ->where(['IdJenisUnsur' => $id])
                ->count();

        $unsurs = Unsur::find()
                ->where(['IdJenisUnsur' => $id])
                ->all();

        if ($countUnsur > 0) {
            echo "<option> - </option>";
            foreach ($unsurs as $unsur) {
                echo "<option value='" . $unsur->IdUnsur . "'>" . $unsur->NamaUnsur . "</option>";
            }
        } else {
            echo "<option> - </option>";
        }
    }

    public function actionNilai($id) {
        $countUnsur = Unsur::find()
                ->where(['IdUnsur' => $id])
                ->count();

        $unsurs = Unsur::find()
                ->where(['IdUnsur' => $id])
                ->all();

        if ($countUnsur > 0) {
            foreach ($unsurs as $unsur) {
                $n = $unsur->Nilai;
                Yii::$app->session['nakAsli'] = $n;
                if ($n == 0) {
                    $rolename = User::getRoleName();
                    if ($rolename == 'kasek') {
                        $idFB = Yii::$app->session['idFB'];
                        $cmdUserFB = Yii::$app->db->createCommand("select * from formulir_master where idFormulirMaster=" . $idFB . "")->queryOne();
                        $idUser = $cmdUserFB['idUser'];
                        $cmd = Yii::$app->db->createCommand("select * from user where id=" . $idUser . "")->queryOne();
                        $idGolongan = $cmd['idGolongan'];
                    } else {
                        $idUser = Yii::$app->user->getId();
                        $cmd = Yii::$app->db->createCommand("select * from user where id=" . $idUser . "")->queryOne();
                        $idGolongan = $cmd['idGolongan'];
                    }
                    $sqlak = "select * from aturan where IdGolongan=" . $idGolongan . " and IdKriteria=2";
                    $ak = Yii::$app->db->createCommand($sqlak)->queryOne();
                    $nilaiAK = $ak['AK'];
                    Yii::$app->session['nak'] = $nilaiAK;
                    return $nilaiAK;
                } else {
                    $this->nilai = $n;
                    return $n;
                }
            }
        } else {
            $n = 0;
            echo $n;
        }
    }

    public function actionNilai2($id) {
        $b = Yii::$app->session['idJenis'];
        $c = Yii::$app->session['nakAsli'];
        $rolename = User::getRoleName();
        if ($rolename == 'kasek') {
            $idFB = Yii::$app->session['idFB'];
            $cmdUserFB = Yii::$app->db->createCommand("select * from formulir_master where idFormulirMaster=" . $idFB . "")->queryOne();
            $idUser = $cmdUserFB['idUser'];
            $sqlCekFormulir = "SELECT Count(*) FROM formulir f LEFT JOIN unsur u ON f.idUnsur=u.idUnsur LEFT JOIN formulir_master fm ON fm.idFormulirMaster=f.idFormulirMaster WHERE fm.idUser=" . $idUser . " AND u.Keterangan='Paket' AND u.IdJenisUnsur=1 AND f.jenisForm='FK'";
            $cekformulirUtama = Yii::$app->db->createCommand($sqlCekFormulir)->queryScalar();
        } else {
            $idUser = Yii::$app->user->getId();
            $sqlCekFormulir = "SELECT Count(*) FROM formulir f LEFT JOIN unsur u ON f.idUnsur=u.idUnsur LEFT JOIN formulir_master fm ON fm.idFormulirMaster=f.idFormulirMaster WHERE fm.idUser=" . $idUser . " AND u.Keterangan='Paket' AND u.IdJenisUnsur=1 AND f.jenisForm='FG'";
            $cekformulirUtama = Yii::$app->db->createCommand($sqlCekFormulir)->queryScalar();
        }

        if ($rolename == 'kasek') {
            if ($cekformulirUtama > 0 && ($b == 1) && ($c == 0)) {
                $idFB = Yii::$app->session['idFB'];
                $cmdUserFB = Yii::$app->db->createCommand("select * from formulir_master where idFormulirMaster=" . $idFB . "")->queryOne();
                $idUser = $cmdUserFB['idUser'];
                $cmd = Yii::$app->db->createCommand("select * from user where id=" . $idUser . "")->queryOne();
                $idGolongan = $cmd['idGolongan'];
                $sqlNilaiAK = "select * from aturan where IdGolongan=" . $idGolongan . " and IdKriteria=2";
                $ak = Yii::$app->db->createCommand($sqlNilaiAK)->queryOne();
                $nilaiAK = $ak['AK'];
                if ($id == 12) {
                    $nilaiasli = $nilaiAK * 5 / 100;
                    return round($nilaiasli, 2);
                } else {
                    $nilaiasli = $nilaiAK * 2 / 100;
                    return round($nilaiasli, 2);
                }
            } else if ($b == 2 && ($c >= 0)) {
                return Yii::$app->session['nakAsli'];
            } else if ($b == 1 && ($c >= 0)) {
                return Yii::$app->session['nakAsli'];
            } else {
                $cmd = Yii::$app->db->createCommand("select * from user where id=" . $idUser . "")->queryOne();
                $idGolongan = $cmd['idGolongan'];
                $ak = Yii::$app->db->createCommand("select * from aturan where IdGolongan=" . $idGolongan . " and IdKriteria=2")->queryOne();
                $nilaiAK = $ak['AK'];
                return $nilaiAK;
            }
        } else {
            if ($cekformulirUtama > 0 && ($b == 1) && ($c == 0)) {
                $idFB = Yii::$app->session['idFB'];
                $cmdUserFB = Yii::$app->db->createCommand("select * from formulir_master where idFormulirMaster=" . $idFB . "")->queryOne();
                $idUser = $cmdUserFB['idUser'];
                $cmd = Yii::$app->db->createCommand("select * from user where id=" . $idUser . "")->queryOne();
                $idGolongan = $cmd['idGolongan'];
                $sqlNilaiAK = "select * from aturan where IdGolongan=" . $idGolongan . " and IdKriteria=2";
                $ak = Yii::$app->db->createCommand($sqlNilaiAK)->queryOne();
                $nilaiAK = $ak['AK'];
                if ($id == 12) {
                    $nilaiasli = $nilaiAK * 5 / 100;
                    return round($nilaiasli, 2);
                } else {
                    $nilaiasli = $nilaiAK * 2 / 100;
                    return round($nilaiasli, 2);
                }
            } else if ($b == 2 && ($c >= 0)) {
                return Yii::$app->session['nakAsli'];
            } else if ($b == 1 && ($c > 0)) {
                return Yii::$app->session['nakAsli'];
            } else if ($b == 1 && ($c == 0)) {
                return Yii::$app->session['nak'];
            } else {
                $cmd = Yii::$app->db->createCommand("select * from user where id=" . $idUser . "")->queryOne();
                $idGolongan = $cmd['idGolongan'];
                $ak = Yii::$app->db->createCommand("select * from aturan where IdGolongan=" . $idGolongan . " and IdKriteria=2")->queryOne();
                $nilaiAK = $ak['AK'];
                return $nilaiAK;
            }
        }
    }

}
