<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "unsur".
 *
 * @property integer $IdUnsur
 * @property string $NamaUnsur
 * @property double $Nilai
 * @property integer $IdJenisUnsur
 *
 * @property Formulir[] $formulirs
 * @property Jenisunsur $idJenisUnsur
 */
class Unsur extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
   
    public static function tableName()
    {
        return 'unsur';
    }

    /**
     * @inheritdoc
     */
    public $idUnsur;
    public $paket;
    public $nilaiak;
    public function rules()
    {
        return [
            [['NamaUnsur', 'Nilai', 'IdJenisUnsur'], 'required'],
            [['Nilai'], 'number'],
            [['idUnsur'], 'safe'],
            [['IdJenisUnsur'], 'integer'],
            [['NamaUnsur','Keterangan'], 'string', 'max' => 200],
            [['IdJenisUnsur'], 'exist', 'skipOnError' => true, 'targetClass' => Jenisunsur::className(), 'targetAttribute' => ['IdJenisUnsur' => 'IdJenisUnsur']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IdUnsur' => Yii::t('app', 'Id Unsur'),
            'NamaUnsur' => Yii::t('app', 'Nama Unsur'),
            'Nilai' => Yii::t('app', 'Nilai'),
            'IdJenisUnsur' => Yii::t('app', 'Id Jenis Unsur'),
            'Keterangan' => Yii::t('app', 'Keterangan'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFormulirs()
    {
        return $this->hasMany(Formulir::className(), ['IdUnsur' => 'idUnsur']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdJenisUnsur()
    {
        return $this->hasOne(Jenisunsur::className(), ['IdJenisUnsur' => 'IdJenisUnsur']);
    }
    
    public function getKeterangan()
    {
        return ['Paket'=>'Paket','Non Paket'=>'Non Paket'];
    }
}
