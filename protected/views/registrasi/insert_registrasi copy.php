
<script>
  function Proses()
    {
        var url = '/index.php?r=Registrasi/InsertRegistrasi';
        var form = $('<form action="' + url + '" method="POST">' +
            '<input type="hidden" name="action" value="cari" />' +
            '<input type="hidden" name="no_rm" value="' + $('#select2pasien').val() + '" />' +               
           
            '</form>');
        $('body').append(form);
        $(form).submit();
    }

  function Simpan() {   
  theConfirm = "Yakin data akan di Simpan : ";
      // theConfirm += uraian + "?";
      var go = confirm(theConfirm);
      if (go == true) {  
      var url = '/index.php?r=Registrasi/InsertRegistrasi';
          var form = $('<form action="' + url + '" method="POST" id="theForm">' +         
  
          '<input type="hidden" name="action" value="simpan" />' +            
          
          '<input type="hidden" name="status_pasien" value="' + $('#ddlstatuspasien').val() + '" />' +    
          '<input type="hidden" name="no_rm" value="' + $('#txtnorm').val() + '" />' +     
          '<input type="hidden" name="kd_jenis_pasien" value="' + $('#ddljenispasien').val() + '" />' +
          '<input type="hidden" name="nik" value="' + $('#txtnik').val() + '" />' +         
          '<input type="hidden" name="nama" value="' + $('#txtnama').val() + '" />' +   
          '<input type="hidden" name="kd_jenis_kelamin" value="' + $('#ddljeniskelamin').val() + '" />' + 

          '<input type="hidden" name="kd_kota_lahir" value="' + $('#select2kotalahir').val() + '" />' + 
          '<input type="hidden" name="tgl_lahir" value="' + $('#txttgl_lahir').val() + '" />' + 
          '<input type="hidden" name="alamat" value="' + $('#txtalamat').val() + '" />' + 
          '<input type="hidden" name="kd_kota_alamat" value="' + $('#ddlkabupaten').val() + '" />' + 
          '<input type="hidden" name="kd_agama" value="' + $('#ddlagama').val() + '" />' + 
          '<input type="hidden" name="kd_status_kawin" value="' + $('#ddlstatuskawin').val() + '" />' + 
          '<input type="hidden" name="kd_pendidikan" value="' + $('#ddlpendidikan').val() + '" />' + 
          '<input type="hidden" name="kd_pekerjaan" value="' + $('#ddlpekerjaan').val() + '" />' + 
          '<input type="hidden" name="kd_suku" value="' + $('#ddl_suku').val() + '" />' +
          '<input type="hidden" name="kd_bahasa" value="' + $('#ddl_bahasa').val() + '" />' +
          '<input type="hidden" name="notelp" value="' + $('#txtnotelp').val() + '" />' +
          '<input type="hidden" name="nama_pj" value="' + $('#txtpj').val() + '" />' +    

             
          '<input type="hidden" name="kd_jenis_daftar" value="' + $('#ddljenisdaftar').val() + '" />' +    
          '<input type="hidden" name="kd_jenis_pembayaran" value="' + $('#ddlpembayaran').val() + '" />' +     
          '<input type="hidden" name="kd_klinik" value="' + $('#ddlklinik').val() + '" />' +
          '<input type="hidden" name="id_medis" value="' + $('#select2medis').val() + '" />' +         
          '<input type="hidden" name="id_petugas" value="' + $('#select2petugas').val() + '" />' +   
          
          '</form>');
          $('body').append(form);
          $(form).submit();
      }
 }

 function Kembali(){
            var url = '/index.php?r=Registrasi/DaftarRegistrasi';
            var form = $('<form action="' + url + '" method="POST">' +
                '<input type="hidden" name="ddltahun" value="' + $('#tahun_anggaran').val() + '" />' +   
                '<input type="hidden" name="ddlunitkerja" value="' + $('#id_unitkerja').val() + '" />' + 
                  
                '</form>');
            $('body').append(form);
            $(form).submit();
    }
   
    </script>
<?php
echo CHtml::beginForm('','POST');
?>


<div class="card card-info">            
<div class="card-header">
    <h3 class="card-title">PENDAFTARAN PASIEN</h3>
</div> 
<div class="card-body">   

<div align="left">
    <table width="100%" class="table table-bordered" >
        
        <tr>
          <td colspan="2" valign="top">
         
                
        <div class="form-group">
                <label>CARI DATA PASIEN (ISIKAN NIK/NOMOR REKAM MEDIK/NAMA)</label>
          <select id="select2pasien"  class="form-control select2" style="width: 80%; height:50%">
            <option selected="selected"></option>
            <?php foreach($dataPasien as $value):?>
            <option value="<?=$value['no_rm']?>">
            <?=$value['nama']?>
            </option>
            <?php endforeach; ?>
          </select>
		   <button type="button" style="width: 100px;" class="btn btn-primary" data-dismiss="modal" onclick="Proses()">Proses</button>	
          </div>		   </td>
        </tr>
        
        <tr>
          <td colspan="2" valign="top" bgcolor="#009900">BIODATA PASIEN </td>
        </tr>
        
        
        <tr>
          <td valign="top">No RM </td>
          <td valign="top"><?php echo CHtml::textfield('txtnorm', $RecordData['no_rm'],
                    array( 'style'=>'width: 100%','disabled'=>true,));?></td>
        </tr>
        <tr>
          <td width="20%" valign="top">Jenis Pasien </td>
          <td width="80%" valign="top">
              <?php                                  
			        echo CHtml::dropDownList('ddljenispasien',$RecordData['kd_jenis_pasien'],$tbl_Jenispasien
            , array('style'=>'width: 100%;height:30px;'          
            ,'disabled'=>false,
                'options'=>array($RecordData['id_jenis_pengadaan']=>array('selected'=>'selected'))))
                ?></td>
        </tr>
        
        <tr>
          <td width="20%" valign="top">NIK</td>
          <td width="80%" valign="top"><?php echo CHtml::textfield('txtnik', $RecordData['nik'],
                    array( 'style'=>'width: 100%'));?></td>
        </tr>
        
        <tr>
          <td valign="top">Nama</td>
          <td valign="top"><?php echo CHtml::textfield('txtnama', $RecordData['nama'],
                    array( 'style'=>'width: 100%'));?></td>
        </tr>
        <tr>
          <td width="20%" valign="top">Jenis Kelamin </td>
          <td width="80%" valign="top"><?php                                  
              echo CHtml::dropDownList('ddljeniskelamin',$RecordData['kd_jenis_kelamin'],$tbl_Jeniskelamin
            , array('style'=>'width: 100%;height:30px;'          
            ,'disabled'=>false,
                'options'=>array($RecordData['kd_jenis_kelamin']=>array('selected'=>'selected'))))?>          </td>
        </tr>
        
        
        <tr>
            <td valign="top" width=20%>Kota Lahir </td>
            <td width="80%" valign="top">  
                 
                    <select  class="form-control select2" id="select2kotalahir"  style="width: 100%; height:50%">
                    <option selected="3509"></option>
                    <?php foreach($dataKab as $value):?>                      
                      <option value=<?=$value['kdkabupaten']?> <?php if($value['kdkabupaten']==$RecordData['kd_kota_lahir']) echo 'selected="selected"'; ?> > <?=$value['kabupaten']?></option>
                      
                     
                    <?php endforeach; ?>
              </select>             </td>
        </tr>

        <tr>
            <td valign="top" width=20%>Tgl Lahir </td>
            <td width="80%" valign="top">

            <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                    'name'=>'txttgl_lahir',
                    'value'=>Yii::app()->dateFormatter->format("dd MMMM yyy",$RecordData['tgl_lahir']),
                    'options'=>array(
                      // 'dateFormat' => 'mm/dd/yy',
                      'showAnim' => 'fade',  
                      'changeMonth' => true,
                      'changeYear' => true,
                      // 'showOn' => 'button',
                    ),
                    'htmlOptions'=>array(
                        'title' => 'tgl_lahir',
                        'style' => 'width:100%'
                    ), ));
                ?>            </td>
        </tr>


        <tr>
          <td width="20%" valign="top">Alamat </td>
          <td width="80%" valign="top"><?php echo CHtml::textArea('txtalamat', $RecordData['alamat'],
                    array( 'style'=>'width: 100%'));?></td>
        </tr>
        <tr>
          <td valign="top">Provinsi</td>
          <td valign="top"><?php   
          
          echo CHtml::dropDownList('ddlprovinsi',$RecordData['kdprovinsi'],$tbl_Prov,
          array(                                   
              'style'=>'width: 100%; height:30px',
           
              'ajax' => array(
                  'type'=>'POST',
                  'url'=>CController::createUrl('IsiKab'), //url to call.
                  'update'=>'#ddlkabupaten',
                  'data'=>array('kdprovinsi'=>'js:this.value'),
              )) );   
            
                ?></td>
        </tr>
        <tr>
          <td width="20%" valign="top">Kabupaten/Kota</td>
          <td width="80%" valign="top"><?php                                  
			        echo CHtml::dropDownList('ddlkabupaten',$RecordData['kd_kota_lahir'],$tbl_Kab
            , array('style'=>'width: 100%;height:30px;'
            ,'disabled'=>false,
                'options'=>array($RecordData['kdkabupaten']=>array('selected'=>'selected'))))
                ?></td>
        </tr>

        <tr>
          <td valign="top">Agama</td>
          <td width="80%" valign="top"><?php                                  
              echo CHtml::dropDownList('ddlagama',$RecordData['kd_agama'],$tbl_Agama
            , array('style'=>'width: 100%;height:30px;'          
            ,'disabled'=>false,
                'options'=>array($RecordData['kd_agama']=>array('selected'=>'selected'))))?></td>
        </tr>
        <tr>
          <td width="20%" valign="top">Status Kawin </td>
          <td width="80%" valign="top"><?php  
                                
			
			echo CHtml::dropDownList('ddlstatuskawin',$RecordData['kd_status_kawin'],$tbl_Statuskawin
            , array('style'=>'width: 100%;height:30px;'          
            ,'disabled'=>false,
                'options'=>array($RecordData['kd_status_kawin']=>array('selected'=>'selected'))));
        ?></td>
        </tr>
        

        
        <tr>
          <td valign="top">Pendidikan</td>
          <td valign="top"><?php 
			
			echo CHtml::dropDownList('ddlpendidikan',$RecordData['kd_pendidikan'],$tbl_Pendidikan
            , array('style'=>'width: 100%;height:30px;'          
            ,'disabled'=>false,
                'options'=>array($RecordData['kd_pendidikan']=>array('selected'=>'selected'))));
        ?></td>
        </tr>
        <tr>
          <td valign="top">Pekerjaan</td>
          <td valign="top"><?php 
			
			echo CHtml::dropDownList('ddlpekerjaan',$RecordData['kd_pekerjaan'],$tbl_Pekerjaan
            , array('style'=>'width: 100%;height:30px;'          
            ,'disabled'=>false,
                'options'=>array($RecordData['kd_pekerjaan']=>array('selected'=>'selected'))));
        ?></td>
        </tr>
        <tr>
          <td valign="top">Suku</td>
          <td valign="top"><?php  			
			echo CHtml::dropDownList('ddl_suku',$RecordData['kd_suku'],$tbl_Suku
            , array('style'=>'width: 100%;height:30px;'          
            ,'disabled'=>false,
                'options'=>array($RecordData['kd_suku']=>array('selected'=>'selected'))));
        ?></td>
        </tr>
        <tr>
          <td valign="top">Bahasa</td>
          <td valign="top"><?php  			
			echo CHtml::dropDownList('ddl_bahasa',$RecordData['kd_bahasa'],$tbl_Bahasa
            , array('style'=>'width: 100%;height:30px;'          
            ,'disabled'=>false,
                'options'=>array($RecordData['kd_bahasa']=>array('selected'=>'selected'))));
        ?></td>
        </tr>
        <tr>
          <td valign="top">No.Telp/HP</em></td>
          <td valign="top"><?php echo CHtml::textfield('txtnotelp', $RecordData['notelp'],
                    array( 'style'=>'width: 100%'));?></td>
        </tr>
        <tr>
          <td valign="top">Nama Ortu/PJ</em></td>
          <td valign="top"><?php echo CHtml::textfield('txtpj', $RecordData['nama_pj'],
                    array( 'style'=>'width: 100%'));?></td>
        </tr>
        <tr>
          <td colspan="2" valign="top" bgcolor="#009900">DATA KUNJUNGAN</td>
        </tr>
        <tr>
          <td valign="top">Jenis daftar</td>
          <td valign="top"><?php                                  
              echo CHtml::dropDownList('ddljenisdaftar',$RecordData['kd_jenis_daftar'],$tbl_jenisdaftar
            , array('style'=>'width: 100%;height:30px;'          
            ,'disabled'=>false,
                'options'=>array($RecordData['kd_jenis_daftar']=>array('selected'=>'selected'))))?></td>
        </tr>
        <tr>
          <td valign="top">Jenis Pembayaran</td>
          <td valign="top"><?php                                  
              echo CHtml::dropDownList('ddlpembayaran',$RecordData['kd_jenis_pembayaran'],$tbl_Pembayaran
            , array('style'=>'width: 100%;height:30px;'          
            ,'disabled'=>false,
                'options'=>array($RecordData['kd_jenis_pembayaran']=>array('selected'=>'selected'))))?></td>
        </tr>
        <tr>
          <td valign="top">Tujuan Klinik</td>
          <td valign="top"><?php                                  
              echo CHtml::dropDownList('ddlklinik',$RecordData['kd_klinik'],$tbl_klinik
            , array('style'=>'width: 100%;height:30px;'          
            ,'disabled'=>false,
                'options'=>array($RecordData['kd_klinik']=>array('selected'=>'selected'))))?></td>
        </tr>
        <tr>
          <td valign="top">Pilihan Medis</td>
          <td valign="top"><select id="select2medis" class="form-control select2" style="width: 100%; height:50%">
            <option selected="selected"></option>
            <?php foreach($dataDokter as $value):?>
            <option value="<?=$value['id_pegawai']?>">
            <?=$value['nama']?>
            </option>
            <?php endforeach; ?>
          </select></td>
        </tr>
        <tr>
          <td valign="top">Petugas</td>
          <td valign="top">
          <?php echo CHtml::textfield('txtpetugas', Yii::app()->session['nama'],
                    array( 'style'=>'width: 100%','disabled'=>true,));?>
          </td>
        </tr>
        <tr>
            <td width="20%" valign="top"></td>
          <td width="80%" valign="top">
		  
		  	  <button type="button" class="btn btn-primary" style="width: 100px;" data-dismiss="modal" onclick="Simpan()">Simpan</button>              
			 <button type="button" class="btn btn-warning" style="width: 100px; " data-dismiss="modal" onclick="Kembali()" >Kembali</button>            </td>
        </tr>
  </table>

    <?php echo CHtml::hiddenField('statussimpan','1');  ?>


</div>

</div>

<?php
echo CHtml::endForm();
?>

