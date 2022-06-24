
 <?php echo CHtml::beginForm('','POST'); 
   $totPaket=$dataProvider[0]['jmlpaket']+$dataProvider[1]['jmlpaket']+$dataProvider[2]['jmlpaket']+$dataProvider[3]['jmlpaket']; 
 ?>

 

 <div class="card">
              			  
	<table class="table" width="100%"  >
     
   
    
    <tr>
      <td colspan="3" valign="top"><div class="card-body p-0">

        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-info">
              <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Pasien Hari ini </span>
                <span class="info-box-number"><?php echo $dataProvider[0]['jmlpaket'].' Paket';?></span>

                <div class="progress">
                  <div class="progress-bar" style="width: <?php echo $persenBarangKontrak.'%';?>"></div>
                </div>
                <span class="progress-description">      
                Rp. <?php echo number_format( $dataProvider[0]["jmlpagu"] , 0 , "," , '.' )?>                </span>              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-success">
              <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">PASIEN IGD</span>                
                <span class="info-box-number"><?php echo $dataProvider[1]['jmlpaket'].' Paket';?></span>

                <div class="progress">
                  <div class="progress-bar" style="width: <?php echo $persenKonstruksiKontrak.'%';?>"></div>
                </div>
                <span class="progress-description">
                Rp. <?php echo number_format( $dataProvider[1]["jmlpagu"] , 0 , "," , '.' )?>                </span>              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-warning">
              <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">PASIEN POLYi</span>
                <span class="info-box-number"><?php echo $dataProvider[2]['jmlpaket'].' Paket';?></span>


                <div class="progress">
                  <div class="progress-bar" style="width: <?php echo $persenKonsultansiKontrak.'%';?>"></div>
                </div>
                <span class="progress-description">
              Rp. <?php echo number_format( $dataProvider[2]["jmlpagu"] , 0 , "," , '.' )?>                </span>              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-danger">
              <span class="info-box-icon"><i class="fas fa-comments"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Jasa Lainnya</span>
                <span class="info-box-number"><?php echo $dataProvider[3]['jmlpaket'].'  Paket';?></span>
                

                <div class="progress">
                  <div class="progress-bar" style="width: <?php echo $persenJasaKontrak.'%';?>"></div>
                </div>
                <span class="progress-description">
                Rp. <?php echo number_format( $dataProvider[3]["jmlpagu"] , 0 , "," , '.' )?>                </span>              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->


 </div>
          <!-- /.col -->
 </div>
    
 
</div>
<!-- /.card-body -->
</div></td>
      </tr>
</table>
        



<table width="100%" border="0" align="center">

  <tr>
    <td width="20%">Gabung Group WA SIBAJA </td>
    <td width="5%">:</td>
    <td width="75%"><div align="left"><?php echo '<a href="https://bit.ly/WaSibajaUnej" target="_blank">'.'bit.ly/WaSibajaUnej'.'</a>'; ?></div></td>
  </tr>
  <tr>
    <td width="20%">Form Pembuatan user SIBAJA </td>
    <td width="5%">:</td>
    <td width="75%"><div align="left"><?php echo '<a href="https://bit.ly/DaftarSibajaUnej" target="_blank">'.'bit.ly/DaftarSibajaUnej'.'</a>'; ?></div></td>
  </tr>
  <tr>
    <td width="20%">&nbsp;</td>
    <td width="5%">&nbsp;</td>
    <td width="75%"><div align="left"></div></td>
  </tr>
</table>
       
  
</div>
<!-- /.card -->
<?php
echo CHtml::endForm();
?>
