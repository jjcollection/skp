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
        if (($model = Formulir::find()->with('idUnsur')->where(['IdFormulir' => $id])->one()) !== null) {
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

    function copyRows(PHPExcel_Worksheet $sheet, $srcRow, $dstRow, $height, $width) {
        for ($row = 0; $row < $height; $row++) {
            for ($col = 0; $col < $width; $col++) {
                $cell = $sheet->getCellByColumnAndRow($col, $srcRow + $row);
                $style = $sheet->getStyleByColumnAndRow($col, $srcRow + $row);
                $dstCell = PHPExcel_Cell::stringFromColumnIndex($col) . (string) ($dstRow + $row);
                $sheet->setCellValue($dstCell, $cell->getValue());
                $sheet->duplicateStyle($style, $dstCell);
            }

            $h = $sheet->getRowDimension($srcRow + $row)->getRowHeight();
            $sheet->getRowDimension($dstRow + $row)->setRowHeight($h);
        }

        foreach ($sheet->getMergeCells() as $mergeCell) {
            $mc = explode(":", $mergeCell);
            $col_s = preg_replace("/[0-9]*/", "", $mc[0]);
            $col_e = preg_replace("/[0-9]*/", "", $mc[1]);
            $row_s = ((int) preg_replace("/[A-Z]*/", "", $mc[0])) - $srcRow;
            $row_e = ((int) preg_replace("/[A-Z]*/", "", $mc[1])) - $srcRow;

            if (0 <= $row_s && $row_s < $height) {
                $merge = $col_s . (string) ($dstRow + $row_s) . ":" . $col_e . (string) ($dstRow + $row_e);
                $sheet->mergeCells($merge);
            }
        }
    }

    public function actionExportExcelHitungTarget($id) {
        $formtargetUtamaFG = Yii::$app->db->createCommand("SELECT * FROM formulir F 
        LEFT JOIN unsur U ON F.IdUnsur=U.IdUnsur 
        LEFT JOIN formulir_master FM ON FM.IdFormulirMaster=F.IdFormulirMaster 
        LEFT JOIN user usr ON FM.idUser=usr.id
        LEFT JOIN golongan g ON usr.idGolongan=g.idGolongan
        LEFT JOIN jabatan j ON usr.IdJabatan=j.IdJabatan
        WHERE F.IdFormulirMaster=$id AND U.IdJenisUnsur=1 AND F.jenisForm='FG'")->queryAll();
        $formtargetPenunjangFG = Yii::$app->db->createCommand("SELECT * FROM formulir F INNER JOIN unsur U ON F.IdUnsur=U.IdUnsur LEFT JOIN formulir_master FM ON FM.IdFormulirMaster=F.IdFormulirMaster WHERE F.IdFormulirMaster=$id AND U.IdJenisUnsur=2 and F.jenisForm='FG'")->queryAll();
        $formtargetUtamaFK = Yii::$app->db->createCommand('SELECT * FROM formulir f INNER JOIN unsur u ON f.IdUnsur=u.IdUnsur  LEFT JOIN formulir_master fm on fm.idFormulirMaster=f.idFormulirMaster where fm.idFormulirMaster=' . $id . ' and u.IdJenisUnsur=1 and fm.idFormulirMaster=' . $id . ' and f.jenisForm="FK"')->queryAll();
        $formtargetPenunjangFK = Yii::$app->db->createCommand('SELECT * FROM formulir f LEFT JOIN unsur u ON f.IdUnsur=u.IdUnsur LEFT JOIN formulir_master fm on fm.idFormulirMaster=f.idFormulirMaster where fm.idFormulirMaster=' . $id . ' and u.IdJenisUnsur=2 and fm.idFormulirMaster=' . $id . ' and f.jenisForm="FK"')->queryAll();
        $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
        $template = Yii::getAlias('@app/views/formulir') . '/_exportHitungToExcel.xlsx';
        $objPHPExcel = $objReader->load($template);
        $activeSheet = $objPHPExcel->getActiveSheet();
        $activeSheet->getPageSetup()->setOrientation(\PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $activeSheet->getPageSetup()->setPaperSize(\PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
        $baseUtama = 8;
        $baris = 1;
        $border_style = array('borders' => array('allborders' => array('style' => \PHPExcel_Style_Border::BORDER_THIN)));
        foreach ($formtargetUtamaFG as $value) {
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

        foreach ($formtargetUtamaFG as $value) {
            $objPHPExcel->getSheet(1)->setCellValue('P38', $value['Nama']);
            $objPHPExcel->getSheet(1)->setCellValue('P39', $value['NIP']);
            $objPHPExcel->getSheet(1)->setCellValue('P40', $value['KodeGolongan']);
            $objPHPExcel->getSheet(1)->setCellValue('P41', $value['NamaJabatan']);
            $objPHPExcel->getSheet(1)->setCellValue('P42', $value['UnitKerja']);
        }



        $baseUtamaPenunjang = $baseUtama + 1;
        $barisPenunjang = 1;
        // $activeSheet->mergeCells('B' . $baseUtamaPenunjang . ':' . 'D' . $baseUtamaPenunjang);
        $activeSheet->setCellValue('B' . $baseUtama, '2. Unsur Penunjang');
        $objPHPExcel->getActiveSheet()->getStyle("A$baseUtama:R$baseUtama")->getFont()->setSize(7);
        $objPHPExcel->getActiveSheet()->getStyle("A$baseUtama:R$baseUtama")->applyFromArray($border_style);
        foreach ($formtargetPenunjangFG as $value) {
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
        $baseSum = $baseUtamaPenunjang - 1;
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $baseUtamaPenunjang, "=SUM(C8:C$baseSum)");
        $objPHPExcel->getActiveSheet()->getStyle('C' . $baseUtamaPenunjang)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $baseUtamaFK = 8;
        $border_style = array('borders' => array('allborders' => array('style' => \PHPExcel_Style_Border::BORDER_THIN)));
        foreach ($formtargetUtamaFK as $value) {
            $activeSheet->setCellValue('J' . $baseUtamaFK, $value['AK']);
            $activeSheet->setCellValue('K' . $baseUtamaFK, $value['Kuantitas']);
            $activeSheet->setCellValue('L' . $baseUtamaFK, $value['Output']);
            $activeSheet->setCellValue('M' . $baseUtamaFK, $value['Mutu']);
            $activeSheet->setCellValue('N' . $baseUtamaFK, $value['Waktu']);
            $activeSheet->setCellValue('O' . $baseUtamaFK, 'Bulan');
            $activeSheet->setCellValue('P' . $baseUtamaFK, '-');
            $objPHPExcel->getActiveSheet()->getRowDimension($baseUtamaFK)->setRowHeight(70);
            $objPHPExcel->getActiveSheet()->getStyle("J8:R$baseUtamaFK")->getFont()->setSize(7);
            //$objPHPExcel->getActiveSheet()->getStyle("A8:K$baseUtama")->getFont()->setSize(9)->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->getStyle("J8:R$baseUtamaFK")->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->getStyle("J8:R$baseUtamaFK")->applyFromArray($border_style);
            $baseUtamaFK++;
        }
        $baseUtamaPenunjangFK = $baseUtamaFK + 1;
        $barisPenunjangFK = 1;
        $activeSheet->setCellValue('B' . $baseUtama, '2. Unsur Penunjang');
        $objPHPExcel->getActiveSheet()->getStyle("A$baseUtama:R$baseUtama")->getFont()->setSize(7);
        $objPHPExcel->getActiveSheet()->getStyle("A$baseUtama:R$baseUtama")->applyFromArray($border_style);
        foreach ($formtargetPenunjangFK as $value) {
            $activeSheet->setCellValue('J' . $baseUtamaPenunjangFK, $value['AK']);
            $activeSheet->setCellValue('K' . $baseUtamaPenunjangFK, $value['Kuantitas']);
            $activeSheet->setCellValue('L' . $baseUtamaPenunjangFK, $value['Output']);
            $activeSheet->setCellValue('M' . $baseUtamaPenunjangFK, $value['Mutu']);
            $activeSheet->setCellValue('N' . $baseUtamaPenunjangFK, $value['Waktu']);
            $activeSheet->setCellValue('O' . $baseUtamaPenunjangFK, 'Bulan');
            $activeSheet->setCellValue('P' . $baseUtamaPenunjangFK, '-');
            $objPHPExcel->getActiveSheet()->getStyle('J' . $baseUtamaPenunjangFK . ':' . 'R' . $baseUtamaPenunjangFK)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('J' . $baseUtamaPenunjangFK . ':' . 'R' . $baseUtamaPenunjangFK)->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getRowDimension($baseUtamaPenunjangFK)->setRowHeight(50);
            $objPHPExcel->getActiveSheet()->getStyle("J$baseUtamaPenunjangFK:R$baseUtamaPenunjangFK")->getFont()->setSize(7);
            $objPHPExcel->getActiveSheet()->getStyle("J$baseUtamaPenunjangFK:R$baseUtamaPenunjangFK")->applyFromArray($border_style);
            $barisPenunjangFK++;
            $baseUtamaPenunjangFK++;
        }
        $objPHPExcel->getActiveSheet()->getStyle("A$baseUtamaPenunjang:R$baseUtamaPenunjang")->getFont()->setSize(7);
        $objPHPExcel->getActiveSheet()->getStyle("A$baseUtamaPenunjang:R$baseUtamaPenunjang")->applyFromArray($border_style);
        $baseSumUkur = $baseUtamaPenunjangFK - 1;
        $objPHPExcel->getActiveSheet()->setCellValue('J' . $baseUtamaPenunjang, "=SUM(J8:J$baseSumUkur)");
        $objPHPExcel->getActiveSheet()->setCellValue('R' . $baseUtamaPenunjang, "=AVERAGE(R8:R$baseSumUkur)");
        $tambah = $baseUtamaPenunjang;
        $tambah1 = $baseUtamaPenunjang + 1;
        $ifform = '=IF(R' . $tambah . '<=50,"(Buruk)",IF(R' . $tambah . '<=60,"(Sedang)",IF(R' . $tambah . '<=75,"(Cukup)",IF(R' . $tambah . '<=90.99,"(Baik)","(Sangat Baik)"))))';
        $fres = \PHPExcel_Calculation::getInstance($objPHPExcel)->calculateFormula($ifform, 'R16', $objPHPExcel->getActiveSheet()->getCell('R16'));
        $objPHPExcel->getActiveSheet()->setCellValue('R' . $tambah1, $fres);
        $objPHPExcel->getActiveSheet()->getStyle("R$tambah1:R$tambah1")->getFont()->setSize(7);
        $objPHPExcel->getActiveSheet()->getStyle('B' . $baseUtamaPenunjang . ':' . 'R' . $baseUtamaPenunjang)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('B' . $baseUtamaPenunjang . ':' . 'R' . $baseUtamaPenunjang)->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('R' . $tambah1 . ':' . 'R' . $tambah1)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('R' . $tambah1 . ':' . 'R' . $tambah1)->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $activeSheet->mergeCells('O18:R18');
        $activeSheet->mergeCells('O23:R23');
        $now = new \DateTime();
        
        $ttdtambahTgl = $baseUtamaPenunjang + 3;
        $ttdtambahPegawai = $baseUtamaPenunjang + 4;
        $ttdtambah1PegawaiNama = $baseUtamaPenunjang + 9;
        $ttdtambahPegawaiNIP = $baseUtamaPenunjang + 10;
        $tgl=date('Y-m-d');
        $penilai = Yii::$app->db->createCommand("SELECT * FROM user u INNER JOIN jabatan j ON u.IdJabatan=j.IdJabatan INNER JOIN golongan g ON u.IdGolongan=g.IdGolongan where PejabatPenilai=1")->queryOne();
        $left = array();
        $left['alignment'] = array();
        $left['alignment']['horizontal'] = \PHPExcel_Style_Alignment::HORIZONTAL_LEFT;
        
        $activeSheet->setCellValue('O' . $ttdtambahTgl,"Tanjungpinang,$tgl");
        $activeSheet->setCellValue('O' . $ttdtambahPegawai,"Pejabat Penilai");
        $activeSheet->setCellValue('O' . $ttdtambah1PegawaiNama, $penilai['Nama']);
        $objPHPExcel->getActiveSheet()->getStyle('O' . $ttdtambah1PegawaiNama)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('O' . $ttdtambah1PegawaiNama)->getFont()->setUnderline(true);
        $activeSheet->setCellValue('O' . $ttdtambahPegawaiNIP, $penilai['NIP']);
        $objPHPExcel->getActiveSheet()->getStyle('O' . $ttdtambahPegawaiNIP)->applyFromArray($left);
        $activeSheet->mergeCells('O' . $ttdtambahPegawaiNIP . ':' . 'P' . $ttdtambahPegawaiNIP);
        
      //  $objPHPExcel->getActiveSheet()->setCellValue('O18', "Tanjungpinang," . $now->format('d-M-Y'));
      //  $objPHPExcel->getActiveSheet()->setCellValue('O23', '(..................................................)');
        $objPHPExcel->getActiveSheet()->getStyle('O18:O18')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('O18:O18')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('O23:O23')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('O23:O23')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle("O18")->getFont()->setSize(7);
        $objPHPExcel->getActiveSheet()->getStyle("O23")->getFont()->setSize(7);



        $objPHPExcel->setActiveSheetIndex(1);
        $objPHPExcel->getActiveSheet()->setCellValue('F3', "='PENGUKURAN'!R$baseUtamaPenunjang");
        $objPHPExcel->setActiveSheetIndex(2);
        $sqlNilai = "SELECT * FROM indikator_nilai inn inner join indikator id on inn.idIndikator=id.idIndikator where inn.IdFormulirMaster=$id";
        $pelayanan = "$sqlNilai and id.idAspek=1";
        $indikator = Yii::$app->db->createCommand($pelayanan)->queryAll();
        $barisnilai = 6;
        $urut = 1;
        foreach ($indikator as $value) {
            $n = $this->pilihNilai($value['nilai'], $barisnilai);
            $objPHPExcel->getActiveSheet()->setCellValue("B$barisnilai", $urut);
            $objPHPExcel->getActiveSheet()->setCellValue("C$barisnilai", $value['namaIndikator']);
            $objPHPExcel->getActiveSheet()->setCellValue($n, $value['nilai']);
            $barisnilai++;
            $urut++;
        }
        $integritas = "$sqlNilai and id.idAspek=2";
        $indikatorintegritas = Yii::$app->db->createCommand($integritas)->queryAll();
        $barisnilaiindikatorintegritas = 22;
        $urutindikatorintegritas = 1;
        foreach ($indikatorintegritas as $value) {
            $n = $this->pilihNilai($value['nilai'], $barisnilaiindikatorintegritas);
            $objPHPExcel->getActiveSheet()->setCellValue("B$barisnilaiindikatorintegritas", $urutindikatorintegritas);
            $objPHPExcel->getActiveSheet()->setCellValue("C$barisnilaiindikatorintegritas", $value['namaIndikator']);
            $objPHPExcel->getActiveSheet()->setCellValue($n, $value['nilai']);
            $barisnilaiindikatorintegritas++;
            $urutindikatorintegritas++;
        }

        $komitmen = "$sqlNilai and id.idAspek=3";
        $indikatorkomitmen = Yii::$app->db->createCommand($komitmen)->queryAll();
        $barisnilaiindikatorkomitmen = 40;
        $urutindikatorkomitmen = 1;
        foreach ($indikatorkomitmen as $value) {
            $n = $this->pilihNilai($value['nilai'], $barisnilaiindikatorkomitmen);
            $objPHPExcel->getActiveSheet()->setCellValue("B$barisnilaiindikatorkomitmen", $urutindikatorkomitmen);
            $objPHPExcel->getActiveSheet()->setCellValue("C$barisnilaiindikatorkomitmen", $value['namaIndikator']);
            $objPHPExcel->getActiveSheet()->setCellValue($n, $value['nilai']);
            $barisnilaiindikatorkomitmen++;
            $urutindikatorkomitmen++;
        }

        $disiplin = "$sqlNilai and id.idAspek=4";
        $indikatordisiplin = Yii::$app->db->createCommand($disiplin)->queryAll();
        $barisnilaiindikatordisiplin = 54;
        $urutindikatordisiplin = 1;
        foreach ($indikatordisiplin as $value) {
            $n = $this->pilihNilai($value['nilai'], $barisnilaiindikatordisiplin);
            $objPHPExcel->getActiveSheet()->setCellValue("B$barisnilaiindikatordisiplin", $urutindikatordisiplin);
            $objPHPExcel->getActiveSheet()->setCellValue("C$barisnilaiindikatordisiplin", $value['namaIndikator']);
            $objPHPExcel->getActiveSheet()->setCellValue($n, $value['nilai']);
            $barisnilaiindikatordisiplin++;
            $urutindikatordisiplin++;
        }

        $kerjasama = "$sqlNilai and id.idAspek=5";
        $indikatorkerjasama = Yii::$app->db->createCommand($kerjasama)->queryAll();
        $barisnilaiindikatorkerjasama = 66;
        $urutindikatorkerjasama = 1;
        foreach ($indikatorkerjasama as $value) {
            $n = $this->pilihNilai($value['nilai'], $barisnilaiindikatorkerjasama);
            $objPHPExcel->getActiveSheet()->setCellValue("B$barisnilaiindikatorkerjasama", $urutindikatorkerjasama);
            $objPHPExcel->getActiveSheet()->setCellValue("C$barisnilaiindikatorkerjasama", $value['namaIndikator']);
            $objPHPExcel->getActiveSheet()->setCellValue($n, $value['nilai']);
            $barisnilaiindikatorkerjasama++;
            $urutindikatorkerjasama++;
        }
        $objPHPExcel->setActiveSheetIndex(0);
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=_exportHitungToExcel.xlsx");
        header("Content-Transfer-Encoding: binary ");
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
        $objWriter->save('php://output');

        exit();
    }

    public function actionExportTargetExcel($id) {
        $pegawai = Yii::$app->db->createCommand("SELECT * FROM user u INNER JOIN jabatan j ON u.IdJabatan=j.IdJabatan INNER JOIN golongan g ON u.IdGolongan=g.IdGolongan WHERE id=" . Yii::$app->user->getId())->queryOne();
        $penilai = Yii::$app->db->createCommand("SELECT * FROM user u INNER JOIN jabatan j ON u.IdJabatan=j.IdJabatan INNER JOIN golongan g ON u.IdGolongan=g.IdGolongan where PejabatPenilai=1")->queryOne();
        $formtargetUtama = Yii::$app->db->createCommand("SELECT * FROM formulir F LEFT JOIN unsur U ON F.IdUnsur=U.IdUnsur LEFT JOIN formulir_master FM ON FM.IdFormulirMaster=F.IdFormulirMaster WHERE FM.IdFormulirMaster=$id AND U.IdJenisUnsur=1 and F.jenisForm='FG'")->queryAll();
        $formtargetPenunjang = Yii::$app->db->createCommand("SELECT * FROM formulir F INNER JOIN unsur U ON F.IdUnsur=U.IdUnsur LEFT JOIN formulir_master FM ON FM.IdFormulirMaster=F.IdFormulirMaster WHERE FM.IdFormulirMaster=$id AND U.IdJenisUnsur=2 and F.jenisForm='FG'")->queryAll();
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

         
        $ttd=$baseUtamaPenunjang+2;
        $ttdPegawai=$baseUtamaPenunjang+3;
        $ttdPegawaiNama=$baseUtamaPenunjang+9;
        $ttdPegawaiNIP=$baseUtamaPenunjang+10;
        $tgl=date('Y-m-d');
        $activeSheet->mergeCells('B' . $baseUtamaPenunjang . ':' . 'D' . $baseUtamaPenunjang);
        $activeSheet->setCellValue('B' . $baseUtamaPenunjang, 'Jumlah');
        
        $left = array();
        $left['alignment'] = array();
        $left['alignment']['horizontal'] = \PHPExcel_Style_Alignment::HORIZONTAL_LEFT;
        
        $activeSheet->setCellValue('H' . $ttd,"Tanjungpinang,$tgl");
        $activeSheet->setCellValue('H' . $ttdPegawai,"Pegawai Negeri Sipil yang Dinilai");
        $activeSheet->setCellValue('H' . $ttdPegawaiNama, $pegawai['Nama']);
        $objPHPExcel->getActiveSheet()->getStyle('H' . $ttdPegawaiNama)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('H' . $ttdPegawaiNama)->getFont()->setUnderline(true);
        $activeSheet->setCellValue('H' . $ttdPegawaiNIP, $pegawai['NIP']);
        $objPHPExcel->getActiveSheet()->getStyle('H' . $ttdPegawaiNIP)->applyFromArray($left);
        
        
        $activeSheet->setCellValue('C' . $ttdPegawai,"Pejabat Penilai");
        $activeSheet->setCellValue('C' . $ttdPegawaiNama, $penilai['Nama']);
        $objPHPExcel->getActiveSheet()->getStyle('C' . $ttdPegawaiNama)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C' . $ttdPegawaiNama)->getFont()->setUnderline(true);
        $activeSheet->setCellValue('C' . $ttdPegawaiNIP, $penilai['NIP']);
        $objPHPExcel->getActiveSheet()->getStyle('C' . $ttdPegawaiNIP)->applyFromArray($left);
        
        $objPHPExcel->getActiveSheet()->getStyle("A13:K$baseUtamaPenunjang")->applyFromArray($border_style);
        $activeSheet->mergeCells('F' . $baseUtamaPenunjang . ':' . 'K' . $baseUtamaPenunjang);
        $baseRata = $baseUtamaPenunjang - 1;
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $baseUtamaPenunjang, "=SUM(E13:E$baseRata)");
        $objPHPExcel->getActiveSheet()->getStyle('E' . $baseUtamaPenunjang)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

       
        //\PhpExcel_Calculation_Par::cloneFormulaForRow("=SUM(A1:B1)",9); //"=SUM(A9:B9)" 


        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
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

    public function pilihNilai($nilai, $baris) {
        if ($nilai == 1) {
            return 'D' . $baris;
        } else if ($nilai == 2) {
            return 'E' . $baris;
        } else if ($nilai == 3) {
            return 'F' . $baris;
        }
    }

}
