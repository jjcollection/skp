<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "aspek".
 *
 * @property integer $idAspek
 * @property string $namaAspek
 *
 * @property Indikator[] $indikators
 */
class Aspek extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aspek';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['namaAspek'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idAspek' => Yii::t('app', 'Id Aspek'),
            'namaAspek' => Yii::t('app', 'Nama Aspek'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIndikators()
    {
        return $this->hasMany(Indikator::className(), ['idAspek' => 'idAspek']);
    }
}
