
<table border=0 cellspacing=0 cellpadding=0 width=900>
    <tr>
        <td align="center" width=100><?php echo "DINAS KESEHATAN KABUPATEN BONDOWOSO"?></td>
    </tr>
    <tr>
        <td align="center" width=100><?php echo "LAPORAN PERSEDIAAN"?></td>
    </tr>
    <tr>
        <td align="center" width=100><?php echo "Per ".$tgl_akhir?></td>
    </tr>

</table>
<br>
<table border=0 cellspacing=0 cellpadding=0 width=1000>
    <tr>
        <td align="left" width=100>Satuan Kerja</td>
        <td align="left" width=30>:</td>
        <td align="left" width=850><?php echo $nama_skpd?></td>
    </tr>

</table>

<table border=1  cellspacing=0 cellpadding=0 width=1000>
    <thead>
    <tr rowspan="2" align="center" height='80px' >
        <th align='center' width=50>NO</th>
        <th align='center' width=700>NAMA PERSEDIAAN</th>
        <th align='center' width=100>JUMLAH</th>
        <th align='center' width=150>NOMINAL</th>
    </tr>
    </thead>
    <tbody>

    <?php
    function IsiBaris($kode,$nama,$nominal){
        if(empty($nominal)){$nominal=0;}
        $nominal=number_format($nominal, 0 , "" , '.' );
        echo "<tr height='30' onMouseOver=this.className='highlight' onMouseOut=this.className='normal'>";
        echo "<td align=center>$kode</td>";
        echo "<td align=left>$nama</td>";
        echo "<td valign=center align=right>0</td>";
        echo "<td valign=center align=right>$nominal</td>";
        echo "</tr>";
    }
    function IsiBarisx($kode,$nama,$nominalx){
        $nominal=$nominalx;
        if(empty($nominal)){$nominal=0;}
        $nominal=number_format($nominal, 0 , "" , '.' );
        echo "<tr height='30' onMouseOver=this.className='highlight' onMouseOut=this.className='normal'>";
        echo "<td align=center>$kode</td>";
        echo "<td align=left>$nama</td>";
        echo "<td valign=center align=right>$nominal</td>";
        echo "<td valign=center align=right>$nominal</td>";
        echo "</tr>";
    }
    function IsiBarisDetail($kode,$nama,$satuan,$nominal){
        $nominal=number_format($nominal, 0 , "" , '.' );
        echo "<tr height='30' onMouseOver=this.className='highlight' onMouseOut=this.className='normal'>";
        echo "<td align=center> $kode</td>";
        echo "<td align=left>&nbsp&nbsp&nbsp&nbsp$nama</td>";
        echo "<td valign=center align=right> $nominal</td>";
        echo "</tr>";
    }
    ?>
    <?php $sumjumlah = 0;
    foreach($dataProvider as $value):
        $id_barang=$value["id_barang"];
        if ($id_skpd==''){$id_skpd=Yii::app()->session['id_skpd'];}
        $RecordData99=Yii::app()->db->createCommand("select * from master.fngettotal_barang_rusak_xx($id_barang,$id_skpd);")->queryRow();
        $nominalrusak     = $RecordData99['nominal'];
//        $sumjumlah=$sumjumlah+$value["saldoakhir_jumlah"]-$nominalrusak;
        $sumjumlah=$sumjumlah+$value["saldoakhir_jumlah"];
     endforeach;

    ?>


    <?php $number = 1;

    ?>
    <?php foreach($dataProvider01 as $value01):
        if ($h1 <> $value01["kd_jenis_persediaan"]) {
            $number = 1;
            $h1=$value01["kd_jenis_persediaan"];
            if ($h1=='C'){
                IsiBaris('<b>'.$value01[kd_jenis_persediaan].'</b>','<b>'.$value01[jenis_persediaan].'</b>',$sumjumlah);}
//            IsiBaris('<b>'.$value01[kd_jenis_persediaan].'</b>','<b>'.$value01[jenis_persediaan].'</b>',0);}
                else {
                    IsiBaris('<b>'.$value01[kd_jenis_persediaan].'</b>','<b>'.$value01[jenis_persediaan].'</b>',0);
                }



            if ($value01[id_jenis_barang]=='1'){
                IsiBaris('<i>'.$number++.'</i>','<i>'.$value01[jenis_barang].'</i>',$sumjumlah);
                $number01 = 1;
                ?>

                <?php foreach($dataProvider as $value):
                    $id_barang=$value["id_barang"];
                     if ($id_skpd==''){$id_skpd=Yii::app()->session['id_skpd'];}


                    $RecordData99=Yii::app()->db->createCommand("select * from master.fngettotal_barang_rusak_xx($id_barang,$id_skpd);")->queryRow();
                    $nominalrusak     = $RecordData99['nominal'];

                    ?>

                    <tr height="30" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                        <td valign="top" align="center"></td>
                        <td valign="top"><?php echo  $number01++."&nbsp;&nbsp;".$value["nama_barang"];?></td>
                        <td valign="top" align="right"> <?php echo number_format( $value["saldoakhir_volume"]-$nominalrusak , 0 , "" , '.' )?></td>
                        <td valign="top" align="right"> <?php echo number_format( $value["saldoakhir_jumlah"]-$nominalrusak , 0 , "" , '.' )?></td>
                    </tr>
                <?php endforeach; ?>

            <?php
            }else{
                IsiBaris('<i>'.$number++.'</i>','<i>'.$value01[jenis_barang].'</i>',0);
            }

        }else {
            IsiBaris('<i>'.$number++.'</i>','<i>'.$value01[jenis_barang].'</i>',0);

        }
     ?>
    <?php endforeach; ?>
    </tbody>







</table>


<table border="0" cellspacing="0" cellpadding="0" width="1000">
  <tr>
    <td colspan="3" valign="top"><div align="center" class="style1">
      <div align="left"></div>
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
