<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIM RS | Universitas Jember</title>

  <!-- Google Font: Source Sans Pro -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="themes/AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="themes/AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- <link rel="stylesheet" href="themes/AdminLTE/plugins/sweetalert2/sweatalert2.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="themes/AdminLTE/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/index.php?r=Dashboard/Dashboard" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <!-- <a href="#" class="nav-link" data-toggle="dropdown"> -->

                        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <?php echo Yii::app()->session['klinik']; ?>
    
                        </a>
                        <div class="dropdown-menu dropdown-menu-left">

                        <?php
                          $username=Yii::app()->session['username'];
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
                                  Where t1.username='$username' order by t1.kd_klinik ;")->queryAll();


                          foreach ($dbcmd as $value):   ?>
                          <a class="dropdown-item" href="<?php echo "index.php?r=Dashboard/Level&id_user=" . $value['id_user']; ?>">
                            <i class="fa fa-calendar"></i> <?php 
                              echo $value['klinik'];                                     
                            ?>
                          </a>
                          <?php endforeach; ?>



      </a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

     
        <!-- <a class="nav-link" data-widget="navbar-search" href="#" role="button"> -->
          <!-- <i class="fas fa-search"></i> -->
        <!-- </a> -->
        <!-- <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div> -->
      


    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="themes/AdminLTE/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SIM-RSGM </span>
    </a>

    <!-- Sidebar -->
    <?php
        if(Yii::app()->session['statuslogin']==true )
      { ?>
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="themes/AdminLTE/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo Yii::app()->session['nama'];?> </a>
        </div>
      </div>
      <?php }?>

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

  
    <!-- Login Aplikasi -->
    <?php if(Yii::app()->session['statuslogin']==true) { ?>   
      <!-- Menu Dashboard -->     
     
         <li class="nav-item">
            <a href="/index.php?r=Dashboard/Dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p> Dashboard </p>
            </a>
          </li>

        <!-- Menu Pendaftaran -->  
        <?php if(Yii::app()->session['kd_klinik']=='01') { ?>        
        <li class="nav-item">
          <a href="#" class="nav-link">
          <i class="nav-icon fas fa-chart-pie"></i>
            <p>
            PENDAFTARAN
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview"> 
          <li class="nav-item">
              <a href="index.php?r=Pasien/DaftarPasien" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pasien</p>
              </a>
            </li> 

          <li class="nav-item">
              <a href="index.php?r=Registrasi/DaftarRegistrasi" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pendaftaran Pasien</p>
              </a>
            </li>  
            
            <li class="nav-item">
              <a href="index.php?r=Orderlab/DaftarOrderLab" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Order Lab TKG</p>
              </a>
            </li> 
               
            <li class="nav-item">
              <a href="index.php?r=Peminjamanrm/DaftarPinjamanRm" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Peminjaman RM</p>
              </a>
            </li>        
          </ul>
        </li>
        <?php }?>

          <!-- Menu Poli Klinik-->  
          <?php if(Yii::app()->session['kd_klinik']=='02' or Yii::app()->session['kd_klinik']=='03' or Yii::app()->session['kd_klinik']=='04' or Yii::app()->session['kd_klinik']=='05' or Yii::app()->session['kd_klinik']=='06' ) { ?> 
          <li class="nav-item">
          <a href="#" class="nav-link">
          <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Poli Klinik
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview"> 
          <li class="nav-item">
              <a href="index.php?r=Poliklinik/DaftarRegistrasi" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> Pasien</p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="index.php?r=Poliklinik/DaftarRegistrasi" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Database</p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="index.php?r=Registrasi/DaftarRegistrasi" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Daftar Tindakan</p>
              </a>
            </li> 
               
            <li class="nav-item">
              <a href="index.php?r=pegawai/Daftarpegawai" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Monitoring</p>
              </a>
            </li>          
                   
          </ul>
        </li>
        <?php }?>


      <!-- Menu Administrator -->  
      <?php if(Yii::app()->session['kd_klinik']=='10') { ?>   
      <li class="nav-item">
        <a href="#" class="nav-link">
        <i class="nav-icon fas fa-chart-pie"></i>
          <p>
            Data Master
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview"> 

            <li class="nav-item">
            <a href="index.php?r=User/DaftarUser" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Daftar User</p>
            </a>
          </li>  
          <li class="nav-item">
            <a href="index.php?r=Support/DaftaJabatan" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Kode Jabatan</p>
            </a>
          </li> 
          <li class="nav-item">
            <a href="index.php?r=Klinik/DaftarKlinik" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Kode Klinik</p>
            </a>
          </li>           
          
        </ul>
      </li>
      <?php }?>
  
  <?php }?>


  <!-- Menu Logout -->  
  <li class="nav-item">
    <a href="index.php?r=Site/Logout" class="nav-link">
    <i class="nav-icon far fa-circle text-danger"></i>
      <p> Logout </p>
    </a>
  </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">


    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            <div class="card">

              <div class="card-body">
              <?php echo $content; ?>
              </div>
              <!-- /.card-body -->
              <!-- <div class="card-footer">
                Footer
              </div> -->
              <!-- /.card-footer-->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2021 <a href="https://adminlte.io">ULP UNEJ</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="themes/AdminLTE/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="themes/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="themes/AdminLTE/plugins/sweetalert2/sweetalert2.all.js"></script>
<!-- overlayScrollbars -->
<script src="themes/AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="themes/AdminLTE/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="themes/AdminLTE/dist/js/demo.js"></script>
</body>
</html>
