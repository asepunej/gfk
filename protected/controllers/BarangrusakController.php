<?php

class BarangrusakController extends Controller
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
    public function actionDaftarBarangRusak() {

        $id_barang      = $_POST['id_barang'];
        $RecordData=Yii::app()->db->createCommand("select * from master.fndata_barang('$id_barang');")->queryRow();
        $nama_barang     = $RecordData['nama_barang'];
        $satuan          = $RecordData['satuan'];


      if($_POST['action']=='statusdelete') {
          $id_status_barang     =$_POST['id_status_barang'];
            Yii::app()->db->createCommand("SELECT * FROM master.fndelete_barang_rusakxfdfd($id_status_barang)")->execute();
       }

        $id_skpd= Yii::app()->session['id_skpd'];
        $myquery="SELECT * FROM master.fndaftar_barang_rusak01($id_barang,$id_skpd)";
        $dataProvider=Yii::app()->db->createCommand("$myquery;")->queryAll();
        $this->render('daftar_barang_rusak',
            array( 'dataProvider'  =>$dataProvider
                ,'id_barang'  =>$id_barang
            ,'nama_barang'  =>$nama_barang
            ,'satuan'  =>$satuan
            ,'id_status_barang'  =>$id_status_barang

    ));
    }

    //--------------------------------------------------------
    public function actionInsertBarangRusak() {
        $statussimpan   ='';
        $id_barang      = $_POST['id_barang'];
        $RecordData=Yii::app()->db->createCommand("select * from master.fndata_barang('$id_barang');")->queryRow();
        $nama_barang     = $RecordData['nama_barang'];
        $satuan          = $RecordData['satuan'];

      if(isset($_POST['statussimpan'])) {
          $id_penerimaan_detail     = $_POST['ddlpenerimaan'];
          $jumlah          = $_POST['txtjumlah'];
          $kd_status_barang = $_POST['ddlstatus'];

            Yii::app()->db->createCommand("SELECT * FROM master.fninsert_barang_rusak
                  ($id_penerimaan_detail,
                  $jumlah,
                   $kd_status_barang
                  ) ")->execute();
            $statussimpan="Data Telah Tersimpan" ;
        }

        $this->render('insert_barang_rusak',array(''
        ,'statussimpan'     => $statussimpan
        ,'id_barang'  =>$id_barang
        ,'nama_barang'  =>$nama_barang
        ,'satuan'  =>$satuan
        ,'id_penerimaan_detail'  =>$id_penerimaan_detail
        ,'jumlah'  =>$jumlah
        ,'kd_status_barang'  =>$kd_status_barang


        ));
    }


    //--------------------------------------------------------
    public function actionEditBarang() {

        $statussimpan   ='';
        $id_barang      = $_POST['id_barang'];
        $RecordData=Yii::app()->db->createCommand("select * from master.fndata_barang('$id_barang');")->queryRow();
         $nama_barang     = $RecordData['nama_barang'];
        $satuan          = $RecordData['satuan'];
        $id_jenis_barang = $RecordData['id_jenis_barang'];
        $id_jenis_persediaan = $RecordData['id_jenis_persediaan'];


        if(isset($_POST['statussimpan'])) {
            $nama_barang     = $_POST['txtnama_barang'];
            $satuan          = $_POST['txtsatuan'];
            $id_jenis_barang = $_POST['ddljenisbarang'];

            Yii::app()->db->createCommand("SELECT * FROM master.fnedit_barang
                  ($id_barang,
                   '$nama_barang',
                  '$id_jenis_barang',
                   '$satuan'
                  ) ")->execute();
            $statussimpan="Data Telah Tersimpan" ;
        }

        $this->render('insert_barang',array(''
        ,'statussimpan'     => $statussimpan
        ,'nama_barang'  =>$nama_barang
        ,'satuan'  =>$satuan
        ,'id_jenis_barang'  =>$id_jenis_barang
        ,'id_barang'  =>$id_barang
        ,'id_jenis_persediaan'  =>$id_jenis_persediaan


        ));
    }

    public function actionAutocomplete()
    {
        $res =array();
        $term = $_GET['term'];
        $qtxt ="SELECT satuan from  master.barang group by satuan";
        $command =Yii::app()->db->createCommand($qtxt);
        $res =$command->queryColumn();

        $return = array_values(array_filter($res, function($element) use ($term) {
            return (stripos($element, $term) !== false);
        }));
//cetak dalam format json
        echo CJSON::encode($return);
    }

}




