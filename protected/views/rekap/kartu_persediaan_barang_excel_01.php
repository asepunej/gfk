<?php
if ($action=='excel'){
    header("Content-Type: application/force-download");
    header("Cache-Control: no-cache, must-revalidate");
    header("content-disposition: attachment;filename=rekap_mutasi_barang".date('dmY').".xls");
}

?>


<?php echo CHtml::beginForm('','POST');
$ReferensiModel=new ReferensiModel();
echo "tgl_akhirq :" . $tgl_akhir;
?>



<table border=0 cellspacing=0 cellpadding=0 width=900>
    <tr>
        <td align="center" width=100><?php echo "KARTU PERSEDIAAN BARANG "?></td>
    </tr>

</table>
<br>
<table border=0 cellspacing=0 cellpadding=0 width=1000>
    <tr>
        <td align="left" width=150>SKPD</td>
        <td align="left" width=50>:</td>
        <td align="left" width=800>DINAS KESEHATAN</td>
    </tr>
    <tr>
        <td align="left" width=150>KABUPATEN</td>
        <td align="left" width=50>:</td>
        <td align="left" width=800>BONDOWOSO</td>
    </tr>
    <tr>
        <td align="left" width=150>PROVINSI</td>
        <td align="left" width=50>:</td>
        <td align="left" width=800>JAWA TIMUR</td>
    </tr>
    <tr>
        <td align="left" width=150>Satuan Kerja</td>
        <td align="left" width=50>:</td>
        <td align="left" width=800><?php echo $nama_skpd ?></td>
    </tr>
    <tr>
        <td align="left" width=150>Nama Barang</td>
        <td align="left" width=50>:</td>
        <td align="left" width=800><?php echo $nama_barang?></td>
    </tr>
    <tr>
        <td align="left" width=150>Satuan</td>
        <td align="left" width=50>:</td>
        <td align="left" width=800><?php echo $satuan?></td>
    </tr>
</table>

<table border=1  bordercolor=#96EBFD cellspacing=1 cellpadding=1 width=1000>
    <thead>
    <tr rowspan="2" align="center" height='40px' >
      <th rowspan="2" align='center'>Tanggal</th>
      <th rowspan="2" align='center'>No/Tgl Surat Dasar Penerimaan/Pengeluaran </th>
      <th rowspan="2" align='center'>Uraian</th>
      <th colspan="3" align='center'>Barang-barang</th>
      <th rowspan="2" align='center'>Harga Satuan</th>
      <th colspan="3" align='center'>Jumlah Harga Barang </th>
      </tr>
    <tr rowspan="2" align="center" height='40px'>
      <th align='center'>Masuk</th>
      <th align='center'>Keluar</th>
      <th align='center'>Sisa</th>
      <th align='center'>Bertambah</th>
      <th align='center'>Berkurang</th>
      <th align='center'>Sisa</th>
    </tr>
    <tr rowspan="2" align="center" height='40px' >
        <th align='center' width=80>[1]</th>
        <th align='center' width=200>[2]</th>
        <th align='center' width=250>[3]</th>
        <th align='center' width=75>[4]</th>
        <th align='center' width=75>[5]</th>
        <th align='center' width=75>[6]</th>
        <th align='center' width=100>[7]</th>
        <th align='center' width=100>[8]</th>
        <th align='center' width=100>[9]</th>
        <th align='center' width=100>[10]</th>
    </tr>
    </thead>
    <tbody>
    <?php $number = 1; $saldo_stok = 0;  $saldo_nilai = 0; $baru=0;
    $sum_masuk = 0; $sum_keluar = 0;
    $sum_masuk_rp = 0; $sum_keluar_rp = 0;


    ?>
    <?php foreach($dataProvider as $value):


    if (substr($value["no_faktur"],0,5)=='saldo') {
        $sum_masuk=$sum_masuk+0;
        $sum_masuk_rp=$sum_masuk_rp+0;
    }
    else{

        $sum_masuk=$sum_masuk+$value["masuk"];
        $sum_masuk_rp=$sum_masuk_rp+$value["nominal_bertambah"];
    }

    $sum_keluar=$sum_keluar+$value["keluar"];
    $sum_keluar_rp=$sum_keluar_rp+$value["nominal_berkurang"];

    $saldo_stok = ($saldo_stok+$value["masuk"])-$value["keluar"];
    $saldo_nilai = ($saldo_nilai+$value["nominal_bertambah"])-$value["nominal_berkurang"];
    ?>




<?php
    if(strtotime($value["tgl_penerimaan"])<=strtotime($tgl_akhir)) {
?>

        <?php

            echo "<tr height=30 onMouseOver=this.className='highlight' onMouseOut=this.className='normal' bgcolor=white> ";
        ?>
                    <td valign="top"><?php echo $value["tgl_penerimaan"]?></td>
                    <td valign="top" align="left"><?php echo $value["uraian"]?></td>
                    <td valign="top" align="left"><?php echo $value["no_faktur"]?></td>
                <?php if (substr($value["no_faktur"],0,5)=='saldo') {?>
                        <td valign="top" align="right"> <?php echo number_format( 0 , 0 , "" , '.' )?></td>
                <?php $xx=0; } else {?>
                        <td valign="top" align="right"> <?php echo number_format( $value["masuk"] , 0 , "" , '.' )?></td>
                <?php $xx=0; };?>
                    <td valign="top" align="right"> <?php echo number_format( $value["keluar"] , 0 , "" , '.' )?></td>
                    <td valign="top" align="right"> <?php echo number_format( $saldo_stok , 0 , "" , '.' )?></td>
                    <td valign="top" align="right"> <?php echo number_format( $value["harga_satuan"] , 0 , "" , '.' )?></td>

        <?php if (substr($value["no_faktur"],0,5)=='saldo') {?>
        <td valign="top" align="right"> <?php echo number_format( 0 , 0 , "" , '.' )?></td>
        <?php $xx=0; } else {?>
        <td valign="top" align="right"> <?php echo number_format( $value["nominal_bertambah"] , 0 , "" , '.' )?></td>
        <?php $xx=0; };?>



                    <td valign="top" align="right"> <?php echo number_format( $value["nominal_berkurang"] , 0 , "" , '.' )?></td>
                    <td valign="top" align="right"> <?php echo number_format( $saldo_nilai , 0 , "" , '.' )?></td>
                </tr>
    <?php } ?>

    </tbody>
    <?php endforeach; ?>
    <tr rowspan="2" align="center" height='40px' bgcolor="#C4E9fA">
        <th align='center' width=80></th>
        <th align='center' width=200></th>
        <th align='center' width=250>TOTAL</th>
        <th align='right' width=75><?php echo number_format($sum_masuk, 0 , "" , '.' )?></th>
        <th align='right' width=75><?php echo number_format($sum_keluar , 0 , "" , '.' )?></th>
        <th align='right' width=75><?php echo number_format( $saldo_stok , 0 , "" , '.' )?></th>
        <th align='right' width=100></th>
        <th align='right' width=100><?php echo number_format( $sum_masuk_rp , 0 , "" , '.' )?></th>
        <th align='right' width=100><?php echo number_format($sum_keluar_rp, 0 , "" , '.' )?></th>
        <th align='right' width=100><?php echo number_format($saldo_nilai , 0 , "" , '.' )?></th>

    </tr>
</table>
</td></tr>
</table>