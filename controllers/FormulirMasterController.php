<?php

namespace app\controllers;

use app\models\FormulirMaster;
use app\models\FormulirMasterSearch;
use app\models\Kriteria;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

/**
 * FormulirMasterController implements the CRUD actions for FormulirMaster model.
 */
class FormulirMasterController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','kasek'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['formulir-master', 'index','kasek'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all FormulirMaster models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new FormulirMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
        
        
    }
    
    public function actionKasek() {
        if( Yii::$app->user->can('fmaster-kasek') )
        {
            $searchModel = new FormulirMasterSearch();
            $dataProvider = $searchModel->searchkasek(Yii::$app->request->queryParams);

            return $this->render('indexkasek', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        }
        else
        {
             throw new ForbiddenHttpException;
        }
    }

    /**
     * Displays a single FormulirMaster model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        Yii::$app->session['idFB'] = $id;
       // $modelUser = User::findOne(Yii::$app->user->getId());
        $sqlUser = "SELECT * FROM formulir_master fm 
        LEFT JOIN user usr ON usr.id=fm.idUser 
        LEFT JOIN golongan g ON usr.idGolongan=g.idGolongan
        LEFT JOIN jabatan j ON usr.IdJabatan=j.IdJabatan
        WHERE fm.IdFormulirMaster=$id";
        $modelUser = Yii::$app->db->createCommand($sqlUser)->queryOne();
        //$modelUser=Yii::$app->db->createCommand('SELECT * FROM formulir_master fm left join user usr on usr.id=fm.idUser where fm.IdFormulirMaster='.$id)->queryOne();
        $formulirUtama = Yii::$app->db->createCommand('SELECT * FROM formulir f INNER JOIN unsur u ON f.IdUnsur=u.IdUnsur  LEFT JOIN formulir_master fm on fm.idFormulirMaster=f.idFormulirMaster where f.idFormulirMaster=' . $id . ' and u.IdJenisUnsur=1 and f.jenisForm="FG"')->queryAll();
        $formulirPenunjang = Yii::$app->db->createCommand('SELECT * FROM formulir f LEFT JOIN unsur u ON f.IdUnsur=u.IdUnsur LEFT JOIN formulir_master fm on fm.idFormulirMaster=f.idFormulirMaster where f.idFormulirMaster=' . $id . ' and u.IdJenisUnsur=2 and f.jenisForm="FG"')->queryAll();
        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'modelUser' => $modelUser,
                    'formulirUtama' => $formulirUtama,
                    'formulirPenunjang' => $formulirPenunjang,
        ]);
    }

    /**
     * Creates a new FormulirMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new FormulirMaster();
        $idUser = Yii::$app->user->getId();
        $cekformulirMaster = Yii::$app->db->createCommand("select count(*) from formulir_master where idUser=" . $idUser . " and tahun=" . date('Y') . "")->queryScalar();
        if ($cekformulirMaster >= 1) {
            Yii::$app->session->setFlash('danger', 'Proses tidak bisa dilanjutkan, Pelaporan SKP pada tahun ' . date('Y') . ' sudah dibuat sebelumnya');
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
        if ($model->load(Yii::$app->request->post())) {
            $model->idUser = Yii::$app->user->getId();
            $model->tahun = substr($model->tanggalBuat, 0, 4);
            $model->save();
            Yii::$app->session['idFB'] = $model->idFormulirMaster;

            return $this->redirect(['view', 'id' => $model->idFormulirMaster]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing FormulirMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idFormulirMaster]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing FormulirMaster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();
        Yii::$app->session->remove('idFB');
        return $this->redirect(['index']);
    }

    /**
     * Finds the FormulirMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FormulirMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = FormulirMaster::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionPilih($id) {
        $cari = Kriteria::findOne($id);
        $nama = $cari->NamaKriteria;
        Yii::$app->session['idKriteria'] = $id;
        Yii::$app->session['nama'] = $nama;
        return Yii::$app->session['nama'];
    }

}
