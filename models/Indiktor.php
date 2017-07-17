<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "indiktor".
 *
 * @property integer $idIndikator
 * @property string $namaIndikator
 * @property integer $idAspek
 *
 * @property Aspek $idAspek0
 */
class Indiktor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'indiktor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['namaIndikator'], 'string'],
            [['idAspek'], 'integer'],
            [['idAspek'], 'exist', 'skipOnError' => true, 'targetClass' => Aspek::className(), 'targetAttribute' => ['idAspek' => 'idAspek']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idIndikator' => Yii::t('app', 'Id Indikator'),
            'namaIndikator' => Yii::t('app', 'Nama Indikator'),
            'idAspek' => Yii::t('app', 'Id Aspek'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAspek0()
    {
        return $this->hasOne(Aspek::className(), ['idAspek' => 'idAspek']);
    }
}
