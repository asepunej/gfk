<?php

class PenerimaandetailController extends Controller
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
    public function actionDaftarPenerimaanDetail() {

        $id_penerimaan      = $_POST['id_penerimaan'];
        $RecordData=Yii::app()->db->createCommand("select * from master.fndata_penerimaan('$id_penerimaan');")->queryRow();
        $tgl_penerimaan     = $RecordData['tgl_penerimaan'];
        $no_faktur          = $RecordData['no_faktur'];
        $tgl_faktur = $RecordData['tgl_faktur'];
        $diserahkan = $RecordData['diserahkan'];
        $diterima     = $RecordData['diterima'];
        $id_distributor     = $RecordData['id_distributor'];
        $id_kegiatan     = $RecordData['id_kegiatan'];
        $id_jenis_transaksi     = $RecordData['id_jenis_transaksi'];
        $distributor     = $RecordData['distributor'];

        $tahun   = date('Y', strtotime($RecordData["tgl_penerimaan"]));
        $bulan   = date('m', strtotime($RecordData["tgl_penerimaan"]));
        $tanggal   = date('d', strtotime($RecordData["tgl_penerimaan"]));
        $id_skpd   =$RecordData['id_skpd'];
        $nama_skpd   =$RecordData['nama_skpd'];
        $nm_sumber_dana   =$RecordData['nm_sumber_dana'];
        $id_m_sumber_dana   =$RecordData['id_m_sumber_dana'];

        if($_POST['action']=='statusdelete') {
            $id_penerimaan_detail     =$_POST['id_penerimaan_detail'];
            Yii::app()->db->createCommand("SELECT * FROM master.fndelete_penerimaan_detail('$id_penerimaan_detail')")->execute();}

        else if($_POST['action']=='deletedatasemua') {
              Yii::app()->db->createCommand("SELECT * FROM master.fndelete_penerimaan_detail_all('$id_penerimaan')")->execute(); }

        else if($_POST['action']=='upload') {
            spl_autoload_unregister(array('YiiBase','autoload'));
            Yii::import('ext.PHPExcel.Classes.PHPExcel', true);
            spl_autoload_register(array('YiiBase','autoload'));

            if (isset($_POST['submit'])) {
                $id_penerimaan    =$_POST['id_penerimaan'];

                if ($_FILES["file"]["error"] > 0)   {
                    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
                }
                else  {
                    ini_set('memory_limit', '-1');
                    $ext1=explode(".", $_FILES["file"]["name"]);
                    $extension = strtolower($ext1[1]);
                    $thefile=$_FILES["file"]["name"];
                    move_uploaded_file($_FILES["file"]["tmp_name"],"images/".$_FILES["file"]["name"]);

                    if ($extension=='xls') $xls='Excel5';
                    if ($extension=='xlsx') $xls='Excel2007';
                    $objReader = PHPExcel_IOFactory::createReader($xls);
                    $objPHPExcel = $objReader->load('images/'.$thefile);
                    $objWorksheet = $objPHPExcel->getActiveSheet();
                    $highestRow = $objWorksheet->getHighestRow()+1;
                    date_default_timezone_set("Asia/Jakarta");
                    for ($rowke=3; $rowke<$highestRow; ++$rowke) {
                        $id_barang=$objWorksheet->getCellByColumnAndRow(0, $rowke)->getCalculatedValue();
                        $volume=$objWorksheet->getCellByColumnAndRow(2, $rowke)->getCalculatedValue();
                        $harga_satuan=$objWorksheet->getCellByColumnAndRow(4, $rowke)->getCalculatedValue();
                        $no_batch=$objWorksheet->getCellByColumnAndRow(3, $rowke)->getCalculatedValue();
                        $tgl_expired=$objWorksheet->getCellByColumnAndRow(5, $rowke)->getCalculatedValue();

                        if ($tgl_expired==''){$tgl_expired='01/01/1976';}
                        if ($volume>0){
                            Yii::app()->db->createCommand("SELECT * FROM master.fninsert_penerimaan_detail
                                                      ( $id_penerimaan,
                                                        $id_barang,
                                                        $volume,
                                                        $harga_satuan,
                                                        '$no_batch',
                                                       '$tgl_expired'
                                                      ) ")->execute();
                        }
                      }

                        $statussimpan="Data Telah Tersimpan " ;
                        unlink("images/".$_FILES["file"]["name"]);

                    }

                }
            }



        else if($_POST['action']=='upload_all') {


            spl_autoload_unregister(array('YiiBase','autoload'));
            Yii::import('ext.PHPExcel.Classes.PHPExcel', true);
            spl_autoload_register(array('YiiBase','autoload'));

            if (isset($_POST['submit'])) {
                $id_penerimaan    =$_POST['id_penerimaan'];

                if ($_FILES["file"]["error"] > 0)   {
                    echo "Return Code: " . $_FILES["file"]["error"] ."coba" ."<br />";
                }
                else  {
                    ini_set('memory_limit', '-1');
                    $ext1=explode(".", $_FILES["file"]["name"]);
                    $extension = strtolower($ext1[1]);
                    $thefile=$_FILES["file"]["name"];
                    move_uploaded_file($_FILES["file"]["tmp_name"],"images/".$_FILES["file"]["name"]);

                    if ($extension=='xls') $xls='Excel5';
                    if ($extension=='xlsx') $xls='Excel2007';
                    $objReader = PHPExcel_IOFactory::createReader($xls);
                    $objPHPExcel = $objReader->load('images/'.$thefile);
                    $objWorksheet = $objPHPExcel->getActiveSheet();
                    $highestRow = $objWorksheet->getHighestRow()+1;
                    date_default_timezone_set("Asia/Jakarta");

                    $tgl1 = date("d",strtotime($tgl_penerimaan));
                    $bln1 = date("m",strtotime($tgl_penerimaan));
                    $thn1 = date("Y",strtotime($tgl_penerimaan));
                    $tgl2 = date("d",strtotime($tgl_faktur));


                    for ($tgl1; $tgl1<=$tgl2; ++$tgl1) {
                        $y=(int)$tgl1;
                        $x=(5*($y-1));
                        $RecordDataxx=Yii::app()->db->createCommand("SELECT * FROM master.fninsert_penerimaan01
                                  ( '$thn1/$bln1/$tgl1',
                                    '-',
                                    '$thn1/$bln1/$tgl1',
                                    '$diserahkan',
                                    '$diterima',
                                    22,
                                    $id_m_sumber_dana,
                                    $id_skpd
                                  ) ")->queryRow();
                        $id_penerimaan = $RecordDataxx['fninsert_penerimaan01'];


//+(5*$tgl1-1)
                        $statussimpan=0 ;
                        for ($rowke=3; $rowke<$highestRow; ++$rowke) {
                            $id_barang=$objWorksheet->getCellByColumnAndRow(0, $rowke)->getCalculatedValue();
                            $volume=$objWorksheet->getCellByColumnAndRow(2+$x, $rowke)->getCalculatedValue();
                            $harga_satuan=$objWorksheet->getCellByColumnAndRow(4+$x, $rowke)->getCalculatedValue();
                            $no_batch=$objWorksheet->getCellByColumnAndRow(3+$x, $rowke)->getCalculatedValue();
                            $tgl_expired=$objWorksheet->getCellByColumnAndRow(5+$x, $rowke)->getCalculatedValue();

                            if ($tgl_expired==''){$tgl_expired='01/01/1976';}
                            if ($volume>0){
                                Yii::app()->db->createCommand("SELECT * FROM master.fninsert_penerimaan_detail
                                                                  ( $id_penerimaan,
                                                                    $id_barang,
                                                                    $volume,
                                                                    $harga_satuan,
                                                                    '$no_batch',
                                                                   '$tgl_expired'
                                                                  ) ")->execute();
                                $statussimpan=1 ;
                            }
                        }
                        if ($statussimpan!=1){
                            Yii::app()->db->createCommand("SELECT * FROM master.fndelete_penerimaan('$id_penerimaan')")->execute();
                        }
                    }
                    $statussimpan="Data Telah Tersimpan " ;
                    unlink("images/".$_FILES["file"]["name"]);
                }

            }

        }



        $myquery="SELECT * FROM master.fndaftar_penerimaan_detail($id_penerimaan)";
        $dataProvider=Yii::app()->db->createCommand("$myquery;")->queryAll();
        $this->render('daftar_penerimaandetail',
            array( 'dataProvider'  =>$dataProvider
            ,'tahun'     => $tahun
            ,'id_skpd'   => $id_skpd
            ,'id_bidang' => $id_bidang

            ,'tgl_penerimaan' => $tgl_penerimaan
            ,'no_faktur'     => $no_fakturf
            ,'tgl_faktur'     => $tgl_faktur
            ,'diserahkan'     => $diserahkan
            ,'diterima'     => $diterima
            ,'id_distributor'     => $id_distributor
            ,'id_kegiatan'     => $id_kegiatan
            ,'id_jenis_transaksi'     => $id_jenis_transaksi
            ,'id_penerimaan'     => $id_penerimaan
            ,'distributor'     => $distributor
            ,'nm_sumber_dana'     => $nm_sumber_dana
            ,'nama_skpd'     => $nama_skpd

    ));
    }
//--------------------------------------------------------

    public function actionInsertPenerimaanDetail() {
        $statussimpan   ='';
        $id_penerimaan      = $_POST['id_penerimaan'];
        $RecordData=Yii::app()->db->createCommand("select * from master.fndata_penerimaan('$id_penerimaan');")->queryRow();
        $no_faktur          = $RecordData['no_faktur'];
        $tgl_faktur = $RecordData['tgl_faktur'];
        $nama_skpd   =$RecordData['nama_skpd'];



        if(isset($_POST['statussimpan'])) {
            $id_barang     = $_POST['txtnama_barang'];
            $xid_barang     = substr($id_barang,1,5) ;
            $volume         = $_POST['txtvolume'];
            $harga_satuan         = $_POST['txtjumlah'];
            $xharga_satuan            = str_replace (".", "", $harga_satuan, $count);
            $batch         =$_POST['txtbatch'];
            $tgl_expired         =$_POST['txttgl_expired'];

        Yii::app()->db->createCommand("SELECT * FROM master.fninsert_penerimaan_detail01
                  ( $id_penerimaan,
                    $xid_barang,
                    $volume,
                    $xharga_satuan,
                    '$batch',
                   '$tgl_expired'
                  ) ")->execute();
            $statussimpan="Data Telah Tersimpan " ;
        }

        $this->render('insert_penerimaan_detail',array('labeljudul'=>' '
        ,'statussimpan'     => $statussimpan
        ,'id_penerimaan'     => $id_penerimaan
        ,'no_faktur'     => $no_faktur
        ,'tgl_faktur'     => $tgl_faktur

        ,'id_barang'     => $id_barang
        ,'volume'     => $volume
        ,'harga_satuan'     => $harga_satuan
        ,'batch'     => $batch
        ,'tgl_expired'     => $tgl_expired
        ,'nama_skpd'     => $nama_skpd

        ));
    }


//--------------------------------------------------------

    public function actionEditPenerimaanDetail() {
        $statussimpan   ='';

        $id_penerimaan_detail      = $_POST['id_penerimaan_detail'];
        $RecordData=Yii::app()->db->createCommand("select * from master.fndata_penerimaan_detail('$id_penerimaan_detail');")->queryRow();
        $id_penerimaan     = $RecordData['id_penerimaan'];
        $id_barang          = $RecordData['id_barang'];
        $volume = $RecordData['volume'];
        $harga_satuan = $RecordData['harga_satuan'];

        $batch     = $RecordData['batch'];
        $expired     = $RecordData['expired'];
        $kd_barang    = $RecordData['kd_barang'];
        $nama_barang     = $RecordData['nama_barang'];
        $satuan   = $RecordData['satuan'];;

        $RecordData=Yii::app()->db->createCommand("select * from master.fndata_penerimaan('$id_penerimaan');")->queryRow();
        $no_faktur          = $RecordData['no_faktur'];
        $tgl_faktur = $RecordData['tgl_faktur'];

        if(isset($_POST['statussimpan'])) {
            $volume         = $_POST['txtvolume'];
            $harga_satuan         = $_POST['txtjumlah'];
            $xharga_satuan            = str_replace (".", "", $harga_satuan, $count);
            $batch         =$_POST['txtbatch'];
            $tgl_expired         =$_POST['txttgl_expired'];

               Yii::app()->db->createCommand("SELECT * FROM master.fnedit_penerimaan_detail
                  ( $id_penerimaan_detail,
                    $volume,
                    $xharga_satuan,
                    '$batch',
                   '$tgl_expired'
                  ) ")->execute();
            $statussimpan="Data Telah Tersimpan " ;
        }

        $this->render('edit_penerimaan_detail',array('labeljudul'=>' '
        ,'statussimpan'     => $statussimpan
        ,'id_penerimaan_detail'     => $id_penerimaan_detail
         ,   'id_penerimaan'     => $id_penerimaan
        ,'no_faktur'     => $no_faktur
        ,'tgl_faktur'     => $tgl_faktur

        ,'id_barang'     => $id_barang
        ,'volume'     => $volume
        ,'harga_satuan'     => $harga_satuan
        ,'batch'     => $batch
        ,'tgl_expired'     => $tgl_expired
        ,'kd_barang'     => $kd_barang
        ,'nama_barang'     => $nama_barang
        ,'satuan'     => $satuan
        ,'expired'     => $expired


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
}




