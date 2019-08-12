<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
spl_autoload_unregister(array('YiiBase','autoload'));
Yii::import('ext.phpCAS.CAS', true);
spl_autoload_register(array('YiiBase','autoload'));
class UserIdentityCas extends CUserIdentity
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
	$this->username=phpCAS::getUser();
	//$this->username='uptti';
        $dbcmd = Yii::app()->db->createCommand("select * from simangga.fnlogin_user01cas('$this->username')")->queryAll();
        Yii::app()->session['id_user'] =$dbcmd[0]['id_user'];
        Yii::app()->session['nama'] =$dbcmd[0]['nama'];

        Yii::app()->session['level'] =$dbcmd[0]['level'];
        Yii::app()->session['id_unitkerja'] =$dbcmd[0]['id_unitkerja'];
        if(isset($dbcmd[0]['nama']))
            Yii::app()->session['statuslogin'] =true;
        else
            Yii::app()->session['statuslogin'] =false;


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
