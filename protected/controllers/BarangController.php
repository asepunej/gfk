<?php

class BarangController extends Controller
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
    public function actionDaftarBarang() {

        if(isset($_POST['ddljenispersediaan'])and  ($_POST['ddljenispersediaan']!='')) {
            $id_jenis_persediaan   =$_POST['ddljenispersediaan'];
        }else  $id_jenis_persediaan  =1;

        if(isset($_POST['ddljenisbarang']) and  ($_POST['ddljenisbarang']!='')) {
            $id_jenis_barang     =$_POST['ddljenisbarang'];
        }else
            $id_jenis_barang     =99999;


      if($_POST['action']=='statusdelete') {
          $id_barang     =$_POST['id_barang'];
            Yii::app()->db->createCommand("SELECT * FROM master.fndelete_barang($id_barang)")->execute();
       }

        $myquery="SELECT * FROM master.fndaftar_barang01($id_jenis_barang)";
        $dataProvider=Yii::app()->db->createCommand("$myquery;")->queryAll();
        $this->render('daftar_barang',
            array( 'dataProvider'  =>$dataProvider
                ,'id_jenis_persediaan'  =>$id_jenis_persediaan
            ,'id_jenis_barang'  =>$id_jenis_barang

    ));
    }

    //--------------------------------------------------------
    public function actionInsertBarang() {
        $statussimpan   ='';
        $id_jenis_persediaan        = $_POST['ddljenispersediaan'];
        $id_jenis_barang        = $_POST['ddljenisbarang'];

      if(isset($_POST['statussimpan'])) {
            $nama_barang     = $_POST['txtnama_barang'];
            $satuan          = $_POST['txtsatuan'];
            $id_jenis_barang = $_POST['ddljenisbarang'];
            $kd_barang           = $_POST['txtkd_barang'];

            Yii::app()->db->createCommand("SELECT * FROM master.fninsert_barang
                  ('$nama_barang',
                  '$id_jenis_barang',
                   '$satuan',
                   '$kd_barang'
                  ) ")->execute();
            $statussimpan="Data Telah Tersimpan" ;
        }

        $this->render('insert_barang',array(''
        ,'statussimpan'     => $statussimpan
        ,'nama_barang'  =>$nama_barang
        ,'satuan'  =>$satuan
        ,'id_jenis_barang'  =>$id_jenis_barang
        ,'id_jenis_persediaan'  =>$id_jenis_persediaan
        ,'kd_barang'  =>$kd_barang
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
        $kd_barang= $RecordData['kd_barang'];

        if(isset($_POST['statussimpan'])) {
            $nama_barang     = $_POST['txtnama_barang'];
            $satuan          = $_POST['txtsatuan'];
            $id_jenis_barang = $_POST['ddljenisbarang'];
            $kd_barang           = $_POST['txtkd_barang'];

            Yii::app()->db->createCommand("SELECT * FROM master.fnedit_barang
                  ($id_barang,
                   '$nama_barang',
                  '$id_jenis_barang',
                   '$satuan',
                   '$kd_barang'
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
        ,'kd_barang'  =>$kd_barang

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




