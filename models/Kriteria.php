<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kriteria".
 *
 * @property integer $IdKriteria
 * @property string $NamaKriteria
 *
 * @property Aturan[] $aturans
 */
class Kriteria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kriteria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NamaKriteria'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IdKriteria' => 'Id Kriteria',
            'NamaKriteria' => 'Nama Kriteria',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAturans()
    {
        return $this->hasMany(Aturan::className(), ['IdKriteria' => 'IdKriteria']);
    }
}
