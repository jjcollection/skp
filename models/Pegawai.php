<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pegawai".
 *
 * @property integer $NoPegawai
 * @property string $Nip
 * @property string $Nama
 * @property string $Agama
 * @property integer $idGolongan
 * @property string $Telp
 * @property string $Alamat
 * @property string $UnitKerja
 * @property integer $IdJabatan
 * @property integer $PejabatPenilai
 * @property integer $IdUser
 *
 * @property Jabatan $idJabatan
 * @property User $idUser
 * @property Golongan $idGolongan0
 */
class Pegawai extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pegawai';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nip', 'Nama', 'Agama', 'idGolongan', 'Telp', 'Alamat', 'UnitKerja', 'IdJabatan', 'IdUser'], 'required'],
            [['idGolongan', 'IdJabatan', 'PejabatPenilai', 'IdUser'], 'integer'],
            [['Nip'], 'string', 'max' => 40],
            [['Nama', 'Alamat'], 'string', 'max' => 100],
            [['Agama', 'Telp'], 'string', 'max' => 20],
            [['UnitKerja'], 'string', 'max' => 200],
            [['IdJabatan'], 'exist', 'skipOnError' => true, 'targetClass' => Jabatan::className(), 'targetAttribute' => ['IdJabatan' => 'IdJabatan']],
            [['IdUser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['IdUser' => 'id']],
            [['idGolongan'], 'exist', 'skipOnError' => true, 'targetClass' => Golongan::className(), 'targetAttribute' => ['idGolongan' => 'idGolongan']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'NoPegawai' => Yii::t('app', 'No Pegawai'),
            'Nip' => Yii::t('app', 'Nip'),
            'Nama' => Yii::t('app', 'Nama'),
            'Agama' => Yii::t('app', 'Agama'),
            'idGolongan' => Yii::t('app', 'Id Golongan'),
            'Telp' => Yii::t('app', 'Telp'),
            'Alamat' => Yii::t('app', 'Alamat'),
            'UnitKerja' => Yii::t('app', 'Unit Kerja'),
            'IdJabatan' => Yii::t('app', 'Jabatan'),
            'PejabatPenilai' => Yii::t('app', 'Pejabat Penilai'),
            'IdUser' => Yii::t('app', 'Id User'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdJabatan()
    {
        return $this->hasOne(Jabatan::className(), ['IdJabatan' => 'IdJabatan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'IdUser']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdGolongan0()
    {
        return $this->hasOne(Golongan::className(), ['idGolongan' => 'idGolongan']);
    }
    
    public function getAgama()
    {
        return ['Islam'=>'Islam','Kristen'=>'Kristen','Hindu'=>'Hindu','Buddha'=>'Buddha'];
    }
}
