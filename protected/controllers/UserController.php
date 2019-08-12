<?php

class UserController extends Controller
{
	public $layout='//layouts/column2';
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('DaftarUser'),
                'users'=>array('*'),
            ),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

//--------------------------------------------------------
    public function actionDaftarUser() {

        if(isset($_POST['ddllevel'])) {
               $id_level_user   =$_POST['ddllevel'];
        }else  $id_level_user   =1;

        if($_POST['action']=='statusdelete') {
            $id_user     =$_POST['id_user'];
			$id_level_user     =$_POST['id_level_user'];
            Yii::app()->db->createCommand("SELECT * FROM keuangan.fndelete_user('$id_user')")->execute();
       }

        $myquery="SELECT * FROM keuangan.fndaftar_user('$id_level_user')";
        $dataProvider=Yii::app()->db->createCommand("$myquery;")->queryAll();
        $this->render('daftar_user',
            array( 'dataProvider'  =>$dataProvider
            ,'id_level_user'       => $id_level_user

    ));
    }

    //--------------------------------------------------------
    public function actionPilihKegiatan() {

        $tahun_anggaran   =$_POST['tahun'];
        $id_unitkerja     =$_POST['idunitkerja'];

        $myquery="SELECT * FROM keuangan.fndaftar_kegiatan()";
        $dataProvider=Yii::app()->db->createCommand("$myquery;")->queryAll();


        $this->renderPartial('pilih_kegiatan',
            array( 'dataProvider'  =>$dataProvider
        ,'tahun'            => $tahun_anggaran
        ,'idunitkerja'       => $id_unitkerja

        ));
    }

    //--------------------------------------------------------
    public function actionInsertUser() {

        $statussimpan      ='';

        if(isset($_POST['statussimpan'])) {

             $username         = $_POST['txtusername'];
             $password         = $_POST['txtpassword'];
             $nama_lengkap     = $_POST['txtnama'];
             $nip              = $_POST['txtnip'];
             $jabatan          = $_POST['txtjabatan'];
            $id_unitkerja      = $_POST['ddlunitkerja'];
            $id_level_user     = $_POST['ddllevel'];
            $id_beban_anggaran = $_POST['ddlbebananggaran'];

            Yii::app()->db->createCommand("SELECT * FROM keuangan.fninsert_user
                  (
                      '$username',
                      '$password',
                      '$nama_lengkap',
                      '$nip',
                      '$jabatan',
                      $id_unitkerja,
                      '$id_level_user',
                      '$id_beban_anggaran'
                  ) ")->execute();

            $statussimpan="Data Telah Tersimpan" ;

        }

        $this->render('insert_user',array('labeljudul'=>'INSERT USER '
        ,'statussimpan'     => $statussimpan
        ,'username'         => $username
        ,'password'         => $password
        ,'nama_lengkap'     => $nama_lengkap
        ,'nip'              => $nip
        ,'jabatan'          => $jabatan
        ,'id_unitkerja'     => $id_unitkerja
        ,'id_level_user'    => $id_level_user

        ));
    }


    //--------------------------------------------------------
    public function actionEditUser() {

        $statussimpan      ='';
        $id_user           = $_POST['id_user'];
        $RecordData=Yii::app()->db->createCommand("select * from keuangan.fndata_user('$id_user');")->queryRow();
        $id_user              =$RecordData['id_user'];
        $id_level_user        =$RecordData['id_level_user'];
        $id_unitkerja         =$RecordData['id_unitkerja'];
        $id_beban_anggaran    =$RecordData['id_beban_anggaran'];
        $username             =$RecordData['username'];
        $nama_lengkap         =$RecordData['nama_lengkap'];
        $password             =$RecordData['password'];
        $nip                  =$RecordData['nip'];
        $jabatan              =$RecordData['jabatan'];

        if(isset($_POST['statussimpan'])) {

	    $id_user              = $_POST['id_user'];
        $username             = $_POST['txtusername'];
        $nama_lengkap         = $_POST['txtnama'];
        $password             = $_POST['txtpassword'];
        $nip                  = $_POST['txtnip'];
        $jabatan              = $_POST['txtjabatan'];
		$id_unitkerja         = $_POST['ddlunitkerja'];
        $id_level_user        = $_POST['ddllevel'];
        $id_beban_anggaran    = $_POST['ddlbebananggaran'];

            Yii::app()->db->createCommand("SELECT * FROM keuangan.fnedit_user
                  (
                     $id_user,
					 '$username',
					 '$password',
					 '$nama_lengkap',
					 '$nip',
					 '$jabatan',
                     '$id_level_user',
                     '$id_beban_anggaran',
					  $id_unitkerja
                  ) ")->execute();

            $statussimpan="Data Telah Tersimpan" ;

        }

        $this->render('insert_user',array('labeljudul'=>'EDIT USER '
        ,'statussimpan'     => $statussimpan
        ,'username'         => $username
        ,'password'         => $password
        ,'nama_lengkap'     => $nama_lengkap
        ,'nip'              => $nip
        ,'jabatan'          => $jabatan
        ,id_unitkerja       => $id_unitkerja
        ,'id_beban_anggaran'=> $id_beban_anggaran
        ,'id_level_user'    => $id_level_user
        ,id_user            => $id_user

        ));
    }

       
}




