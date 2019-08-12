    <!-- Theme CSS -->
    <link rel="stylesheet" type="text/css" href="assets/skin/default_skin/css/theme.css">

  <?php

    if(isset(Yii::app()->session['id_unitkerja'])) {
        $id_unitkerja     =Yii::app()->session['id_unitkerja'];
    }else
        $id_unitkerja     =99999;

    $tahun_anggaran='2015';
    $id_jenis_buku='1';



//    $RecordData=Yii::app()->db->createCommand("select * from keuangan.fnget_saldopembukuan($id_unitkerja,$tahun_anggaran,2);")->queryRow();
//    $BP_Kas   =$RecordData['saldo'];
//
//    $RecordData=Yii::app()->db->createCommand("select * from keuangan.fnget_saldopembukuan($id_unitkerja,$tahun_anggaran,5);")->queryRow();
//    $BP_UP   =$RecordData['saldo'];
//
//    $RecordData=Yii::app()->db->createCommand("select * from keuangan.fnget_saldopembukuan($id_unitkerja,$tahun_anggaran,7);")->queryRow();
//    $BP_LS   =$RecordData['saldo'];
//
//    $RecordData=Yii::app()->db->createCommand("select * from keuangan.fnget_saldopembukuan($id_unitkerja,$tahun_anggaran,8);")->queryRow();
//    $BP_UM   =$RecordData['saldo'];
//
//    $RecordData=Yii::app()->db->createCommand("select * from keuangan.fnget_saldopembukuan($id_unitkerja,$tahun_anggaran,9);")->queryRow();
//    $BP_Lain   =$RecordData['saldo'];
//
//    $RecordData=Yii::app()->db->createCommand("select * from keuangan.fnget_saldopembukuan($id_unitkerja,$tahun_anggaran,10);")->queryRow();
//    $BP_Pajak   =$RecordData['saldo'];



   ?>
 <!-- Dashboard Tiles -->
                <div class="row mb10">
                    <div class="col-md-3">
                        <div class="panel bg-alert light of-h mb10">
                            <div class="pn pl20 p5">

                                <h2 class="mt15 lh15"> <b>Vol.<?php echo number_format( $BP_Kas , 0 , "" , '.' )?> </b> </h2>
                                <h5 class="text-muted">OBAT EXPIRED</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="panel bg-info light of-h mb10">
                            <div class="pn pl20 p5">
                               
                                <h2 class="mt15 lh15"> <b>Vol.<?php echo number_format( $BP_UM , 0 , "" , '.' )?> </b> </h2>
                                <h5 class="text-muted">OBAT RUSAK</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="panel bg-danger light of-h mb10">
                            <div class="pn pl20 p5">
                               
                                <h2 class="mt15 lh15"> <b>Rp.<?php echo number_format( $BP_UP , 0 , "" , '.' )?> </b> </h2>
                                <h5 class="text-muted">NILAI ASET </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="panel bg-warning light of-h mb10">
                            <div class="pn pl20 p5">
                               
                                <h2 class="mt15 lh15"> <b>Rp.<?php echo number_format( $BP_LS , 0 , "" , '.' )?> </b> </h2>
                                <h5 class="text-muted">NILAI ASET</h5>
                            </div>
                        </div>
                    </div>
                </div>
  
    <center><b>GRAFIK STOK BARANG / OBAT TERENDAH 2015 <?php echo "Jenis Persediaan "?></b>
<br>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Simkeu Universitas Jember</title>
        <link rel="stylesheet" href="style.css" type="text/css">
        <link href='http://fonts.googleapis.com/css?family=Covered+By+Your+Grace' rel='stylesheet' type='text/css'>
        <script src="../charts/amcharts.js" type="text/javascript"></script>
        <script src="../charts/serial.js" type="text/javascript"></script>
        <script src="../charts/pie.js" type="text/javascript"></script>
        <!-- theme files. you only need to include the theme you use.
             feel free to modify themes and create your own themes -->

        <script>
        // in order to set theme for a chart, all you need to include theme file
        // located in charts/themes folder and set theme property for the chart.

        var chart1;
        var chart2;

        makeCharts("light", "#FFFFFF");

        // Theme can only be applied when creating chart instance - this means
        // that if you need to change theme at run time, youhave to create whole
        // chart object once again.

        function makeCharts(theme, bgColor, bgImage) {

        <?php

//        $dbcmd = Yii::app()->db->createCommand("select * from keuangan.fndaftar_monitoring_anggaran(2015)")->queryAll();

        ?>


            if (chart1) {
                chart1.clear();
            }
            if (chart2) {
                chart2.clear();
            }


            // column chart
            chart1 = AmCharts.makeChart("chartdiv1", {
                type: "serial",
                theme: theme,
                dataProvider: [{
                  "fakultas": "FH",
                    "jumlah":<?php echo $dbcmd[0]['realisasiup'];?>,
                    "color": "#FF0F00"
                }, {
                   "fakultas": "Fisip",
                    "jumlah":<?php echo $dbcmd[1]['realisasiup'];?>,
                    "color": "#FF6600"
          
                }, {
				
               "fakultas": "Faperta",
                    "jumlah":<?php echo $dbcmd[2]['realisasiup'];?>,
                    "color": "#FF9E01"
          
                },
                    {
             "fakultas": "FE",
                        "jumlah":<?php echo $dbcmd[3]['realisasiup'];?>,
                    "color": "#FCD202"
                  }, {
             "fakultas": "FKIP",
                        "jumlah":<?php echo $dbcmd[4]['realisasiup'];?>,
                    "color": "#F8FF01"
				
				 }, {
             "fakultas": "FS",
                        "jumlah":<?php echo $dbcmd[5]['realisasiup'];?>,
                    "color": "#B0DE09"
                 }, {
                        "fakultas": "FTP",
                        "jumlah":<?php echo $dbcmd[6]['realisasiup'];?>,
                        "color": "#0D52D1"
				
				}, {
             "fakultas": "FKG",
                        "jumlah":<?php echo $dbcmd[7]['realisasiup'];?>,
                     "color": "#04D215"
				}, {
             "fakultas": "FMIPA",
                        "jumlah":<?php echo $dbcmd[8]['realisasiup'];?>,
                  "color": "#0D8ECF"

					}, {
             "fakultas": "FK",
                        "jumlah":<?php echo $dbcmd[9]['realisasiup'];?>,
                    "color": "#2A0CD0"
						}, {
             "fakultas": "FT",
                        "jumlah":<?php echo $dbcmd[10]['realisasiup'];?>,
                      "color": "#8A0CCF"
					}, {
             "fakultas": "FKM",
                        "jumlah":<?php echo $dbcmd[11]['realisasiup'];?>,
                         "color": "#CD0D74"
					
					}, {
             "fakultas": "FF",
                        "jumlah":<?php echo $dbcmd[12]['realisasiup'];?>,
                        "color": "#754DEB"
	                }, {
             "fakultas": "PSIK",
                        "jumlah":<?php echo $dbcmd[13]['realisasiup'];?>,
                      "color": "#DDDDDD"
	                }, {
             "fakultas": "PSSI",
                        "jumlah":<?php echo $dbcmd[14]['realisasiup'];?>,
                          "color": "#999999"	 
					
				}],
                categoryField: "fakultas",
				
                startDuration: 1,					   
				depth3D : 15,
                angle : 30,
				

                categoryAxis: {
                    gridPosition: "start"
                },
                valueAxes: [{
                    title: "Jumlah"
                }],
                graphs: [{
                    type: "column",
                  
                    valueField: "jumlah",
					colorField: "color",
                    lineAlpha: 0,
                    fillAlphas: 0.8,
					balloonText: "[[category]]:<b>[[value]]</b>",

                }, {
                    type: "line",
                   
                    valueField: "jumlah",
                    lineThickness: 2,
                    fillAlphas: 0,
                    bullet: "round",
                    balloonText: "[[category]]:<b>[[value]]</b>"
                }],
                legend: {
                    useGraphSettings: true
                }

            });

            // pie chart
            chart2 = AmCharts.makeChart("chartdiv2", {
                type: "pie",
                theme: theme,
                dataProvider: [{
                   "fakultas": "Kantor Pusat",
                    "value": <?php echo $dbcmd[23]['realisasiup'];?>
                }, {
                  "fakultas": "UPT. Kesehatan",
                    "value": <?php echo $dbcmd[17]['realisasiup'];?>
               
                }, {
                  "fakultas": "UPT. Perpustakaan",
                    "value":  <?php echo $dbcmd[18]['realisasiup'];?>
               
                }, {
                     "fakultas": "UPT. TI",
                    "value":  <?php echo $dbcmd[19]['realisasiup'];?>
			    }, {
                     "fakultas": "UPT. Bahasa",
                    "value":  <?php echo $dbcmd[20]['realisasiup'];?>
			    }, {
                     "fakultas": "Lemlit",
                    "value":  <?php echo $dbcmd[21]['realisasiup'];?>
			    }, {
                     "fakultas": "LP3",
                    "value":  <?php echo $dbcmd[22]['realisasiup'];?>
			    }, {
                     "fakultas": "LPM",
                    "value":  <?php echo $dbcmd[24]['realisasiup'];?>
			    }, {
                    "fakultas": "UKM",
                    "value":  <?php echo $dbcmd[25]['realisasiup'];?>
                }],
                titleField: "fakultas",
                valueField: "value",
                balloonText: "[[title]]<br><b>[[value]]</b> ([[percents]]%)",
				depth3D: 15,
                angle:30,
                legend: {
                    align: "center",
                    markerType: "circle"
                }
            });

        }


        </script>


        <div id="chartdiv1" style="width: 100%; height: 400px;"></div>
        <div id="chartdiv2" style="width: 100%; height: 450px;"></div>
