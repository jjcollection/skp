<?php

namespace app\models;

use app\models\User;
use Yii;
use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model {

    public $username;
    public $email;
    public $password;
    public $NIP;
    public $Nama;
    public $Agama;
    public $Telp;
    public $Alamat;
    public $UnitKerja;
    public $IdGolongan;
    public $IdJabatan;
    public $PejabatPenilai;

    //const PejabatPenilai = 0;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'required'],
            ['PejabatPenilai', 'safe'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['NIP', 'required'],
            ['Nama', 'required'],
            ['Agama', 'required'],
            ['Telp', 'required'],
            ['UnitKerja', 'required'],
            ['IdGolongan', 'required'],
            ['IdJabatan', 'required'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup() {
        if (!$this->validate()) {
            return null;
        }


        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->NIP = $this->NIP;
        $user->Nama = $this->Nama;
        $user->Agama = $this->Agama;
        $user->Telp = $this->Telp;
        $user->Alamat = $this->Alamat;
        $user->idGolongan = $this->IdGolongan;
        $user->UnitKerja = $this->UnitKerja;
        $user->IdJabatan = $this->IdJabatan;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        if ($this->IdJabatan == 1) {
            $jab = "kasek";
            $user->PejabatPenilai = 1;
        } else {
            $jab = "guru";
            $user->PejabatPenilai = 0;
        }
        $user->save();
        Yii::$app->db->createCommand("insert into auth_assignment (item_name,user_id,created_at) values('$jab',$user->id,NOW())")->execute();
        return $user;
    }

}
