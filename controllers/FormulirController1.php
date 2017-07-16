<?php

namespace app\controllers;

use app\models\Formulir;
use app\models\User;
use app\models\FormulirSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * FormulirController implements the CRUD actions for Formulir model.
 */
class FormulirController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
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
     * Lists all Formulir models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FormulirSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Formulir model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Formulir model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Formulir();
        $modelUser=User::findOne(Yii::$app->user->getId());
        $formulirUtama=Yii::$app->db->createCommand('SELECT * FROM formulir f INNER JOIN unsur u ON f.IdUnsur=u.IdUnsur  LEFT JOIN formulir_master fm on fm.idFormulirMaster=f.idFormulirMaster where fm.idUser='.Yii::$app->user->getId().' and u.IdJenisUnsur=1')->queryAll();
        $formulirPenunjang=Yii::$app->db->createCommand('SELECT * FROM formulir f LEFT JOIN unsur u ON f.IdUnsur=u.IdUnsur LEFT JOIN formulir_master fm on fm.idFormulirMaster=f.idFormulirMaster where fm.idUser='.Yii::$app->user->getId().' and u.IdJenisUnsur=2')->queryAll();
        if ($model->load(Yii::$app->request->post())) {
            $model->idFormulirMaster=Yii::$app->session['idFB'];
            $model->save();
            $this->layout="mainEntri";
            return $this->redirect('index.php?r=formulir/create');
        } else {
            $this->layout="mainEntri";
            return $this->render('create', [
                'model' => $model,
                'modelUser'=>$modelUser,
                'formulirUtama' => $formulirUtama,
                'formulirPenunjang'=>$formulirPenunjang,
            ]);
        }
    }

    /**
     * Updates an existing Formulir model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->IdFormulir]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Formulir model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect('index.php?r=formulir/create');
    }

    /**
     * Finds the Formulir model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Formulir the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Formulir::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionExportPdf()
    {
        $pegawai=Yii::$app->db->createCommand("SELECT * FROM USER u INNER JOIN jabatan j ON u.IdJabatan=j.IdJabatan INNER JOIN Golongan g ON u.IdGolongan=g.IdGolongan WHERE id=".Yii::$app->user->getId())->queryOne();
        $penilai=Yii::$app->db->createCommand("SELECT * FROM USER u INNER JOIN jabatan j ON u.IdJabatan=j.IdJabatan INNER JOIN Golongan g ON u.IdGolongan=g.IdGolongan where PejabatPenilai=1")->queryOne();
        $formtargetUtama=Yii::$app->db->createCommand("SELECT * FROM FORMULIR F INNER JOIN UNSUR U ON F.IDUNSUR=U.IDUNSUR WHERE IDUSER=".Yii::$app->user->getId()." AND U.IDJENISUNSUR=1")->queryAll();
        $formtargetPenunjang=Yii::$app->db->createCommand("SELECT * FROM FORMULIR F INNER JOIN UNSUR U ON F.IDUNSUR=U.IDUNSUR WHERE IDUSER=".Yii::$app->user->getId()." AND U.IDJENISUNSUR=2")->queryAll();
        $html=$this->renderPartial('_exportToPDF',
            [
                'pegawai'=>$pegawai,
                'penilai'=>$penilai,
                'formTargetUtama'=>$formtargetUtama,
                'formTargetPenunjang'=>$formtargetPenunjang,
            ]);
       // $mpdf=new \mPDF('c','A4-L ','','',0,0,0,0,0,0);
        //$mpdf=new \mPDF('c','A4-L');//,'','',0,0,0,0,0,0);
        $mpdf=new \mPDF('c','A4-L','','',15,15,10,10,9,9,'L');
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->list_indent_first_level=0;
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit();
    }
}
