

<?php echo CHtml::beginForm('','POST');

?>


<table border=0 cellspacing=0 cellpadding=0 width=900>
    <tr>
        <td align="center" width=100><?php echo "DINAS KESEHATAN KABUPATEN BONDOWOSO"?></td>
    </tr>
    <tr>
        <td align="center" width=100><?php echo "REKAP MUTASI PERSEDIAAN"?></td>
    </tr>
    <tr>
        <td align="center" width=100><?php echo "Periode ".$tgl_mulai."  s.d  ".$tgl_akhir?></td>
    </tr>

</table>
<br>
<table border=0 cellspacing=0 cellpadding=0 width=1000>
    <tr>
        <td align="left" width=100>Unit Kerja</td>
        <td align="left" width=30>:</td>
        <td align="left" width=850><?php echo $nama_skpd?></td>
    </tr>

</table>




<table border=1  bordercolor=#96EBFD cellspacing=0 cellpadding=0 width=1000>
    <thead>
    <tr rowspan="2" align="center" height='40px'>
      <th colspan="2" rowspan="2" align='center'>Nama Persedian </th>
      <th width=50 rowspan="3" align='center'>Satuan</th>
      <th colspan="2" rowspan="2" align='center'>Saldo Awal </th>
      <th colspan="4" align='center'>Mutasi</th>
      <th colspan="2" rowspan="2" align='center'>Saldo Akhir </th>
      </tr>
    <tr rowspan="2" align="center" height='40px' >
      <th colspan="2" align='center'>Bertambah</th>
      <th colspan="2" align='center'>Berkurang</th>
      </tr>
    <tr rowspan="2" align="center" height='40px'>
      <th width=50 align='center'>No</th>
        <th width=200 align='center'>Uraian</th>
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

    <tr height="30" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
        <td valign="top" align="center">[1]</td>
        <td valign="top" align="center">[2]</td>
        <td valign="top" align="center">[3]</td>
        <td valign="top" align="center">[4]</td>
        <td valign="top" align="center">[5]</td>
        <td valign="top" align="center">[6]</td>
        <td valign="top" align="center">[7]</td>
        <td valign="top" align="center">[8]</td>
        <td valign="top" align="center">[9]</td>
        <td valign="top" align="center">[10]</td>
        <td valign="top" align="center">[11]</td>
    </tr>
    <?php $number = 1; $totalsaldoawal=0; $totalpenerimaan=0;
    $totalpengeluaran=0; $totalsaldoakhir=0;?>
    <?php foreach($dataProvider as $value):
    $totalsaldoawal=$totalsaldoawal+$value["saldoawal_jumlah"];
    $totalpenerimaan=$totalpenerimaan+$value["penerimaan_jumlah"];
    $totalpengeluaran=$totalpengeluaran+$value["pengeluaran_jumlah"];
    $totalsaldoakhir=$totalsaldoakhir+$value["saldoakhir_jumlah"];
    ;?>
    <tr height="30" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
      <td valign="top" align="center"><?php echo $value["id_barang"]?></td>
      <td valign="top"><?php echo $value["nama_barang"]?></td>
      <td valign="top" align="center"><?php echo $value["satuan"]?></td>
      <td valign="top" align="right"><?php echo number_format( $value["saldoawal_volume"] , 0 , "" , '.' )?></td>
      <td valign="top" align="right"><?php echo number_format( $value["saldoawal_jumlah"] , 0 , "" , '.' )?></td>
      <td valign="top" align="right"><?php echo number_format( $value["penerimaan_volume"] , 0 , "" , '.' )?></td>
      <td valign="top" align="right"><?php echo number_format( $value["penerimaan_jumlah"] , 0 , "" , '.' )?></td>
      <td valign="top" align="right"><?php echo number_format( $value["pengeluaran_volume"] , 0 , "" , '.' )?></td>
      <td valign="top" align="right"><?php echo number_format( $value["pengeluaran_jumlah"] , 0 , "" , '.' )?></td>
      <td valign="top" align="right"><?php echo number_format( $value["saldoakhir_volume"] , 0 , "" , '.' )?></td>
      <td valign="top" align="right"><?php echo number_format( $value["saldoakhir_jumlah"] , 0 , "" , '.' )?></td>



    </tr>
    </tbody>
    <?php endforeach; ?>
    <tr height="30" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
        <td valign="top" align="center">.</td>

        <td valign="top">TOTAL</td>
        <td valign="top" align="center">&nbsp;</td>


        <td valign="top" align="right">&nbsp;</td>
        <td valign="top" align="right"><?php echo number_format( $totalsaldoawal , 0 , "" , '.' )?></td>


         <td valign="top" align="right">&nbsp;</td>
         <td valign="top" align="right"><?php echo number_format( $totalpenerimaan , 0 , "" , '.' )?></td>

         <td valign="top" align="right">&nbsp;</td>
         <td valign="top" align="right"><?php echo number_format( $totalpengeluaran , 0 , "" , '.' )?></td>

        <td valign="top" align="right">&nbsp;</td>
        <td valign="top" align="right"><?php echo number_format( $totalsaldoakhir , 0 , "" , '.' )?></td>
  </tr>

</table>
</td></tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" width="1000">
  <tr>
    <td colspan="3" valign="top"><div align="center" class="style1">
      <div align="left"></div>
    </div></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><span class="style1">Keterangan : </span></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><span class="style1">1. Persediaan senilai Rp. <?php echo number_format( $nominalrusak , 0 , "" , '.' )?> Dalam Kondisi Rusak </span></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><div align="center" class="style1">
      <div align="left">2. Persediaan senilai Rp. <?php echo number_format( $nominalusang , 0 , "" , '.' )?> Dalam Kondisi Kadaluarsa </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><div align="center" class="style1">
      <div align="left"></div>
    </div></td>
  </tr>
  <tr>
    <td valign="top"><span class="style1"></span></td>
    <td valign="top"><span class="style1"></span></td>
    <td width="395" valign="top"><span class="style1"> <?php echo 'Bondowoso , '. $tgl_akhir;?>

    </span></td>
  </tr>
  <tr>
    <td valign="top"><span class="style1"></span></td>
    <td valign="top"><span class="style1"></span></td>
    <td valign="top"><span class="style1">Kepala</span></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top"><span class="style1">Nama</span></td>
  </tr>
  <tr>
    <td valign="top" width="111">&nbsp;</td>
    <td valign="top" width="494">&nbsp;</td>
    <td valign="top"><span class="style1">Nip</span></td>
  </tr>
</table>
