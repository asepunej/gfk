<?php
if ($action=='excel'){
    header("Content-Type: application/force-download");
    header("Cache-Control: no-cache, must-revalidate");
    header("content-disposition: attachment;filename=kartu_persediaan_barang".date('dmY').".xls");
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


    function Kembali(){
        var url = '/index.php?r=Rekap/RekapMutasiBarang';
        var form = $('<form action="' + url + '" method="POST">' +
            '<input type="hidden" name="ddltahun" value="' + $('#ddltahun').val() + '" />' +
            '<input type="hidden" name="ddlskpd" value="' + $('#ddlskpd').val() + '" />' +

            '<input type="hidden" name="txttgl_mulai" value="' + $('#txttgl_mulai').val() + '" />' +
            '<input type="hidden" name="txttgl_akhir" value="' + $('#txttgl_akhir').val() + '" />' +
            '<input type="hidden" name="ddlsumberdana" value="' + $('#ddlsumberdana').val() + '" />' +

            '</form>');
        $('body').append(form);
        $(form).submit();
    }

    function detailpengeluaran01(id_barang)
    {
        var url = '/index.php?r=Rekap/RekapPengeluaranBarang01';
        var form = $('<form action="' + url + '" method="POST" + target=_blank>' +
            '<input type="hidden" name="id_barang" value="' + id_barang + '" />' +
            '<input type="hidden" name="ddltahun" value="' + $('#ddltahun').val() + '" />' +
            '<input type="hidden" name="ddlskpd" value="' + $('#ddlskpd').val() + '" />' +
            '<input type="hidden" name="txttgl_mulai" value="' + $('#txttgl_mulai').val() + '" />' +
            '<input type="hidden" name="txttgl_akhir" value="' + $('#txttgl_akhir').val() + '" />' +
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
    <b>DETAIL PENGELUARAN BARANG</b>
</div>
<br>
<table border=0 cellspacing=0 cellpadding=0 width=1000>
    <tr>
        <td valign="top" width=120><?php echo "Tahun"?></td>
        <td valign="top" width=20><?php echo ":"?></td>
        <td valign="top"> <?php echo $tahun ?></td>
    </tr>

    <tr>
        <td valign="top" width=120><?php echo "SKPD"?></td>
        <td valign="top" width=20><?php echo ":"?></td>
        <td valign="top"> <?php echo $nama_skpd ?></td>
    </tr>
    <tr>
        <td valign="top" width=120><?php echo "Nama Barang"?></td>
        <td valign="top" width=20><?php echo ":"?></td>
        <td valign="top"> <?php echo $nama_barang ?></td>
    </tr>

    <tr>
        <td valign="top" width=120><?php echo "Tanggal "?></td>
        <td valign="top" width=20><?php echo ":"?></td>
        <td valign="top"> <?php echo $tgl_mulai .  " s/d " . $tgl_akhir?> </td>
    </tr>
    <tr>
        <td valign="top" width=120><?php echo "Penerima"?></td>
        <td valign="top" width=20><?php echo ":"?></td>
        <td valign="top"> <?php echo $nama_skpd_penerima ?></td>
    </tr>
</table>

<table border=1  bordercolor=#96EBFD cellspacing=1 cellpadding=1 width=100%>
    <thead>
    <tr rowspan="2" align="center" height='40px' bgcolor="#C4E9fA">
        <th align='center' width=10%>No</th>
        <th align='center' width=70%>Tanggal</th>
        <th align='center' width=20%>Jumlah</th>

    </tr>
    </thead>
    <tbody>
    <?php $number = 1; $total = 0;
    foreach($dataProvider as $value):
    $total=$total+$value["volume"];

            ?>
        <tr>
        <td valign="top" align="center"><?php echo $number++?>.</td>
        <td valign="top" align="left"><?php echo $value["tgl_pengeluaran"]?></td>
        <td valign="top" align="right"> <?php echo number_format( $value["volume"] , 0 , "" , '.' )?></td>
          </tr>

    </tbody>
    <?php endforeach; ?>


    <tr rowspan="2" align="center" height='40px' bgcolor="#C4E9fA">
        <th align='center' width=80></th>
         <th align='center' width=250>TOTAL</th>
        <th align='right' width=75><?php echo number_format($total, 0 , "" , '.' )?></th>

    </tr>
</table>

<?php echo CHtml::hiddenField('id_barang',$id_barang);  ?>
<?php echo CHtml::hiddenField('ddltahun',$tahun);  ?>


<?php
echo CHtml::endForm();
?>




