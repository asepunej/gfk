<?php

class PoliklinikController extends Controller
{
	public $layout='//layouts/main';
    public $f;

    public function init(){
        parent::init();
        $this->f = Yii::createComponent('application.extensions.format.format');
    }

	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('Daftar'),
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

    public function actionJava1() {

        $this->render('java1',
                array( 'dataProvider'  =>$dataProvider,

                
                ));
    }

//--------------------------------------------------------
    public function actionDaftarRegistrasi() {

       if(isset($_POST['txttgl'])and ($_POST['txttgl']!='')) {
            $tgl  =$_POST['txttgl'];           
        }else  $tgl=date('d-m-Y'); 
       
        $kd_klinik=Yii::app()->session['kd_klinik'];
        
        if($_POST['action']=='statusdelete') {
            $cmd = Yii::app()->db->createCommand();
            $cmd->delete('public.registrasi', 'id_registrasi=:id_registrasi', array(':id_registrasi' => $_POST['id_registrasi']));
        } 

        $sql="SELECT 
                t1.id_registrasi,       
                t1.kd_jenis_daftar,       
                t1.kd_jenis_pembayaran,      
                t1.kd_klinik,     
                t1.id_medis,
                t1.id_petugas,
                t1.id_user,
                t1.tgl,       
                t2.nama,
                t2.no_rm,
                t2.alamat,
                t2.kd_kota_alamat,
                t2.nik,
                t2.notelp,
                t2.nama_pj,
                t3.jenis_daftar,
                t4.jenis_pembayaran,
                t5.klinik,
                t6.kabupaten,
                t7.provinsi,
                t8.jenis_kelamin,
                t2.tgl_lahir,
                EXTRACT(year FROM AGE(t2.tgl_lahir))umur,
                t9.nama as nama_dokter        
            FROM public.registrasi t1
            LEFT JOIN public.pasien t2 on t1.no_rm=t2.no_rm
            LEFT join support.jenis_daftar t3 on t1.kd_jenis_daftar=t3.kd_jenis_daftar
            LEFT join support.jenis_pembayaran t4 on t1.kd_jenis_pembayaran=t4.kd_jenis_pembayaran
            LEFT join support.klinik t5 on t1.kd_klinik=t5.kd_klinik
            LEFT join support.kabupaten t6 on t2.kd_kota_alamat=t6.kdkabupaten
            LEFT join support.provinsi t7 on t6.kdprovinsi=t7.kdprovinsi
            LEFT join support.jenis_kelamin t8 on t2.kd_jenis_kelamin=t8.kd_jenis_kelamin
            LEFT join public.staf t9 on t1.id_medis=t9.id_staf
            WHERE to_char(t1.tgl,'dd-mm-yyyy')='$tgl'
             AND t1.kd_klinik='$kd_klinik'
            Order by t1.tgl desc";
                
    $cmd = Yii::app()->db->createCommand($sql);  
    $dataProvider = $cmd->queryAll();      
  
    $this->render('pasien',
        array( 'dataProvider'  =>$dataProvider,
            'tgl'  =>$tgl
            
        ));
}
   
//--------------------------------------------------------

    public function actionInsertRegistrasi() {
       
        $statussimpan   ='';      
        if($_POST['action']=='simpan') {   
            if($_POST['no_rm']=='') {    
                 
                    //input tabel Pasien        
                    $cmd = Yii::app()->db->createCommand();
                    $cmd->insert('public.pasien', array(                       
                        'kd_jenis_pasien'=> $_POST['kd_jenis_pasien'],
                        'nik'=> $_POST['nik'],
                        'nama' => $_POST['nama'],
                        'kd_jenis_kelamin'  => $_POST['kd_jenis_kelamin'],                
                        'kd_kota_lahir' => $_POST['kd_kota_lahir'],
                        'tgl_lahir' => $_POST['tgl_lahir'],
                        'alamat' => $_POST['alamat'],
                        'kd_kota_alamat'  => $_POST['kd_kota_alamat'],
                        'kd_agama'  => $_POST['kd_agama'],
                        'kd_status_kawin'  =>$_POST['kd_status_kawin'],
                        'kd_pendidikan'  => $_POST['kd_pendidikan'],
                        'kd_pekerjaan'  => $_POST['kd_pekerjaan'],
                        'kd_suku'  => $_POST['kd_suku'],
                        'kd_bahasa'  => $_POST['kd_bahasa'],
                        'notelp'  => $_POST['notelp'],
                        'nama_pj'  => $_POST['nama_pj']
                        ));                    
                    $RecordData=Yii::app()->db->createCommand("SELECT max(no_rm) no_rm FROM public.pasien;")->queryRow();           
                    $no_rm=$RecordData[no_rm];

                        // input tabel registrasi
                        $cmd = Yii::app()->db->createCommand();
                        $cmd->insert('public.registrasi', array(                       
                            'no_rm'=> $no_rm,
                            'kd_jenis_daftar'=> $_POST['kd_jenis_daftar'],
                            'kd_jenis_pembayaran' => $_POST['kd_jenis_pembayaran'],
                            'kd_klinik'  => $_POST['kd_klinik'],                
                            'id_medis' => $_POST['id_medis'],
                            'id_petugas' => Yii::app()->session['id_user'],
                            'id_user' => Yii::app()->session['id_user'],
                            'tgl'  =>date("Y-m-d h:i:sa"), 
                            'kd_klinik_reg'  =>  Yii::app()->session['kd_klinik'],                          
                            ));
                        $RecordData=Yii::app()->db->createCommand("SELECT max(id_registrasi) id_registrasi FROM public.registrasi;")->queryRow();           
                        $id_registrasi=$RecordData[id_registrasi];
                      
                    }
        else {
            $no_rm=$_POST['no_rm'];
            $cmd = Yii::app()->db->createCommand();
                    $cmd->update('public.pasien', array(                                           
                        'kd_jenis_pasien'=> $_POST['kd_jenis_pasien'],
                        'nik'=> $_POST['nik'],
                        'nama' => $_POST['nama'],
                        'kd_jenis_kelamin'  => $_POST['kd_jenis_kelamin'],                
                        'kd_kota_lahir' => $_POST['kd_kota_lahir'],
                        'tgl_lahir' => $_POST['tgl_lahir'],
                        'alamat' => $_POST['alamat'],
                        'kd_kota_alamat'  => $_POST['kd_kota_alamat'],
                        'kd_agama'  => $_POST['kd_agama'],
                        'kd_status_kawin'  =>$_POST['kd_status_kawin'],
                        'kd_pendidikan'  => $_POST['kd_pendidikan'],
                        'kd_pekerjaan'  => $_POST['kd_pekerjaan'],
                        'kd_suku'  => $_POST['kd_suku'],
                        'kd_bahasa'  => $_POST['kd_bahasa'],
                        'notelp'  => $_POST['notelp'],
                        'nama_pj'  => $_POST['nama_pj']
                    ), 'no_rm=:no_rm', array(':no_rm' => $_POST['no_rm']));

                     $cmd = Yii::app()->db->createCommand();
                        $cmd->insert('public.registrasi', array(                       
                            'no_rm'=> $no_rm,
                            'kd_jenis_daftar'=> $_POST['kd_jenis_daftar'],
                            'kd_jenis_pembayaran' => $_POST['kd_jenis_pembayaran'],
                            'kd_klinik'  => $_POST['kd_klinik'],               
                            'id_medis' => $_POST['id_medis'],
                            'id_petugas' => Yii::app()->session['id_user'],
                            'id_user' => Yii::app()->session['id_user'],
                            'tgl'  =>date("Y-m-d h:i:sa"),
                            'kd_klinik_reg'  =>  Yii::app()->session['kd_klinik'],                         
                            ));
         }
         $RecordData=Yii::app()->db->createCommand(" SELECT * FROM public.pasien where no_rm='$no_rm';")->queryRow(); 

        $statussimpan=true ;            
        $this->redirect(array("Poliklinik/DaftarRegistrasi"));
        
        }

    // Kode Status Pasien
    $dbcmd = Yii::app()->db->createCommand("SELECT kd_status_pasien,status_pasien FROM support.status_pasien ;")->queryAll();
    $tbl_statuspasien = CHtml::listData($dbcmd,'kd_status_pasien','status_pasien');

    // Kode Jenis Pasien
    $dbcmd = Yii::app()->db->createCommand("SELECT kd_jenis_pasien, jenis_pasien FROM support.jenis_pasien ;")->queryAll();
    $tbl_Jenispasien = CHtml::listData($dbcmd,'kd_jenis_pasien','jenis_pasien');

    // Kode Jenis Kelamin
    $dbcmd = Yii::app()->db->createCommand("SELECT kd_jenis_kelamin,  jenis_kelamin FROM support.jenis_kelamin;")->queryAll();
    $tbl_Jeniskelamin = CHtml::listData($dbcmd,'kd_jenis_kelamin','jenis_kelamin');

    // Kode Agama
    $dbcmd = Yii::app()->db->createCommand("SELECT kd_agama, agama FROM support.agama ;")->queryAll();
    $tbl_Agama = CHtml::listData($dbcmd,'kd_agama','agama');

    // Kode Status Kawin
    $dbcmd = Yii::app()->db->createCommand("SELECT kd_status_kawin,status_kawin FROM support.status_kawin ;")->queryAll();
    $tbl_Statuskawin = CHtml::listData($dbcmd,'kd_status_kawin','status_kawin');

    // Kode Pendidikan
    $dbcmd = Yii::app()->db->createCommand("SELECT kd_pendidikan, pendidikan FROM support.pendidikan ;")->queryAll();
    $tbl_Pendidikan = CHtml::listData($dbcmd,'kd_pendidikan','pendidikan');

    // Kode Pekerjaan
    $dbcmd = Yii::app()->db->createCommand("SELECT kd_pekerjaan,pekerjaan FROM support.pekerjaan ;")->queryAll();
    $tbl_Pekerjaan = CHtml::listData($dbcmd,'kd_pekerjaan','pekerjaan');

    // Kode Suku
    $dbcmd = Yii::app()->db->createCommand("SELECT kd_suku,suku FROM support.suku ;")->queryAll();
    $tbl_Suku = CHtml::listData($dbcmd,'kd_suku','suku');    
    
    // Kode Bahasa
    $dbcmd = Yii::app()->db->createCommand("SELECT kd_bahasa,bahasa FROM support.bahasa ;")->queryAll();
    $tbl_Bahasa = CHtml::listData($dbcmd,'kd_bahasa','bahasa');    


    // Kode Kabupaten
    $dataKab=Yii::app()->db->createCommand("SELECT kdkabupaten,kabupaten FROM support.kabupaten;")->queryAll();
    $tbl_Kab = CHtml::listData($dataKab,'kdkabupaten','kabupaten');

    // Kode Provinsi
    $dataProv=Yii::app()->db->createCommand("SELECT kdprovinsi,provinsi FROM support.provinsi;")->queryAll();
    $tbl_Prov = CHtml::listData($dataProv,'kdprovinsi','provinsi');

    // Kode Jenis Daftar
    $dbcmd=Yii::app()->db->createCommand("SELECT  kd_jenis_daftar,jenis_daftar FROM support.jenis_daftar ;")->queryAll();
    $tbl_jenisdaftar = CHtml::listData($dbcmd,'kd_jenis_daftar','jenis_daftar');

    // Kode Pembayaran
    $dbcmd=Yii::app()->db->createCommand("SELECT kd_jenis_pembayaran,jenis_pembayaran FROM support.jenis_pembayaran ;")->queryAll();
    $tbl_Pembayaran = CHtml::listData($dbcmd,'kd_jenis_pembayaran','jenis_pembayaran');

     // Kode Tujuan Klinik
     $dbcmd=Yii::app()->db->createCommand("SELECT kd_klinik, klinik FROM support.klinik order by kd_klinik ")->queryAll();
     $tbl_klinik = CHtml::listData($dbcmd,'kd_klinik','klinik');

     // Kode Pilihan Medis
     $dbcmd=Yii::app()->db->createCommand("SELECT kd_pilihan_medis, pilihan_medis FROM support.pilihan_medis ;")->queryAll();
     $tbl_pilihan_medis = CHtml::listData($dbcmd,'kd_pilihan_medis','pilihan_medis');

    
    $dataPasien=Yii::app()->db->createCommand("SELECT no_rm, no_rm||' | '||nama||' | '|| alamat as  nama  FROM public.pasien ;")->queryAll();
    $dataDokter=Yii::app()->db->createCommand("SELECT t1.id_staf,t1.nip,t1.nama || ' - '||t2.jabatan as nama FROM public.staf t1 
                                                LEFT JOIN support.jabatan t2 on t1.kd_jabatan=t2.kd_jabatan
                                                where t1.kd_jabatan in ('1','2','3') ORDER BY t1.kd_jabatan ")->queryAll();

    $dataPetugas=Yii::app()->db->createCommand("SELECT t1.id_staf,t1.nip,t1.nama|| ' - '||t2.jabatan as nama  FROM public.staf t1 
                                                LEFT JOIN support.jabatan t2 on t1.kd_jabatan=t2.kd_jabatan
                                                where t1.kd_jabatan in ('4','5','6') ORDER BY t1.kd_jabatan")->queryAll();
    if($_POST['action']=='cari') {
        if ($_POST['no_rm']>0){$no_rm=$_POST['no_rm'];} else{$no_rm=0;} ;
        $RecordData = Yii::app()->db->createCommand("SELECT 
        no_rm,
        kd_jenis_pasien,
        nik,
        nama,
        kd_jenis_kelamin,
        kd_kota_lahir,
        tgl_lahir,
        alamat,
        kd_kota_alamat,
        kd_agama,
        kd_status_kawin,
        kd_pendidikan,
        kd_pekerjaan,
        kd_suku,
        kd_bahasa,
        notelp,
        nama_pj
      FROM 
        public.pasien where no_rm='$no_rm';")->queryRow();
     }
    
  
        $this->render('insert_registrasi',array(   
             'tbl_statuspasien'     => $tbl_statuspasien                
            ,'tbl_Jenispasien'     => $tbl_Jenispasien
            ,'tbl_Jeniskelamin'     => $tbl_Jeniskelamin
            ,'tbl_Agama'     => $tbl_Agama
            ,'tbl_Statuskawin'     => $tbl_Statuskawin
            ,'tbl_Pendidikan'     => $tbl_Pendidikan
            ,'tbl_Pekerjaan'     => $tbl_Pekerjaan
            ,'tbl_Suku'     => $tbl_Suku
            ,'tbl_Bahasa'     => $tbl_Bahasa     
            

            ,'tbl_Prov'     => $tbl_Prov
            ,'tbl_Kab'     => $tbl_Kab           
            ,'tbl_jenisdaftar'     => $tbl_jenisdaftar
            ,'tbl_Pembayaran'     => $tbl_Pembayaran
            ,'tbl_klinik'     => $tbl_klinik
            ,'tbl_pilihan_medis'     => $tbl_pilihan_medis
           
            ,'dataKab'     => $dataKab
            ,'dataPasien'     => $dataPasien
            ,'dataDokter'     => $dataDokter
            ,'dataPetugas'     => $dataPetugas
            
            ,'RecordData'     => $RecordData
            ,'statussimpan'     => $statussimpan
            
        ));
    }


    public function actionIsiKab()
    {
        $kdprovinsi = $_POST['kdprovinsi'];
        $dataKab     = Yii::app()->db->createCommand("SELECT kdkabupaten,kabupaten FROM support.kabupaten where kdprovinsi='$kdprovinsi';")->queryAll();
        $tbl_Kab = CHtml::listData($dataKab,'kdkabupaten','kabupaten');       
        echo CHtml::dropDownList('ddlkabupaten','',$tbl_Kab);
    }


}




