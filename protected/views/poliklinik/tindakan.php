<script type="text/javascript">
 

    function cetak_info() {
        var url = '/index.php?r=Rup/InfoRup';
        var form = $('<form action="' + url + '" method="POST" + target=_blank>' +
            '<input type="hidden" name="action" value="cetak_info" />' +
            '<input type="hidden" name="id_rup" value="' + $('#id_rup').val() + '" />' +

            '</form>');
        $('body').append(form);
        $(form).submit();
    }
    
 function databaru() {       
    document.getElementById("id_approvel").value = '' ;   
    document.getElementById("txtcatatan").value = '' ;           
  }

function editdata(id_approvel,catatan) {       
       document.getElementById("id_approvel").value = id_approvel ;
       document.getElementById("txtcatatan").value =catatan ;   
 }

function simpanData() {   
  theConfirm = "Yakin akan Paket akan diproses : ";
      // theConfirm += uraian + "?";
      var go = confirm(theConfirm);
      if (go == true) {  
      var url = '/index.php?r=Rup/InfoRup';
          var form = $('<form action="' + url + '" method="POST" id="theForm">' +
          '<input type="hidden" name="action" value="simpan" />' +            
          '<input type="hidden" name="id_approvel" value="' + $('#id_approvel').val() + '" />' +     
          '<input type="hidden" name="id_rup" value="' + $('#id_rup').val() + '" />' +
          '<input type="hidden" name="catatan" value="' + $('#txtcatatan1').val() + '" />' +         
          '<input type="hidden" name="id_proses" value="' + $('#ddlproses').val() + '" />' +            

          '</form>');
          $('body').append(form);
          $(form).submit();
      }
 }
 function InputLsSimkeu() {   
  theConfirm = "Yakin Data akan diproses ke LS SIMKEU ? ";
      // lltheConfirm += uraian + "?";
      var go = confirm(theConfirm);
      if (go == true) {  
        var url = '/index.php?r=Rup/InfoRup';
          var form = $('<form action="' + url + '" method="POST" id="theForm">' +
          '<input type="hidden" name="action" value="inputlssimkeu" />' +                
          '<input type="hidden" name="id_rup" value="' + $('#id_rup').val() + '" />' +
        
          '</form>');
          $('body').append(form);
          $(form).submit();
      }
 }

 function InputRupSimkeu() {   
  theConfirm = "Yakin Data akan diproses ke RUP SIMKEU ? ";
      // theConfirm += uraian + "?";
      var go = confirm(theConfirm);
      if (go == true) {  
        var url = '/index.php?r=Rup/InfoRup';
          var form = $('<form action="' + url + '" method="POST" id="theForm">' +
          '<input type="hidden" name="action" value="inputrupsimkeu" />' +                
          '<input type="hidden" name="id_rup" value="' + $('#id_rup').val() + '" />' +
        
          '</form>');
          $('body').append(form);
          $(form).submit();
      }
 }


 function deletedata(id_approvel,uraian){
      theConfirm = "Anda yakin ingin menghapus data ? ";
      theConfirm += uraian + "?";
      var go = confirm(theConfirm);
      if (go == true) {
          var url = '/index.php?r=Rup/InfoRup';
          var form = $('<form action="' + url + '" method="POST">' +             
              '<input type="hidden" name="action" value="delete" />' +
              '<input type="hidden" name="id_approvel" value="' + id_approvel + '" />' +
              '<input type="hidden" name="id_rup" value="' + $('#id_rup').val() + '" />' +  
              '</form>');
          $('body').append(form);
          $(form).submit();
      }
  }


			function Kembali(){
            var url = '/index.php?r=Rup/DaftarRup';
            var form = $('<form action="' + url + '" method="POST">' +
                '<input type="hidden" name="ddltahun" value="' + $('#tahun_anggaran').val() + '" />' +   
                '<input type="hidden" name="ddlunitkerja" value="' + $('#id_unitkerja').val() + '" />' + 
                // '<input type="hidden" name="ddlmetodepemilihan" value="' + $('#id_metode_pemilihan').val() + '" />' + 
                // '<input type="hidden" name="ddljenispengadaan" value="' + $('#id_jenis_pengadaan').val() + '" />' + 
                
                '</form>');
            $('body').append(form);
            $(form).submit();
    }
   
      function editpaket(id)
    {
        var url = '/index.php?r=Rup/EditRup';
        var form = $('<form action="' + url + '" method="POST">' +
            '<input type="hidden" name="id_rup" value="' + id + '" />' +			  
            '</form>');
        $('body').append(form);
        $(form).submit();
    }
</script>
<style type="text/css">
<!--
.style1 {color: #FF0000}
.style6 {color: #000000}
-->
</style>



<div class="card card-info">            
<div class="card-header">
    <h3 class="card-title">INFO PAKET PENGADAAAN BARANG JASA </h3>
</div>        
<div class="card-body">

<h5><b>1.Data Paket</b></h5>  
   

<div align="left">
    <table class="table table-bordered" width="100%" >
        <tr>
          <td width="20%" valign="top">Tahun - Sumber Dana </td>
          <td width="70%" valign="top"><?php echo $dataRup['tahun_anggaran']." | ". $dataRup['beban_anggaran'] ?></td>
        </tr>
        <tr>
          <td valign="top">Nama Paket </td>
          <td valign="top"><?php echo 'ID-'.  $dataRup['id'].' | '. $dataRup['uraian']?></td>
        </tr>
        <tr>
          <td valign="top">Unit kerja  </td>
          <td valign="top"><?php echo $dataRup['nama_unitkerja']?></td>
        </tr>
        <tr>
          <td width="20%" valign="top">Beban Anggaran </td>
          <td width="70%" valign="top"><kbd><?php echo $dataRup['nama_unitkerja_beban']?></kbd></td>
        </tr>
        
        <tr>
          <td width="20%" valign="top"> Akun </td>
          <td width="70%" valign="top"><?php echo $dataRup['kd_mak']?><br>
          <?php echo $dataRup['uraian_mak']?> 

          <?php if(Yii::app()->session['id_level']=='2' or Yii::app()->session['id_level']=='4'or Yii::app()->session['id_level']=='100' ){
            echo "</br> Pagu Unitkerja  Rp.". CHtml::textField('txtsisapagu',number_format( $paguUnitkerja["sisa_pagu"] , 0 , "," , '.' ),array( 'style'=>'width: 10%; ' ,'disabled'=>true,));
            echo "  Pagu Universitas Rp.". CHtml::textField('txtsisapagu',number_format( $paguUniversitas["sisa_pagu"] , 0 , "," , '.' ),array( 'style'=>'width: 10%; ' ,'disabled'=>true,));
          } ?>
         
          
         
          </td>
        </tr>
        
        
        <tr>
            <td valign="top" width=20%>Lokasi</td>
            <td width="70%" valign="top"><?php echo $dataRup['lokasi']?></td>
        </tr>

        <tr>
            <td valign="top" width=20%>Jenis Pengadaan </td>
            <td width="70%" valign="top"><?php echo $dataRup['jenis_pengadaan']?></td>
        </tr>


        <tr>
          <td width="20%" valign="top">Metode Pemilihan </td>
          <td width="70%" valign="top"><?php echo $dataRup['metode_pemilihan']?></td>
        </tr>
        <tr>
          <td valign="top">Jumlah Rp. </td>
          <td width="70%" valign="top"><?php echo number_format( $dataRup["jumlah"] , 0 , "," , '.' ) ;?></td>
        </tr>
        <tr>
            <td valign="top">Kode RUP / PIC </td>
            <td width="70%" valign="top"><?php echo $dataRup['kd_rup']?> / <?php echo $dataRup['ket']?> 
                
          </td>
        </tr>
  </table>
</div>  
<?php
 echo CHtml::hiddenField('id_rup',$dataRup['id']); 
 echo CHtml::hiddenField('tahun_anggaran',$dataRup['tahun_anggaran']); 
 echo CHtml::hiddenField('id_unitkerja',$dataRup['id_unitkerja']); 
 ?>
<table width="100%" border="0">
  <tr>
    <td width="10%">&nbsp;</td>
    <td width="10%">&nbsp;</td>
    <td width="10%">&nbsp;</td>
    <td width="10%"><?php if( Yii::app()->session['id_level']==10000){?>   
                  <button type="button" class="btn btn-block btn-success" onclick="cetak_info()" >Cetak Info</button>               
         <?php }?></td>
    <td width="10%">
	<?php
   
        if ($dataRup['id_sign'] != '') {           
              echo '<a style="width:100px" target="_blank" href="index.php?r=Imagesx/viewfile&id_rup=' . $dataRup['id'].'&path=images/signfile/' . $dataRup['id_sign'] . '/' . 		$dataRup['id'] . '_signed.pdf " class="btn btn-block btn-primary">Download HPS</a>';
           
        }else {
          if (Yii::app()->session['id_level'] == '3' or Yii::app()->session['id_level'] == '14'){ //====ppk universitas dan ppk unitkerja
            echo CHtml::button('E-sign HPS ',
                array(
                    'title' => 'E-sign HPS ',
                    'style' => 'width:100px',
                    'class' => 'btn btn-primary',
                    "onClick" => "sign_hps()"
                ));
              } 
        }
      
    ?>	</td>
    <td width="10%">
	    <?php if($dataRup["id_metode_pemilihan"]!=6 and $dataRup["id_level"]==5 and Yii::app()->session['id_level']==5 and $dataRup['id_rup_keuangan']==NULL){ ?>   				
                <button type="button" class="btn btn-block btn-danger" onclick="InputRupSimkeu()"> Input RUP SIMKEU  </button>            
     	<?php }?>	</td>
    <td width="10%">

	  	<?php if($dataRup["id_metode_pemilihan"]==6 and $dataRup["id_level"]==4 and Yii::app()->session['id_level']==4 and $dataRup['id_ls_keuangan']==NULL){ ?>  		 
               <button type="button" class="btn btn-block btn-danger" onclick="InputLsSimkeu()" > Input LS SIMKEU </button>          
     	<?php }?>	</td>
    <td width="10%">
	
		<?php if(Yii::app()->session['id_level']==4 ){ ?>  		 
               <button type="button" class="btn btn-block btn-success" onclick="editpaket(<?php echo $dataRup['id']?>)" >Edit Paket</button>        
     	<?php }?>	</td>
    <td width="10%">
	<?php if(Yii::app()->session['id_level']==$dataRup["id_level"] or Yii::app()->session['id_level']==100){?>   
                  <button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#tambahmodal" onclick="databaru()" >Proses</button>               
         <?php }?>	</td>
    <td width="10%">
	<button type="button" class="btn btn-block btn-warning"  onclick="Kembali()" >Kembali</button>	</td>
  </tr>
</table>
 
<!-- ============================RAB======================================= -->
 <br>
 <h5><b>2. Rincian Anggaran Biaya (RAB) / HPS </b></h5>    
  <table id="example2" class="table table-bordered table-hover" width=100%> 
 <thead>
    <tr rowspan="2" align="center" height='40px' bgcolor="#CCCCCC">
        <th width=5% align='center' bgcolor="#66CC00">No</th>
        <th width=20% align='center' bgcolor="#66CC00">Nama Barang/Pekerjaan </th>
        <th width=25% align='center' bgcolor="#66CC00">Spesifikasi</th>
        <th width=5% align='center' bgcolor="#66CC00">Jumlah </th>
        <th width=5% align='center' bgcolor="#66CC00">Satuan</th>
        <th width=10% align='center' bgcolor="#66CC00">Harga</th>
        <th width=10% align='center' bgcolor="#66CC00">Total</th>
        <th width=10% align='center' bgcolor="#66CC00">Referensi</th>
        <th width=10% align='center' bgcolor="#66CC00">Kd BMN </th>
    </tr>
  </thead>
    <tbody>
    <?php $number = 1; $sumtotal = 0  ?>
    <?php foreach($listRincian as $value):
          $sumtotal = $sumtotal + $value["total"]; ?>
     
    
    <tr><td width="5%" align="center" valign="top"><?php echo $number++?>.</td>
    <td width="20%" align="left" valign="top"><?php echo $value['uraian']; ?></td>
    <td width="25%" align="left" valign="top"><span class="style6"><?php echo $value["spesifikasi"]?></span></td>
      <td width="5%" align="center" valign="top"><?php echo number_format( $value["jumlah"] , 2 , "," , '.' )?> <br></td>
        <td width="5%" align="left" valign="top"><span class="style6"><?php echo $value["satuan"]?></span></td>
        <td width="10%" align="right" valign="top"><?php echo number_format( $value["harga"] , 0 , "," , '.' )?></td>
        <td width="10%" align="right" valign="top"><?php echo number_format( $value["total"] , 0 , "," , '.' )?></td>
        <td width="10%" align="center" valign="top"><span class="style6"><?php echo $value['referensi'] ?></span></td>
        <td width="10%" align="center" valign="top"><span class="style6"><?php echo $value['kd_bmn'] ?></span></td>
      </tr>
    </tbody>
    <?php endforeach; ?>
    <tr rowspan="2" align="center" height='40px' bgcolor="#CCCCCC">
                        <th width=5% align='center' bgcolor="#FFFFFF"></th>
                        <th width=20% align='center' bgcolor="#FFFFFF"></th>
                        <th width=25% align='center' bgcolor="#FFFFFF"></th>
                        <th width=5% align='center' bgcolor="#FFFFFF"></th>
                        <th width=5% align='center' bgcolor="#FFFFFF"></th>
                        <th width=10% align='center' bgcolor="#FFFFFF"></th>
                        <th width=10% align='right' bgcolor="#FFFFFF">Rp.<?php echo number_format($sumtotal, 0, ",", '.') ?></th>
                        <th width=10% align='center' bgcolor="#FFFFFF"></th>
                        <th width=10% align='center' bgcolor="#FFFFFF"></th>
    </tr>
</table>

<!-- ==================================== Daftar Dokumen ================================================================ -->

       
<br>
<h5><b>3. Data Dukung Dokumen</b></h5>   
<table id="example2" class="table table-bordered table-hover" width="100%"> 
    <thead>
    <tr rowspan="2" align="center" height='40px' bgcolor="#CCCCCC">
        <th width=5% align='center' bgcolor="#FF9900">No</th>
        <th width=20% align='center' bgcolor="#FF9900">Jenis Dokumen </th>
        <th width=25% align='center' bgcolor="#FF9900">Uraian</th>
        <th width=20% align='center' bgcolor="#FF9900">Download File </th>
        <th width=15% align='center' bgcolor="#FF9900">Username</th>
        <th width=15% align='center' bgcolor="#FF9900">Tanggal</th>
      </tr>
    </thead>
    <tbody>
    <?php $number = 1; ?>
    <?php foreach($listDokumen as $value): ?>
    
    <tr><td width="5%" align="center" valign="top"><?php echo $number++?>.</td>
    <td width="20%" align="left" valign="top"><span class="style6"><?php echo $value["jenis_dokumen"]?>
    </span></td>
    <td width="25%" align="left" valign="top"><span class="style6"><?php echo $value["uraian"]?></span></td>
      <td width="20%" align="left" valign="top"><span class="style6"><?php echo '<a href="files/'.$value['nama_file'].'" target="_blank">'.substr($value['nama_file'],0,1000).'</a>'; ?></span></td>
      <td width="15%" align="center" valign="top"><span class="style6"><?php echo $value["nama"]?></span></td>
      <td width="15%" align="center" valign="top"><span class="style6"><?php echo date('d-M-Y', strtotime($value['tgl_upload'])); ?><br>
      </td>
      </tr>
    </tbody>
    <?php endforeach; ?>
</table>

  
<!-- ==================================== Data Kontrak ================================================================ -->

       
<br>
<h5><b>4. Data Kontrak</b></h5>
       
    <table id="example2" class="table table-bordered table-hover" width="100%"> 
    <thead>
    <tr rowspan="2" align="center" height='40px' bgcolor="#0066CC">
        <th width=5% align='center' bgcolor="#9966FF">No</th>
        <th width=35% align='center' bgcolor="#9966FF">Data Supplier </th>
        <th width=20% align='center' bgcolor="#9966FF">Data Kontrak </th>
        <th width=20% align='center' bgcolor="#9966FF">Pelaksanaan</th>
        <th width=20% align='center' bgcolor="#9966FF">Data Pembayaran </th>
      </tr>
    </thead>
    <tbody>
    <?php $number = 1; ?>
    <?php 
	
	 foreach($dataKontrak as $value): ?>

    <tr><td width="5%" align="center" valign="top"><?php echo $number++?>.</td>
    <td width="35%" align="left" valign="top">
      
         <?php echo $value["nama_supplier"]?>  <br>
        <?php echo 'Rp. '. number_format( $value["jumlah"] , 0 , "," , '.' )?><br/>
			
		<?php	if ($value["nosp2d"]==NULL){?>
      <span class="badge bg-danger"><?php echo 'Belum Terbayar'; ?></span>
    <?php	}else{ ?>
      <span class="badge bg-success"><?php echo 'Sudah Terbayar';?></span>
    <?php	}	?>

	  </td>
		
        <td width="20%" align="left" valign="top"><?php echo 'No : '. $value["no"]?><br />
        <?php 	if ($value["tgl"]!=NULL){ echo 'Tgl : '. date('d-M-Y', strtotime($value["tgl"]));} ?></td>
        <td width="20%" align="left" valign="top">
           <?php if ($value["tgl"]!=NULL){echo 'Tgl Awal : '. date('d-M-Y', strtotime($value["tgl_awal"]));} ?> <br />
          <?php  if ($value["tgl"]!=NULL){echo 'Tgl Akhir : '. date('d-M-Y', strtotime($value["tgl_akhir"]));} ?></td>
        <td width="20%" align="left" valign="top">
		<?php echo 'No SP2D : '. $value["nosp2d"]?> <br />
		<?php if ($value["tgl"]!=NULL){ echo 'Tgl : '. date('d-M-Y', strtotime($value["tgl_sp2d"]));} ?><br/>	</td>
    </tr>
    </tbody>
    <?php endforeach; ?>
</table>
   
<!-- ==================================== Data Approved ================================================================ -->

<br>
<h5><b>5. Disposisi Proses</b></h5>

<table id="example2" class="table table-bordered table-hover" width=100%> 
 
 <thead>
    <tr rowspan="2" align="center" height='40px' bgcolor="#CCCCCC">
        <th width=5% align='center' bgcolor="#FF0000">No</th>
        <th width=10% align='center' bgcolor="#FF0000">Tanggal &amp; Jam </th>
        <th width=20% align='center' bgcolor="#FF0000">Pengirim</th>
        <th width=20% align='center' bgcolor="#FF0000">Penerima </th>
        <th width=40% align='center' bgcolor="#FF0000"> Pesan </th>
        <th width=5% align='center' bgcolor="#FF0000">Aksi </th>
    </tr>
  </thead>
    <tbody>
    <?php $number = 1; ?>
    <?php foreach($dataProses as $value): ?>
    
    <tr><td width="5%" align="center" valign="top"><?php echo $number++?>.</td>
    <td width="10%" align="left" valign="top">
      <span class="style6"><?php echo date('d-M-Y', strtotime($value['tgl'])); ?> <br>
      <?php echo date('H:i:s', strtotime($value['tgl'])); ?></span>
      </td>
    <td width="20%" align="left" valign="top"><span class="style6">
        <?php echo $value["nama"]?> <br>
       <span class="badge bg-success"><?php echo $value["pengirim_level"]?></span> <br>
        
      
     </span></td>
    <td width="20%" align="left" valign="top"><span class="style6">
      <?php echo $value["penerima_level"]?><br>
       <span class="badge bg-warning"><?php echo $value["proses"]?></span></span></td>
        <td width="40%" align="left" valign="top"><?php echo $value["catatan"];?><span class="style6"><br>
        </span></td>
        <td width="5%" align="center" valign="top">  
        <?php                 
            if(Yii::app()->session['id_level'] =='100'){?>   
                  <div class="btn-group">
                    <button type="button" class="btn btn-default">Pilih</button>
                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                      <span class="sr-only">Toggle Dropdown</span> </button>
                    <div class="dropdown-menu" role="menu">                     

                      <a class="dropdown-item" href="#" onclick="deletedata(<?php echo $value["id_approvel"] ?>,'<?php echo $value["tgl"]?>'); return false;"> Delete</a>                    </div>
          </div>  
        <?php }?>        </td>
    </tr>
    </tbody>
    <?php endforeach; ?>
</table>


<?php //===========================Form Insert Approvel ========================================================== ?>
<div class="modal fade" id="tambahmodal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">URAIAN PROSES PBJ  </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body"> 
         
          
              
                <table class="table table-bordered" width=100%>
                
                        <tr>
                        <td width="20%" valign="top">Tanggal</td>
                        <td width="80%" valign="top"><?php echo date('l, d-m-Y  h:i:s a');?></td>
                        </tr>
                        <tr>
                        <td width="20%" valign="top">Pengirim</td>
                        <td width="80%" valign="top"><?php echo Yii::app()->session['nama_lengkap']. '('.Yii::app()->session['level'].')';?>        </tr>
                        
                        <tr>
                          <td valign="top">Proses Selanjutnya </td>
                          <td width="80%" valign="top">

                      
                          <?php 
                 
                          $id_metode_pemilihan=$dataRup['id_metode_pemilihan'];                    
                          $cmd = Yii::app()->db->createCommand("SELECT 
																t1.id_proses,
																t1.no_urut || '-' ||t1.proses  || '-' ||t2.level as proses 
																FROM 
																pbj.kode_proses t1
																left join pbj.level t2 on t1.id_level_user=t2.id_level
                                                                where t1.id_metode_pemilihan=$id_metode_pemilihan
                                                                order by t1.no_urut;")->queryAll();                  
													$lsdata = CHtml::listData($cmd,'id_proses','proses');
                          
                          echo CHtml::dropDownList('ddlproses', $dataRup['id_proses'],$lsdata,
                                array(                                   
                                    'style'=>'width: 80%;',

                                    'ajax' => array(
                                        'type'=>'POST',
                                        'url'=>CController::createUrl('IsiCatatan'), //url to call.
                                        'update'=>'#txtcatatan1',
                                        'data'=>array('id_proses'=>'js:this.value'),
                                    )) );
                          
                            ?>
                            
                          </td>
                        </tr>
                        
                        <tr>
                          <td valign="top">Catatan <br>
                          * <span class="style1">Template untuk memudahkan proses disposisi, Silahkan disesuaikan </span></td>
                          <td valign="top"><?php 
                          echo CHtml::textarea('txtcatatan1','',                                  
									array( 'style'=>'width: 500px; height: 200px;' ,'disabled'=>false,));?>
									
						  </td>
                        </tr>
                </table> 

                <?php echo CHtml::hiddenField('id_approvel');  ?>	     	     
               
              <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>             
              <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="simpanData()">Simpan</button>
              </div>
          
              
    </div>  <!-- /.modal-body -->
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php //=========================== Form Edit ========================================================== ?>

</div>  

<script>
                        function sign_hps() {
                            Swal.fire({
                                title: 'Apa Anda Yakin Menandatangani HPS?',
                                text: "E-sign tidak dapat dihapus",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yakin!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    var url = '/index.php?r=Rup/InfoRup';
                                    var form = $('<form action="' + url + '" method="POST">' +
                                        '<input type="hidden" name="action" value="cetak_hps" />' +
                                        '<input type="hidden" name="sign" value="1" />' +
                                        '<input type="hidden" name="id_rup" value="' + $('#id_rup').val() + '" />' +
                                        '</form>');
                                    $('body').append(form);
                                    $(form).submit();
                                }
                            })
                        }
                    </script>

