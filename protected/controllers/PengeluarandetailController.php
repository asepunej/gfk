<?php

class PengeluarandetailController extends Controller
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
    public function actionDaftarPengeluaranDetail() {

        $id_pengeluaran      = $_POST['id_pengeluaran'];
        $RecordData=Yii::app()->db->createCommand("select * from master.fndata_pengeluaran('$id_pengeluaran');")->queryRow();
        $tgl_pengeluaran     = $RecordData['tgl_pengeluaran'];
        $no_permintaan          = $RecordData['no_permintaan'];
        $tgl_permintaan = $RecordData['tgl_permintaan'];
        $diserahkan = $RecordData['diserahkan'];
        $diterima     = $RecordData['diterima'];
        $bidang    = $RecordData['bidang'];
        $tahun   = date('Y', strtotime($RecordData["tgl_pengeluaran"]));
        $id_skpd   =$RecordData['id_skpd'];
        $id_bidang   =$RecordData['id_bidang_penerima'];
        $id_bidang_penerima   =$RecordData['id_bidang_penerima'];
        $distribusi_status=$RecordData['distribusi_status'];
        $nama_skpd=$RecordData['nama_skpd'];
        $level_unit=$RecordData['level_unit'];
        $nm_sumber_dana=$RecordData['nm_sumber_dana'];
        $id_sumber_dana=$RecordData['id_sumber_dana'];


        if($_POST['action']=='statusdelete') {
            $id_pengeluaran_detail     =$_POST['id_pengeluaran_detail'];
            Yii::app()->db->createCommand("SELECT * FROM master.fndelete_pengeluaran_detail('$id_pengeluaran_detail')")->execute();
       } else if($_POST['action']=='deletedatasemua') {
            Yii::app()->db->createCommand("SELECT * FROM master.fndelete_pengeluaran_detail_all('$id_pengeluaran')")->execute(); }

        else if($_POST['action']=='upload') {

            spl_autoload_unregister(array('YiiBase','autoload'));
            Yii::import('ext.PHPExcel.Classes.PHPExcel', true);
            spl_autoload_register(array('YiiBase','autoload'));

            if (isset($_POST['submit'])) {
                $id_pengeluaran    =$_POST['id_pengeluaran'];

                if ($_FILES["file"]["error"] > 0)   {
                    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
                }
                else  {


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
                        $tgl1 = date("d",strtotime($tgl_pengeluaran));
                        $y=(int)$tgl1;
                        $x=(2*($y-1));

                        $id_barang=$objWorksheet->getCellByColumnAndRow(0, $rowke)->getCalculatedValue();
                        $volume=$objWorksheet->getCellByColumnAndRow(2+$x, $rowke)->getCalculatedValue();
                        $ket=$objWorksheet->getCellByColumnAndRow(3+$x, $rowke)->getCalculatedValue();
                        $id_barangx=$id_barang;
                        $keterangan=$ket;


                        if ($volume>0){

                            $RecordData01           =Yii::app()->db->createCommand("select * from master.fngetsisa_barang('$id_barangx','$id_skpd');")->queryRow();
                            $id_penerimaan_detail   =$RecordData01['id_penerimaan_detail'];
                            $volume_sisa            = $RecordData01['volume_sisa'];

                            while($volume_sisa<$volume and $id_penerimaan_detail!='')       {
                            Yii::app()->db->createCommand("SELECT * FROM master.fninsert_pengeluaran_detail01
                                  ( $id_pengeluaran,
                                    $id_barangx,
                                    $volume_sisa,
                                   '$keterangan',
                                   $id_penerimaan_detail
                                  ) ")->execute();

                                $volume=$volume-$volume_sisa;
                                $RecordData01           =Yii::app()->db->createCommand("select * from master.fngetsisa_barang('$id_barangx','$id_skpd');")->queryRow();
                                $id_penerimaan_detail   =$RecordData01['id_penerimaan_detail'];
                                $volume_sisa            = $RecordData01['volume_sisa'];

                            }
                            if ($id_penerimaan_detail!=''){
                                Yii::app()->db->createCommand("SELECT * FROM master.fninsert_pengeluaran_detail01
                                      ( $id_pengeluaran,
                                        $id_barangx,
                                        $volume,
                                       '$keterangan',
                                       $id_penerimaan_detail
                                      ) ")->execute();
                            }

//
                        }
                    }
                    $statussimpan="Data Telah Tersimpan " ;
                    unlink("images/".$_FILES["file"]["name"]);
                }

            }
        } else if($_POST['action']=='upload_all') {

            $tgl_penerimaan=$tgl_pengeluaran;
            $tgl_faktur=$tgl_permintaan ;

            spl_autoload_unregister(array('YiiBase','autoload'));
            Yii::import('ext.PHPExcel.Classes.PHPExcel', true);
            spl_autoload_register(array('YiiBase','autoload'));

            if (isset($_POST['submit'])) {
                $id_pengeluaran    =$_POST['id_pengeluaran'];

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
                        $x=(2*($y-1));

                        $RecordDataxx=Yii::app()->db->createCommand("SELECT * FROM master.fninsert_pengeluaran01
                                  ( '$thn1/$bln1/$tgl1',
                                    '-',
                                    '$thn1/$bln1/$tgl1',
                                    '$diserahkan',
                                    '$diterima',
                                    $id_bidang_penerima,
                                    $id_skpd,
                                    $id_sumber_dana
                                  ) ")->queryRow();

                        $id_pengeluaran = $RecordDataxx['fninsert_pengeluaran01'];

//+(5*$tgl1-1)
                        $statussimpan=0 ;
                        for ($rowke=3; $rowke<$highestRow; ++$rowke) {
                            $id_barang=$objWorksheet->getCellByColumnAndRow(0, $rowke)->getCalculatedValue();
                            $volume=$objWorksheet->getCellByColumnAndRow(2+$x, $rowke)->getCalculatedValue();
                            $ket=$objWorksheet->getCellByColumnAndRow(3+$x, $rowke)->getCalculatedValue();
                            $id_barangx=$id_barang;
                            $keterangan=$ket;


                            if ($volume>0){

                                $RecordData01           =Yii::app()->db->createCommand("select * from master.fngetsisa_barang('$id_barangx','$id_skpd');")->queryRow();
                                $id_penerimaan_detail   =$RecordData01['id_penerimaan_detail'];
                                $volume_sisa            = $RecordData01['volume_sisa'];

                                while($volume_sisa<$volume and $id_penerimaan_detail!='')       {
                                    Yii::app()->db->createCommand("SELECT * FROM master.fninsert_pengeluaran_detail01
                                  ( $id_pengeluaran,
                                    $id_barangx,
                                    $volume_sisa,
                                   '$keterangan',
                                   $id_penerimaan_detail
                                  ) ")->execute();

                                    $volume=$volume-$volume_sisa;
                                    $RecordData01           =Yii::app()->db->createCommand("select * from master.fngetsisa_barang('$id_barangx','$id_skpd');")->queryRow();
                                    $id_penerimaan_detail   =$RecordData01['id_penerimaan_detail'];
                                    $volume_sisa            = $RecordData01['volume_sisa'];

                                }
                                if ($id_penerimaan_detail!=''){
                                    Yii::app()->db->createCommand("SELECT * FROM master.fninsert_pengeluaran_detail01
                                      ( $id_pengeluaran,
                                        $id_barangx,
                                        $volume,
                                       '$keterangan',
                                       $id_penerimaan_detail
                                      ) ")->execute();
                                }

                                $statussimpan=1 ;
                            }
                        }
                        if ($statussimpan!=1){
                            Yii::app()->db->createCommand("SELECT * FROM master.fndelete_pengeluaran('$id_pengeluaran')")->execute();
                        }
                    }
                    $statussimpan="Data Telah Tersimpan " ;
                    unlink("images/".$_FILES["file"]["name"]);
                }

            }

        }


        if($_POST['action']=='statusdistribusi') {
            $id_pengeluaran    =$_POST['id_pengeluaran'];
            Yii::app()->db->createCommand("SELECT * FROM master.fndistribusi_pengeluaran('$id_pengeluaran')")->execute();
            $RecordData01=Yii::app()->db->createCommand("select * from master.fndata_pengeluaran('$id_pengeluaran');")->queryRow();
            $distribusi_status=$RecordData01['distribusi_status'];

        }
        $myquery="SELECT * FROM master.fndaftar_pengeluaran_detail($id_pengeluaran)";
        $dataProvider=Yii::app()->db->createCommand("$myquery;")->queryAll();
        $this->render('daftar_pengeluarandetail',
            array( 'dataProvider'  =>$dataProvider
            ,'tahun'     => $tahun
            ,'id_skpd'   => $id_skpd
            ,'id_bidang'   => $id_bidang

            ,'tgl_pengeluaran' => $tgl_pengeluaran
            ,'no_permintaan'     => $no_permintaan
            ,'tgl_permintaan'     => $tgl_permintaan
            ,'diserahkan'     => $diserahkan
            ,'diterima'     => $diterima

            ,'bidang'     => $bidang
            ,'id_pengeluaran'     => $id_pengeluaran
            ,'distribusi_status'     => $distribusi_status
            ,'nama_skpd'     => $nama_skpd
            ,'level_unit'     => $level_unit
            ,'nm_sumber_dana'     => $nm_sumber_dana

    ));
    }
//--------------------------------------------------------

    public function actionInsertPengeluaranDetail() {
        $statussimpan   ='';
        $id_pengeluaran      = $_POST['id_pengeluaran'];
        $RecordData=Yii::app()->db->createCommand("select * from master.fndata_pengeluaran('$id_pengeluaran');")->queryRow();
        $no_permintaan          = $RecordData['no_permintaan'];
        $tgl_pengeluaran     = $RecordData['tgl_pengeluaran'];
        $tgl_permintaan = $RecordData['tgl_pengeluaran'];

        $id_bidang    = $RecordData['id_bidang'];
        $bidang    = $RecordData['bidang'];
        $id_skpd    = $RecordData['id_skpd'];
        $nama_skpd=$RecordData['nama_skpd'];
        $id_sumber_dana=$RecordData['id_sumber_dana'];
        $nm_sumber_dana=$RecordData['nm_sumber_dana'];

        Yii::app()->session['id_sumber_dana'] =$id_sumber_dana;

        if(isset($_POST['statussimpan'])) {

            $id_barang     = $_POST['txtnama_barang'];
            $id_barangx     =substr($id_barang,1,5) ;
            $volume         = $_POST['txtvolume'];
            $volumeawal         = $_POST['txtvolume'];
            $keterangan         =$_POST['txtketerangan'];

            $RecordData01           =Yii::app()->db->createCommand("select * from master.fngetsisa_barang('$id_barangx','$id_skpd');")->queryRow();
            $id_penerimaan_detail   =$RecordData01['id_penerimaan_detail'];
            $volume_sisa            = $RecordData01['volume_sisa'];


            while($volume_sisa<$volume and $id_penerimaan_detail!='')       {

               Yii::app()->db->createCommand("SELECT * FROM master.fninsert_pengeluaran_detail01
              ( $id_pengeluaran,
                $id_barangx,
                $volume_sisa,
               '$keterangan',
               $id_penerimaan_detail
              ) ")->execute();

                $volume=$volume-$volume_sisa;
                $RecordData01           =Yii::app()->db->createCommand("select * from master.fngetsisa_barang('$id_barangx','$id_skpd');")->queryRow();
                $id_penerimaan_detail   =$RecordData01['id_penerimaan_detail'];
                $volume_sisa            = $RecordData01['volume_sisa'];

            }
           if ($id_penerimaan_detail!=''){
               Yii::app()->db->createCommand("SELECT * FROM master.fninsert_pengeluaran_detail01
                          ( $id_pengeluaran,
                            $id_barangx,
                            $volume,
                           '$keterangan',
                           $id_penerimaan_detail
                          ) ")->execute();
           }

        }



        $this->render('insert_pengeluarandetail',array('labeljudul'=>' '
        ,'statussimpan'     => $statussimpan
        ,'id_pengeluaran'     => $id_pengeluaran
        ,'no_permintaan'     => $no_permintaan
        ,'tgl_pengeluaran' => $tgl_pengeluaran
        ,'tgl_permintaan'     => $tgl_permintaan
        ,'id_bidang'     => $id_bidang
        ,'bidang'     => $bidang

        ,'id_skpd'     => $id_skpd
        ,'nama_skpd'     => $nama_skpd

        ,'id_barang'     => $id_barang
        ,'volume'     => $volumeawal
        ,'keterangan' => $keterangan
        ,'nm_sumber_dana' => $nm_sumber_dana
        ,'id_sumber_dana' => $id_sumber_dana





        ));
    }

//--------------------------------------------------------
    public function actionEditPengeluaranDetail() {
        $statussimpan   ='';

        $id_pengeluaran_detail      = $_POST['id_pengeluaran_detail'];
        $RecordData=Yii::app()->db->createCommand("select * from master.fndata_pengeluaran_detail('$id_pengeluaran_detail');")->queryRow();
        $id_pengeluaran     = $RecordData['id_pengeluaran'];
        $volume     = $RecordData['volume'];
        $nama_barang     = $RecordData['nama_barang'];
        $keterangan     = $RecordData['keterangan'];


        $RecordData=Yii::app()->db->createCommand("select * from master.fndata_pengeluaran('$id_pengeluaran');")->queryRow();
        $no_permintaan          = $RecordData['no_permintaan'];
        $tgl_pengeluaran     = $RecordData['tgl_pengeluaran'];
        $tgl_permintaan = $RecordData['tgl_pengeluaran'];

        $id_bidang    = $RecordData['id_bidang'];
        $bidang    = $RecordData['bidang'];
        $id_skpd    = $RecordData['id_skpd'];
        $nama_skpd=$RecordData['nama_skpd'];
        $id_sumber_dana=$RecordData['id_sumber_dana'];
        $nm_sumber_dana=$RecordData['nm_sumber_dana'];


        if(isset($_POST['statussimpan'])) {

            $id_barang     = $_POST['txtnama_barang'];
            $id_barangx     =substr($id_barang,1,5) ;
            $id_penerimaan_detail     =substr($id_barang,7,5) ;
            $volume         = $_POST['txtvolume'];
            $keterangan         =$_POST['txtketerangan'];


            Yii::app()->db->createCommand("SELECT * FROM master.fnedit_pengeluaran_detail
                  ( $id_pengeluaran_detail,
                    $volume,
                    '$keterangan'
                  ) ")->execute();
            $statussimpan="Data Telah Tersimpan " ;
        }

        $this->render('edit_pengeluarandetail',array('labeljudul'=>' '
        ,'statussimpan'     => $statussimpan
        ,'id_pengeluaran'     => $id_pengeluaran
        ,'no_permintaan'     => $no_permintaan
        ,'tgl_pengeluaran' => $tgl_pengeluaran
        ,'tgl_permintaan'     => $tgl_permintaan
        ,'id_bidang'     => $id_bidang
        ,'bidang'     => $bidang

        ,'id_skpd'     => $id_skpd
        ,'nama_skpd'     => $nama_skpd

        ,'id_barang'     => $id_barang
        ,'volume'     => $volume
        ,'keterangan' => $keterangan
        ,'nm_sumber_dana' => $nm_sumber_dana
        ,'id_sumber_dana' => $id_sumber_dana


        ,'nama_barang' => $nama_barang
        ,'id_pengeluaran_detail' => $id_pengeluaran_detail







        ));
    }
//--------------------------------------------------------

//    public function actionEditPenerimaan() {
//        $statussimpan   ='';
//
//        $id_penerimaan      = $_POST['id_penerimaan'];
//        $RecordData=Yii::app()->db->createCommand("select * from master.fndata_penerimaan('$id_penerimaan');")->queryRow();
//        $tgl_penerimaan     = $RecordData['tgl_penerimaan'];
//        $no_faktur          = $RecordData['no_faktur'];
//        $tgl_faktur = $RecordData['tgl_faktur'];
//        $diserahkan = $RecordData['diserahkan'];
//        $diterima     = $RecordData['diterima'];
//        $id_distributor     = $RecordData['id_distributor'];
//        $id_kegiatan     = $RecordData['id_kegiatan'];
//        $id_jenis_transaksi     = $RecordData['id_jenis_transaksi'];
//        $tahun   = $RecordData['tahun'];;
//        $id_skpd   =$RecordData['id_skpd'];;
//
//
//        if(isset($_POST['statussimpan'])) {
//
//            $tgl_penerimaan     = $_POST['txttgl_penerimaan'];
//            $no_faktur          = $_POST['txtno_faktur'];
//            $tgl_faktur         = $_POST['txttgl_faktur'];
//            $diserahkan         =$_POST['txtdiserahkan'];
//            $diterima           = $_POST['txtditerima'];
//            $id_distributor     = $_POST['ddldistributor'];
//            $id_kegiatan        = $_POST['ddlkegiatan'];
//            $id_jenis_transaksi = $_POST['ddljenistransaksi'];
//
//
//            Yii::app()->db->createCommand("SELECT * FROM master.fnedit_penerimaan
//                  ( $id_penerimaan,
//                    '$tgl_penerimaan',
//                    '$no_faktur',
//                    '$tgl_faktur',
//                    '$diserahkan',
//                    '$diterima',
//                    $id_distributor,
//                    $id_kegiatan,
//                    $id_jenis_transaksi
//                  ) ")->execute();
//            $statussimpan="Data Telah Tersimpan " ;
//        }
//
//        $this->render('insert_penerimaan',array('labeljudul'=>' '
//        ,'statussimpan'     => $statussimpan
//        ,'tahun'     => $tahun
//        ,'id_skpd'   => $id_skpd
//
//        ,'tgl_penerimaan' => $tgl_penerimaan
//        ,'no_faktur'     => $no_faktur
//        ,'tgl_faktur'     => $tgl_faktur
//        ,'diserahkan'     => $diserahkan
//        ,'diterima'     => $diterima
//        ,'id_distributor'     => $id_distributor
//        ,'id_kegiatan'     => $id_kegiatan
//        ,'id_jenis_transaksi'     => $id_jenis_transaksi
//        ,'id_penerimaan'     => $id_penerimaan
//
//        ));
//    }

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
        $id_skpd=Yii::app()->session['id_skpd_induk'];
//        $id_skpd   =$_POST['id_skpd'];
        $id_sumber_dana=Yii::app()->session['id_sumber_dana'];

        $qtxt ="SELECT nama_barang from  master.fnautocomplete_stokbarang02($id_skpd,$id_sumber_dana)";
        $command =Yii::app()->db->createCommand($qtxt);
        $res =$command->queryColumn();

        $return = array_values(array_filter($res, function($element) use ($term) {
            return (stripos($element, $term) !== false);
        }));
//cetak dalam format json
        echo CJSON::encode($return);
    }
}




