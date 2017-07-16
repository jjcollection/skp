<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jabatan".
 *
 * @property integer $IdJabatan
 * @property string $NamaJabatan
 *
 * @property Pegawai[] $pegawais
 */
class Jabatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jabatan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NamaJabatan'], 'required'],
            [['NamaJabatan'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IdJabatan' => Yii::t('app', 'Id Jabatan'),
            'NamaJabatan' => Yii::t('app', 'Nama Jabatan'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPegawais()
    {
        return $this->hasMany(Pegawai::className(), ['IdJabatan' => 'IdJabatan']);
    }
}
