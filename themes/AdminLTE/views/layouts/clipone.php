<!DOCTYPE html>
<!-- Template Name: Clip-One - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.4 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
	<!--<![endif]-->
	<!-- start: HEAD -->
	<head>
        <?php

        if(Yii::app()->session['statuslogin'] ==true) {
            $beban_anggaran     =Yii::app()->session['beban_anggaran'];
        }else
            $beban_anggaran     ='';
        ?>

        <title>
            Sistem Informasi Persediaan (<?php echo $beban_anggaran; ?>)
        </title>
		<!-- start: META -->
		<meta charset="utf-8" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<!-- end: META -->
		<!-- start: MAIN CSS -->
		<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/fonts/style.css">
		<link rel="stylesheet" href="assets/css/main.css">
		<link rel="stylesheet" href="assets/css/main-responsive.css">
		<link rel="stylesheet" href="assets/plugins/iCheck/skins/all.css">
		<link rel="stylesheet" href="assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css">
		<link rel="stylesheet" href="assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css">
		<link rel="stylesheet" href="assets/css/theme_light.css" type="text/css" id="skin_color">
		<link rel="stylesheet" href="assets/css/print.css" type="text/css" media="print"/>
		<!--[if IE 7]>
		<link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome-ie7.min.css">
		<![endif]-->
		<!-- end: MAIN CSS -->
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
		<link rel="shortcut icon" href="favicon.ico" />
	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<body>
		<!-- start: HEADER -->
		<div class="navbar navbar-inverse navbar-fixed-top">
			<!-- start: TOP NAVIGATION CONTAINER -->
			<div class="container">
				<div class="navbar-header">
					<!-- start: RESPONSIVE MENU TOGGLER -->
					<button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
						<span class="clip-list-2"></span>
					</button>
					<!-- end: RESPONSIVE MENU TOGGLER -->
					<!-- start: LOGO -->
					<a class="navbar-brand">
					<img src="assets/images/logo_unej.png" alt="logo unej"> PBJ UNEJ <?php echo Yii::app()->session['nama_skpd'].' '.Yii::app()->session['tahun_anggaran'] ; ?>
					</a>
					<!-- end: LOGO -->
				</div>
				<div class="navbar-tools">
					<!-- start: TOP NAVIGATION MENU -->
					<ul class="nav navbar-right">
						<!-- start: TO-DO DROPDOWN -->
						
						<!-- end: TO-DO DROPDOWN-->
						<!-- start: NOTIFICATION DROPDOWN -->
						
						<!-- end: NOTIFICATION DROPDOWN -->
						<!-- start: MESSAGE DROPDOWN -->
						
						<!-- end: MESSAGE DROPDOWN -->
						<!-- start: USER DROPDOWN -->
						<li class="dropdown current-user">
							<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
								<img src="assets/images/avatar-1-small.jpg" class="circle-img" alt="">
								<span class="username">
                                  <?php
                                    if(Yii::app()->session['statuslogin']==true)
                                    {
                                        echo Yii::app()->session['nama_lengkap'];
                                    }
                                    else
                                        echo "Login";

                                    ?>

                                </span>
								<i class="clip-chevron-down"></i>
							</a>
							<ul class="dropdown-menu">
								<li>
									<a>
										<i class="clip-user-2"></i>
                                        <?php
                                        if(Yii::app()->session['statuslogin']==true)
                                        {
                                            echo "".Yii::app()->session['level_user'];
                                        }
                                        else
                                            echo "Level";

                                        ?>
									</a>
								</li>
								<li>
									<a>
										<i class="clip-calendar"></i>
                                        <?php
                                        if(Yii::app()->session['statuslogin']==true)
                                        {
                                            echo "".Yii::app()->session['nama_unitkerja'];
                                        }
                                        else
                                            echo "Unitkerja";

                                        ?>
									</a>
								<li>
<!--									<a>-->
<!--										<i class="clip-bubble-4"></i>-->
<!--                                    --><?php
//                                    if(Yii::app()->session['statuslogin']==true)
//                                    {
//                                        echo "".Yii::app()->session['nama_unitkerja'];
//                                    }
//                                    else
//                                        echo "Unitkerja";
//
//                                    ?>
<!--									</a>-->
								</li>
								<li class="divider"></li>
<!--								<li>-->
<!--									<a href="utility_lock_screen.html"><i class="clip-locked"></i>-->
<!--										&nbsp;Lock Screen </a>-->
<!--								</li>-->
								<li>
									<a href="index.php?r=site/login">
										<i class="clip-exit"></i>
                                        <?php
                                        if(Yii::app()->session['statuslogin']==true)
                                        {
                                            echo "Log Out";
                                        }
                                        else
                                            echo "Log In";

                                        ?>

									</a>
								</li>
							</ul>
						</li>
						<!-- end: USER DROPDOWN -->
						<!-- start: PAGE SIDEBAR TOGGLE -->
						
						<!-- end: PAGE SIDEBAR TOGGLE -->
					</ul>
					<!-- end: TOP NAVIGATION MENU -->
				</div>
			</div>
			<!-- end: TOP NAVIGATION CONTAINER -->
		</div>
		<!-- end: HEADER -->
		<!-- start: MAIN CONTAINER -->
		<div class="main-container">
			<div class="navbar-content">
				<!-- start: SIDEBAR -->
				<div class="main-navigation navbar-collapse collapse">
					<!-- start: MAIN MENU TOGGLER BUTTON -->
					<div class="navigation-toggler">
						<i class="clip-chevron-left"></i>
						<i class="clip-chevron-right"></i>
					</div>
					<!-- end: MAIN MENU TOGGLER BUTTON -->
<!-- start: MAIN NAVIGATION MENU -->
					<ul class="main-navigation-menu">
						<li class="active open">
							<a href="index.php"><i class="clip-home-3"></i>
								<span class="title"> Dashboard </span><span class="selected"></span>
							</a>
						</li>

                        <!------------------------------   MENU PBJ   ---------------------------------------->
						<?php
                        if(Yii::app()->session['statuslogin']==true )
                        { ?>
							<li>
								<a href="index.php?r=Rup/DaftarRup"><i class="clip-grid-6"></i>
									<span class="title"> Paket RUP </span>
								</a>
							</li>
							<li>
								<a href="index.php?r=Ls/DaftarLs"><i class="clip-pencil"></i>
									<span class="title"> Pembelian langsung </span>
								</a>
							</li>
							<li>
								<a href="index.php?r=peg/index"><i class="clip-screen"></i>
									<span class="title"> Penyedia</span>
								</a>
							</li>
							<li>
								<a href="index.php?r=peg/index"><i class="clip-cog-2"></i>
									<span class="title"> DHS</span>
								</a>
							</li>

							<li>
								<a href="index.php?r=monitoring/RekapJenisPengadaan"><i class="clip-cog-2"></i>
									<span class="title"> Monitoring</span>
								</a>
							</li>
							

							
                        <?php }
						?>
                       

                        <!------------------------------   MODUL DOWNLOAD    ---------------------------------------->
                        <?php
                        if(Yii::app()->session['statuslogin']==true && (Yii::app()->session['id_level_user']==1 or
                            Yii::app()->session['id_level_user']==9
                        ))
                        { ?>
                            <li>
                                <a href="images/panduan.pdf" target="_blank"><i class="clip-screen"></i>
                                    <span class="title">Panduan Aplikasi </span><i class="icon-arrow"></i>
                                    <span class="selected"></span>
                                </a>

                            </li>
                        <?php }
                        ?>

                        
					<!-- end: MAIN NAVIGATION MENU -->
				</div>
				<!-- end: SIDEBAR -->
			</div>
			<!-- start: PAGE -->
			<div class="main-content">
				<!-- start: PANEL CONFIGURATION MODAL FORM -->
				<div class="modal fade" id="panel-config" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
									&times;
								</button>
								<h4 class="modal-title">Panel Configuration</h4>
							</div>
							<div class="modal-body">
								Here will be a configuration form
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">
									Close
								</button>
								<button type="button" class="btn btn-primary">
									Save changes
								</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->
				<!-- end: SPANEL CONFIGURATION MODAL FORM -->
				<div class="container">
					<!-- start: PAGE HEADER -->
					<div class="row">
						<div class="col-sm-12">
							<!-- start: STYLE SELECTOR BOX -->
							<div id="style_selector" class="hidden-xs">
								<div id="style_selector_container">
									<div class="style-main-title">
										Style Selector
									</div>
									<div class="box-title">
										Choose Your Layout Style
									</div>
									<div class="input-box">
										<div class="input">
											<select name="layout">
												<option value="default">Wide</option><option value="boxed">Boxed</option>
											</select>
										</div>
									</div>
									<div class="box-title">
										Choose Your Header Style
									</div>
									<div class="input-box">
										<div class="input">
											<select name="header">
												<option value="fixed">Fixed</option><option value="default">Default</option>
											</select>
										</div>
									</div>
									<div class="box-title">
										Choose Your Footer Style
									</div>
									<div class="input-box">
										<div class="input">
											<select name="footer">
												<option value="default">Default</option><option value="fixed">Fixed</option>
											</select>
										</div>
									</div>
									<div class="box-title">
										Backgrounds for Boxed Version
									</div>
									<div class="images boxed-patterns">
										<a id="bg_style_1" href="#"><img alt="" src="assets/images/bg.png"></a>
										<a id="bg_style_2" href="#"><img alt="" src="assets/images/bg_2.png"></a>
										<a id="bg_style_3" href="#"><img alt="" src="assets/images/bg_3.png"></a>
										<a id="bg_style_4" href="#"><img alt="" src="assets/images/bg_4.png"></a>
										<a id="bg_style_5" href="#"><img alt="" src="assets/images/bg_5.png"></a>
									</div>
									<div class="box-title">
										5 Predefined Color Schemes
									</div>
									<div class="images icons-color">
										<a id="light" href="#"><img class="active" alt="" src="assets/images/lightgrey.png"></a>
										<a id="dark" href="#"><img alt="" src="assets/images/darkgrey.png"></a>
										<a id="black_and_white" href="#"><img alt="" src="assets/images/blackandwhite.png"></a>
										<a id="navy" href="#"><img alt="" src="assets/images/navy.png"></a>
										<a id="green" href="#"><img alt="" src="assets/images/green.png"></a>
									</div>
									<div class="box-title">
										Style it with LESS
									</div>
									<div class="images">
										<div class="form-group">
											<label>
												Basic
											</label>
											<input type="text" value="#ffffff" class="color-base">
											<div class="dropdown">
												<a class="add-on dropdown-toggle" data-toggle="dropdown"><i style="background-color: #ffffff"></i></a>
												<ul class="dropdown-menu pull-right">
													<li>
														<div class="colorpalette"></div>
													</li>
												</ul>
											</div>
										</div>
										<div class="form-group">
											<label>
												Text
											</label>
											<input type="text" value="#555555" class="color-text">
											<div class="dropdown">
												<a class="add-on dropdown-toggle" data-toggle="dropdown"><i style="background-color: #555555"></i></a>
												<ul class="dropdown-menu pull-right">
													<li>
														<div class="colorpalette"></div>
													</li>
												</ul>
											</div>
										</div>
										<div class="form-group">
											<label>
												Elements
											</label>
											<input type="text" value="#007AFF" class="color-badge">
											<div class="dropdown">
												<a class="add-on dropdown-toggle" data-toggle="dropdown"><i style="background-color: #007AFF"></i></a>
												<ul class="dropdown-menu pull-right">
													<li>
														<div class="colorpalette"></div>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<div style="height:25px;line-height:25px; text-align: center">
										<a class="clear_style" href="#">
											Clear Styles
										</a>
										<a class="save_style" href="#">
											Save Styles
										</a>
									</div>
								</div>
								<div class="style-toggle close"></div>
							</div>
							<!-- end: STYLE SELECTOR BOX -->
							<!-- start: PAGE TITLE & BREADCRUMB -->
	
							<div class="page-headerx">
									<?php echo $content; ?>
									
							</div>
							
							<!-- end: PAGE TITLE & BREADCRUMB -->
						</div>
					</div>
					<!-- end: PAGE HEADER -->
					<!-- start: PAGE CONTENT -->
					<!-- end: PAGE CONTENT-->
				</div>
			</div>
			<!-- end: PAGE -->
		</div>
		<!-- end: MAIN CONTAINER -->
		<!-- start: FOOTER -->
		<div class="navbar navbar-inverse navbar-fixed-bottom">
		   <div class="footer clearfix">
					<ol class="breadcrumb">
                        <?php
//                        $dbcmd01 = Yii::app()->db->createCommand("select * from keuangan.fndaftar_pengumuman_aktif()")->queryAll();
//                        $pengumuman=$dbcmd01[0]['pengumuman'];
                        ?>
								 <marquee><font color="red" size="3"><?php echo "$pengumuman";?></font></marquee>
                                 Designed by <a href=http://dinkes.bondowoso.go.id" target="_new">Dinas Kesehatan Bondowos 2015</a>. All Rights Reserved.
								 <li class="search-box">
								 <li class="search-box">
									
								</li>
							</ol>	
        						
			
		</div>
		</div>
		
		<!-- end: FOOTER -->
		<!-- start: RIGHT SIDEBAR -->

		<!-- end: RIGHT SIDEBAR -->
		<!-- start: MAIN JAVASCRIPTS -->
		<!--[if lt IE 9]>
		<script src="assets/plugins/respond.min.js"></script>
		<script src="assets/plugins/excanvas.min.js"></script>
		<script type="text/javascript" src="assets/plugins/jQuery-lib/1.10.2/jquery.min.js"></script>
		<![endif]-->
		<!--[if gte IE 9]><!-->
		<script src="assets/plugins/jQuery-lib/2.0.3/jquery.min.js"></script>
		<!--<![endif]-->
		<script src="assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
		<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
		<script src="assets/plugins/blockUI/jquery.blockUI.js"></script>
		<script src="assets/plugins/iCheck/jquery.icheck.min.js"></script>
		<script src="assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
		<script src="assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
		<script src="assets/plugins/less/less-1.5.0.min.js"></script>
		<script src="assets/plugins/jquery-cookie/jquery.cookie.js"></script>
		<script src="assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
		<script src="assets/js/main.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script>
			jQuery(document).ready(function() {
				Main.init();
			});
		</script>
	</body>
	<!-- end: BODY -->
</html>