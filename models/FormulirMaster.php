<?php
namespace app\models;

use app\models\Formulir;
use app\models\Kriteria;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;


/**
 * This is the model class for table "formulir_master".
 *
 * @property integer $idFormulirMaster
 * @property string $tanggalBuat
 * @property string $tahun
 * @property integer $idUser
 *
 * @property Formulir[] $formulirs
 * @property User2 $idUser0
 */
class FormulirMaster extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'formulir_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tanggalBuat','idKriteria'], 'safe'],
            [['idUser'], 'integer'],
            [['tahun'], 'string', 'max' => 20],
            [['idUser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idUser' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idFormulirMaster' => Yii::t('app', 'Id Formulir Master'),
            'tanggalBuat' => Yii::t('app', 'Tanggal Buat'),
            'tahun' => Yii::t('app', 'Tahun'),
            'idUser' => Yii::t('app', 'Id User'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getFormulirs()
    {
        return $this->hasMany(Formulir::className(), ['idFormulirMaster' => 'idFormulirMaster']);
    }

    /**
     * @return ActiveQuery
     */
    public function getIdUser0()
    {
        return $this->hasOne(User::className(), ['id' => 'idUser']);
    }
    
    public function akrata($id,$jenisForm)
    {
        if($id=="")
        {
            $id=0;
        }
        $rata=Yii::$app->db->createCommand("SELECT SUM(AK) FROM formulir WHERE idFormulirMaster=$id and jenisForm='$jenisForm'")->queryScalar();
        Yii::$app->db->createCommand("UPDATE formulir_master SET rataAK='$rata' WHERE idFormulirMaster=$id")->execute();
        return round($rata,2);
    }
    
    public function pilihid($id) {
        $cari = FormulirMaster::findOne($id);
        $idk = $cari->idKriteria;
        return $idk;
    }
    
    public function namakriteria($id) {
        $cari = Kriteria::findOne($id);
        $nama = $cari->NamaKriteria;
        Yii::$app->session['idKriteria'] = $id;
        Yii::$app->session['nama'] = $nama;
        return Yii::$app->session['nama'];
    }
}
