<?php

class MonitoringController extends Controller
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
    public function actionRealisasiPengeluaran() {

        if(isset($_POST['ddltahun'])) {
            $tahun_anggaran   =$_POST['ddltahun'];
        }else  $tahun_anggaran   =Yii::app()->session['tahun_anggaran'];;

        if(isset($_POST['ddlunitkerja'])) {
            $id_unitkerja     =$_POST['ddlunitkerja'];
        }else
            $id_unitkerja     =Yii::app()->session['id_unitkerja'];




        $myquery="SELECT * FROM keuangan.fnmonitoring_realisasi_pengeluaran($id_unitkerja,$tahun_anggaran)";
        $dataProvider=Yii::app()->db->createCommand("$myquery;")->queryAll();


        $this->render('realisasi_pengeluaran',
            array( 'dataProvider'  =>$dataProvider,
                'tahun_anggaran'  =>$tahun_anggaran,
                'id_unitkerja'  =>$id_unitkerja

            ));
    }

//--------------------------------------------------------

    public function actionDaftarMonitoringAnggaranUnitkerja() {

        if(isset($_POST['ddltahun'])) {
            $tahun_anggaran   =$_POST['ddltahun'];
        }else  $tahun_anggaran   =2015;

        if(isset($_POST['ddlunitkerja'])) {
            $id_unitkerja     =$_POST['ddlunitkerja'];
        }else
            $id_unitkerja     =Yii::app()->session['id_unitkerja'];

        $RecordData=Yii::app()->db->createCommand("select * from keuangan.fndata_monitoring_anggaran('$tahun_anggaran','$id_unitkerja');")->queryRow();


        $this->render('daftar_monitoring_anggaran_unitkerja',
            array( 'RecordData'  =>$RecordData,
                'tahun_anggaran'  =>$tahun_anggaran,
                'id_unitkerja'  =>$id_unitkerja


    ));
    }


}




