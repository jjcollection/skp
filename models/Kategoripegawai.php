<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kategoripegawai".
 *
 * @property integer $IdKategoriPegawai
 * @property string $Kategori
 *
 * @property Pegawai[] $pegawais
 */
class Kategoripegawai extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kategoripegawai';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kategori'], 'required'],
            [['Kategori'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IdKategoriPegawai' => Yii::t('app', 'Id Kategori Pegawai'),
            'Kategori' => Yii::t('app', 'Kategori'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPegawais()
    {
        return $this->hasMany(Pegawai::className(), ['IdKategoriPegawai' => 'IdKategoriPegawai']);
    }
}
