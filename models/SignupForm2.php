<?php
namespace app\models;

use Yii;
use yii\base\Model;


/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $NIP;
    public $Nama;
    public $Agama;
    public $Telp;
    public $Alamat;
    public $UnitKerja;
    public $idGolongan;
    public $IdJabatan;
    public $PejabatPenilai;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            
            ['NIP','required'],
            ['Nama','required'],
            ['Agama','required'],
            ['Telp','required'],
            ['Alamat','required'],
            ['UnitKerja','required'],
            ['idGolongan','required'],
            ['IdJabatan','required'],
            ['PejabatPenilai','required'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
       
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
//            $user->NIP=$this->NIP;
//            $user->Nama=$this->Nama;
//            $user->Agama="islam";
//            $user->Telp=$this->Tlp;
//            $user->Alamat=$this->Alamat;
//            $user->UnitKerja=$this->UnitKerja;
//            $user->idGolongan=1;
//            $user->IdJabatan=1;
//            $user->PejabatPenilai=1;
           
            

            return $user->save() ? $user : null;
        
    }
}
