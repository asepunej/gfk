<?php

class PenerimaanController extends Controller
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
    public function actionDaftarPenerimaan() {

        if(isset($_POST['ddltahun'])) {
            $tahun   =$_POST['ddltahun'];
        }else  $tahun  =Yii::app()->session['tahun_anggaran'];

        if(isset($_POST['ddlskpd'])) {
            $id_skpd     =$_POST['ddlskpd'];
        }else
            $id_skpd     =Yii::app()->session['id_skpd'];

        if(isset($_POST['ddlbulan'])) {
            $kdbulan   =$_POST['ddlbulan'];
        }else  $kdbulan   =(int)(date('m'));

        if($_POST['action']=='statusdelete') {
            $id_penerimaan     =$_POST['id_penerimaan'];
            Yii::app()->db->createCommand("SELECT * FROM master.fndelete_penerimaan('$id_penerimaan')")->execute();
       }  else if($_POST['action']=='upload') {

            $tgl_penerimaan     =$_POST['txttgl_penerimaan'];
            $tgl_faktur         =$_POST['txttgl_faktur'];
            $id_m_sumber_dana   =$_POST['ddlsumberdana'];

            spl_autoload_unregister(array('YiiBase','autoload'));
            Yii::import('ext.PHPExcel.Classes.PHPExcel', true);
            spl_autoload_register(array('YiiBase','autoload'));

            if (isset($_POST['submit'])) {
//                $id_penerimaan    =$_POST['id_penerimaan'];

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
                    //$tgl2 = date("d",strtotime($tgl_faktur));
                    $tgl2 =31;

                    for ($tgl1; $tgl1<=$tgl2; ++$tgl1) {
                        $y=(int)$tgl1;
                        $x=(5*($y-1));
                        $RecordDataxx=Yii::app()->db->createCommand("SELECT * FROM master.fninsert_penerimaan01
                                  ( '$thn1/$bln1/$tgl1',
                                    '-',
                                    '$thn1/$bln1/$tgl1',
                                    '-',
                                    '-',
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
                }

            }

        }


        $myquery="SELECT * FROM master.fndaftar_penerimaan($tahun,$id_skpd)";
        $dataProvider=Yii::app()->db->createCommand("$myquery;")->queryAll();
        $this->render('daftar_penerimaan',
            array( 'dataProvider'  =>$dataProvider
            ,'tahun'     => $tahun
            ,'id_skpd'   => $id_skpd
            ,'kdbulan'   => $kdbulan
    ));
    }
//--------------------------------------------------------

    public function actionInsertPenerimaan() {
        $statussimpan   ='';
        $tahun   = $_POST['ddltahun'];
        $id_skpd   = $_POST['ddlskpd'];
        $kdbulan   = $_POST['ddlbulan'];

        if(isset($_POST['statussimpan'])) {

            $tgl_penerimaan     = $_POST['txttgl_penerimaan'];
            $no_faktur          = $_POST['txtno_faktur'];
            $tgl_faktur         = $_POST['txttgl_faktur'];
            $diserahkan         =$_POST['txtdiserahkan'];
            $diterima           = $_POST['txtditerima'];
            $id_distributor     = $_POST['ddldistributor'];
            $id_m_sumber_dana        = $_POST['ddlsumberdana'];

            Yii::app()->db->createCommand("SELECT * FROM master.fninsert_penerimaan
                  ( '$tgl_penerimaan',
                    '$no_faktur',
                    '$tgl_faktur',
                    '$diserahkan',
                    '$diterima',
                    $id_distributor,
                    $id_m_sumber_dana,
                    $id_skpd
                  ) ")->execute();
            $statussimpan="Data Telah Tersimpan " ;
        }

        $this->render('insert_penerimaan',array('labeljudul'=>' '
        ,'statussimpan'     => $statussimpan
        ,'tahun'     => $tahun
        ,'id_skpd'   => $id_skpd

        ,'tgl_penerimaan' => $tgl_penerimaan
        ,'no_faktur'     => $no_faktur
        ,'tgl_faktur'     => $tgl_faktur
        ,'diserahkan'     => $diserahkan
        ,'diterima'     => $diterima
        ,'id_distributor'     => $id_distributor
        ,'id_m_sumber_dana'     => $id_m_sumber_dana
        ,'kdbulan'     => $kdbulan

        ));
    }

//--------------------------------------------------------
//--------------------------------------------------------

    public function actionEditPenerimaan() {
        $statussimpan   ='';

        $id_penerimaan      = $_POST['id_penerimaan'];
        $RecordData=Yii::app()->db->createCommand("select * from master.fndata_penerimaan('$id_penerimaan');")->queryRow();
        $tgl_penerimaan     = $RecordData['tgl_penerimaan'];
        $no_faktur          = $RecordData['no_faktur'];
        $tgl_faktur = $RecordData['tgl_faktur'];
        $diserahkan = $RecordData['diserahkan'];
        $diterima     = $RecordData['diterima'];
        $id_distributor     = $RecordData['id_distributor'];
        $tahun   = date('Y', strtotime($RecordData["tgl_penerimaan"]));
        $id_skpd   =$RecordData['id_skpd'];;
        $id_m_sumber_dana   =$RecordData['id_m_sumber_dana'];;


        if(isset($_POST['statussimpan'])) {

            $tgl_penerimaan     = $_POST['txttgl_penerimaan'];
            $no_faktur          = $_POST['txtno_faktur'];
            $tgl_faktur         = $_POST['txttgl_faktur'];
            $diserahkan         =$_POST['txtdiserahkan'];
            $diterima           = $_POST['txtditerima'];
            $id_distributor     = $_POST['ddldistributor'];
            $id_m_sumber_dana        = $_POST['ddlsumberdana'];

            Yii::app()->db->createCommand("SELECT * FROM master.fnedit_penerimaan
                  ( $id_penerimaan,
                    '$tgl_penerimaan',
                    '$no_faktur',
                    '$tgl_faktur',
                    '$diserahkan',
                    '$diterima',
                    $id_distributor,
                    $id_m_sumber_dana,
                    $id_skpd
                  ) ")->execute();
            $statussimpan="Data Telah Tersimpan " ;
        }

        $this->render('insert_penerimaan',array('labeljudul'=>' '
        ,'statussimpan'     => $statussimpan
        ,'tahun'     => $tahun
        ,'id_skpd'   => $id_skpd

        ,'tgl_penerimaan' => $tgl_penerimaan
        ,'no_faktur'     => $no_faktur
        ,'tgl_faktur'     => $tgl_faktur
        ,'diserahkan'     => $diserahkan
        ,'diterima'     => $diterima
        ,'id_distributor'     => $id_distributor
        ,'id_m_sumber_dana'     => $id_m_sumber_dana
            ,'id_penerimaan'     => $id_penerimaan


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

    public function actionIsiddlkegiatan()
    {
        $ReferensiModel=new ReferensiModel();
        $id_bidang = $_POST['id_bidang'];
        echo CHtml::dropDownList('ddlkegiatan','',$ReferensiModel->getdaftarkegiatanbidangxx($id_bidang),array('prompt'=>'Pilih',));

    }

//--------------------------------------------------------

    public function actionUploadExcel() {


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
                    //$tgl2 = date("d",strtotime($tgl_faktur));
                    $tgl2 =31;

                    for ($tgl1; $tgl1<=$tgl2; ++$tgl1) {
                        $y=(int)$tgl1;
                        $x=(5*($y-1));
                        $RecordDataxx=Yii::app()->db->createCommand("SELECT * FROM master.fninsert_penerimaan01
                                  ( '$thn1/$bln1/$tgl1',
                                    '-',
                                    '$thn1/$bln1/$tgl1',
                                    '-',
                                    '-',
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
                }

            }





        $this->render('upload_excel',array('labeljudul'=>' '
        ,'statussimpan'     => $statussimpan
        ,'tahun'     => $tahun
        ,'id_skpd'   => $id_skpd

        ,'tgl_penerimaan' => $tgl_penerimaan
        ,'no_faktur'     => $no_faktur
        ,'tgl_faktur'     => $tgl_faktur
        ,'diserahkan'     => $diserahkan
        ,'diterima'     => $diterima
        ,'id_distributor'     => $id_distributor
        ,'id_m_sumber_dana'     => $id_m_sumber_dana

        ));
    }

//--------------------------------------------------------

}




