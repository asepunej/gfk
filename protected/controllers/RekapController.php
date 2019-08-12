<?php

class RekapController extends Controller
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
    public function actionRekapMutasiBarang() {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 300);

        if(isset($_POST['ddltahun'])) {
            $tahun   =$_POST['ddltahun'];
        }else  $tahun  =Yii::app()->session['tahun_anggaran'];

        if(isset($_POST['ddlskpd'])) {
            $id_skpd     =$_POST['ddlskpd'];
        }

        if(isset($_POST['ddljenisbarang']) and ($_POST['ddljenisbarang']!='')) {
            $id_jenis_barang   =$_POST['ddljenisbarang'];
        }else  $id_jenis_barang  =0;

        if(isset($_POST['txttgl_mulai'])) {
            $tgl_mulai     =$_POST['txttgl_mulai'];
        }else
            $tgl_mulai     ='01/01/'.$tahun;

        if(isset($_POST['txttgl_akhir'])) {
            $tgl_akhir     =$_POST['txttgl_akhir'];
        }else
           $tgl_akhir     ='12/31/'.$tahun;

        if(isset($_POST['ddlskpd']) and $_POST['ddlskpd']!='') {
            // Pilihan SKPD
            $RecordData=Yii::app()->db->createCommand("select * from referensi.fndata_skpd('$id_skpd');")->queryRow();
            $nama_skpd     = $RecordData['nama_skpd'];
            $id_skpd_induk   = $RecordData['id_skpd_induk'];

            $RecordData01=Yii::app()->db->createCommand("select * from master.fngettotal_barang_rusak02($id_skpd,1);")->queryRow();
            $nominalrusak     = $RecordData01['nominal'];

            $RecordData01=Yii::app()->db->createCommand("select * from master.fngettotal_barang_rusak02($id_skpd,2);")->queryRow();
            $nominalusang     = $RecordData01['nominal'];

            if ( Yii::app()->session['level_unit']==2){
                $RecordData=Yii::app()->db->createCommand("select * from referensi.fndata_skpd('$id_skpd_induk');")->queryRow();
                $nama_skpd     = $nama_skpd.' '.substr($RecordData['nama_skpd'],7,100);
            }

            if(isset($_POST['ddljenisbarang']) and $_POST['ddljenisbarang']!='') {
                 $myquery="SELECT * FROM master.fnrmp_skpd_jenisbarang($tahun,$id_skpd,'$tgl_mulai','$tgl_akhir',$id_jenis_barang)";
            }else{
                $myquery="SELECT * FROM master.fnrmp_skpd($tahun,$id_skpd,'$tgl_mulai','$tgl_akhir')";
            }

        }else{
            // Pilihan Dinkes
            $id_skpd_induk=Yii::app()->session['id_skpd'];

            if ($id_skpd_induk ==0){
                $nama_skpd     = 'GFK Dan Puskesmas';
                $RecordData01=Yii::app()->db->createCommand("select * from master.fngettotal_barang_rusak_dinkes(1);")->queryRow();
                $nominalrusak     = $RecordData01['nominal'];
                $RecordData01=Yii::app()->db->createCommand("select * from master.fngettotal_barang_rusak_dinkes(2);")->queryRow();
                $nominalusang     = $RecordData01['nominal'];

                if(isset($_POST['ddljenisbarang']) and $_POST['ddljenisbarang']!='') {
                    $myquery="SELECT * FROM master.fnrmp_dinkes_jenisbarang($tahun,0,'$tgl_mulai','$tgl_akhir',$id_jenis_barang)";
                }else{
                    $myquery="SELECT * FROM master.fnrmp_dinkes($tahun,0,'$tgl_mulai','$tgl_akhir')";}
            }else {
             //pilihan puskesmas

                $RecordData=Yii::app()->db->createCommand("select * from referensi.fndata_skpd('$id_skpd_induk');")->queryRow();
                $nama_skpd     = $RecordData['nama_skpd'];
                $nama_skpd     = $nama_skpd.' Dan Unit';

                $RecordData01=Yii::app()->db->createCommand("select * from master.fngettotal_barang_rusak_puskesmas($id_skpd_induk,1);")->queryRow();
                $nominalrusak     = $RecordData01['nominal'];
                $RecordData01=Yii::app()->db->createCommand("select * from master.fngettotal_barang_rusak_puskesmas($id_skpd_induk,2);")->queryRow();
                $nominalusang     = $RecordData01['nominal'];

                if(isset($_POST['ddljenisbarang']) and $_POST['ddljenisbarang']!='') {
                    $myquery="SELECT * FROM master.fnrmp_puskesmas_jenisbarang($tahun,$id_skpd_induk,'$tgl_mulai','$tgl_akhir',$id_jenis_barang)";
                }else{
                    $myquery="SELECT * FROM master.fnrmp_puskesmas($tahun,$id_skpd_induk,'$tgl_mulai','$tgl_akhir')";}

            }

        }

        $dataProvider=Yii::app()->db->createCommand("$myquery;")->queryAll();

        if($_POST['action']=='excel') {
            $this->renderpartial('rekap_mutasi_barang',
                array( 'dataProvider'  =>$dataProvider
                ,'tahun'     => $tahun
                ,'id_skpd'   => $id_skpd
                ,'tgl_mulai'   => $tgl_mulai
                ,'tgl_akhir'   => $tgl_akhir
                ,'id_sumber_dana'   => $id_sumber_dana
                ,'action'   => 'excel'
                ,'id_jenis_barang'   => $id_jenis_barang

                ));
        }else{
            if($_POST['action']=='pdf') {

                 $mpdf = Yii::createComponent('application.extensions.MPDF56.mpdf', 'win-1252', 'A4');
                 $html = Yii::app()->controller->renderPartial('rekap_mutasi_barang_pdf',
                    array( 'dataProvider'  =>$dataProvider
                    ,'tahun'     => $tahun
                    ,'id_skpd'   => $id_skpd
                    ,'tgl_mulai'   => $tgl_mulai
                    ,'tgl_akhir'   => $tgl_akhir
                    ,'id_sumber_dana'   => $id_sumber_dana
                    ,'nama_skpd'   => $nama_skpd
                    ,'nominalrusak'   => $nominalrusak
                    ,'nominalusang'   => $nominalusang
                    ),true);

                $mpdf->WriteHTML($html);
                $mpdf->Output('Cetak_RMP.pdf', 'I');
            }
            else {
                if($_POST['action']=='pdf_lap') {
                    $dataProvider01=Yii::app()->db->createCommand("select * from referensi.fndaftar_jenis_barang ();")->queryAll();
                    $mpdf = Yii::createComponent('application.extensions.MPDF56.mpdf', 'win-1252', 'A4');
                    $html = Yii::app()->controller->renderPartial('laporan_persediaan_pdf01',
                        array( 'dataProvider'  =>$dataProvider
                        ,'dataProvider01'     => $dataProvider01
                        ,'tahun'     => $tahun
                        ,'id_skpd'   => $id_skpd
                        ,'tgl_mulai'   => $tgl_mulai
                        ,'tgl_akhir'   => $tgl_akhir
                        ,'id_sumber_dana'   => $id_sumber_dana
                        ,'nama_skpd'   => $nama_skpd
                        ),true);

                    $mpdf->WriteHTML($html);
                    $mpdf->Output('Cetak_Laporan.pdf', 'I');
                }else {
                    if($_POST['action']=='excel_saldo_akhir') {
                        $this->renderpartial('rmp_saldo_akhir_excel',
                            array( 'dataProvider'  =>$dataProvider
                            ,'tahun'     => $tahun
                            ,'id_skpd'   => $id_skpd
                              ,'tgl_mulai'   => $tgl_mulai
                            ,'tgl_akhir'   => $tgl_akhir
                            ,'id_sumber_dana'   => $id_sumber_dana
                            ,'action'   => 'excel'
                            ,'id_jenis_barang'   => $id_jenis_barang
                            ,'nama_skpd'   => $nama_skpd
                            ));

                }else
                $this->render('rekap_mutasi_barang',
                    array( 'dataProvider'  =>$dataProvider
                    ,'tahun'     => $tahun
                    ,'id_skpd'   => $id_skpd
                    ,'tgl_mulai'   => $tgl_mulai
                    ,'tgl_akhir'   => $tgl_akhir
                    ,'id_sumber_dana'   => $id_sumber_dana
                    ,'action'   => $action
                    ,'id_jenis_barang'   => $id_jenis_barang

                    ));
                }
            }

        }

    }
    //--------------------------------------------------------
    public function actionRekapLPLPO() {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 300);

        if(isset($_POST['ddltahun'])) {
            $tahun   =$_POST['ddltahun'];
        }else  $tahun  =Yii::app()->session['tahun_anggaran'];;

        if(isset($_POST['ddlskpd']) and $_POST['ddlskpd']!='') {
            $id_skpd     =$_POST['ddlskpd'];
        }
//        else
//            $id_skpd     =3479879483;
//        $id_skpd     =Yii::app()->session['id_skpd'];

        if(isset($_POST['ddlbulan'])) {
            $kdbulan     =$_POST['ddlbulan'];}
        else{
            $kdbulan     =1;        }

        if ($kdbulan ==1){$tgl_akhir=31;}
        if ($kdbulan ==2){$tgl_akhir=28;}
        if ($kdbulan ==3){$tgl_akhir=31;}
        if ($kdbulan ==4){$tgl_akhir=30;}
        if ($kdbulan ==5){$tgl_akhir=31;}
        if ($kdbulan ==6){$tgl_akhir=30;}
        if ($kdbulan ==7){$tgl_akhir=31;}
        if ($kdbulan ==8){$tgl_akhir=31;}
        if ($kdbulan ==9){$tgl_akhir=30;}
        if ($kdbulan ==10){$tgl_akhir=31;}
        if ($kdbulan ==11){$tgl_akhir=30;}
        if ($kdbulan ==12){$tgl_akhir=31;}



        if ($kdbulan==12){
                $tgl_mulai     =$kdbulan.'/1/'.$tahun;
                $tgl_akhir     =$kdbulan.'/31/'.$tahun;
            }else{
                $tgl_mulai     =$kdbulan.'/1/'.$tahun;
                $tgl_akhir     =$kdbulan.'/'.$tgl_akhir.'/'.$tahun;
            }

        if(isset($_POST['ddlskpd']) and $_POST['ddlskpd']!='') {
            // Pilihan SKPD
            $myquery="SELECT * FROM master.fnrmp_skpd($tahun,$id_skpd,'$tgl_mulai','$tgl_akhir')";
    }
        else{
            $id_skpd_induk=Yii::app()->session['id_skpd'];
            if ($id_skpd_induk ==0){
                // Pilihan Dinkes
                $myquery="SELECT * FROM master.fnrmp_dinkes($tahun,0,'$tgl_mulai','$tgl_akhir')";
            }
            else{
                // Pilihan Puskesmas
                $myquery="SELECT * FROM master.fnrmp_puskesmas($tahun,$id_skpd_induk,'$tgl_mulai','$tgl_akhir')";
            }

        }

        $dataProvider=Yii::app()->db->createCommand("$myquery;")->queryAll();



        if($_POST['action']=='excel') {
            $action     ='excel';
            $this->renderPartial('rekap_lplpo',
                array( 'dataProvider'  =>$dataProvider
                ,'tahun'     => $tahun
                ,'id_skpd'   => $id_skpd
                ,'tgl_mulai'   => $tgl_mulai
                ,'tgl_akhir'   => $tgl_akhir
                ,'id_sumber_dana'   => $id_sumber_dana
                ,'action'   => $action
                ,'kdbulan'   => $kdbulan
                ));
        } else  if($_POST['action']=='register') {
//            $myquery="SELECT * FROM master.fnregister_bulanan($tahun,$id_skpd,$kdbulan)";


            $myquery="select t1.id_barang as kode
                    ,t1.nama_barang as nama_barang_01
                    ,t1.saldoawal_volume
                    ,t1.penerimaan_volume
                    ,t1.saldoawal_volume+t1.penerimaan_volume as persediaan
                    ,t1.pengeluaran_volume
                    ,t1.saldoakhir_volume
                    , t2.*
                    from (select * from master.fnrmp_skpd ($tahun,$id_skpd,'$tgl_mulai','$tgl_akhir'))t1
                    left join ( select * from master.fnregister_bulanan ($tahun,$id_skpd,$kdbulan)
                        )t2 on t1.id_barang=t2.id_barang";

            $dataProvider=Yii::app()->db->createCommand("$myquery;")->queryAll();
            $this->renderPartial('rekap_lplpo_register',
                array( 'dataProvider'  =>$dataProvider
                ,'tahun'     => $tahun
                ,'id_skpd'   => $id_skpd
                ,'tgl_mulai'   => $tgl_mulai
                ,'tgl_akhir'   => $tgl_akhir
                ,'id_sumber_dana'   => $id_sumber_dana
                ,'action'   => $action
                ,'kdbulan'   => $kdbulan
                ));
        }

        else {
            $this->render('rekap_lplpo',
                array( 'dataProvider'  =>$dataProvider
                ,'tahun'     => $tahun
                ,'id_skpd'   => $id_skpd
                ,'tgl_mulai'   => $tgl_mulai
                ,'tgl_akhir'   => $tgl_akhir
                ,'id_sumber_dana'   => $id_sumber_dana
                ,'action'   => $action
                ,'kdbulan'   => $kdbulan
                ));
        }

    }
//--------------------------------------------------------
    public function actionLaporanPersediaan() {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 300);

        if(isset($_POST['ddltahun'])) {
            $tahun   =$_POST['ddltahun'];
        }else  $tahun  =Yii::app()->session['tahun_anggaran'];;

        if(isset($_POST['ddlskpd'])) {
            $id_skpd     =$_POST['ddlskpd'];
        }else
            $id_skpd     =Yii::app()->session['id_skpd'];

        $myquery="SELECT * FROM master.fnrekap_mutasi_persedian($tahun,$id_skpd)";
        $dataProvider=Yii::app()->db->createCommand("$myquery;")->queryAll();
        $this->render('laporan_persediaan',
            array( 'dataProvider'  =>$dataProvider
            ,'tahun'     => $tahun
            ,'id_skpd'   => $id_skpd
            ));
    }

    //--------------------------------------------------------
    public function actionKartuPersediaanBarang() {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 300);

        $tgl_mulai     =$_POST['txttgl_mulai'];
        $tgl_akhir     =$_POST['txttgl_akhir'];
        $id_sumber_dana     =$_POST['ddlsumberdana'];

        $tahun   =$_POST['ddltahun'];
        $id_skpd     =$_POST['ddlskpd'];
        $id_barang  =$_POST['id_barang'];

        $RecordData=Yii::app()->db->createCommand("select * from master.fndata_barang('$id_barang');")->queryRow();
        $nama_barang     = $RecordData['nama_barang'];
        $satuan          = $RecordData['satuan'];
        $jenis_barang = $RecordData['jenis_barang'];
        $jenis_persediaan = $RecordData['jenis_persediaan'];


        if(isset($_POST['ddlskpd']) and $_POST['ddlskpd']!='') {
        // Pilihan SKPD

            $RecordData=Yii::app()->db->createCommand("select * from referensi.fndata_skpd('$id_skpd');")->queryRow();
            $nama_skpd     = $RecordData['nama_skpd'];
            $id_skpd_induk     = $RecordData['id_skpd_induk'];

            if ( Yii::app()->session['level_unit']==2){
                $RecordData=Yii::app()->db->createCommand("select * from referensi.fndata_skpd('$id_skpd_induk');")->queryRow();
                $nama_skpd     = $nama_skpd.' '.substr($RecordData['nama_skpd'],7,100);
            }

            $myquery="SELECT * FROM master.fnkartu_persediaan_barang03($tahun,$id_barang,$id_skpd)";

        }else{

            // Pilihan Dinkes
            $id_skpdx=Yii::app()->session['id_skpd'];
            if ($id_skpdx ==0){
                $nama_skpd     = 'Dinas Kesehatan';
                $myquery="SELECT * FROM master.fnkartu_stok_dinkes($tahun,$id_barang,0)";


            }else {
                //pilihan puskesmas
                $RecordData=Yii::app()->db->createCommand("select * from referensi.fndata_skpd('$id_skpdx');")->queryRow();
                $nama_skpd     = $RecordData['nama_skpd']. ' Dan Unit';
                $myquery="SELECT * FROM master.fnkartu_stok_puskesmas($tahun,$id_barang,$id_skpdx)";}

        }
       ;
        $dataProvider=Yii::app()->db->createCommand("$myquery;")->queryAll();


        if($_POST['action']=='excel') {
            $action     ='excel';
            $this->renderPartial('kartu_persediaan_barang_excel_01',
                array( 'dataProvider'  =>$dataProvider
                ,'tahun'     => $tahun
                ,'id_skpd'     => $id_skpd
                ,'id_barang'   => $id_barang
                ,'nama_barang'   => $nama_barang
                ,'satuan'   => $satuan
                ,'jenis_barang'   => $jenis_barang
                ,'jenis_persediaan'   => $jenis_persediaan

                ,'tgl_mulai'   => $tgl_mulai
                ,'tgl_akhir'   => $tgl_akhir
                ,'id_sumber_dana'   => $id_sumber_dana
                ,'action'   => $action

                ));
        }else {
            if($_POST['action']=='pdf') {

                $mpdf = Yii::createComponent('application.extensions.MPDF56.mpdf', 'win-1252', 'A4');
                $html = Yii::app()->controller->renderPartial('kartu_persediaan_barang_pdf',
                    array(  'dataProvider'  =>$dataProvider
                    ,'tahun'     => $tahun
                    ,'id_skpd'     => $id_skpd
                    ,'id_barang'   => $id_barang
                    ,'nama_barang'   => $nama_barang
                    ,'satuan'   => $satuan
                    ,'jenis_barang'   => $jenis_barang
                    ,'jenis_persediaan'   => $jenis_persediaan

                    ,'tgl_mulai'   => $tgl_mulai
                    ,'tgl_akhir'   => $tgl_akhir
                    ,'id_sumber_dana'   => $id_sumber_dana
                    ,'nama_skpd'   => $nama_skpd

                    ),true);

                $mpdf->WriteHTML($html);
                $mpdf->Output('Cetak_RMP.pdf', 'I');


            }else {
                $this->render('kartu_persediaan_barang',
                    array( 'dataProvider'  =>$dataProvider
                    ,'tahun'     => $tahun
                    ,'id_skpd'     => $id_skpd
                    ,'id_barang'   => $id_barang
                    ,'nama_barang'   => $nama_barang
                    ,'satuan'   => $satuan
                    ,'jenis_barang'   => $jenis_barang
                    ,'jenis_persediaan'   => $jenis_persediaan

                    ,'tgl_mulai'   => $tgl_mulai
                    ,'tgl_akhir'   => $tgl_akhir
                    ,'id_sumber_dana'   => $id_sumber_dana
                    ));
            }


        }
    }

    //--------------------------------------------------------
    public function actionRekapMutasiBarangKegiatan() {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 300);

        if(isset($_POST['ddltahun'])) {
            $tahun   =$_POST['ddltahun'];
        }else  $tahun  =Yii::app()->session['tahun_anggaran'];;

        if(isset($_POST['ddlskpd'])) {
            $id_skpd     =$_POST['ddlskpd'];
        }else
            $id_skpd     =Yii::app()->session['id_skpd'];

        if((isset($_POST['ddlbidang']))or ($_POST['ddlbidang']!='')) {
            $id_bidang     =$_POST['ddlbidang'];
        }else
            $id_bidang     =0;

        if($_POST['action']=='statusdelete') {
            $id_kegiatan     =$_POST['id_kegiatan'];
            Yii::app()->db->createCommand("SELECT * FROM referensi.fndelete_kegiatan($id_kegiatan)")->execute();
        }

        $myquery="SELECT * FROM master.fnlaporan_pengeluaran_perunit($tahun,$id_bidang)";
        $dataProvider=Yii::app()->db->createCommand("$myquery;")->queryAll();
        $this->render('laporan_pengeluaran_perbidang',
            array( 'dataProvider'  =>$dataProvider
            ,'tahun'  =>$tahun
            ,'id_skpd'  =>$id_skpd
            ,'id_bidang'  =>$id_bidang
            ));
    }
    //--------------------------------------------------------
    public function actionDetailMutasiBarangBidang() {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 300);

       $id_barang   =$_POST['id_barang'];
        $tahun   =$_POST['ddltahun'];
        $id_skpd   =$_POST['ddlskpd'];
        $id_bidang   =$_POST['ddlbidang'];

        $RecordData=Yii::app()->db->createCommand("select * from master.fndata_barang($id_barang);")->queryRow();
        $barang = $RecordData['barang'];
        $satuan     = $RecordData['satuan'];


        $myquery="SELECT * FROM master.fndetail_mutasi_barang_perunit($id_barang,$id_bidang)";
        $dataProvider=Yii::app()->db->createCommand("$myquery;")->queryAll();
        $this->render('DetailMutasiBarangBidang',
            array( 'dataProvider'  =>$dataProvider
            ,'tahun'     => $tahun
            ,'id_skpd'   => $id_skpd
            ,'id_bidang'   => $id_bidang
            ,'barang'   => $barang
            ,'satuan'   => $satuan
            ));
    }

    //--------------------------------------------------------

    public function actionCetakExcel()


    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 300);

        if(isset($_POST['ddltahun'])) {
            $tahun   =$_POST['ddltahun'];
        }else  $tahun  =Yii::app()->session['tahun_anggaran'];;

        if(isset($_POST['ddlskpd'])) {
            $id_skpd     =$_POST['ddlskpd'];
        }else
            $id_skpd     =1;

        $RecordData=Yii::app()->db->createCommand("select * from referensi.fndata_skpd($id_skpd);")->queryRow();
        $skpd = $RecordData['nama_skpd'];


        $myquery="SELECT * FROM master.fnrekap_mutasi_persedian($tahun,$id_skpd)";
        $dataProvider=Yii::app()->db->createCommand("$myquery;")->queryAll();
        $this->renderPartial('rekap_mutasi_barang_excel',
            array( 'dataProvider'  =>$dataProvider
            ,'tahun'     => $tahun
            ,'skpd'   => $skpd
            ));

    }


    //--------------------------------------------------------
    public function actionCetakExcelKartu() {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 300);

        $tahun   =$_POST['ddltahun'];
        $id_skpd     =$_POST['ddlskpd'];
        $id_barang  =$_POST['id_barang'];

        $RecordData=Yii::app()->db->createCommand("select * from referensi.fndata_skpd($id_skpd);")->queryRow();
        $skpd = $RecordData['nama_skpd'];

        $RecordData=Yii::app()->db->createCommand("select * from master.fndata_barang('$id_barang');")->queryRow();
        $nama_barang     = $RecordData['nama_barang'];
        $satuan          = $RecordData['satuan'];
        $jenis_barang = $RecordData['jenis_barang'];
        $jenis_persediaan = $RecordData['jenis_persediaan'];

        $myquery="SELECT * FROM master.fnkartu_persediaan_barang($tahun,$id_barang)";
        $dataProvider=Yii::app()->db->createCommand("$myquery;")->queryAll();
        $this->renderPartial('kartu_persediaan_barang_excel',
            array( 'dataProvider'  =>$dataProvider
            ,'tahun'     => $tahun
            ,'id_skpd'     => $id_skpd
            ,'id_barang'   => $id_barang
            ,'nama_barang'   => $nama_barang
            ,'satuan'   => $satuan
            ,'jenis_barang'   => $jenis_barang
            ,'jenis_persediaan'   => $jenis_persediaan
            ,'skpd'     => $skpd


            ));
    }
//--------------------------------------------------------
    public function actionCetakExcelMutasiBarangBidang() {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 300);

        if(isset($_POST['ddltahun'])) {
            $tahun   =$_POST['ddltahun'];
        }else  $tahun  =Yii::app()->session['tahun_anggaran'];;

        if(isset($_POST['ddlskpd'])) {
            $id_skpd     =$_POST['ddlskpd'];
        }else
            $id_skpd     =1;

        $RecordData=Yii::app()->db->createCommand("select * from referensi.fndata_skpd($id_skpd);")->queryRow();
        $skpd = $RecordData['nama_skpd'];

        if((isset($_POST['ddlbidang']))or ($_POST['ddlbidang']!='')) {
            $id_bidang     =$_POST['ddlbidang'];
        }else
            $id_bidang     =0;

        $RecordData=Yii::app()->db->createCommand("select * from referensi.fndata_bidang($id_bidang);")->queryRow();
        $bidang = $RecordData['bidang'];

        if($_POST['action']=='statusdelete') {
            $id_kegiatan     =$_POST['id_kegiatan'];
            Yii::app()->db->createCommand("SELECT * FROM referensi.fndelete_kegiatan($id_kegiatan)")->execute();
        }

        $myquery="SELECT * FROM master.fnlaporan_pengeluaran_perunit($tahun,$id_bidang)";
        $dataProvider=Yii::app()->db->createCommand("$myquery;")->queryAll();
        $this->renderPartial('laporan_pengeluaran_perbidang_excel',
            array( 'dataProvider'  =>$dataProvider
            ,'tahun'  =>$tahun
            ,'id_skpd'  =>$id_skpd
            ,'id_bidang'  =>$id_bidang
            ,'skpd'     => $skpd
            ,'bidang'     =>    $bidang
            ));
    }

    //------------------------------------------------------------------------------------------------------------------
    public function actionCetakRMP() {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 300);

        $mpdf = Yii::createComponent('application.extensions.MPDF56.mpdf', 'win-1252', 'A4');

        $id_pembukuan=$_POST['id_pembukuan'];
        $RecordData=Yii::app()->db->createCommand("select * from keuangan.fndata_pembukuan($id_pembukuan);")->queryRow();
//        $id_jenis_transaksi   =$RecordData['id_jenis_transaksi'];

        $html = Yii::app()->controller->renderPartial('cetak_kuitansi',
            array( 'RecordData'=>$RecordData
            ),true);

        $mpdf->WriteHTML($html);

        $mpdf->Output('cetakalbum.pdf', 'I');
    }
    //--------------------------------------------------------
    public function actionRekapPengeluaranBarang() {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 300);

        if(isset($_POST['id_barang'])) {
            $id_barang   =$_POST['id_barang'];
        }else  $id_barang  =0;

        if(isset($_POST['ddltahun'])) {
            $tahun     =$_POST['ddltahun'];
        }else
            $tahun     =0;


        if(isset($_POST['ddlskpd'])) {
            $id_skpd     =$_POST['ddlskpd'];
        }else
            $id_skpd     =Yii::app()->session['id_skpd'];

        $tgl_mulai     =$_POST['txttgl_mulai'];
        $tgl_akhir=$_POST['txttgl_akhir'];


        $RecordData=Yii::app()->db->createCommand("select * from master.fndata_barang('$id_barang');")->queryRow();
        $nama_barang     = $RecordData['nama_barang'];
        $satuan          = $RecordData['satuan'];

        $RecordData=Yii::app()->db->createCommand("select * from referensi.fndata_skpd('$id_skpd');")->queryRow();
        $nama_skpd     = $RecordData['nama_skpd'];



        $myquery="SELECT * FROM master.fnrekap_pengeluaran_barang($id_barang,$id_skpd,'$tgl_mulai','$tgl_akhir')";
        $dataProvider=Yii::app()->db->createCommand("$myquery;")->queryAll();
        $this->render('rekap_pengeluaran_barang',
            array( 'dataProvider'  =>$dataProvider
            ,'tahun'  =>$tahun
            ,'id_skpd'  =>$id_skpd
            ,'nama_skpd'  =>$nama_skpd
            ,'tgl_mulai'  =>$tgl_mulai
            ,'tgl_akhir'  =>$tgl_akhir
            ,'id_barang'  =>$id_barang
            ,'nama_barang'  =>$nama_barang
            ,'satuan'  =>$satuan
            ));
    }
    //--------------------------------------------------------

    public function actionRekapPengeluaranBarang01() {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 300);

        if(isset($_POST['id_barang'])) {
            $id_barang   =$_POST['id_barang'];
        }else  $id_barang  =0;

        if(isset($_POST['id_bidang_penerima'])) {
            $id_bidang_penerima     =$_POST['id_bidang_penerima'];
        }else
            $id_bidang_penerima     =Yii::app()->session['id_bidang_penerima'];

        if(isset($_POST['ddltahun'])) {
            $tahun     =$_POST['ddltahun'];
        }else
            $tahun     =0;

        if(isset($_POST['ddlskpd'])) {
            $id_skpd     =$_POST['ddlskpd'];
        }else
            $id_skpd     =Yii::app()->session['id_skpd'];

        $tgl_mulai     =$_POST['txttgl_mulai'];
        $tgl_akhir=$_POST['txttgl_akhir'];


        $RecordData=Yii::app()->db->createCommand("select * from master.fndata_barang('$id_barang');")->queryRow();
        $nama_barang     = $RecordData['nama_barang'];
        $satuan          = $RecordData['satuan'];

        $RecordData=Yii::app()->db->createCommand("select * from referensi.fndata_skpd('$id_skpd');")->queryRow();
        $nama_skpd     = $RecordData['nama_skpd'];

        $RecordData=Yii::app()->db->createCommand("select * from referensi.fndata_skpd('$id_bidang_penerima');")->queryRow();
        $nama_skpd_penerima     = $RecordData['nama_skpd'];

        $myquery="SELECT * FROM master.fnrekap_pengeluaran_barang01($id_barang,$id_skpd,'$tgl_mulai','$tgl_akhir',$id_bidang_penerima)";
        $dataProvider=Yii::app()->db->createCommand("$myquery;")->queryAll();
        $this->render('rekap_pengeluaran_barang_01',
            array( 'dataProvider'  =>$dataProvider
            ,'tahun'  =>$tahun
            ,'id_skpd'  =>$id_skpd
            ,'nama_skpd'  =>$nama_skpd
            ,'nama_skpd_penerima'  =>$nama_skpd_penerima
            ,'tgl_mulai'  =>$tgl_mulai
            ,'tgl_akhir'  =>$tgl_akhir
            ,'id_barang'  =>$id_barang
            ,'nama_barang'  =>$nama_barang
            ,'satuan'  =>$satuan
            ));
    }
    //--------------------------------------------------------

    public function actionRekapPengeluaranUnit() {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 300);

        if(isset($_POST['ddltahun'])) {
            $tahun   =$_POST['ddltahun'];
        }else  $tahun  =Yii::app()->session['tahun_anggaran'];;

        if(isset($_POST['ddlskpd'])) {
            $id_skpd     =$_POST['ddlskpd'];
        }

        if(isset($_POST['ddljenisbarang']) and ($_POST['ddljenisbarang']!='')) {
            $id_jenis_barang   =$_POST['ddljenisbarang'];
        }else  $id_jenis_barang  =0;

        if(isset($_POST['txttgl_mulai'])) {
            $tgl_mulai     =$_POST['txttgl_mulai'];
        }else
            $tgl_mulai     ='01/01/'.$tahun;

        if(isset($_POST['txttgl_akhir'])) {
            $tgl_akhir     =$_POST['txttgl_akhir'];
        }else
            $tgl_akhir     ='12/31/'.$tahun;

        if(isset($_POST['ddlskpd']) and $_POST['ddlskpd']!='') {
            // Pilihan SKPD
            $RecordData=Yii::app()->db->createCommand("select * from referensi.fndata_skpd('$id_skpd');")->queryRow();
            $nama_skpd     = $RecordData['nama_skpd'];
            $id_skpd_induk   = $RecordData['id_skpd_induk'];

            $RecordData01=Yii::app()->db->createCommand("select * from master.fngettotal_barang_rusak02($id_skpd,1);")->queryRow();
            $nominalrusak     = $RecordData01['nominal'];
            $RecordData01=Yii::app()->db->createCommand("select * from master.fngettotal_barang_rusak02($id_skpd,2);")->queryRow();
            $nominalusang     = $RecordData01['nominal'];

            if ( Yii::app()->session['level_unit']==2){
                $RecordData=Yii::app()->db->createCommand("select * from referensi.fndata_skpd('$id_skpd_induk');")->queryRow();
                $nama_skpd     = $nama_skpd.' '.substr($RecordData['nama_skpd'],7,100);
            }

            if(isset($_POST['ddljenisbarang']) and $_POST['ddljenisbarang']!='') {
                $myquery="SELECT * FROM master.fnrmp_skpd_jenisbarang($tahun,$id_skpd,'$tgl_mulai','$tgl_akhir',$id_jenis_barang)";
            }else{
                $myquery="SELECT * FROM master.fnrmp_skpd($tahun,$id_skpd,'$tgl_mulai','$tgl_akhir')";
            }

        }else{
            // Pilihan Dinkes
            $id_skpd_induk=Yii::app()->session['id_skpd'];

            if ($id_skpd_induk ==0){
                $nama_skpd     = 'GFK Dan Puskesmas';
                $RecordData01=Yii::app()->db->createCommand("select * from master.fngettotal_barang_rusak_dinkes(1);")->queryRow();
                $nominalrusak     = $RecordData01['nominal'];
                $RecordData01=Yii::app()->db->createCommand("select * from master.fngettotal_barang_rusak_dinkes(2);")->queryRow();
                $nominalusang     = $RecordData01['nominal'];

                if(isset($_POST['ddljenisbarang']) and $_POST['ddljenisbarang']!='') {
                    $myquery="SELECT * FROM master.fnrmp_dinkes_jenisbarang($tahun,0,'$tgl_mulai','$tgl_akhir',$id_jenis_barang)";
                }else{
                    $myquery="SELECT * FROM master.fnrmp_dinkes($tahun,0,'$tgl_mulai','$tgl_akhir')";}
            }else {
                //pilihan puskesmas

                $RecordData=Yii::app()->db->createCommand("select * from referensi.fndata_skpd('$id_skpd_induk');")->queryRow();
                $nama_skpd     = $RecordData['nama_skpd'];
                $nama_skpd     = $nama_skpd.' Dan Unit';

                $RecordData01=Yii::app()->db->createCommand("select * from master.fngettotal_barang_rusak_puskesmas($id_skpd_induk,1);")->queryRow();
                $nominalrusak     = $RecordData01['nominal'];
                $RecordData01=Yii::app()->db->createCommand("select * from master.fngettotal_barang_rusak_puskesmas($id_skpd_induk,2);")->queryRow();
                $nominalusang     = $RecordData01['nominal'];

                if(isset($_POST['ddljenisbarang']) and $_POST['ddljenisbarang']!='') {
                    $myquery="SELECT * FROM master.fnrmp_puskesmas_jenisbarang($tahun,$id_skpd_induk,'$tgl_mulai','$tgl_akhir',$id_jenis_barang)";
                }else{
                    $myquery="SELECT * FROM master.fnrmp_puskesmas($tahun,$id_skpd_induk,'$tgl_mulai','$tgl_akhir')";}

            }

        }

        $dataProvider=Yii::app()->db->createCommand("$myquery;")->queryAll();

        if($_POST['action']=='excel') {
            $action     ='excel';
            $this->renderPartial('rekap_mutasi_barang',
                array( 'dataProvider'  =>$dataProvider
                ,'tahun'     => $tahun
                ,'id_skpd'   => $id_skpd
                ,'tgl_mulai'   => $tgl_mulai
                ,'tgl_akhir'   => $tgl_akhir
                ,'id_sumber_dana'   => $id_sumber_dana
                ,'action'   => $action
                ));
        }else{
            if($_POST['action']=='pdf') {


                $mpdf = Yii::createComponent('application.extensions.MPDF56.mpdf', 'win-1252', 'A4');
                $html = Yii::app()->controller->renderPartial('rekap_mutasi_barang_pdf',
                    array( 'dataProvider'  =>$dataProvider
                    ,'tahun'     => $tahun
                    ,'id_skpd'   => $id_skpd
                    ,'tgl_mulai'   => $tgl_mulai
                    ,'tgl_akhir'   => $tgl_akhir
                    ,'id_sumber_dana'   => $id_sumber_dana
                    ,'nama_skpd'   => $nama_skpd
                    ,'nominalrusak'   => $nominalrusak
                    ,'nominalusang'   => $nominalusang
                    ),true);

                $mpdf->WriteHTML($html);
                $mpdf->Output('Cetak_RMP.pdf', 'I');
            }
            else {
                if($_POST['action']=='pdf_lap') {
                    $dataProvider01=Yii::app()->db->createCommand("select * from referensi.fndaftar_jenis_barang ();")->queryAll();
                    $mpdf = Yii::createComponent('application.extensions.MPDF56.mpdf', 'win-1252', 'A4');
                    $html = Yii::app()->controller->renderPartial('laporan_persediaan_pdf01',
                        array( 'dataProvider'  =>$dataProvider
                        ,'dataProvider01'     => $dataProvider01
                        ,'tahun'     => $tahun
                        ,'id_skpd'   => $id_skpd
                        ,'tgl_mulai'   => $tgl_mulai
                        ,'tgl_akhir'   => $tgl_akhir
                        ,'id_sumber_dana'   => $id_sumber_dana
                        ,'nama_skpd'   => $nama_skpd
                        ),true);

                    $mpdf->WriteHTML($html);
                    $mpdf->Output('Cetak_Laporan.pdf', 'I');
                }else
                    $this->render('rekap_mutasi_barang',
                        array( 'dataProvider'  =>$dataProvider
                        ,'tahun'     => $tahun
                        ,'id_skpd'   => $id_skpd
                        ,'tgl_mulai'   => $tgl_mulai
                        ,'tgl_akhir'   => $tgl_akhir
                        ,'id_sumber_dana'   => $id_sumber_dana
                        ,'action'   => $action
                        ,'id_jenis_barang'   => $id_jenis_barang

                        ));
            }

        }



    }

///--------------------------------------------------------
    public function actionRekapRmpUnit() {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 300);

        if(isset($_POST['ddltahun'])) {
            $tahun   =$_POST['ddltahun'];
        }else  $tahun  =Yii::app()->session['tahun_anggaran'];

        if(isset($_POST['ddlskpd'])) {
            $id_skpd     =$_POST['ddlskpd'];
        }

//        if(isset($_POST['ddljenisbarang']) and ($_POST['ddljenisbarang']!='')) {
//            $id_jenis_barang   =$_POST['ddljenisbarang'];
//        }else  $id_jenis_barang  =0;

        if(isset($_POST['txttgl_mulai'])) {
            $tgl_mulai     =$_POST['txttgl_mulai'];
        }else
            $tgl_mulai     ='01/01/'.$tahun;

        if(isset($_POST['txttgl_akhir'])) {
            $tgl_akhir     =$_POST['txttgl_akhir'];
        }else
            $tgl_akhir     ='12/31/'.$tahun;

        if(isset($_POST['ddlskpd']) and $_POST['ddlskpd']!='') {
            // Pilihan SKPD
            $RecordData=Yii::app()->db->createCommand("select * from referensi.fndata_skpd('$id_skpd');")->queryRow();
            $nama_skpd     = $RecordData['nama_skpd'];
            $id_skpd_induk   = $RecordData['id_skpd_induk'];

            $RecordData01=Yii::app()->db->createCommand("select * from master.fngettotal_barang_rusak02($id_skpd,1);")->queryRow();
            $nominalrusak     = $RecordData01['nominal'];

            $RecordData01=Yii::app()->db->createCommand("select * from master.fngettotal_barang_rusak02($id_skpd,2);")->queryRow();
            $nominalusang     = $RecordData01['nominal'];

            if ( Yii::app()->session['level_unit']==2){
                $RecordData=Yii::app()->db->createCommand("select * from referensi.fndata_skpd('$id_skpd_induk');")->queryRow();
                $nama_skpd     = $nama_skpd.' '.substr($RecordData['nama_skpd'],7,100);
            }


            $myquery="SELECT * FROM master.fnrmp_puskesmas_perunit($id_skpd,'$tgl_mulai','$tgl_akhir')";
        }else
        {
            $myquery="SELECT * FROM master.fnrmp_dinkes_perunit(0,'$tgl_mulai','$tgl_akhir')";
        }
        
        $dataProvider=Yii::app()->db->createCommand("$myquery;")->queryAll();

        $this->render('rekap_rmp_unit',
            array( 'dataProvider'  =>$dataProvider
            ,'tahun'     => $tahun
            ,'id_skpd'   => $id_skpd
            ,'tgl_mulai'   => $tgl_mulai
            ,'tgl_akhir'   => $tgl_akhir
            ,'id_sumber_dana'   => $id_sumber_dana
            ,'action'   => $action
            ,'id_jenis_barang'   => $id_jenis_barang
            ));

    }


}




