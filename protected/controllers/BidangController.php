<?php

class BidangController extends Controller
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
    public function actionDaftarBidang() {

        if(isset($_POST['ddlskpd'])) {
            $id_skpd     =$_POST['ddlskpd'];
        }else
            $id_skpd     =Yii::app()->session['id_skpd'];

      if($_POST['action']=='statusdelete') {
          $id_bidang     =$_POST['id_bidang'];
            Yii::app()->db->createCommand("SELECT * FROM referensi.fndelete_skpd($id_bidang)")->execute();
       }

        $myquery="SELECT * FROM referensi.fndaftar_bidang($id_skpd)";
        $dataProvider=Yii::app()->db->createCommand("$myquery;")->queryAll();
        $this->render('daftar_bidang',
            array( 'dataProvider'  =>$dataProvider,
                'id_skpd'  =>$id_skpd

    ));
    }

    //--------------------------------------------------------
    public function actionInsertBidang() {
        $id_skpd     =$_POST['id_skpd'];
        $statussimpan   ='';
        if(isset($_POST['statussimpan'])) {
             $id_skpd        = $_POST['ddlskpd'];
             $bidang           = $_POST['txtbidang'];

            Yii::app()->db->createCommand("SELECT * FROM referensi.fninsert_skpd
                  (
                      '$bidang',
                      '$id_skpd'
                  ) ")->execute();
            $statussimpan="Data Telah Tersimpan" ;

        }

        $this->render('insert_bidang',array(''
        ,'statussimpan'     => $statussimpan
        ,'id_skpd'            => $id_skpd
        ,'bidang'       => $bidang

        ));
    }


    //--------------------------------------------------------
    public function actionEditBidang() {

        $statussimpan   ='';
        $id_bidang      = $_POST['id_bidang'];
        $RecordData=Yii::app()->db->createCommand("select * from referensi.fndata_skpd('$id_bidang');")->queryRow();
        $nama_skpd     =$RecordData['nama_skpd'];
        $id_skpd       =$RecordData['id_skpd_induk'];

        if(isset($_POST['statussimpan'])) {
            $id_skpd        = $_POST['ddlskpd'];
            $nama_skpd           = $_POST['txtbidang'];
            Yii::app()->db->createCommand("SELECT * FROM referensi.fnedit_skpd                  (
                      $id_bidang,
                      '$nama_skpd'

                  ) ")->execute();

            $statussimpan="Data Telah Tersimpan" ;

        }

        $this->render('insert_bidang',array(''
        ,'statussimpan'     => $statussimpan
        ,'id_skpd'            => $id_skpd
        ,'id_bidang'            => $id_bidang
        ,'bidang'       => $nama_skpd
        ));
    }

    //--------------------------------------------------------
//$no_spby        =$RecordData['no_spby'];
//$tgl_spby       =$RecordData['tgl_spby'];
//$kepada         =$RecordData['kepada'];
//$uraian         =$RecordData['uraian'];
//$no_kwitansi    =$RecordData['no_kwitansi'];
//$no_nota        =$RecordData['no_nota'];
//$tahun_anggaran =$RecordData['tahun_anggaran'];
//$id_unitkerja   =$RecordData['id_unitkerja'];
//$id_kegiatan    =$RecordData['id_kegiatan'];

    //--------------------------------------------------------
    public function actionEditBarang() {

        $statussimpan   ='';
        $idbarang    = $_POST['idbarang'];

        $RecordData=Yii::app()->db->createCommand("select * from pasar.fndata_barang('$idbarang');")->queryRow();
        $barang      =$RecordData['barang'];

        if(isset($_POST['statussimpan'])) {
            $barang = $_POST['txtbarang'];
            Yii::app()->db->createCommand("SELECT * FROM pasar.fnedit_barang
                  ( '$idbarang',
                    '$barang'
                  ) ")->execute();
            $statussimpan="Data Telah Tersimpan" ;
            $this->redirect(array("Barang/DaftarBarang"));
        }

        $this->renderPartial('insert_barang',array('labeljudul'=>'EDIT BARANG '
        ,'statussimpan'     => $statussimpan
        ,'idbarang'          => $idbarang
        ,'barang'            => $barang

        ));
    }

}




