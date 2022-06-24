<?php

class DashboardController extends Controller
{
	public $layout='//layouts/main';
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
    public function actionLevel ($id_user){

    $dbcmd = Yii::app()->db->createCommand("
    SELECT
    t1.id_user,
    t1.username,
    t1.pasword,
    t1.id_pegawai,
    t1.kd_jabatan,
    t1.kd_klinik,
    t2.jabatan,
    t3.nama,
    t4.klinik
    FROM support.user t1
    LEFT JOIN support.jabatan t2 on t1.kd_jabatan=t2.kd_jabatan
    LEFT JOIN public.pegawai t3 on t1.id_pegawai=t3.id_pegawai
    LEFT JOIN support.klinik t4 on t1.kd_klinik=t4.kd_klinik      
    Where t1.id_user='$id_user';
    ")->queryAll();

    Yii::app()->session['statuslogin'] =true;
    Yii::app()->session['id_user'] =$dbcmd[0]['id_user'];
    Yii::app()->session['username'] =$dbcmd[0]['username']; 
    Yii::app()->session['id_pegawai'] =$dbcmd[0]['id_pegawai'];
    Yii::app()->session['kd_jabatan'] =$dbcmd[0]['kd_jabatan'];
    Yii::app()->session['kd_klinik'] =$dbcmd[0]['kd_klinik'];
    Yii::app()->session['nama'] =$dbcmd[0]['nama']; 
    Yii::app()->session['jabatan'] =$dbcmd[0]['jabatan'];      
    Yii::app()->session['klinik'] =$dbcmd[0]['klinik'];
       
 	$this->redirect(array("Dashboard/Dashboard"));
	
}

 public function actionDashboard() {
    if (Yii::app()->session['statuslogin'] <>true) { $this->redirect(array("site/logout"));}

    if(isset($_POST['ddltahun'])) {
        $tahun_anggaran   =$_POST['ddltahun'];
    }else  $tahun_anggaran  =Yii::app()->session['tahun_anggaran'];
    
    if(Yii::app()->session['id_level']=='1' or Yii::app()->session['id_level']=='14' ){
        // $id_unitkerja=Yii::app()->session['id_unitkerja'];
        $id_unitkerja='%';
    }else{
        if(isset($_POST['ddlunitkerja'])and ($_POST['ddlunitkerja']!='')) {
            $id_unitkerja   =$_POST['ddlunitkerja'];
        }else  {$id_unitkerja  ='%'; }
    }

    // $sql="SELECT id_jenis_pengadaan
    //                 ,t2.uraian as jenis_pengadaan
    //                 ,count(*) as jmlpaket
    //                 ,sum(jumlah) as jmlpagu
    //                 ,count(CASE WHEN id_metode_pemilihan=1 THEN id_jenis_pengadaan END)as jmlpaket1
    //                 ,sum(CASE WHEN id_metode_pemilihan=1 THEN jumlah END)as jmlpagu1
    //                 ,count(CASE WHEN id_metode_pemilihan=2 THEN id_jenis_pengadaan END)as jmlpaket2
    //                 ,sum(CASE WHEN id_metode_pemilihan=2 THEN jumlah END)as jmlpagu2
    //                 ,count(CASE WHEN id_metode_pemilihan=3 THEN id_jenis_pengadaan END)as jmlpaket3
    //                 ,sum(CASE WHEN id_metode_pemilihan=3 THEN jumlah END)as jmlpagu3
    //                 ,count(CASE WHEN id_metode_pemilihan=4 THEN id_jenis_pengadaan END)as jmlpaket4
    //                 ,sum(CASE WHEN id_metode_pemilihan=4 THEN jumlah END)as jmlpagu4  

                    
    //                 ,count(CASE WHEN flag =1 THEN flag END)as jmlkontrak
    //                 ,sum(CASE WHEN flag =1 THEN jumlah END)as nilaikontrak 
    //                 ,count(CASE WHEN id_metode_pemilihan=1 and flag =1 THEN id_jenis_pengadaan END)as jmlkontrak1
    //                 ,sum(CASE WHEN id_metode_pemilihan=1 and flag =1 THEN jumlah END)as nilaikontrak1
    //                 ,count(CASE WHEN id_metode_pemilihan=2 and flag =1 THEN id_jenis_pengadaan END)as jmlkontrak2
    //                 ,sum(CASE WHEN id_metode_pemilihan=2 and flag =1 THEN jumlah END)as nilaikontrak2
    //                 ,count(CASE WHEN id_metode_pemilihan=3 and flag =1 THEN id_jenis_pengadaan END)as jmlkontrak3
    //                 ,sum(CASE WHEN id_metode_pemilihan=3 and flag =1 THEN jumlah END)as nilaikontrak3
    //                 ,count(CASE WHEN id_metode_pemilihan=4 and flag =1 THEN id_jenis_pengadaan END)as jmlkontrak4
    //                 ,sum(CASE WHEN id_metode_pemilihan=4 and flag =1 THEN jumlah END)as nilaikontrak4 
                      
    //             FROM  keuangan.rup t1
    //             left join keuangan.jenis_pengadaan t2 on t1.id_jenis_pengadaan=t2.id
    //             WHERE t1.tahun_anggaran=:tahun_anggaran 
    //             and CAST( t1.id_unitkerja AS TEXT ) like CAST( :id_unitkerja AS TEXT )  
    //             group by t1.id_jenis_pengadaan, t2.uraian 
    //             order by id_jenis_pengadaan;
    //             ";

    //     $cmd = Yii::app()->db->createCommand($sql);
    //     $cmd->bindValue(':tahun_anggaran', $tahun_anggaran);
    //     $cmd->bindValue(':id_unitkerja', $id_unitkerja);   
    //     $dataProvider = $cmd->queryAll();      
      

    //     $sql="SELECT 
    //     t4.id_level
    //    , t4.level
    //    ,count(*)jmlpaket
        
    //    FROM 
    //      pbj.rup t1 
    //      left join pbj.rup_approvel t2  on t1.id_approvel=t2.id_approvel
    //      left join pbj.kode_proses t3 on t2.id_proses=t3.id_proses
    //      left join pbj.level t4 on t3.id_level_user=t4.id_level
    //     where t1.tahun_anggaran=:tahun_anggaran 
    //     group by t4.id_level, t4.level
    //     order by t4.no_urut";

    //     $cmd = Yii::app()->db->createCommand($sql);
    //     $cmd->bindValue(':tahun_anggaran', $tahun_anggaran);
    //     $dataProses = $cmd->queryAll(); 

    $this->render('dashboard',
        array(  'dataProvider'  =>$dataProvider,
                'dataProses'    =>$dataProses,
                'tahun_anggaran'  =>$tahun_anggaran,
                'id_unitkerja'  =>$id_unitkerja
           
        ));
}

//--------------------------------------------------------




}




