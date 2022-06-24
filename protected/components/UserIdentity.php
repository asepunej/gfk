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

        $dbcmd = Yii::app()->db->createCommand("
                    SELECT
                    t1.id_user,
                    t1.username,
                    t1.pasword,
                    t1.id_pegawai,
                    t1.kd_jabatan,
                    t1.kd_klinik,
                    t2.jabatan,
                    t3.nama,
                    t4.klinik
                    FROM support.user t1
                    LEFT JOIN support.jabatan t2 on t1.kd_jabatan=t2.kd_jabatan
                    LEFT JOIN public.pegawai t3 on t1.id_pegawai=t3.id_pegawai
                    LEFT JOIN support.klinik t4 on t1.kd_klinik=t4.kd_klinik      
            Where t1.username='$this->username'
            and t1.pasword='$this->password' ;
        ")->queryAll();

       
        
      
        if(isset($dbcmd[0]['id_user'])){
                Yii::app()->session['statuslogin'] =true;

                Yii::app()->session['id_user'] =$dbcmd[0]['id_user'];
                Yii::app()->session['username'] =$dbcmd[0]['username']; 
                Yii::app()->session['id_pegawai'] =$dbcmd[0]['id_pegawai'];
                Yii::app()->session['kd_jabatan'] =$dbcmd[0]['kd_jabatan'];
                Yii::app()->session['kd_klinik'] =$dbcmd[0]['kd_klinik'];

                Yii::app()->session['nama'] =$dbcmd[0]['nama']; 
                Yii::app()->session['jabatan'] =$dbcmd[0]['jabatan'];      
                Yii::app()->session['klinik'] =$dbcmd[0]['klinik'];
               
            }
            
        else{
            Yii::app()->session['statuslogin'] =false;
             $this->redirect(array("Site/Logout"));
          
        }
            


        $this->errorCode=self::ERROR_NONE;
        return !$this->errorCode;

        Yii::app()->session['statuslogin'] =true;
        $this->errorCode=self::ERROR_NONE;
        return !$this->errorCode;


        $this->errorCode=self::ERROR_NONE;
        return !$this->errorCode;

    }
}