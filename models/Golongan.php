<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "golongan".
 *
 * @property integer $idGolongan
 * @property string $KodeGolongan
 * @property string $NamaGolongan
 *
 * @property Pegawai[] $pegawais
 */
class Golongan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'golongan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['KodeGolongan', 'NamaGolongan'], 'required'],
            [['KodeGolongan'], 'string', 'max' => 50],
            [['NamaGolongan'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idGolongan' => Yii::t('app', 'Id Golongan'),
            'KodeGolongan' => Yii::t('app', 'Kode Golongan'),
            'NamaGolongan' => Yii::t('app', 'Nama Golongan'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPegawais()
    {
        return $this->hasMany(Pegawai::className(), ['idGolongan' => 'idGolongan']);
    }
}
