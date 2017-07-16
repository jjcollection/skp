<?php

namespace app\controllers;

use app\models\Formulir;
use app\models\FormulirMaster;
use app\models\FormulirSearch;
use app\models\User;
use mPDF;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

/**
 * FormulirController implements the CRUD actions for Formulir model.
 */
class FormulirController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['formulir-master', 'index'],
//                        'matchCallback'=>function(){
//                            return (
//                                Yii::$app->user->identity->role=='admin'
//                         );}
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Formulir models.
     * @return mixed
     */
    public function actionIndex() {
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
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Formulir model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (Yii::$app->user->can('create-formulir')) {
            $model = new Formulir();
            $modelUser = User::findOne(Yii::$app->user->getId());
            $formulirUtama = Yii::$app->db->createCommand('SELECT * FROM formulir f INNER JOIN unsur u ON f.IdUnsur=u.IdUnsur  LEFT JOIN formulir_master fm on fm.idFormulirMaster=f.idFormulirMaster where fm.idUser=' . Yii::$app->user->getId() . ' and u.IdJenisUnsur=1')->queryAll();
            $formulirPenunjang = Yii::$app->db->createCommand('SELECT * FROM formulir f LEFT JOIN unsur u ON f.IdUnsur=u.IdUnsur LEFT JOIN formulir_master fm on fm.idFormulirMaster=f.idFormulirMaster where fm.idUser=' . Yii::$app->user->getId() . ' and u.IdJenisUnsur=2')->queryAll();
            if ($model->load(Yii::$app->request->post())) {
                $model->idFormulirMaster = Yii::$app->session['idFB'];
                $model->jenisForm = 'FG';
                $model->save();
                FormulirMaster::akrata(Yii::$app->session['idFB'], 'FG');
                $this->layout = "mainEntri";
                return $this->redirect('create');
            } else {
                $this->layout = "mainEntri";
                return $this->render('create', [
                            'model' => $model,
                            'modelUser' => $modelUser,
                            'formulirUtama' => $formulirUtama,
                            'formulirPenunjang' => $formulirPenunjang,
                ]);
            }
        } else {
            throw new ForbiddenHttpException;
        }
    }

    public function actionCreateold($id) {
        $model = new Formulir();
        $modelUser = FormulirMaster::findOne($id);
        $formulirUtamaGuru = Yii::$app->db->createCommand('SELECT * FROM formulir f INNER JOIN unsur u ON f.IdUnsur=u.IdUnsur  LEFT JOIN formulir_master fm on fm.idFormulirMaster=f.idFormulirMaster where fm.idFormulirMaster=' . $id . ' and u.IdJenisUnsur=1 and fm.idFormulirMaster=' . $id . ' and f.jenisForm="FG"')->queryAll();
        $formulirPenunjangGuru = Yii::$app->db->createCommand('SELECT * FROM formulir f LEFT JOIN unsur u ON f.IdUnsur=u.IdUnsur LEFT JOIN formulir_master fm on fm.idFormulirMaster=f.idFormulirMaster where fm.idFormulirMaster=' . $id . ' and u.IdJenisUnsur=2 and fm.idFormulirMaster=' . $id . ' and f.jenisForm="FG"')->queryAll();
        $formulirUtama = Yii::$app->db->createCommand('SELECT * FROM formulir f INNER JOIN unsur u ON f.IdUnsur=u.IdUnsur  LEFT JOIN formulir_master fm on fm.idFormulirMaster=f.idFormulirMaster where fm.idFormulirMaster=' . $id . ' and u.IdJenisUnsur=1 and fm.idFormulirMaster=' . $id . ' and f.jenisForm="FK"')->queryAll();
        $formulirPenunjang = Yii::$app->db->createCommand('SELECT * FROM formulir f LEFT JOIN unsur u ON f.IdUnsur=u.IdUnsur LEFT JOIN formulir_master fm on fm.idFormulirMaster=f.idFormulirMaster where fm.idFormulirMaster=' . $id . ' and u.IdJenisUnsur=2 and fm.idFormulirMaster=' . $id . ' and f.jenisForm="FK"')->queryAll();
        if ($model->load(Yii::$app->request->post())) {
            $model->idFormulirMaster = Yii::$app->session['idFB'];
            $model->jenisForm = 'FK';
            $model->save();
            $this->layout = "mainEntri";
            return $this->render('createold', [
                        'model' => $model,
                        'modelUser' => $modelUser,
                        'formulirUtamaGuru' => $formulirUtamaGuru,
                        'formulirPenunjangGuru' => $formulirPenunjangGuru,
                        'formulirUtama' => $formulirUtama,
                        'formulirPenunjang' => $formulirPenunjang,
            ]);
        } else {
            $this->layout = "mainEntri";
            return $this->render('createold', [
                        'model' => $model,
                        'modelUser' => $modelUser,
                        'formulirUtamaGuru' => $formulirUtamaGuru,
                        'formulirPenunjangGuru' => $formulirPenunjangGuru,
                        'formulirUtama' => $formulirUtama,
                        'formulirPenunjang' => $formulirPenunjang,
            ]);
        }
    }

    public function actionCreateks() {
        $id = Yii::$app->session['idFB'];
        $model = new Formulir();
        $modelUser = FormulirMaster::findOne($id);
        $formulirUtamaGuru = Yii::$app->db->createCommand('SELECT * FROM formulir f INNER JOIN unsur u ON f.IdUnsur=u.IdUnsur  LEFT JOIN formulir_master fm on fm.idFormulirMaster=f.idFormulirMaster where fm.idFormulirMaster=' . $id . ' and u.IdJenisUnsur=1 and fm.idFormulirMaster=' . $id . ' and f.jenisForm="FG"')->queryAll();
        $formulirPenunjangGuru = Yii::$app->db->createCommand('SELECT * FROM formulir f LEFT JOIN unsur u ON f.IdUnsur=u.IdUnsur LEFT JOIN formulir_master fm on fm.idFormulirMaster=f.idFormulirMaster where fm.idFormulirMaster=' . $id . ' and u.IdJenisUnsur=2 and fm.idFormulirMaster=' . $id . ' and f.jenisForm="FG"')->queryAll();
        $formulirUtama = Yii::$app->db->createCommand('SELECT * FROM formulir f INNER JOIN unsur u ON f.IdUnsur=u.IdUnsur  LEFT JOIN formulir_master fm on fm.idFormulirMaster=f.idFormulirMaster where fm.idFormulirMaster=' . $id . ' and u.IdJenisUnsur=1 and fm.idFormulirMaster=' . $id . ' and f.jenisForm="FK"')->queryAll();
        $formulirPenunjang = Yii::$app->db->createCommand('SELECT * FROM formulir f LEFT JOIN unsur u ON f.IdUnsur=u.IdUnsur LEFT JOIN formulir_master fm on fm.idFormulirMaster=f.idFormulirMaster where fm.idFormulirMaster=' . $id . ' and u.IdJenisUnsur=2 and fm.idFormulirMaster=' . $id . ' and f.jenisForm="FK"')->queryAll();
        if ($model->load(Yii::$app->request->post())) {
            $model->idFormulirMaster = Yii::$app->session['idFB'];
            $model->jenisForm = 'FK';
            $model->save();
            $this->layout = "mainEntri";
            return $this->render('createold', [
                        'model' => $model,
                        'modelUser' => $modelUser,
                        'formulirUtamaGuru' => $formulirUtamaGuru,
                        'formulirPenunjangGuru' => $formulirPenunjangGuru,
                        'formulirUtama' => $formulirUtama,
                        'formulirPenunjang' => $formulirPenunjang,
            ]);
        } else {
            $this->layout = "mainEntri";
            return $this->render('createold', [
                        'model' => $model,
                        'modelUser' => $modelUser,
                        'formulirUtamaGuru' => $formulirUtamaGuru,
                        'formulirPenunjangGuru' => $formulirPenunjangGuru,
                        'formulirUtama' => $formulirUtama,
                        'formulirPenunjang' => $formulirPenunjang,
            ]);
        }
    }

    /**
     * Updates an existing Formulir model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        Yii::$app->session['idUnsur'] = $model->IdUnsur;
        Yii::$app->session['idFormulir'] = $model->IdFormulir;
        $idfb = Yii::$app->session['idFB'];
        $idUnsur = Yii::$app->session['idUnsur'];
        $idFormulir = Yii::$app->session['idFormulir'];
        $modelUser = FormulirMaster::findOne($idfb);
        $formulirUtamaGuru = Yii::$app->db->createCommand('SELECT * FROM formulir f INNER JOIN unsur u ON f.IdUnsur=u.IdUnsur  LEFT JOIN formulir_master fm on fm.idFormulirMaster=f.idFormulirMaster where fm.idFormulirMaster=' . $idfb . ' and u.IdJenisUnsur=1 and fm.idFormulirMaster=' . $id . ' and f.jenisForm="FG"')->queryAll();
        $formulirPenunjangGuru = Yii::$app->db->createCommand('SELECT * FROM formulir f LEFT JOIN unsur u ON f.IdUnsur=u.IdUnsur LEFT JOIN formulir_master fm on fm.idFormulirMaster=f.idFormulirMaster where fm.idFormulirMaster=' . $idfb . ' and u.IdJenisUnsur=2 and fm.idFormulirMaster=' . $id . ' and f.jenisForm="FG"')->queryAll();
        $formulirUtama = Yii::$app->db->createCommand('SELECT * FROM formulir f INNER JOIN unsur u ON f.IdUnsur=u.IdUnsur  LEFT JOIN formulir_master fm on fm.idFormulirMaster=f.idFormulirMaster where fm.idFormulirMaster=' . $idfb . ' and u.IdJenisUnsur=1 and fm.idFormulirMaster=' . $id . ' and f.jenisForm="FK"')->queryAll();
        $formulirPenunjang = Yii::$app->db->createCommand('SELECT * FROM formulir f LEFT JOIN unsur u ON f.IdUnsur=u.IdUnsur LEFT JOIN formulir_master fm on fm.idFormulirMaster=f.idFormulirMaster where fm.idFormulirMaster=' . $idfb . ' and u.IdJenisUnsur=2 and fm.idFormulirMaster=' . $id . ' and f.jenisForm="FK"')->queryAll();
        if ($model->load(Yii::$app->request->post())) {
            $rolename = User::getRoleName();
            if ($rolename == 'kasek') {
                Yii::$app->db->createCommand()
                        ->insert('formulir', [
                            'Kuantitas' => $model->Kuantitas,
                            'Output' => $model->Output,
                            'Mutu' => $model->Mutu,
                            'Waktu' => $model->Waktu,
                            'Biaya' => $model->Biaya,
                            'AK' => $model->AK,
                            'IdUnsur' => $model->IdUnsur,
                            'IdFormulirMaster' => Yii::$app->session['idFB'],
                            'jenisForm' => 'FK',
                                ]
                        )
                        ->execute();
                //$data = Formulir::hitungPencapaian($idUnsur, Yii::$app->session['idFB']);
                //foreach ($data as $datas) {
                //    $kuant = $datas['kuant'];
                //    $mut = $datas['mut'];
                //    $wkt = $datas['wkt'];
                //}
                //$penghitungan = $kuant + $mut + $wkt;
                //$nilaiCapaian = $penghitungan / 3;

                Yii::$app->db->createCommand()
                        ->insert('formulir_nilai', [
                            'idFormulir' => $idFormulir,
                            'penghitungan' => $penghitungan,
                            'nilaiCapaian' => $nilaiCapaian,
                                ]
                        )
                        ->execute();
                $this->layout = "mainEntri";
                return $this->redirect(['createold', 'id' => $idfb]);
            } else {
                $model = $this->findModel($id);
                $modelUser = User::findOne(Yii::$app->user->getId());
                $formulirUtama = Yii::$app->db->createCommand('SELECT * FROM formulir f INNER JOIN unsur u ON f.IdUnsur=u.IdUnsur  LEFT JOIN formulir_master fm on fm.idFormulirMaster=f.idFormulirMaster where fm.idUser=' . Yii::$app->user->getId() . ' and u.IdJenisUnsur=1')->queryAll();
                $formulirPenunjang = Yii::$app->db->createCommand('SELECT * FROM formulir f LEFT JOIN unsur u ON f.IdUnsur=u.IdUnsur LEFT JOIN formulir_master fm on fm.idFormulirMaster=f.idFormulirMaster where fm.idUser=' . Yii::$app->user->getId() . ' and u.IdJenisUnsur=2')->queryAll();
                if ($model->load(Yii::$app->request->post())) {
                    $model->idFormulirMaster = Yii::$app->session['idFB'];
                    $model->jenisForm = 'FG';
                    $model->save();
                    FormulirMaster::akrata(Yii::$app->session['idFB'], 'FG');
                    //$this->layout = "mainEntri";
                    return $this->redirect(['formulir-master/view', 'id' => $idfb]);
                } else {
                    $this->layout = "mainEntri";
                    return $this->render('create', [
                                'model' => $model,
                                'modelUser' => $modelUser,
                                'formulirUtama' => $formulirUtama,
                                'formulirPenunjang' => $formulirPenunjang,
                    ]);
                }
            }
        } else {
           // echo $model->Kuantitas;
           // exit();
            return $this->render('update', [
                        'model' => $model,
                        'modelUser' => $modelUser,
                        'formulirUtamaGuru' => $formulirUtamaGuru,
                        'formulirPenunjangGuru' => $formulirPenunjangGuru,
                        'formulirUtama' => $formulirUtama,
                        'formulirPenunjang' => $formulirPenunjang,
            ]);
        }
    }

    /**
     * Deletes an existing Formulir model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $rolename = User::getRoleName();
        if ($rolename == 'kasek') {
            $idfb = Yii::$app->session['idFB'];
            $this->findModel($id)->delete();
            FormulirMaster::akrata(Yii::$app->session['idFB'], 'FG');
            $this->layout = "mainEntri";
            return $this->redirect(['createold', 'id' => $idfb]);
        } else {
            $idfb = Yii::$app->session['idFB'];
            $this->findModel($id)->delete();
            FormulirMaster::akrata(Yii::$app->session['idFB'], 'FG');
            $this->layout = "mainEntri";
            return $this->redirect(['formulir-master/view', 'id' => $idfb]);
        }
    }

    /**
     * Finds the Formulir model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Formulir the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Formulir::find()->with('idUnsur')->where(['IdFormulir'=>$id])->one()) !== null) {
            //print_r($model);
            //exit();
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionExportPdf($id) {
        $pegawai = Yii::$app->db->createCommand("SELECT * FROM user u INNER JOIN jabatan j ON u.IdJabatan=j.IdJabatan INNER JOIN golongan g ON u.IdGolongan=g.IdGolongan WHERE id=" . Yii::$app->user->getId())->queryOne();
        $penilai = Yii::$app->db->createCommand("SELECT * FROM user u INNER JOIN jabatan j ON u.IdJabatan=j.IdJabatan INNER JOIN golongan g ON u.IdGolongan=g.IdGolongan where PejabatPenilai=1")->queryOne();
        $formtargetUtama = Yii::$app->db->createCommand("SELECT * FROM formulir F LEFT JOIN unsur U ON F.IdUnsur=U.IdUnsur LEFT JOIN formulir_master FM ON FM.IdFormulirMaster=F.IdFormulirMaster WHERE FM.IdFormulirMaster=$id AND U.IdJenisUnsur=1")->queryAll();
        $formtargetPenunjang = Yii::$app->db->createCommand("SELECT * FROM formulir F INNER JOIN unsur U ON F.IdUnsur=U.IdUnsur LEFT JOIN formulir_master FM ON FM.IdFormulirMaster=F.IdFormulirMaster WHERE FM.IdFormulirMaster=$id AND U.IdJenisUnsur=2")->queryAll();
        $rata = FormulirMaster::akrata(Yii::$app->session['idFB'], 'FG');
        $html = $this->renderPartial('_exportToPDF', [
            'pegawai' => $pegawai,
            'penilai' => $penilai,
            'formTargetUtama' => $formtargetUtama,
            'formTargetPenunjang' => $formtargetPenunjang,
            'rata' => $rata,
        ]);
        // $mpdf=new \mPDF('c','A4-L ','','',0,0,0,0,0,0);
        //$mpdf=new \mPDF('c','A4-L');//,'','',0,0,0,0,0,0);
        $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 10, 10, 9, 9, 'L');
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->list_indent_first_level = 0;
        $mpdf->WriteHTML($html);
        $mpdf->Output("Target_SKP_" . Yii::$app->user->username . ".pdf", "I");
        exit();
    }

    public function actionExportHitungPdf($id) {
        $formtargetUtama = Yii::$app->db->createCommand("SELECT * FROM formulir F LEFT JOIN unsur U ON F.IdUnsur=U.IdUnsur LEFT JOIN formulir_master FM ON FM.IdFormulirMaster=F.IdFormulirMaster WHERE F.IdFormulirMaster=$id AND U.IdJenisUnsur=1")->queryAll();
        $formtargetPenunjang = Yii::$app->db->createCommand("SELECT * FROM formulir F INNER JOIN unsur U ON F.IdUnsur=U.IdUnsur LEFT JOIN formulir_master FM ON FM.IdFormulirMaster=F.IdFormulirMaster WHERE F.IdFormulirMaster=$id AND U.IdJenisUnsur=2")->queryAll();
        $rata = FormulirMaster::akrata(Yii::$app->session['idFB'], 'FG');
        $html = $this->renderPartial('_exportHitungToPDF', [
            'formTargetUtama' => $formtargetUtama,
            'formTargetPenunjang' => $formtargetPenunjang,
            'rata' => $rata,
        ]);
        $mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 10, 10, 9, 9, 'L');
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->list_indent_first_level = 0;
        $mpdf->WriteHTML($html);
        $mpdf->Output("Pengukuran_SKP_" . Yii::$app->user->username . ".pdf", "I");
        exit();
    }
    
    public function actionExportExcelHitungTarget($id) {
        $formtargetUtama = Yii::$app->db->createCommand("SELECT * FROM formulir F LEFT JOIN unsur U ON F.IdUnsur=U.IdUnsur LEFT JOIN formulir_master FM ON FM.IdFormulirMaster=F.IdFormulirMaster WHERE F.IdFormulirMaster=$id AND U.IdJenisUnsur=1")->queryAll();
        $formtargetPenunjang = Yii::$app->db->createCommand("SELECT * FROM formulir F INNER JOIN unsur U ON F.IdUnsur=U.IdUnsur LEFT JOIN formulir_master FM ON FM.IdFormulirMaster=F.IdFormulirMaster WHERE F.IdFormulirMaster=$id AND U.IdJenisUnsur=2")->queryAll();
        $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
        $template = Yii::getAlias('@app/views/formulir') . '/_exportHitungToExcel.xlsx';
        $objPHPExcel = $objReader->load($template);
        $activeSheet = $objPHPExcel->getActiveSheet();
        $activeSheet->getPageSetup()->setOrientation(\PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $activeSheet->getPageSetup()->setPaperSize(\PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
        $baseUtama = 8;
        $baris = 1;
        $border_style = array('borders' => array('allborders' => array('style' => \PHPExcel_Style_Border::BORDER_THIN)));
        foreach ($formtargetUtama as $value) {
            $activeSheet->setCellValue('A' . $baseUtama, $baris);
            $activeSheet->setCellValue('B' . $baseUtama, $value['NamaUnsur']);
            $activeSheet->setCellValue('C' . $baseUtama, $value['AK']);
            $activeSheet->setCellValue('D' . $baseUtama, $value['Kuantitas']);
            $activeSheet->setCellValue('E' . $baseUtama, $value['Output']);
            $activeSheet->setCellValue('F' . $baseUtama, $value['Mutu']);
            $activeSheet->setCellValue('G' . $baseUtama, $value['Waktu']);
            $activeSheet->setCellValue('H' . $baseUtama, 'Bulan');
            $activeSheet->setCellValue('I' . $baseUtama, '-');

            $objPHPExcel->getActiveSheet()->getStyle('B' . $baseUtama)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT)->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('C' . $baseUtama . ':' . 'R' . $baseUtama)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('B' . $baseUtama . ':' . 'R' . $baseUtama)->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER)->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $baseUtama)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $baseUtama)->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getRowDimension($baseUtama)->setRowHeight(70);
            $objPHPExcel->getActiveSheet()->getStyle("A8:K$baseUtama")->getFont()->setSize(7);
            //$objPHPExcel->getActiveSheet()->getStyle("A8:K$baseUtama")->getFont()->setSize(9)->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->getStyle("A8:R$baseUtama")->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->getStyle("A8:R$baseUtama")->applyFromArray($border_style);
            $baris++;
            $baseUtama++;
        }
        $baseUtamaPenunjang = $baseUtama + 1;
        $barisPenunjang = 1;
       // $activeSheet->mergeCells('B' . $baseUtamaPenunjang . ':' . 'D' . $baseUtamaPenunjang);
        $activeSheet->setCellValue('B' . $baseUtama, '2. Unsur Penunjang');
        $objPHPExcel->getActiveSheet()->getStyle("A$baseUtama:R$baseUtama")->getFont()->setSize(7);
        $objPHPExcel->getActiveSheet()->getStyle("A$baseUtama:R$baseUtama")->applyFromArray($border_style);
        foreach ($formtargetPenunjang as $value) {
            $activeSheet->setCellValue('A' . $baseUtamaPenunjang, $barisPenunjang);
            $activeSheet->setCellValue('B' . $baseUtamaPenunjang, $value['NamaUnsur']);
            $activeSheet->setCellValue('C' . $baseUtamaPenunjang, $value['AK']);
            $activeSheet->setCellValue('D' . $baseUtamaPenunjang, $value['Kuantitas']);
            $activeSheet->setCellValue('E' . $baseUtamaPenunjang, $value['Output']);
            $activeSheet->setCellValue('F' . $baseUtamaPenunjang, $value['Mutu']);
            $activeSheet->setCellValue('G' . $baseUtamaPenunjang, $value['Waktu']);
            $activeSheet->setCellValue('H' . $baseUtamaPenunjang, 'Bulan');
            $activeSheet->setCellValue('I' . $baseUtamaPenunjang, '-');
            $objPHPExcel->getActiveSheet()->getStyle('B' . $baseUtamaPenunjang)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT)->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('C' . $baseUtamaPenunjang . ':' . 'K' . $baseUtamaPenunjang)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('B' . $baseUtamaPenunjang . ':' . 'K' . $baseUtamaPenunjang)->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER)->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $baseUtamaPenunjang)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $baseUtamaPenunjang)->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getRowDimension($baseUtamaPenunjang)->setRowHeight(50);
            $objPHPExcel->getActiveSheet()->getStyle("A$baseUtamaPenunjang:R$baseUtamaPenunjang")->getFont()->setSize(7);
            $objPHPExcel->getActiveSheet()->getStyle("A$baseUtamaPenunjang:R$baseUtamaPenunjang")->applyFromArray($border_style);
            $barisPenunjang++;
            $baseUtamaPenunjang++;
        }

        $activeSheet->setCellValue('B' . $baseUtamaPenunjang, 'Jumlah');
        $objPHPExcel->getActiveSheet()->getStyle("A$baseUtamaPenunjang:R$baseUtamaPenunjang")->getFont()->setSize(7);
        $objPHPExcel->getActiveSheet()->getStyle("A$baseUtamaPenunjang:R$baseUtamaPenunjang")->applyFromArray($border_style);
        $baseSum=$baseUtamaPenunjang-1;
        $objPHPExcel->getActiveSheet()->setCellValue('C'.$baseUtamaPenunjang, "=SUM(C8:C$baseSum)");
        $objPHPExcel->getActiveSheet()->getStyle('C' . $baseUtamaPenunjang)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");;
        header("Content-Disposition: attachment;filename=_exportHitungToExcel.xlsx");
        header("Content-Transfer-Encoding: binary ");
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
        $objWriter->save('php://output');

        exit();
    }

    public function actionExportTargetExcel($id) {
        $pegawai = Yii::$app->db->createCommand("SELECT * FROM user u INNER JOIN jabatan j ON u.IdJabatan=j.IdJabatan INNER JOIN golongan g ON u.IdGolongan=g.IdGolongan WHERE id=" . Yii::$app->user->getId())->queryOne();
        $penilai = Yii::$app->db->createCommand("SELECT * FROM user u INNER JOIN jabatan j ON u.IdJabatan=j.IdJabatan INNER JOIN golongan g ON u.IdGolongan=g.IdGolongan where PejabatPenilai=1")->queryOne();
        $formtargetUtama = Yii::$app->db->createCommand("SELECT * FROM formulir F LEFT JOIN unsur U ON F.IdUnsur=U.IdUnsur LEFT JOIN formulir_master FM ON FM.IdFormulirMaster=F.IdFormulirMaster WHERE FM.IdFormulirMaster=$id AND U.IdJenisUnsur=1")->queryAll();
        $formtargetPenunjang = Yii::$app->db->createCommand("SELECT * FROM formulir F INNER JOIN unsur U ON F.IdUnsur=U.IdUnsur LEFT JOIN formulir_master FM ON FM.IdFormulirMaster=F.IdFormulirMaster WHERE FM.IdFormulirMaster=$id AND U.IdJenisUnsur=2")->queryAll();
        $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
        $template = Yii::getAlias('@app/views/formulir') . '/_exportTarget.xlsx';
        $objPHPExcel = $objReader->load($template);
        $activeSheet = $objPHPExcel->getActiveSheet();
        $activeSheet->getPageSetup()->setOrientation(\PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $activeSheet->getPageSetup()->setPaperSize(\PHPExcel_Worksheet_PageSetup::PAPERSIZE_FOLIO);
        $base5 = 5;
        $base6 = 6;
        $base7 = 7;
        $base8 = 8;
        $base9 = 9;
        $baseUtama = 13;
        $baris = 1;
        $activeSheet->setCellValue('H' . $base5, $pegawai['Nama']);
        $activeSheet->setCellValue('H' . $base6, $pegawai['NIP']);
        $activeSheet->setCellValue('H' . $base7, $pegawai['NamaGolongan']);
        $activeSheet->setCellValue('H' . $base8, $pegawai['NamaJabatan']);
        $activeSheet->setCellValue('H' . $base9, $pegawai['UnitKerja']);
        $activeSheet->setCellValue('C' . $base5, $penilai['Nama']);
        $activeSheet->setCellValue('C' . $base6, $penilai['NIP']);
        $activeSheet->setCellValue('C' . $base7, $penilai['NamaGolongan']);
        $activeSheet->setCellValue('C' . $base8, $penilai['NamaJabatan']);
        $activeSheet->setCellValue('C' . $base9, $penilai['UnitKerja']);
        $border_style = array('borders' => array('allborders' => array('style' => \PHPExcel_Style_Border::BORDER_THIN)));
        foreach ($formtargetUtama as $value) {
            $activeSheet->setCellValue('A' . $baseUtama, $baris);
            $activeSheet->setCellValue('B' . $baseUtama, $value['NamaUnsur']);
            $activeSheet->setCellValue('E' . $baseUtama, $value['AK']);
            $activeSheet->setCellValue('F' . $baseUtama, $value['Kuantitas']);
            $activeSheet->setCellValue('G' . $baseUtama, $value['Output']);
            $activeSheet->setCellValue('H' . $baseUtama, $value['Mutu']);
            $activeSheet->setCellValue('I' . $baseUtama, $value['Waktu']);
            $activeSheet->setCellValue('J' . $baseUtama, 'Bulan');
            $activeSheet->setCellValue('K' . $baseUtama, '-');
            $activeSheet->mergeCells('B' . $baseUtama . ':' . 'D' . $baseUtama);
            
            $objPHPExcel->getActiveSheet()->getStyle('B' . $baseUtama)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT)->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('E' . $baseUtama . ':' . 'K' . $baseUtama)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('B' . $baseUtama . ':' . 'K' . $baseUtama)->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER)->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $baseUtama)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $baseUtama)->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getRowDimension($baseUtama)->setRowHeight(50);
            $objPHPExcel->getActiveSheet()->getStyle("A13:K$baseUtama")->applyFromArray($border_style);
            $baris++;
            $baseUtama++;
        }
      
        $baseUtamaPenunjang = $baseUtama + 1;
        $barisPenunjang = 1;
        $activeSheet->mergeCells('B' . $baseUtama . ':' . 'D' . $baseUtama);
        $activeSheet->setCellValue('B' . $baseUtama, '2. Unsur Penunjang');

        foreach ($formtargetPenunjang as $value) {
            $activeSheet->setCellValue('A' . $baseUtamaPenunjang, $barisPenunjang);
            $activeSheet->setCellValue('B' . $baseUtamaPenunjang, $value['NamaUnsur']);
            $activeSheet->setCellValue('E' . $baseUtamaPenunjang, $value['AK']);
            $activeSheet->setCellValue('F' . $baseUtamaPenunjang, $value['Kuantitas']);
            $activeSheet->setCellValue('G' . $baseUtamaPenunjang, $value['Output']);
            $activeSheet->setCellValue('H' . $baseUtamaPenunjang, $value['Mutu']);
            $activeSheet->setCellValue('I' . $baseUtamaPenunjang, $value['Waktu']);
            $activeSheet->setCellValue('J' . $baseUtamaPenunjang, 'Bulan');
            $activeSheet->setCellValue('K' . $baseUtamaPenunjang, '-');
            $activeSheet->mergeCells('B' . $baseUtamaPenunjang . ':' . 'D' . $baseUtamaPenunjang);
            $objPHPExcel->getActiveSheet()->getStyle('B' . $baseUtamaPenunjang)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT)->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('E' . $baseUtamaPenunjang . ':' . 'K' . $baseUtamaPenunjang)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('B' . $baseUtamaPenunjang . ':' . 'K' . $baseUtamaPenunjang)->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER)->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $baseUtamaPenunjang)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $baseUtamaPenunjang)->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getRowDimension($baseUtamaPenunjang)->setRowHeight(50);
            $objPHPExcel->getActiveSheet()->getStyle("A13:K$baseUtamaPenunjang")->applyFromArray($border_style);
            $barisPenunjang++;
            $baseUtamaPenunjang++;
        }

        $activeSheet->mergeCells('B' . $baseUtamaPenunjang . ':' . 'D' . $baseUtamaPenunjang);
        $activeSheet->setCellValue('B' . $baseUtamaPenunjang, 'Jumlah');
        $objPHPExcel->getActiveSheet()->getStyle("A13:K$baseUtamaPenunjang")->applyFromArray($border_style);
        $activeSheet->mergeCells('F' . $baseUtamaPenunjang . ':' . 'K' . $baseUtamaPenunjang);
        $baseRata=$baseUtamaPenunjang-1;
        $objPHPExcel->getActiveSheet()->setCellValue('E'.$baseUtamaPenunjang, "=SUM(E13:E$baseRata)");
        $objPHPExcel->getActiveSheet()->getStyle('E' . $baseUtamaPenunjang)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");;
        header("Content-Disposition: attachment;filename=_exportTarget.xlsx");
        header("Content-Transfer-Encoding: binary ");
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
        $objWriter->save('php://output');

        exit();
    }

    function IsExcelFormula($String = null) {
        if (!$String OR strlen($String) <= 0) {
            return false;
        }

        $First = $String[0];

        return ($First == '=' ? true : false);
    }

}
