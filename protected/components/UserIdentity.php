<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
//        $db='db';
        $dbcmd = Yii::app()->db->createCommand("select * from referensi.fnlogin_user('$this->username','$this->password')")->queryAll();
        Yii::app()->session['id_user'] =$dbcmd[0]['id_user'];
        Yii::app()->session['nama_lengkap'] =$dbcmd[0]['nama_lengkap'];
        Yii::app()->session['nip'] =$dbcmd[0]['nip'];
        Yii::app()->session['jabatan'] =$dbcmd[0]['jabatan'];
        Yii::app()->session['id_level_user'] =$dbcmd[0]['id_level_user'];
        Yii::app()->session['id_skpd'] =$dbcmd[0]['id_skpd'];
        Yii::app()->session['level_user'] =$dbcmd[0]['level_user'];
        Yii::app()->session['nama_skpd'] =$dbcmd[0]['nama_skpd'];
        Yii::app()->session['level_unit'] =$dbcmd[0]['level_unit'];

      // Yii::app()->session['tahun_anggaran']=$_POST['ddltahun'];


//$config=dirname(__FILE__).'/protected/config/main.php';
//        $config=dirname(__FILE__).'/protected/config/main.php';
//        yii::app()->$config;


//require_once($yii);
//Yii::createWebApplication($config)->run();
//        yii::createComponent($config)->run();



        if(isset($dbcmd[0]['id_user']))
            Yii::app()->session['statuslogin'] =true;
        else
            Yii::app()->session['statuslogin'] =false;

        $this->errorCode=self::ERROR_NONE;
        return !$this->errorCode;

        Yii::app()->session['statuslogin'] =true;
        $this->errorCode=self::ERROR_NONE;
        return !$this->errorCode;


//
//
//        $users=array(
//            // username => password
//            'demo'=>'demo',
//            'admin'=>'admin',
//        );
//
//
//		if(!isset($users[$this->username]))
//			$this->errorCode=self::ERROR_USERNAME_INVALID;
//		elseif($users[$this->username]!==$this->password)
//			$this->errorCode=self::ERROR_PASSWORD_INVALID;
//		else
//			$this->errorCode=self::ERROR_NONE;
//		return !$this->errorCode;

//        if (!Yii::app()->session['statuslogin'])
//            $this->errorCode=self::ERROR_PASSWORD_INVALID;
//        else
//            $this->errorCode=self::ERROR_NONE;
//        return !$this->errorCode;
//
//        if(isset($dbcmd[0]['Nama']))
//            Yii::app()->session['statuslogin'] =true;
//        else
//            Yii::app()->session['statuslogin'] =false;


        $this->errorCode=self::ERROR_NONE;
        return !$this->errorCode;

    }
}