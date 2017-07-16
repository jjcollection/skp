<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kredit".
 *
 * @property integer $No
 * @property string $Kode
 * @property string $Kegiatan
 * @property string $Keterangan
 * @property double $NIlai
 */
class Kredit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kredit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kode', 'Kegiatan', 'Keterangan', 'NIlai'], 'required'],
            [['Kegiatan'], 'string'],
            [['NIlai'], 'number'],
            [['Kode'], 'string', 'max' => 10],
            [['Keterangan'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'No' => Yii::t('app', 'No'),
            'Kode' => Yii::t('app', 'Kode'),
            'Kegiatan' => Yii::t('app', 'Kegiatan'),
            'Keterangan' => Yii::t('app', 'Keterangan'),
            'NIlai' => Yii::t('app', 'Nilai'),
        ];
    }
}
