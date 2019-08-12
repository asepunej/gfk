<?php
if ($action=='excel'){
    header("Content-Type: application/force-download");
    header("Cache-Control: no-cache, must-revalidate");
    header("content-disposition: attachment;filename=Saldo_Akhir_".$tahun."_".trim($nama_skpd).".xls");
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

<table border=1  bordercolor=#96EBFD cellspacing=1 cellpadding=1 width=1000>
    <thead>
    <tr rowspan="2" align="center" height='40px' bgcolor="#C4E9fA">
      <th width=80 rowspan="2" align='center'>No</th>
      <th width=200 rowspan="2" align='center'>Barang</th>

      <th colspan="4" align='center'>Saldo Akhir </th>
      </tr>
    
    <tr rowspan="2" align="center" height='40px' bgcolor="#C4E9fA">
        <th align='center' width=100>Kuantitas</th>
        <th align='center' width=100>No Batch</th>
        <th align='center' width=100>Harga Satuan</th>
        <th align='center' width=100>Tgl Expired</th>
        <th align='center' width=100>Total Nilai</th>
      </tr>
    </thead>
    <tbody>
    <?php $number = 1;
    $sum_saldoawal=0;
    $sum_bertambah=0;
    $sum_berkurang=0;
    ?>
    <?php foreach($dataProvider as $value):
    $sum_saldoawal=$sum_saldoawal+$value["saldoawal_jumlah"];
    $sum_bertambah=$sum_bertambah+$value["penerimaan_jumlah"];
    $sum_berkurang=$sum_berkurang+$value["pengeluaran_jumlah"];
    $sum_saldoakhir=$sum_saldoakhir+ $value["saldoakhir_jumlah"]
    ?>


    <?php

    if  ($value["saldoakhir_volume"]>0){?>



       <tr height="30" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">

        <td valign="top" align="center"><?php echo $value["id_barang"] ?></td>
        <td valign="top"><?php echo $value["nama_barang"] ?></td>
        <td valign="top" align="right" bgcolor="#adff2f"> <?php echo number_format( $value["saldoakhir_volume"] , 0 , "" , '.' )?></td>
        <td valign="top" align="right">&nbsp;</td>
        <td valign="top" align="right"> <?php echo number_format( $value["saldoakhir_jumlah"]/$value["saldoakhir_volume"], 2 , ',' , '.' )?></td>
        <td valign="top" align="right">&nbsp;</td>
        <td valign="top" align="right"> <?php echo number_format( $value["saldoakhir_jumlah"] , 2 , ',' , '.' )?></td>
      </tr>

    <?php  } ?>

    </tbody>
<?php  endforeach; ?>
</table>
</td></tr>
</table>



