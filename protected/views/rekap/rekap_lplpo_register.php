<?php

    header("Content-Type: application/force-download");
    header("Cache-Control: no-cache, must-revalidate");
    header("content-disposition: attachment;filename=Register_".$kdbulan."_".$tahun.".xls");


?>

<?php echo CHtml::beginForm('','POST');
$ReferensiModel=new ReferensiModel();
?>


<div class="panel-heading">
    <i class="fa fa-external-link-square"></i>
    <b>REKAP LPLPO </b>
</div>
<br>
<table border=0 cellspacing=0 cellpadding=0 width=1000>
    <tr>
        <td valign="top" width=70><?php echo "Tahun"?></td>
        <td valign="top" width=20><?php echo ":"?></td>
        <td valign="top"> <?php echo "$tahun"?>

        </td>
    </tr>

    <tr>
        <td valign="top" width=70><?php echo "Unit Kerja"?></td>
        <td valign="top" width=20><?php echo ":"?></td>
        <td valign="top">  <?php
            $RecordData=Yii::app()->db->createCommand("select * from referensi.fndata_skpd('$id_skpd');")->queryRow();
            echo $RecordData['nama_skpd']?>


        </td>
    </tr>

    <tr>
        <td valign="top" width=70><?php echo "Bulan"?></td>
        <td valign="top" width=20><?php echo ":"?></td>
        <td valign="top">  <?php echo "$kdbulan"?>

        </td>
    </tr>

</table>




<table border=1  bordercolor=#96EBFD cellspacing=1 cellpadding=1 width=100%>
    <thead>
    
    <tr rowspan="2" align="center" height='40px' bgcolor="#C4E9fA">
      <th width=5% align='center'>Kode</th>
      <th width=30% align='center'>Obat</th>
      <th width=5% align='center'>Stok Awal</th>
      <th width=5% align='center'>Terima</th>
      <th width=5% align='center'>Persediaan</th>

        <th align='center' width=2%>Tgl 1 </th>
        <th align='center' width=2%>Tgl 2 </th>
        <th align='center' width=2%>Tgl 3 </th>
        <th align='center' width=2%>Tgl 4 </th>
        <th align='center' width=2%>Tgl 5  </th>
        <th align='center' width=2%>Tgl 6 </th>
        <th align='center' width=2%>Tgl 7 </th>
        <th align='center' width=2%>Tgl 8 </th>
        <th align='center' width=2%>Tgl 9 </th>
        <th align='center' width=2%>Tgl 10 </th>

        <th align='center' width=2%>Tgl 11 </th>
        <th align='center' width=2%>Tgl 12 </th>
        <th align='center' width=2%>Tgl 13 </th>
        <th align='center' width=2%>Tgl 14 </th>
        <th align='center' width=2%>Tgl 15  </th>
        <th align='center' width=2%>Tgl 16 </th>
        <th align='center' width=2%>Tgl 17 </th>
        <th align='center' width=2%>Tgl 18 </th>
        <th align='center' width=2%>Tgl 19 </th>
        <th align='center' width=2%>Tgl 20 </th>

        <th align='center' width=2%>Tgl 21 </th>
        <th align='center' width=2%>Tgl 22 </th>
        <th align='center' width=2%>Tgl 23 </th>
        <th align='center' width=2%>Tgl 24 </th>
        <th align='center' width=2%>Tgl 25  </th>
        <th align='center' width=2%>Tgl 26 </th>
        <th align='center' width=2%>Tgl 27 </th>
        <th align='center' width=2%>Tgl 28 </th>
        <th align='center' width=2%>Tgl 29 </th>
        <th align='center' width=2%>Tgl 30 </th>

        <th align='center' width=2%>Tgl 31 </th>
        <th align='center' width=2%>TOTAL </th>
        <th align='center' width=2%>Stok Akhir </th>



    </tr>
    </thead>
    <tbody>
    <?php $number = 1; ?>
    <?php foreach($dataProvider as $value):


    ?>

    <tr height="30" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
        <td valign="top"><?php echo $value["kode"]?></td>
        <td valign="top"><?php echo $value["nama_barang_01"]?></td>
        <td valign="top" align="center"><?php echo $value["saldoawal_volume"]?></td>
        <td valign="top" align="center"><?php echo $value["penerimaan_volume"]?></td>
        <td valign="top" align="center"><?php echo $value["persediaan"]?></td>

        <td valign="top" align="right"> <?php echo number_format( $value["tgl_1"] , 0 , "" , '.' )?></td>
        <td valign="top" align="right"> <?php echo number_format( $value["tgl_2"] , 0 , "" , '.' )?></td>
        <td valign="top" align="right"> <?php echo number_format( $value["tgl_3"] , 0 , "" , '.' )?></td>
        <td valign="top" align="right"> <?php echo number_format( $value["tgl_4"] , 0 , "" , '.' )?></td>
        <td valign="top" align="right"> <?php echo number_format( $value["tgl_5"] , 0 , "" , '.' )?></td>
        <td valign="top" align="right"> <?php echo number_format( $value["tgl_6"] , 0 , "" , '.' )?></td>
        <td valign="top" align="right"> <?php echo number_format( $value["tgl_7"] , 0 , "" , '.' )?></td>
        <td valign="top" align="right"> <?php echo number_format( $value["tgl_8"] , 0 , "" , '.' )?></td>
        <td valign="top" align="right"> <?php echo number_format( $value["tgl_9"] , 0 , "" , '.' )?></td>
        <td valign="top" align="right"> <?php echo number_format( $value["tgl_10"] , 0 , "" , '.' )?></td>

        <td valign="top" align="right"> <?php echo number_format( $value["tgl_11"] , 0 , "" , '.' )?></td>
        <td valign="top" align="right"> <?php echo number_format( $value["tgl_12"] , 0 , "" , '.' )?></td>
        <td valign="top" align="right"> <?php echo number_format( $value["tgl_13"] , 0 , "" , '.' )?></td>
        <td valign="top" align="right"> <?php echo number_format( $value["tgl_14"] , 0 , "" , '.' )?></td>
        <td valign="top" align="right"> <?php echo number_format( $value["tgl_15"] , 0 , "" , '.' )?></td>
        <td valign="top" align="right"> <?php echo number_format( $value["tgl_16"] , 0 , "" , '.' )?></td>
        <td valign="top" align="right"> <?php echo number_format( $value["tgl_17"] , 0 , "" , '.' )?></td>
        <td valign="top" align="right"> <?php echo number_format( $value["tgl_18"] , 0 , "" , '.' )?></td>
        <td valign="top" align="right"> <?php echo number_format( $value["tgl_19"] , 0 , "" , '.' )?></td>
        <td valign="top" align="right"> <?php echo number_format( $value["tgl_20"] , 0 , "" , '.' )?></td>

        <td valign="top" align="right"> <?php echo number_format( $value["tgl_21"] , 0 , "" , '.' )?></td>
        <td valign="top" align="right"> <?php echo number_format( $value["tgl_22"] , 0 , "" , '.' )?></td>
        <td valign="top" align="right"> <?php echo number_format( $value["tgl_23"] , 0 , "" , '.' )?></td>
        <td valign="top" align="right"> <?php echo number_format( $value["tgl_24"] , 0 , "" , '.' )?></td>
        <td valign="top" align="right"> <?php echo number_format( $value["tgl_25"] , 0 , "" , '.' )?></td>
        <td valign="top" align="right"> <?php echo number_format( $value["tgl_26"] , 0 , "" , '.' )?></td>
        <td valign="top" align="right"> <?php echo number_format( $value["tgl_27"] , 0 , "" , '.' )?></td>
        <td valign="top" align="right"> <?php echo number_format( $value["tgl_28"] , 0 , "" , '.' )?></td>
        <td valign="top" align="right"> <?php echo number_format( $value["tgl_29"] , 0 , "" , '.' )?></td>
        <td valign="top" align="right"> <?php echo number_format( $value["tgl_30"] , 0 , "" , '.' )?></td>

        <td valign="top" align="right"> <?php echo number_format( $value["tgl_31"] , 0 , "" , '.' )?></td>
         <td valign="top" align="right"> <?php echo number_format( $value["pengeluaran_volume"] , 0 , "" , '.' )?></td>
        <td valign="top" align="right"> <?php echo number_format( $value["saldoakhir_volume"] , 0 , "" , '.' )?></td>



    </tr>
    </tbody>
    <?php endforeach; ?>
</table>
</td></tr>
</table>
<?php
echo CHtml::endForm();
?>




