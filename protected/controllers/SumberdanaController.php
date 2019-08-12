<?php

class SumberdanaController extends Controller
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
    public function actionDaftarJenisPersediaan() {

      if($_POST['action']=='statusdelete') {
          $id_jenis_persediaan     =$_POST['id_jenis_persediaan'];
            Yii::app()->db->createCommand("SELECT * FROM referensi.fndelete_jenis_persediaan($id_jenis_persediaan)")->execute();
       }

        $myquery="SELECT * FROM referensi.fndaftar_jenis_persediaan()";
        $dataProvider=Yii::app()->db->createCommand("$myquery;")->queryAll();
        $this->render('daftar_jenis_persediaan',
            array( 'dataProvider'  =>$dataProvider
    ));
    }

    //--------------------------------------------------------
    public function actionInsertJenisPersediaan() {

        $statussimpan   ='';

      if(isset($_POST['statussimpan'])) {
            $jenis_persediaan     = $_POST['txtjenis_persediaan'];

            Yii::app()->db->createCommand("SELECT * FROM referensi.fninsert_jenis_persediaan
                  ('$jenis_persediaan'
                  ) ")->execute();
            $statussimpan="Data Telah Tersimpan" ;
        }

        $this->render('insert_jenis_persediaan',array(''
        ,'statussimpan'     => $statussimpan
        , 'jenis_persediaan'  =>$jenis_persediaan

        ));
    }


    //--------------------------------------------------------
    public function actionEditJenisPersediaan() {

        $statussimpan   ='';
        $id_jenis_persediaan      = $_POST['id_jenis_persediaan'];
        $RecordData=Yii::app()->db->createCommand("select * from referensi.fndata_jenis_persediaan($id_jenis_persediaan);")->queryRow();
        $jenis_persediaan        = $RecordData['jenis_persediaan'];


        if(isset($_POST['statussimpan'])) {
            $jenis_persediaan     = $_POST['txtjenis_persediaan'];

            Yii::app()->db->createCommand("SELECT * FROM referensi.fnedit_jenis_persediaan
                  ($id_jenis_persediaan,
                   '$jenis_persediaan'
                  ) ")->execute();
            $statussimpan="Data Telah Tersimpan" ;
        }

        $this->render('insert_jenis_persediaan',array(''
        ,'statussimpan'     => $statussimpan
        , 'id_jenis_persediaan'  =>$id_jenis_persediaan
        , 'jenis_persediaan'  =>$jenis_persediaan

        ));
    }


}




