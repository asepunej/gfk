<?php
header("Content-Type: application/force-download");
header("Cache-Control: no-cache, must-revalidate");
header("content-disposition: attachment;filename=rekap_kegiatan".date('dmY').".xls");
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
           var url = '/index.php?r=Rekap/DetailMutasiBarangBidang';
           var form = $('<form action="' + url + '" method="POST">' +
               '<input type="hidden" name="id_barang" value="' + id_barang + '" />' +
               '<input type="hidden" name="ddltahun" value="' + $('#ddltahun').val() + '" />' +
               '<input type="hidden" name="ddlskpd" value="' + $('#ddlskpd').val() + '" />' +
               '<input type="hidden" name="ddlbidang" value="' + $('#ddlbidang').val() + '" />' +

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
            'title'=>'Pilih Pagu',
            'height'=>'500',
            'width'=>'710px',
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
    <b>LAPORAN PENERIMAAN DAN PEMAKAIAN OBAT PUSKESMAS </b>
</div>

<br>
<table border=0 cellspacing=0 cellpadding=0 width=900>
    <tr>
        <td valign="top" width=120><?php echo "Tahun"?></td>
        <td valign="top" width=20><?php echo ": ". $tahun?></td>
        <td valign="top">

        </td>
    </tr>

    <tr>
        <td valign="top" width=120><?php echo "SKPD"?></td>
        <td valign="top" width=20><?php echo ": ".$skpd?></td>
        <td valign="top">
        </td>
    </tr>
    <tr>
        <td valign="top" width=120><?php echo "Unit / Bidang"?></td>
        <td valign="top" width=20><?php echo ": ".$bidang?></td>
        <td valign="top">


        </td>
    </tr>


</table>

<table border=1  bordercolor=#96EBFD cellspacing=1 cellpadding=1 width=900>
    <thead>
    <tr rowspan="2" align="center" height='40px' bgcolor="#C4E9fA">
            <th align='center' width=50>NO</th>
            <th align='center' width=400>Barang / Obat</th>
            <th align='center' width=200>Satuan</th>
            <th align='center' width=200>Jumlah</th>


        </tr>
        </thead>
        <tbody>
        <?php $number = 1; ?>
        <?php foreach($dataProvider as $value): ?>
        <tr height="30" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
            <td valign="top" align="center"><?php echo $number++?>.</td>
            <td valign="top"><?php echo $value["nama_barang"]?></td>
            <td valign="top"><?php echo $value["satuan"]?></td>
            <td valign="top" align="right"> <?php echo number_format( $value["volume"] , 0 , "" , '.' )?></td>


        </tr>
        </tbody>
        <?php endforeach; ?>

    </table>
     </td></tr>
</table>

<?php
echo CHtml::endForm();
?>




