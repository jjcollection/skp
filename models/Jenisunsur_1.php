<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "jenisunsur".
 *
 * @property integer $IdJenisUnsur
 * @property string $NamaUnsur
 *
 * @property Unsur[] $unsurs
 */
class Jenisunsur extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jenisunsur';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NamaUnsur'], 'required'],
            [['NamaUnsur'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IdJenisUnsur' => Yii::t('app', 'Id Jenis Unsur'),
            'NamaUnsur' => Yii::t('app', 'Nama Unsur'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnsurs()
    {
        return $this->hasMany(Unsur::className(), ['IdJenisUnsur' => 'IdJenisUnsur']);
    }
}
