<?php
if ($action=='excel'){
    header("Content-Type: application/force-download");
    header("Cache-Control: no-cache, must-revalidate");
    header("content-disposition: attachment;filename=rekap_mutasi_barang".date('dmY').".xls");
}

?>
<STYLE>
<!--
  tr { }
  .initial { background-color: #FFFFFF; color:#000000 }
  .normal { background-color: #FFFFFF }
  .highlight { background-color: #DFFBED }
 //-->
</style>

<script type="text/javascript">

       function detaildata(id_barang)
       {
           var url = '/index.php?r=Rekap/KartuPersediaanBarang';
           var form = $('<form action="' + url + '" method="POST">' +
               '<input type="hidden" name="id_barang" value="' + id_barang + '" />' +
               '<input type="hidden" name="ddltahun" value="' + $('#ddltahun').val() + '" />' +
               '<input type="hidden" name="ddlskpd" value="' + $('#ddlskpd').val() + '" />' +

               '<input type="hidden" name="txttgl_mulai" value="' + $('#txttgl_mulai').val() + '" />' +
               '<input type="hidden" name="txttgl_akhir" value="' + $('#txttgl_akhir').val() + '" />' +
               '<input type="hidden" name="ddlsumberdana" value="' + $('#ddlsumberdana').val() + '" />' +
               '</form>');
           $('body').append(form);
           $(form).submit();
       }
    function proses()    {
           var url = '/index.php?r=Rekap/RekapMutasiBarang';
            var form = $('<form action="' + url + '" method="POST">' +

                '<input type="hidden" name="action" value="proses" />' +
                '<input type="hidden" name="ddltahun" value="' + $('#ddltahun').val() + '" />' +
                '<input type="hidden" name="ddlskpd" value="' + $('#ddlskpd').val() + '" />' +
                '<input type="hidden" name="txttgl_mulai" value="' + $('#txttgl_mulai').val() + '" />' +
                '<input type="hidden" name="txttgl_akhir" value="' + $('#txttgl_akhir').val() + '" />' +
                '<input type="hidden" name="ddlsumberdana" value="' + $('#ddlsumberdana').val() + '" />' +
                '</form>');
            $('body').append(form);
            $(form).submit();


    }
       function cetakexcel()
       {
           var url = '/index.php?r=Rekap/RekapMutasiBarang';
           var form = $('<form action="' + url + '" method="POST">' +
               '<input type="hidden" name="action" value="excel" />' +
               '<input type="hidden" name="ddltahun" value="' + $('#ddltahun').val() + '" />' +
               '<input type="hidden" name="ddlskpd" value="' + $('#ddlskpd').val() + '" />' +
               '<input type="hidden" name="txttgl_mulai" value="' + $('#txttgl_mulai').val() + '" />' +
               '<input type="hidden" name="txttgl_akhir" value="' + $('#txttgl_akhir').val() + '" />' +
               '<input type="hidden" name="ddlsumberdana" value="' + $('#ddlsumberdana').val() + '" />' +
               '</form>');
           $('body').append(form);
           $(form).submit();
       }

       function cetakpdf()
       {
           var url = '/index.php?r=Rekap/RekapMutasiBarang';
           var form = $('<form action="' + url + '" method="POST" + target=_blank>' +
               '<input type="hidden" name="action" value="pdf" />' +
               '<input type="hidden" name="ddltahun" value="' + $('#ddltahun').val() + '" />' +
               '<input type="hidden" name="ddlskpd" value="' + $('#ddlskpd').val() + '" />' +
               '<input type="hidden" name="txttgl_mulai" value="' + $('#txttgl_mulai').val() + '" />' +
               '<input type="hidden" name="txttgl_akhir" value="' + $('#txttgl_akhir').val() + '" />' +
               '<input type="hidden" name="ddlsumberdana" value="' + $('#ddlsumberdana').val() + '" />' +
               '</form>');
           $('body').append(form);
           $(form).submit();
       }

       function cetakpdflap()
       {
           var url = '/index.php?r=Rekap/RekapMutasiBarang';
           var form = $('<form action="' + url + '" method="POST" + target=_blank>' +
               '<input type="hidden" name="action" value="pdf_lap" />' +
               '<input type="hidden" name="ddltahun" value="' + $('#ddltahun').val() + '" />' +
               '<input type="hidden" name="ddlskpd" value="' + $('#ddlskpd').val() + '" />' +
               '<input type="hidden" name="txttgl_mulai" value="' + $('#txttgl_mulai').val() + '" />' +
               '<input type="hidden" name="txttgl_akhir" value="' + $('#txttgl_akhir').val() + '" />' +
               '<input type="hidden" name="ddlsumberdana" value="' + $('#ddlsumberdana').val() + '" />' +
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


<div class="panel-heading">
    <i class="fa fa-external-link-square"></i>
    <b>REKAP MUTASI BARANG </b>
</div>
<br>
<table border=0 cellspacing=0 cellpadding=0 width=1000>
    <tr>
        <td valign="top" width=120><?php echo "Tahun"?></td>
        <td valign="top" width=20><?php echo ":"?></td>
        <td valign="top">
            <?php  echo CHtml::dropDownList('ddltahun',$tahun,$ReferensiModel->getdaftartahun()
            , array('onChange'=>'this.form.submit();','style'=>'width: 80px;background-color: #F3FDF0'
            ,'disabled'=>false,
                'options'=>array($tahun=>array('selected'=>'selected'))));
        ?>


        </td>
    </tr>

    <tr>
        <td valign="top" width=120><?php echo "Unit Kerja"?></td>
        <td valign="top" width=20><?php echo ":"?></td>
        <td valign="top">
            <?php
            if(Yii::app()->session['id_level_user']=='9'   )
            {
                echo CHtml::dropDownList('ddlskpd',$id_skpd,$ReferensiModel->getdaftarskpdunit(Yii::app()->session['id_skpd'])
                    , array('onChange'=>'this.form.submit();','style'=>'width: 400px;background-color: #F3FDF0'
                    , 'prompt'=>'Semua'
                    ,'disabled'=>FALSE,
                        'options'=>array($id_skpd=>array('selected'=>'selected'))));
            }
            else
            {
                echo CHtml::dropDownList('ddlskpd',$id_skpd,$ReferensiModel->getdaftarskpdunit(Yii::app()->session['id_skpd'])
                    , array('onChange'=>'this.form.submit();','style'=>'width: 400px;background-color: #F3FDF0'
                    , 'prompt'=>'Semua'
                    ,'disabled'=>FALSE,
                        'options'=>array($id_skpd=>array('selected'=>'selected'))));
            }
            ?>

        </td>
    </tr>

    <tr>
        <td valign="top" width=120><?php echo "Tanggal "?></td>
        <td valign="top" width=20><?php echo ":"?></td>
        <td valign="top">
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                'name'=>'txttgl_mulai',
                'value'=>Yii::app()->dateFormatter->format("dd MMMM yyy",$tgl_mulai),
                'options'=>array(
                    'showAnim'=>'fold',
                ),
                'htmlOptions'=>array(
                    'title' => 'tgl_mulai',
                    'style' => 'width:150px'
                ), ));
            ?>
            <?php echo " s/d "?>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                'name'=>'txttgl_akhir',
                'value'=>Yii::app()->dateFormatter->format("dd MMMM yyy",$tgl_akhir),
                'options'=>array(
                    'showAnim'=>'fold',
                ),
                'htmlOptions'=>array(
                    'title' => 'tgl_akhir',
                    'style' => 'width:150px'
                ), ));
            ?>

            <?php echo CHtml::image('/images/eksekusi0.png','',
                array(
                    'title' => 'Proses',
                    'style' => 'width:20px',
                    "onClick"=>"proses()"
                ));?>
        </td>
    </tr>
    <tr>
        <td valign="top" width=120><?php echo "Sumber Dana"?></td>
        <td valign="top" width=20><?php echo ":"?></td>
        <td valign="top">
            <?php  echo CHtml::dropDownList('ddlsumberdana',$id_sumber_dana,$ReferensiModel->getdaftarsumberdana()
                , array('onChange'=>'this.form.submit();','style'=>'width: 100px;background-color: #F3FDF0'
                , 'prompt'=>'Semua'
                ,'disabled'=>false,
                    'options'=>array($id_sumber_dana=>array('selected'=>'selected'))));
            ?>

            <?php echo CHtml::button('Cetak RMP',
                array(
                    'title' => 'Cetak RMP',
                    'style' => 'width:100px',
                    "onClick"=>"cetakpdf()"
                ));  ?>

            <?php echo CHtml::button('Cetak Lap Persediaan',
                array(
                    'title' => 'Cetak RMP',
                    'style' => 'width:200px',
                    "onClick"=>"cetakpdflap()"
                ));  ?>

            <?php echo CHtml::button('Export Excel',
                array(
                    'title' => 'Export Excel',
                    'style' => 'width:100px',
                    "onClick"=>"cetakexcel()"
                ));  ?>
        </td>
    </tr>
</table>




<table border=1  bordercolor=#96EBFD cellspacing=1 cellpadding=1 width=1000>
    <thead>
    <tr rowspan="2" align="center" height='40px' bgcolor="#C4E9fA">
      <th width=50 rowspan="3" align='center'>Nox</th>
      <th width=200 rowspan="3" align='center'>Barang</th>
      <th width=50 rowspan="3" align='center'>Satuan</th>
      <th colspan="2" rowspan="2" align='center'>Saldo Awal </th>
      <th colspan="4" align='center'>Mutasi</th>
      <th colspan="2" rowspan="2" align='center'>Saldo Akhir </th>
      <th width=50 rowspan="3" align='center'>Aksi </th>
    </tr>
    <tr rowspan="2" align="center" height='40px' bgcolor="#C4E9fA">
      <th colspan="2" align='center'>Bertambah</th>
      <th colspan="2" align='center'>Berkurang</th>
      </tr>
    <tr rowspan="2" align="center" height='40px' bgcolor="#C4E9fA">
        <th align='center' width=50>Kuantitas</th>
        <th align='center' width=100>Nilai</th>
        <th align='center' width=50>Kuantitas</th>
        <th align='center' width=100>Nilai</th>
        <th align='center' width=50>Kuantitas</th>
        <th align='center' width=100>Nilai</th>
        <th align='center' width=50>Kuantitas</th>
        <th align='center' width=100>Nilai</th>
      </tr>
    </thead>
    <tbody>
    <?php $number = 1; ?>
    <?php foreach($dataProvider as $value): ?>
    <tr height="30" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
        <td valign="top" align="center"><?php echo $value["id_barang"] ?>.</td>

        <td valign="top"><?php echo $value["nama_barang"]?></td>
        <td valign="top" align="center"><?php echo $value["satuan"]?></td>


        <td valign="top" align="right"> <?php echo  $value["saldoawal_volume"]?></td>
        <td valign="top" align="right"> <?php echo $value["saldoawal_jumlah"]?></td>


         <td valign="top" align="right"> <?php echo $value["penerimaan_volume"]?></td>
         <td valign="top" align="right"> <?php echo  $value["penerimaan_jumlah"]?></td>

         <td valign="top" align="right"> <?php echo  $value["pengeluaran_volume"]?></td>
         <td valign="top" align="right"> <?php echo $value["pengeluaran_jumlah"]?></td>

        <td valign="top" align="right"> <?php echo  $value["saldoakhir_volume"]?></td>
<!--        <td valign="top" align="right"> --><?php //echo  $value["saldoakhir_jumlah"]?><!--</td>-->
        <td valign="top" align="right"> <?php echo number_format( $value["saldoakhir_jumlah"] , 0 , "" , '.' )?></td>

        <td valign="top" align="center">

      <?php
            if ($action!='excel'){
                echo CHtml::image('/images/kpi1.png','',
                    array(
                        'title' => 'Kartu Persediaan Barang',
                        'style' => 'width:20px',
                        "onClick"=>"detaildata('$value[id_barang]')"
                    ));
            }


         ?>
    </tr>
    </tbody>
    <?php endforeach; ?>
</table>
</td></tr>
</table>
<?php
echo CHtml::endForm();
?>




