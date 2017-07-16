<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "aturan".
 *
 * @property integer $IdAturan
 * @property integer $IdGolongan
 * @property integer $IdKriteria
 * @property double $AK
 *
 * @property Kriteria $idKriteria
 * @property Golongan $idGolongan
 */
class Aturan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aturan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdGolongan', 'IdKriteria'], 'integer'],
            [['AK'], 'number'],
            [['IdKriteria'], 'exist', 'skipOnError' => true, 'targetClass' => Kriteria::className(), 'targetAttribute' => ['IdKriteria' => 'IdKriteria']],
            [['IdGolongan'], 'exist', 'skipOnError' => true, 'targetClass' => Golongan::className(), 'targetAttribute' => ['IdGolongan' => 'idGolongan']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IdAturan' => Yii::t('app', 'Id Aturan'),
            'IdGolongan' => Yii::t('app', 'Id Golongan'),
            'IdKriteria' => Yii::t('app', 'Id Kriteria'),
            'AK' => Yii::t('app', 'Ak'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdKriteria()
    {
        return $this->hasOne(Kriteria::className(), ['IdKriteria' => 'IdKriteria']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdGolongan()
    {
        return $this->hasOne(Golongan::className(), ['idGolongan' => 'IdGolongan']);
    }
}
