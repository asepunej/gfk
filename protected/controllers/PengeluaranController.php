<?php

class PengeluaranController extends Controller
{
	public $layout='//layouts/column2';
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('DaftarPembukuan'),
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
    public function actionDaftarPengeluaran() {
        if(isset($_POST['ddltahun'])) {
            $tahun   =$_POST['ddltahun'];
        }else  $tahun  =Yii::app()->session['tahun_anggaran'];;

        if(isset($_POST['ddlskpd'])) {
            $id_skpd     =$_POST['ddlskpd'];
        }else
            $id_skpd     =Yii::app()->session['id_skpd'];

        if(isset($_POST['ddlbulan'])) {
            $kdbulan   =$_POST['ddlbulan'];
        }else  $kdbulan   =(int)(date('m'));


        if($_POST['action']=='statusdelete') {
            $id_pengeluaran     =$_POST['id_pengeluaran'];
            Yii::app()->db->createCommand("SELECT * FROM master.fndelete_pengeluaran('$id_pengeluaran')")->execute();
       }

        $myquery="SELECT * FROM master.fndaftar_pengeluaran($tahun,$id_skpd)";
        $dataProvider=Yii::app()->db->createCommand("$myquery;")->queryAll();
        $this->render('daftar_pengeluaran',
            array( 'dataProvider'  =>$dataProvider
            ,'tahun'     => $tahun
            ,'id_skpd'   => $id_skpd
            ,'kdbulan'   => $kdbulan
    ));
    }
//--------------------------------------------------------

    public function actionInsertPengeluaran() {
        $statussimpan   ='';
        $tahun   = $_POST['ddltahun'];
        $id_skpd   = $_POST['ddlskpd'];
        $id_bidang   = $_POST['ddlbidang'];
        $kdbulan   = $_POST['ddlbulan'];

        if(isset($_POST['statussimpan'])) {

            $tgl_pengeluaran     = $_POST['txttgl_pengeluaran'];
            $no_permintaan          = $_POST['txtno_permintaan'];
            $tgl_permintaan         = $_POST['txttgl_permintaan'];
            $diserahkan         =$_POST['txtdiserahkan'];
            $diterima           = $_POST['txtditerima'];
            $id_skpd   = $_POST['ddlskpd'];
            $id_bidang   = $_POST['ddlbidang'];
            if ($id_bidang=='') {
                $id_bidang=1000;
            }
            $id_sumber_dana   = $_POST['ddlsumberdana'];

            Yii::app()->db->createCommand("SELECT * FROM master.fninsert_pengeluaran
                  ( '$tgl_pengeluaran',
                    '$no_permintaan',
                    '$tgl_permintaan',
                    '$diserahkan',
                    '$diterima',
                    $id_bidang,
                    $id_skpd,
                    $id_sumber_dana
                  ) ")->execute();
            $statussimpan="Data Telah Tersimpan " ;
        }

        $this->render('insert_pengeluaran',array('labeljudul'=>' '
        ,'statussimpan'     => $statussimpan
        ,'tahun'     => $tahun
        ,'id_skpd'   => $id_skpd
        ,'id_bidang'   => $id_bidang
        ,'id_sumber_dana'   => $id_sumber_dana

        ,'tgl_pengeluaran' => $tgl_pengeluaran
        ,'no_permintaan'     => $no_permintaan
        ,'tgl_permintaan'     => $tgl_permintaan
        ,'diserahkan'     => $diserahkan
        ,'diterima'     => $diterima
        ,'kdbulan'   => $kdbulan

        ));
    }


//--------------------------------------------------------

    public function actionEditPengeluaran() {
        $statussimpan   ='';

        $id_pengeluaran      = $_POST['id_pengeluaran'];
        $RecordData=Yii::app()->db->createCommand("select * from master.fndata_pengeluaran('$id_pengeluaran');")->queryRow();
        $tgl_pengeluaran     = $RecordData['tgl_pengeluaran'];
        $no_permintaan          = $RecordData['no_permintaan'];
        $tgl_permintaan = $RecordData['tgl_permintaan'];
        $diserahkan = $RecordData['diserahkan'];
        $diterima     = $RecordData['diterima'];
        $tahun   = date('Y', strtotime($RecordData["tgl_pengeluaran"]));
        $id_skpd   =$RecordData['id_skpd'];;
        $id_bidang   = $RecordData['id_bidang_penerima'];
        $id_sumber_dana   = $RecordData['id_sumber_dana'];

        if(isset($_POST['statussimpan'])) {

            $tgl_pengeluaran     = $_POST['txttgl_pengeluaran'];
            $no_permintaan       = $_POST['txtno_permintaan'];
            $tgl_permintaan       = $_POST['txttgl_permintaan'];
            $diserahkan         =$_POST['txtdiserahkan'];
            $diterima           = $_POST['txtditerima'];
            $id_bidang        = $_POST['ddlbidang'];

            Yii::app()->db->createCommand("SELECT * FROM master.fnedit_pengeluaran
                  ( $id_pengeluaran,
                    '$tgl_pengeluaran',
                    '$no_permintaan',
                    '$tgl_permintaan',
                    '$diserahkan',
                    '$diterima',
                    $id_bidang,
                    $id_sumber_dana
                  ) ")->execute();
            $statussimpan="Data Telah Tersimpan " ;
        }

        $this->render('insert_pengeluaran',array('labeljudul'=>' '
        ,'statussimpan'     => $statussimpan
        ,'tahun'     => $tahun
        ,'id_skpd'   => $id_skpd
        ,'id_bidang'   => $id_bidang

        ,'tgl_pengeluaran' => $tgl_pengeluaran
        ,'no_permintaan'     => $no_permintaan
        ,'tgl_permintaan'     => $tgl_permintaan
        ,'diserahkan'     => $diserahkan
        ,'diterima'     => $diterima
        ,'id_pengeluaran'     => $id_pengeluaran
        ,'id_sumber_dana'     => $id_sumber_dana



        ));
    }

//--------------------------------------------------------
    public function actionPilihBarang() {

        $tahun   =$_POST['ddltahun'];
        $id_skpd     =$_POST['ddlskpd'];
        $id_bidang     =$_POST['ddlbidang'];

        $myquery="SELECT * FROM master.fndaftar_barang(1)";
        $dataProvider=Yii::app()->db->createCommand("$myquery;")->queryAll();

        $this->renderPartial('pilih_barang',
            array( 'dataProvider'  =>$dataProvider
            ,'tahun'            => $tahun
            ,'id_bidang'       => $id_bidang
            ,'id_skpd'       => $id_skpd

            ));
    }
    //--------------------------------------------------------

    public function actionAutocomplete()
    {
        $res =array();
        $term = $_GET['term'];
        $qtxt ="SELECT nama_barang from  master.fnautocomplete_barang()";
        $command =Yii::app()->db->createCommand($qtxt);
        $res =$command->queryColumn();

        $return = array_values(array_filter($res, function($element) use ($term) {
            return (stripos($element, $term) !== false);
        }));
//cetak dalam format json
        echo CJSON::encode($return);
    }

    //--------------------------------------------------------
    public function actionRekapPengeluaran() {
        if(isset($_POST['ddltahun'])) {
            $tahun   =$_POST['ddltahun'];
        }else
            $tahun  =Yii::app()->session['tahun_anggaran'];;

        if(isset($_POST['ddlskpd'])) {
            $id_skpd     =$_POST['ddlskpd'];
        }else
            $id_skpd     =Yii::app()->session['id_skpd'];

        if(isset($_POST['ddlskpdpenerima'])) {
            $id_skpd_penerima   =$_POST['ddlskpdpenerima'];
        }else  $id_skpd_penerima   =0;

        if(isset($_POST['ddlstatus'])) {
            $id_status   =$_POST['ddlstatus'];
        }else  $id_status   =2;

        if(isset($_POST['txttgl_mulai'])) {
            $tgl_mulai     =$_POST['txttgl_mulai'];
        }else
            $tgl_mulai     ='01/01/'.$tahun;

        if(isset($_POST['txttgl_akhir'])) {
            $tgl_akhir     =$_POST['txttgl_akhir'];
        }else
            $tgl_akhir     ='12/31/'.$tahun;


        if($id_status==1) {
            $myquery="SELECT * FROM master.fnrekap_pengeluaran_keunit_pertanggal($id_skpd,$id_skpd_penerima,$tahun,'$tgl_mulai','$tgl_akhir') WHERE volume>0 ";
        }else $myquery="SELECT * FROM master.fnrekap_pengeluaran_keunit_pertanggal($id_skpd,$id_skpd_penerima,$tahun,'$tgl_mulai','$tgl_akhir') WHERE volume>0 ";

        $dataProvider=Yii::app()->db->createCommand("$myquery;")->queryAll();


        if($_POST['action']=='excel') {
            $this->renderPartial('rekap_pengeluaran',
                array( 'dataProvider'  =>$dataProvider
                ,'tahun'     => $tahun
                ,'id_skpd'   => $id_skpd
                ,'id_skpd_penerima'   => $id_skpd_penerima
                ,'id_status'   => $id_status
                ,'action'   => 'excel'
                ));
        }else{
            $this->render('rekap_pengeluaran',
                array( 'dataProvider'  =>$dataProvider
                ,'tahun'     => $tahun
                ,'id_skpd'   => $id_skpd
                ,'id_skpd_penerima'   => $id_skpd_penerima
                ,'id_status'   => $id_status
                ,'tgl_mulai'   => $tgl_mulai
                ,'tgl_akhir'   => $tgl_akhir
                ));
        }
    }

    //--------------------------------------------------------
    public function actionRekapPengeluaranDetail() {
        if(isset($_POST['ddltahun'])) {
            $tahun   =$_POST['ddltahun'];
        }else
            $tahun  =Yii::app()->session['tahun_anggaran'];;

        if(isset($_POST['ddlskpd'])) {
            $id_skpd     =$_POST['ddlskpd'];
        }else
            $id_skpd     =Yii::app()->session['id_skpd'];

        if(isset($_POST['ddlskpdpenerima'])) {
            $id_skpd_penerima   =$_POST['ddlskpdpenerima'];
        }else  $id_skpd_penerima   =0;

        $id_barang   =$_POST['id_barang'];

        $RecordData=Yii::app()->db->createCommand("select * from master.fndata_barang('$id_barang');")->queryRow();
        $nama_barang     = $RecordData['nama_barang'];
        $satuan          = $RecordData['satuan'];

        $RecordData=Yii::app()->db->createCommand("select * from referensi.fndata_skpd('$id_skpd');")->queryRow();
        $nama_skpd     = $RecordData['nama_skpd'];

        $RecordData=Yii::app()->db->createCommand("select * from referensi.fndata_skpd('$id_skpd_penerima');")->queryRow();
        $nama_skpd_penerima     = $RecordData['nama_skpd'];


        $myquery="SELECT * FROM master.fnrekap_pengeluaran_keunit_detail($id_barang,$id_skpd,$id_skpd_penerima,$tahun)";
        $dataProvider=Yii::app()->db->createCommand("$myquery;")->queryAll();
        $this->render('rekap_pengeluaran_detail',
            array( 'dataProvider'  =>$dataProvider
            ,'tahun'  =>$tahun
            ,'id_skpd'  =>$id_skpd
            ,'nama_skpd'  =>$nama_skpd
            ,'nama_skpd_penerima'  =>$nama_skpd_penerima
            ,'id_barang'  =>$id_barang
            ,'nama_barang'  =>$nama_barang
            ,'satuan'  =>$satuan
            ));
    }
}




