<?php

class JenisbarangController extends Controller
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
    public function actionDaftarJenisBarang() {

        if(isset($_POST['ddljenispersediaan'])) {
            $id_jenis_persediaan     =$_POST['ddljenispersediaan'];
        }else
            $id_jenis_persediaan     =1;

      if($_POST['action']=='statusdelete') {
          $id_jenis_barang     =$_POST['id_jenis_barang'];
            Yii::app()->db->createCommand("SELECT * FROM referensi.fndelete_jenis_barang($id_jenis_barang)")->execute();
       }

        $myquery="SELECT * FROM referensi.fndaftar_jenis_barang('$id_jenis_persediaan')";
        $dataProvider=Yii::app()->db->createCommand("$myquery;")->queryAll();
        $this->render('daftar_jenis_barang',
            array( 'dataProvider'  =>$dataProvider
            ,'id_jenis_persediaan'            => $id_jenis_persediaan

    ));
    }

    //--------------------------------------------------------
    public function actionInsertJenisBarang() {
        $id_jenis_persediaan       = $_POST['ddljenispersediaan'];
        $statussimpan   ='';
        if(isset($_POST['statussimpan'])) {
             $id_jenis_persediaan      = $_POST['ddljenispersediaan'];
             $jenis_barang           = $_POST['txtjenisbarang'];
            $kd_jenis_barang           = $_POST['txtkdjenisbarang'];

            Yii::app()->db->createCommand("SELECT * FROM referensi.fninsert_jenis_barang
                  (  '$jenis_barang',
                      $id_jenis_persediaan,
                      '$kd_jenis_barang'
                  ) ")->execute();
            $statussimpan="Data Telah Tersimpan" ;

        }

        $this->render('insert_jenis_barang',array(''
        ,'statussimpan'     => $statussimpan
        ,'id_jenis_persediaan'            => $id_jenis_persediaan
        ,'jenis_barang'       => $jenis_barang
        ,'kd_jenis_barang'       => $kd_jenis_barang


        ));
    }


    //--------------------------------------------------------
    public function actionEditJenisBarang() {

        $statussimpan   ='';
        $id_jenis_barang      = $_POST['id_jenis_barang'];
        $RecordData=Yii::app()->db->createCommand("select * from referensi.fndata_jenis_barang('$id_jenis_barang');")->queryRow();
        $id_jenis_persediaan    =$RecordData['id_jenis_persediaan'];
        $jenis_barang           = $RecordData['jenis_barang'];
        $kd_jenis_barang           = $RecordData['kd_jenis_barang'];

        if(isset($_POST['statussimpan'])) {
            $id_jenis_persediaan    = $_POST['ddljenispersediaan'];
            $jenis_barang           = $_POST['txtjenisbarang'];
            $kd_jenis_barang           = $_POST['txtkdjenisbarang'];
            Yii::app()->db->createCommand("SELECT * FROM referensi.fnedit_jenis_barang
                  (  $id_jenis_barang,
                     '$jenis_barang',
                      $id_jenis_persediaan,
                      '$kd_jenis_barang'
                  ) ")->execute();
            $statussimpan="Data Telah Tersimpan" ;

        }

        $this->render('insert_jenis_barang',array(''
        ,'statussimpan'     => $statussimpan
        ,'id_jenis_barang'            => $id_jenis_barang
        ,'id_jenis_persediaan'            => $id_jenis_persediaan
        ,'jenis_barang'       => $jenis_barang
        ,'kd_jenis_barang'       => $kd_jenis_barang


        ));
    }


}




