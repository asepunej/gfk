<?php

class DistributorController extends Controller
{
	public $layout='//layouts/column2';
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('DaftarDipa'),
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
    public function actionDaftarDistributor() {

      if($_POST['action']=='statusdelete') {
          $id_distributor     =$_POST['id_distributor'];
            Yii::app()->db->createCommand("SELECT * FROM referensi.fndelete_distributor($id_distributor)")->execute();
       }

        $myquery="SELECT * FROM referensi.fndaftar_distributor()";
        $dataProvider=Yii::app()->db->createCommand("$myquery;")->queryAll();
        $this->render('daftar_distributor',
            array( 'dataProvider'  =>$dataProvider
    ));
    }

    //--------------------------------------------------------
    public function actionInsertDistributor() {

        $statussimpan   ='';

      if(isset($_POST['statussimpan'])) {
            $distributor     = $_POST['txtdistributor'];
            $perusahaan     = $_POST['txtperusahaan'];
            $alamat     = $_POST['txtalamat'];
            $notelp     = $_POST['txtnotelp'];

            Yii::app()->db->createCommand("SELECT * FROM referensi.fninsert_distributor
                  ('$distributor'
                    ,'$perusahaan'
                    ,'$alamat'
                    ,'$notelp'
                  ) ")->execute();
            $statussimpan="Data Telah Tersimpan" ;
        }

        $this->render('insert_distributor',array(''
        ,'statussimpan'     => $statussimpan
        , 'distributor'  =>$distributor
        , 'perusahaan'  =>$perusahaan
        , 'alamat'  =>$alamat
        , 'notelp'  =>$notelp

        ));
    }


    //--------------------------------------------------------
    public function actionEditDistributor() {

        $statussimpan   ='';
        $id_distributor     = $_POST['id_distributor'];
        $RecordData=Yii::app()->db->createCommand("select * from referensi.fndata_distributor($id_distributor);")->queryRow();
        $distributor     =$RecordData['distributor'];
        $perusahaan     =$RecordData['perusahaan'];
        $alamat     = $RecordData['alamat'];
        $notelp     = $RecordData['notelp'];

        if(isset($_POST['statussimpan'])) {
            $distributor     = $_POST['txtdistributor'];
            $perusahaan     = $_POST['txtperusahaan'];
            $alamat     = $_POST['txtalamat'];
            $notelp     = $_POST['txtnotelp'];

            Yii::app()->db->createCommand("SELECT * FROM referensi.fnedit_distributor
                  ($id_distributor
                    ,'$distributor'
                    ,'$perusahaan'
                    ,'$alamat'
                    ,'$notelp'
                  ) ")->execute();
            $statussimpan="Data Telah Tersimpan" ;
        }

        $this->render('insert_distributor',array(''
        ,'statussimpan'     => $statussimpan
        , 'distributor'  =>$distributor
        , 'perusahaan'  =>$perusahaan
        , 'alamat'  =>$alamat
        , 'notelp'  =>$notelp
        , 'id_distributor'  =>$id_distributor

        ));
    }


}




