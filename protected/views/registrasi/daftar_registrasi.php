

<script type="text/javascript">

function proses()
    {
        var url = '/index.php?r=Registrasi/DaftarRegistrasi';
        var form = $('<form action="' + url + '" method="POST">' +
            // '<input type="hidden" name="action" value="statusdelete" />' +
            '<input type="hidden" name="txttgl" value="' + $('#txttgl').val() + '" />' +   
            '<input type="hidden" name="txttgl_mulai" value="' + $('#txttgl_mulai').val() + '" />' +            
            // '<input type="hidden" name="ddlunitkerja" value="' + $('#ddlunitkerja').val() + '" />' +		 
            
            '</form>');
        $('body').append(form);
        $(form).submit();
    }

    
    function insertRegistrasi()
    {
        var url = '/index.php?r=Registrasi/InsertRegistrasi';
        var form = $('<form action="' + url + '" method="POST">' +
            '<input type="hidden" name="ddltahun" value="' + $('#ddltahun').val() + '" />' +               
            '<input type="hidden" name="ddlunitkerja" value="' + $('#ddlunitkerja').val() + '" />' +		 
            
            '</form>');
        $('body').append(form);
        $(form).submit();
    }

   

    function editdata(id)
    {
        var url = '/index.php?r=Registrasi/EditRegistrasi';
        var form = $('<form action="' + url + '" method="POST">' +
            '<input type="hidden" name="id_rup" value="' + id + '" />' +			  
            '</form>');
        $('body').append(form);
        $(form).submit();
    }

    function deletedata(id_registrasi,nama)
    {
        theConfirm = "Anda yakin ingin menghapus data ";
        theConfirm += nama + "?";
        var go = confirm(theConfirm);
        if (go == true) {
            var url = '/index.php?r=Registrasi/DaftarRegistrasi';
            var form = $('<form action="' + url + '" method="POST">' +
                '<input type="hidden" name="action" value="statusdelete" />' +
                '<input type="hidden" name="id_registrasi" value="' + id_registrasi + '" />' +
                
                '</form>');
            $('body').append(form);
            $(form).submit();
        }

    }

    function detaildata(id)
    {
        var url = '/index.php?r=Rupdetail/DaftarRupDetail';
        var form = $('<form action="' + url + '" method="POST">' +
            '<input type="hidden" name="id_rup" value="' + id + '" />' +
            '</form>');
        $('body').append(form);
        $(form).submit();
    }
    
    
       function dokumen(id)
       {
           var url = '/index.php?r=Dokumen/DaftarDokumen';
           var form = $('<form action="' + url + '" method="POST">' +
               '<input type="hidden" name="id_rup" value="' + id + '" />' +
               '</form>');
           $('body').append(form);
           $(form).submit();
       }
       function approvel(id)
       {
           var url = '/index.php?r=Rupapprovel/Approvel';
           var form = $('<form action="' + url + '" method="POST">' +
                '<input type="hidden" name="id_rup" value="' + id + '" />' +
                '<input type="hidden" name="ddltahun" value="' + $('#ddltahun').val() + '" />' +               
                '<input type="hidden" name="ddlunitkerja" value="' + $('#ddlunitkerja').val() + '" />' +
                '<input type="hidden" name="ddlmetodepemilihan" value="' + $('#ddlmetodepemilihan').val() + '" />' +               
                '<input type="hidden" name="ddljenispengadaan" value="' + $('#ddljenispengadaan').val() + '" />' +
               '</form>');
           $('body').append(form);
           $(form).submit();
       }

       function inforup(id)
    {
        var url = '/index.php?r=Rup/InfoRup';
        var form = $('<form action="' + url + '" method="POST">' +
            '<input type="hidden" name="id_rup" value="' + id + '" />' +
            '</form>');
        $('body').append(form);
        $(form).submit();
    }
   
</script>
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog'
    ,array(
        'id'=>'pop',
        'options'=>array(
            'autoOpen'=>false,
            'title'=>'Pilih SPBY',
            'height'=>'400',
            'width'=>'900px',
            'modal'=>true,
            'position' => 'center',
            'show'=>'{effect: "fade",duration: 1000}'
        )
    )
);
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>

<?php echo CHtml::beginForm('','POST');
$ReferensiModel=new ReferensiModel();
?>




<div class="card card-info">            
<div class="card-header">
    <h3 class="card-title">PENDAFTARAN PASIEN</h3>
    
</div>        
<div class="card-body">
<table class="table" width="100%"  >
    
    <tr>
      <td width="15%" valign="top">Tanggal</td>
      <td width="5%" valign="top">:</td>
      <td width="20%" valign="top">

      
           <?php                  
                $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                    'name'=>'txttgl',
                    'value'=>Yii::app()->dateFormatter->format("dd-MM-yyy",$tgl),
                    'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'dd-mm-yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                        
                    ),
                    'htmlOptions'=>array(
                        'title' => 'tanggal',
                        'style' => 'width:100%'
                    ), ));
                ?> 
                 
            
                            <!-- <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i></span>
                              <input name="text" type="text" class="form-control float-right" id="reservation"/>
                              <button type="button" style="width: 120px;"  class="btn btn-block btn-primary" onclick="proses()" >Proses</button>   
                            </div>       -->            </td>
        <td width="30%" align="left"><button type="button" style="width: 120px;"  class="btn btn-block btn-warning" onclick="proses()" >Proses</button> </td>
        <td width="30%" align="left">  </td>
        <td width="5%" align="right">           
                    <button type="button" style="width: 100px;" class="btn btn-block btn-primary"  onclick="insertRegistrasi()" >Tambah</button>      </td>
    </tr>
</table>

<table id="example2" class="table table-bordered table-hover" width="100%" > 
<!-- <table width="100%" id="example1" class="table table-bordered table-striped">     -->
    <thead>
    <tr rowspan="2" align="center" height='40px' bgcolor="#CCCCCC">
        <th width=5% align='center'>No <br> RM</th>
        <th width=10% align='center'>Tanggal <br> Jam</th>
        <th width=30% align='center'>Nama <br/> Alamat</th>
        <th width=10% align='center'>L/P <br/> Usia</th>
        <!-- <th width=15% align='center'>Akun</th> -->
        <th width=20% align='center'>Klinik </th>
        <th width=10% align='center'>Jenis Daftar <br> Pembayaran</th>
        <th width=5% align='center'>Aksi </th>
    </tr>
    </thead>
    <tbody>
    <?php $number = 1; ?>
    <?php foreach($dataProvider as $value):
     
    ?>

  <tr>
    <td width="5%" align="center" valign="top"><?php echo $number++; ?> <br> <span class="badge bg-warning"> <?php echo 'RM: '.$value["no_rm"]?> </span> </td>
    <td width="10%" align="left" valign="top">
	 <span class="style6"><?php echo date('d-M-Y', strtotime($value['tgl'])); ?> <br>
      <?php echo date('H:i:s', strtotime($value['tgl'])); ?></span>	</td>
    <td width="30%" align="left" valign="top">
        <?php echo $value["nama"]?>  <br/> 
        <?php echo $value["alamat"]?>  <?php echo $value["kabupaten"]?> </td>
    <td width="10%" align="left" valign="top"><?php echo $value["jenis_kelamin"]?> <br/> <span class="badge bg-warning"> <?php echo $value["umur"].' Thn'?> </span></td>
    <td width="20%" align="left" valign="top"><?php echo $value["klinik"]?> <br/> <span class="badge bg-warning"> <?php echo $value["nama_dokter"]?> </span></td>
    <td width="10%" align="left" valign="top"><?php echo $value["jenis_daftar"]?> <br> <span class="badge bg-warning"> <?php echo $value["jenis_pembayaran"]?> </span> </td>
    <td width="5%" align="center" valign="top">  
      <div class="btn-group">
          <button type="button" class="btn btn-info">Pilih</button>
          <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
            <span class="sr-only">Toggle Dropdown</span> </button>
            <div class="dropdown-menu" role="menu">		
            <a class="dropdown-item" href="#" onclick="editdata(<?php echo $value[id_registrasi] ?>); return false;"> Edit</a>        
            <a class="dropdown-item" href="#" onclick="deletedata(<?php echo $value[id_registrasi] ?>,<?php echo $value[no_rm]?>); return false;"> Delete</a>            </div>
      </div>    </td>
    </tr>
   
   
    <?php endforeach; ?>
    </tbody>
</table>

<?php
echo CHtml::endForm();
?>
</div>  

