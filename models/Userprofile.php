<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $NIP
 * @property string $Nama
 * @property string $Agama
 * @property string $Telp
 * @property string $Alamat
 * @property string $UnitKerja
 * @property integer $idGolongan
 * @property integer $IdJabatan
 * @property integer $PejabatPenilai
 *
 * @property Formulir[] $formulirs
 */
class Userprofile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at', 'NIP', 'idGolongan', 'IdJabatan', 'PejabatPenilai'], 'integer'],
            [['Alamat'], 'string'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['Nama', 'Agama', 'Telp'], 'string', 'max' => 20],
            [['UnitKerja'], 'string', 'max' => 200],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'NIP' => Yii::t('app', 'Nip'),
            'Nama' => Yii::t('app', 'Nama'),
            'Agama' => Yii::t('app', 'Agama'),
            'Telp' => Yii::t('app', 'Telp'),
            'Alamat' => Yii::t('app', 'Alamat'),
            'UnitKerja' => Yii::t('app', 'Unit Kerja'),
            'idGolongan' => Yii::t('app', 'Id Golongan'),
            'IdJabatan' => Yii::t('app', 'Id Jabatan'),
            'PejabatPenilai' => Yii::t('app', 'Pejabat Penilai'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFormulirs()
    {
        return $this->hasMany(Formulir::className(), ['IdUser' => 'id']);
    }
}
