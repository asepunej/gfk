<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIM-RSGM | UNEJ</title>

  <!-- Google Font: Source Sans Proxx -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="themes/AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="themes/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="themes/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="themes/AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="themes/AdminLTE/dist/css/adminlte.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="themes/AdminLTE/plugins/daterangepicker/daterangepicker.css">
  
  
</head>

<script type="text/javascript">

function proses()
    {
        var url = '/index.php?r=Poliklinik/DaftarRegistrasi';
        var form = $('<form action="' + url + '" method="POST">' +           
            '<input type="hidden" name="txttgl" value="' + $('#txttgl').val() + '" />' +   
            '</form>');
        $('body').append(form);
        $(form).submit();
    }

    
    function tindakan()
    {
        var url = '/index.php?r=Poliklinik/Tindakan';
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
    <h3 class="card-title">DAFTAR REGISTRASI</h3>
    
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
            <a class="dropdown-item" href="#" onclick="infopasien(<?php echo $value[id_registrasi] ?>); return false;"> Info Pasien</a>        
            <a class="dropdown-item" href="#" onclick="tindakan(<?php echo $value[id_registrasi] ?>,<?php echo $value[no_rm]?>); return false;"> Tindakan</a>            </div>
      </div>    </td>
    </tr>
   
   
    <?php endforeach; ?>
    </tbody>
</table>

<?php
echo CHtml::endForm();
?>
</div>  


<!-- jQuery -->
<script src="themes/AdminLTE/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<!-- <script src="themes/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
<!-- DataTables  & Plugins -->
<script src="themes/AdminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="themes/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="themes/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="themes/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="themes/AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="themes/AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="themes/AdminLTE/plugins/jszip/jszip.min.js"></script>
<script src="themes/AdminLTE/plugins/pdfmake/pdfmake.min.js"></script>
<script src="themes/AdminLTE/plugins/pdfmake/vfs_fonts.js"></script>
<script src="themes/AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="themes/AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="themes/AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="themes/AdminLTE/plugins/daterangepicker/daterangepicker.js"></script>


<!-- Select2 -->
<script src="../../plugins/select2/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="../../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="../../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="../../plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="../../plugins/dropzone/min/dropzone.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>


<!-- Page specific script -->

  <script type="text/javascript">
  $(function () {
    $.noConflict();
    $("#example1").DataTable({
     "lengthMenu": [[25, 50, 100,-1], [25, 50, 100,"All"]],
      "responsive": true, "true": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "aaSorting": [],
        columnDefs: [{
        orderable: false,
        targets: 0
        }]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

  });

</script>

<!-- jQuery -->
<!-- Page specific script -->
<script>
  $(function () {

    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
 
  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  })

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
  })

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  })

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1"
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  })

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
  })

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  }
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true)
  }
  // DropzoneJS Demo Code End
</script>
