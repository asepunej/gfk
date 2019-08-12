<?php

class SkpdController extends Controller
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
    public function actionDaftarSKPD() {


        if($_POST['action']=='statusdelete') {
            $id_skpd     =$_POST['id_skpd'];
            Yii::app()->db->createCommand("SELECT * FROM referensi.fndelete_skpd($id_skpd)")->execute();
        }

        $myquery="SELECT * FROM referensi.fndaftar_skpd()";
        $dataProvider=Yii::app()->db->createCommand("$myquery;")->queryAll();
        $this->render('daftar_skpd',
            array( 'dataProvider'  =>$dataProvider

            ));
    }

    //--------------------------------------------------------
    public function actionInsertSKPD() {

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

        $this->render('insert_skpd',array(''
        ,'statussimpan'     => $statussimpan
        ,'id_skpd'            => $id_skpd
        ,'bidang'       => $bidang

        ));
    }


    //--------------------------------------------------------
    public function actionEditBidang() {

        $statussimpan   ='';
        $id_bidang      = $_POST['id_bidang'];
        $RecordData=Yii::app()->db->createCommand("select * from referensi.fndata_bidang('$id_bidang');")->queryRow();
        $bidang        =$RecordData['bidang'];
        $id_skpd       =$RecordData['id_skpd'];

        if(isset($_POST['statussimpan'])) {
            $id_skpd        = $_POST['ddlskpd'];
            $bidang           = $_POST['txtbidang'];
            Yii::app()->db->createCommand("SELECT * FROM referensi.fnedit_bidang                  (
                      $id_bidang,
                     '$bidang',
                      $id_skpd
                  ) ")->execute();

            $statussimpan="Data Telah Tersimpan" ;

        }

        $this->render('insert_bidang',array(''
        ,'statussimpan'     => $statussimpan
        ,'id_bidang'            => $id_bidang
        ,'id_skpd'            => $id_skpd
        ,'bidang'       => $bidang
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




