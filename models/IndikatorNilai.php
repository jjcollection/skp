<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "indikator_nilai".
 *
 * @property integer $idIndikatorNilai
 * @property integer $idFormulirMaster
 * @property integer $idIndikator
 * @property double $nilai
 *
 * @property FormulirMaster $idFormulirMaster0
 * @property Indikator $idIndikator0
 */
class IndikatorNilai extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'indikator_nilai';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
             [['idFormulirMaster', 'idIndikator'], 'required'],
            
            [['idFormulirMaster', 'idIndikator'], 'integer'],
            [['nilai'], 'number'],
            [['idFormulirMaster'], 'exist', 'skipOnError' => true, 'targetClass' => FormulirMaster::className(), 'targetAttribute' => ['idFormulirMaster' => 'idFormulirMaster']],
            [['idIndikator'], 'exist', 'skipOnError' => true, 'targetClass' => Indikator::className(), 'targetAttribute' => ['idIndikator' => 'idIndikator']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idIndikatorNilai' => Yii::t('app', 'Id Indikator Nilai'),
            'idFormulirMaster' => Yii::t('app', 'Id Formulir Master'),
            'idIndikator' => Yii::t('app', 'Id Indikator'),
            'nilai' => Yii::t('app', 'Nilai'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdFormulirMaster0()
    {
        return $this->hasOne(FormulirMaster::className(), ['idFormulirMaster' => 'idFormulirMaster']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdIndikator0()
    {
        return $this->hasOne(Indikator::className(), ['idIndikator' => 'idIndikator']);
    }
}
