<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
    <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
     
          <!-- Be sure to leave the brand out there if you want it shown -->
          <a class="brand" href="#">Gudang Farmasi Kabupaten</a>
          
          <div class="nav-collapse">
			<?php $this->widget('zii.widgets.CMenu',array(
                    'htmlOptions'=>array('class'=>'pull-right nav'),
                    'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),
					'itemCssClass'=>'item-test',
                    'encodeLabel'=>false,
                'items'=>array(
                    //array('label'=>'Dashboard', 'url'=>array('/site/index')),
                     //  array('label'=>'Home', 'url'=>array('/site/index'), 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>'Dashboard', 'url'=>array('/Simangga/Chat'), 'visible'=>Yii::app()->session['statuslogin']),

                    array('label'=>'Data Pendukung <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
                        'items'=>array(
                            array('label'=>'Kode Jenis Persediaan', 'url'=>array("/Jenispersediaan/DaftarJenisPersediaan")),
                            array('label'=>'Kode Jenis Barang', 'url'=>array("/Jenisbarang/DaftarJenisbarang")),
                            array('label'=>'Kode Obat', 'url'=>array("/Barang/DaftarBarang")),
                            array('label'=>'Daftar Puskesmas', 'url'=>array("/Skpd/DaftarSkpd")),
                            array('label'=>'Daftar Unit Puskesmas ', 'url'=>array('/Bidang/DaftarBidang')),
                            array('label'=>'Daftar Sumber Dana', 'url'=>array("/Sumberdana/DaftarSumberdana")),
                            array('label'=>'Daftar Distributor', 'url'=>array("/Distributor/DaftarDistributor")),
                            array('label'=>'Daftar Perusahaan', 'url'=>array("/Perusahaan/DaftarPerusahaan")),

                        ), 'visible'=>Yii::app()->session['statuslogin']),

                    array('label'=>'Data Transaksi  <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
                        'items'=>array(
                            array('label'=>'Persediaan Masuk', 'url'=>array("/Penerimaan/DaftarPenerimaan")),
                            array('label'=>'Persedian Keluar', 'url'=>array("/Pengeluaran/DaftarPengeluaran")),
                            array('label'=>'Opname Fisik  ', 'url'=>array('/Transaksi/Opname Fisik')),

                        ), 'visible'=>Yii::app()->session['statuslogin']),

                    array('label'=>'Laporan <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
                        'items'=>array(
                            array('label'=>'Rekap Mutasi Barang ', 'url'=>array('/Rekap/RekapMutasiBarang')),
                            array('label'=>'Laporan Persediaan', 'url'=>array('/Rekap/LaporanPersediaan')),
                            array('label'=>'Rekap Mutasi Barang Puskesmas ', 'url'=>array('/Rekap/RekapMutasiBarangKegiatan')),
                            array('label'=>'Rekap Mutasi Barang Global', 'url'=>array('/Rekap/RekapRmpUnit')),

                        ), 'visible'=>Yii::app()->session['statuslogin']),


                    array('label'=>'Profil <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
                        'items'=>array(
                            array('label'=>'Ubah Profil ', 'url'=>array('/Simangga/PenggunaEdit&id_user='.Yii::app()->session['id_user'].'&level='.Yii::app()->session['level'].'')),
                            ), 'visible'=>Yii::app()->session['statuslogin']&& (Yii::app()->session['level']==1 or Yii::app()->session['level']==9 or Yii::app()->session['level']==11 or Yii::app()->session['level']==12 or Yii::app()->session['level']==4)),

                    array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>!Yii::app()->session['statuslogin'],'linkOptions'=>array("data-description"=>"member area")),
                    array('label'=>'Logout ('.Yii::app()->session['nama'].')', 'url'=>array('/site/logout'),  'visible'=>Yii::app()->session['statuslogin']),

                ),
            )); ?>
          </div>
    </div>
    </div>
</div>
<div class="subnav navbar navbar-fixed-top">
    <div class="navbar-inner">
    	<div class="container">
        
        	<div class="style-switcher pull-left">
                <a href="javascript:chooseStyle('none', 60)" checked="checked"><span class="style" style="background-color:#468847;"></span></a>
                <a href="javascript:chooseStyle('style2', 60)"><span class="style" style="background-color:#7c5706;"></span></a>
                <a href="javascript:chooseStyle('style3', 60)"><span class="style" style="background-color:#0000FF;"></span></a>
                <a href="javascript:chooseStyle('style4', 60)"><span class="style" style="background-color:#4e4e4e;"></span></a>
                <a href="javascript:chooseStyle('style5', 60)"><span class="style" style="background-color:#d85515;"></span></a>
                <a href="javascript:chooseStyle('style6', 60)"><span class="style" style="background-color:#a00a69;"></span></a>
                <a href="javascript:chooseStyle('style7', 60)"><span class="style" style="background-color:#a30c22;"></span></a>
          	</div>
           <form class="navbar-search pull-right" action="">
           	 
           <input type="text" class="search-query span2" placeholder="Search">
           
           </form>
    	</div><!-- container -->
    </div><!-- navbar-inner -->
</div><!-- subnav -->
