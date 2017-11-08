<?php

namespace app\controllers;

use app\models\IndikatorNilai;
use app\models\IndikatorNilaiSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * IndikatorNilaiController implements the CRUD actions for IndikatorNilai model.
 */
class IndikatorNilaiController extends Controller {

    /**
     * @inheritdoc
     */
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
     * Lists all IndikatorNilai models.
     * @return mixed
     */
    public function actionIndex() {
        $idFB=Yii::$app->session['idFB'];
        $this->layout = 'mainEntri';
        $searchModel = new IndikatorNilaiSearch();
        $dataProviderPelayanan = $searchModel->searchPelayanan(Yii::$app->request->queryParams);
        $dataProviderIntegritas = $searchModel->searchIntegritas(Yii::$app->request->queryParams);
        $dataProviderKomitmen = $searchModel->searchKomitmen(Yii::$app->request->queryParams);
        $dataProviderDisiplin = $searchModel->searchDisiplin(Yii::$app->request->queryParams);
        $dataProviderKerjasama = $searchModel->searchKerjasama(Yii::$app->request->queryParams);
        $dataProviderKepemimpinan = $searchModel->searchKepemimpinan(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProviderPelayanan' => $dataProviderPelayanan,
                    'dataProviderIntegritas' => $dataProviderIntegritas,
                    'dataProviderKomitmen' => $dataProviderKomitmen,
                    'dataProviderDisiplin' => $dataProviderDisiplin,
                    'dataProviderKerjasama' => $dataProviderKerjasama,
                    'dataProviderKepemimpinan' => $dataProviderKepemimpinan,
        ]);
    }

    /**
     * Displays a single IndikatorNilai model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new IndikatorNilai model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {

        $model = new IndikatorNilai();
        if ($model->load(Yii::$app->request->post())) {
            $model->idFormulirMaster=Yii::$app->session['idFB'];
            if ($model->save()) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            return $this->renderAjax('create', [
                        'model' => $model,
            ]);
        }
        
    }
    public function actionIntegritas() {

        $model = new IndikatorNilai();
        if ($model->load(Yii::$app->request->post())) {
            $model->idFormulirMaster=Yii::$app->session['idFB'];
            if ($model->save()) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            return $this->renderAjax('cintegritas', [
                        'model' => $model,
            ]);
        }
        
    }
    public function actionKomitmen() {

        $model = new IndikatorNilai();
        if ($model->load(Yii::$app->request->post())) {
            $model->idFormulirMaster=Yii::$app->session['idFB'];
            if ($model->save()) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            return $this->renderAjax('ckomitmen', [
                        'model' => $model,
            ]);
        }
        
    }
    
    public function actionDisiplin() {

        $model = new IndikatorNilai();
        if ($model->load(Yii::$app->request->post())) {
            $model->idFormulirMaster=Yii::$app->session['idFB'];
            if ($model->save()) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            return $this->renderAjax('cdisiplin', [
                        'model' => $model,
            ]);
        }
        
    }
    
    public function actionKerjasama() {

        $model = new IndikatorNilai();
        if ($model->load(Yii::$app->request->post())) {
            $model->idFormulirMaster=Yii::$app->session['idFB'];
            if ($model->save()) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            return $this->renderAjax('ckerjasama', [
                        'model' => $model,
            ]);
        }
        
    }
    
    public function actionKepemimpinan() {

        $model = new IndikatorNilai();
        if ($model->load(Yii::$app->request->post())) {
            $model->idFormulirMaster=Yii::$app->session['idFB'];
            if ($model->save()) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            return $this->renderAjax('ckepemimpinan', [
                        'model' => $model,
            ]);
        }
        
    }

    /**
     * Updates an existing IndikatorNilai model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idIndikatorNilai]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing IndikatorNilai model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the IndikatorNilai model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return IndikatorNilai the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = IndikatorNilai::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
