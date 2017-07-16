<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\Response;

/**
 * This is the model class for table "formulir".
 *
 * @property integer $IdFormulir
 * @property integer $IdUser
 * @property integer $Kuantitas
 * @property string $Output
 * @property integer $Mutu
 * @property double $Waktu
 * @property double $Biaya
 * @property double $AK
 * @property integer $IdUnsur
 * @property integer $idFormulirMaster
 *
 * @property User $idUser
 * @property Unsur $idUnsur
 * @property Unsur $IdJenisUnsur
 * @property FormulirMaster $idFormulirMaster0
 */
class Formulir extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public $nilai;
    public $IdJenisUnsur;
    public $nilaiak;
    public $paket;

    public static function tableName() {
        return 'formulir';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['Kuantitas', 'Output', 'Mutu','IdJenisUnsur', 'Waktu', 'Biaya', 'AK', 'IdUnsur'], 'required'],
            [['Kuantitas', 'Mutu', 'IdUnsur', 'idFormulirMaster'], 'integer'],
            [['Waktu', 'Biaya', 'AK'], 'number'],
            [['Output'], 'string', 'max' => 200],
            [['IdUnsur'], 'exist', 'skipOnError' => true, 'targetClass' => Unsur::className(), 'targetAttribute' => ['IdUnsur' => 'idUnsur']],
            [['idFormulirMaster'], 'exist', 'skipOnError' => true, 'targetClass' => FormulirMaster::className(), 'targetAttribute' => ['idFormulirMaster' => 'idFormulirMaster']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'IdFormulir' => Yii::t('app', 'Id Formulir'),
            'Kuantitas' => Yii::t('app', 'Kuantitas'),
            'Output' => Yii::t('app', 'Output'),
            'Mutu' => Yii::t('app', 'Mutu'),
            'Waktu' => Yii::t('app', 'Waktu'),
            'Biaya' => Yii::t('app', 'Biaya'),
            'AK' => Yii::t('app', 'Ak'),
            'IdUnsur' => Yii::t('app', 'Id Unsur'),
            'idFormulirMaster' => Yii::t('app', 'Id Formulir Master'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getIdUser() {
        return $this->hasOne(User::className(), ['id' => 'IdUser']);
    }

    /**
     * @return ActiveQuery
     */
    public function getIdUnsur() {
        return $this->hasOne(Unsur::className(), ['idUnsur' => 'IdUnsur']);
    }

    /**
     * @return ActiveQuery
     */
    public function getIdFormulirMaster0() {
        return $this->hasOne(FormulirMaster::className(), ['idFormulirMaster' => 'idFormulirMaster']);
    }

    public function getOutput() {
        return array('Laporan' => 'Laporan', 'Sertifikat' => 'Sertifikat', 'Ijazah' => 'Ijazah');
    }

    public function actionGetunsur($idJenis) {
        $unsur = Yii::$app->db->createCommand('select * from unsur where IdJenisUnsur')->queryAll();
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['unsur' => $unsur];
    }

    public function hitungPencapaian($idUnsur, $idFormulirMaster) {
        $sqlHitung = "
            SELECT DISTINCT(idformulirmaster), ((SELECT kuantitas FROM formulir WHERE jenisform='FK' AND idUnsur=$idUnsur AND idformulirmaster=7)/(
            SELECT kuantitas FROM formulir WHERE jenisform='FG' AND idUnsur=$idUnsur AND idformulirmaster=$idFormulirMaster)*100) AS kuant,
            ((SELECT mutu FROM formulir WHERE jenisform='FK' AND idUnsur=$idUnsur AND idformulirmaster=$idFormulirMaster)/(
            SELECT mutu FROM formulir WHERE jenisform='FG' AND idUnsur=$idUnsur AND idformulirmaster=$idFormulirMaster)*100) AS mut,
            (100-(SELECT waktu FROM formulir WHERE jenisform='FK' AND idUnsur=$idUnsur AND idformulirmaster=$idFormulirMaster)/(
            SELECT waktu FROM formulir WHERE jenisform='FG' AND idUnsur=95 AND idformulirmaster=$idFormulirMaster)*100) AS waktu, IF(waktu>24,100,76) AS wkt
            FROM formulir WHERE idformulirmaster=$idFormulirMaster";
       // echo $sqlHitung;
        //exit();
            $hitung = Yii::$app->db->createCommand($sqlHitung)->queryAll();
            return $hitung;
    }

}
