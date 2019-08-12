<STYLE>
<!--
  tr { }
  .initial { background-color: #FFFFFF; color:#000000 }
  .normal { background-color: #FFFFFF }
  .highlight { background-color: #DFFBED }
 //-->
</style>

<script type="text/javascript">



       function insertpenerimaan()
       {
           var url = '/index.php?r=Penerimaan/InsertPenerimaan';
           var form = $('<form action="' + url + '" method="POST">' +
               '<input type="hidden" name="ddltahun" value="' + $('#ddltahun').val() + '" />' +
               '<input type="hidden" name="ddlskpd" value="' + $('#ddlskpd').val() + '" />' +
               '<input type="hidden" name="ddlbidang" value="' + $('#ddlbidang').val() + '" />' +
               '</form>');
           $('body').append(form);
           $(form).submit();
       }
       function editdata(id_penerimaan)
       {
           var url = '/index.php?r=Penerimaan/EditPenerimaan';
           var form = $('<form action="' + url + '" method="POST">' +
               '<input type="hidden" name="id_penerimaan" value="' + id_penerimaan + '" />' +
               '</form>');
           $('body').append(form);
           $(form).submit();
       }

       function detaildata(id_penerimaan)
       {
           var url = '/index.php?r=Penerimaandetail/DaftarPenerimaanDetail';
           var form = $('<form action="' + url + '" method="POST">' +
               '<input type="hidden" name="id_penerimaan" value="' + id_penerimaan + '" />' +
               '</form>');
           $('body').append(form);
           $(form).submit();
       }
    function deletedata(id_penerimaan,nomor_pembukuan)
    {
        theConfirm = "Anda yakin ingin menghapus data ";
        theConfirm += nomor_pembukuan + "?";
        var go = confirm(theConfirm);
        if (go == true) {
            var url = '/index.php?r=Penerimaan/DaftarPenerimaan';
            var form = $('<form action="' + url + '" method="POST">' +
                '<input type="hidden" name="action" value="statusdelete" />' +
                '<input type="hidden" name="id_penerimaan" value="' + id_penerimaan + '" />' +
                '<input type="hidden" name="ddltahun" value="' + $('#ddltahun').val() + '" />' +
                '<input type="hidden" name="ddlskpd" value="' + $('#ddlskpd').val() + '" />' +
                '<input type="hidden" name="ddlbidang" value="' + $('#ddlbidang').val() + '" />' +
                '</form>');
            $('body').append(form);
            $(form).submit();
        }

    }
       function cetakspby(id_pembukuan)
       {
           var url = '/index.php?r=Pembukuan/CetakKuitansi';
           var form = $('<form action="' + url + '" method="POST" + target=_blank>' +
               '<input type="hidden" name="id_pembukuan" value="' + id_pembukuan + '" />' +
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
    <b>Laporan Persediaan </b>
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
        <td valign="top" width=120><?php echo "SKPD"?></td>
        <td valign="top" width=20><?php echo ":"?></td>
        <td valign="top">
            <?php
            if(Yii::app()->session['id_level_user']=='9'   )
            {
                echo CHtml::dropDownList('ddlskpd',$id_skpd,$ReferensiModel->getdaftarskpd()
                    , array('onChange'=>'this.form.submit();','style'=>'width: 400px;background-color: #F3FDF0'
                    ,'disabled'=>false,
                        'options'=>array($id_skpd=>array('selected'=>'selected'))));
            }
            else
            {
                echo CHtml::dropDownList('ddlskpd',$id_skpd,$ReferensiModel->getdaftarskpd()
                    , array('onChange'=>'this.form.submit();','style'=>'width: 400px;background-color: #F3FDF0'
                    ,'disabled'=>true,
                        'options'=>array($id_skpd=>array('selected'=>'selected'))));
            }
            ?>
        </td>
    </tr>

</table>




<table border=1  bordercolor=#96EBFD cellspacing=1 cellpadding=1 width=1000>
    <thead>
    <tr rowspan="2" align="center" height='40px' bgcolor="#C4E9fA">
        <th align='center' width=50>No</th>
        <th align='center' width=200>jenis_persediaan</th>
        <th align='center' width=200>jenis_barang</th>
        <th align='center' width=200>Nama Persediaan</th>
        <th align='center' width=100>Satuan</th>
        <th align='center' width=200>Nilai</th>


    </tr>
    </thead>
    <tbody>
    <?php $number = 1; ?>
    <?php foreach($dataProvider as $value): ?>
    <tr height="30" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
        <td valign="top" align="center"><?php echo $number++?>.</td>
        <td valign="top"><?php echo $value["jenis_persediaan"]?></td>
        <td valign="top"><?php echo $value["jenis_barang"]?></td>

        <td valign="top"><?php echo $value["nama_barang"]?></td>
        <td valign="top" align="center"><?php echo $value["satuan"]?></td>
        <td valign="top" align="right"> <?php echo number_format( $value["saldoakhir_jumlah"] , 0 , "" , '.' )?></td>

    </tr>
    </tbody>
    <?php endforeach; ?>

</table>
</td></tr>
</table>
<!---->
<!--<table  border=1 bordercolor=#BDEDA3 cellspacing=1 cellpadding=1 width=1000>-->
<!---->
<!--    <tr align='center'  valign=center  height='50px' bgcolor="#CBFBB6"">-->
<!--    <td align='center' width=100><b>NO.</b></td>-->
<!--    <td align='center' width=500><b>Nama Persediaan</b></td>-->
<!--    <td align='center' width=100><b>Satuan</b></td>-->
<!--    <td align='center' width=100><b>jumlah.</b></td>-->
<!--    <td align='center' width=200><b>Nilai</b></td>-->
<!---->
<!--    </tr>-->
<!---->
<!---->
<!--    --><?php
//    $spasi1='&nbsp&nbsp&nbsp&nbsp&nbsp';
//    function IsiBaris($barang,$jumlahl){
//        $pagunominal=number_format( $pagunominal , 0 , "" , '.' );
//        echo "<tr height='30' onMouseOver=this.className='highlight' onMouseOut=this.className='normal'>";
//        echo "<td align=center> $kode</td>";
//        echo "<td align=left>&nbsp&nbsp&nbsp&nbsp$nama</td>";
//        echo "<td valign=center> </td>";
//        echo "<td valign=center align=right> $pagunominal</td>";
//        echo "<td valign=center> </td>";
//        echo "<td valign=center> </td>";
//        echo "</tr>";
//
//    }
//
//    function IsiBarisakun($kode,$nama,$sumberdana,$id_akun,$pagunominal,$serapan){
//        $pagunominal=number_format( $pagunominal , 0 , "" , '.' );
//        $serapan=number_format( $serapan , 0 , "" , '.' );
//        echo "<tr height='30' onMouseOver=this.className='highlight' onMouseOut=this.className='normal'>";
//        echo "<td align=right> $kode</td>";
//        echo "<td valign=center> $nama</td>";
//        echo "<td valign=center align=center>$sumberdana</td>";
//        echo "<td valign=center align=right> $pagunominal</td>";
//        echo "<td valign=center align=right> $serapan</td>";?>
<!---->
<!--        <td valign="top" align="center">-->
<!--            --><?php //echo CHtml::image('/images/detail.png','',
//                array(
//                    'title' => 'detail',
//                    'style' => 'width:20px',
//                    "onClick"=>"detaildata('$id_akun')"
//                ));?>
<!--            --><?php //echo CHtml::image('/images/tbedit.png','',
//                array(
//                    'title' => 'edit',
//                    'style' => 'width:20px',
//                    "onClick"=>"editdata('$id_akun')"
//                ));?>
<!--            --><?php
//            echo CHtml::image('/images/error.png','',
//                array(
//                    'title' => 'hapus',
//                    'style' => 'width:20px',
//                    "onClick"=>"deletedata('$id_akun','$kode','2015')"
//                ));?>
<!--        </td>-->
<!---->
<!---->
<!--        --><?php
//        echo "</tr>";
//    }
//
//    $spasi1='&nbsp&nbsp&nbsp&nbsp&nbsp';
//    $spasi2='&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp - ';
//    $number = 1;
//    foreach($dataProvider as $value):
//
//        if ($h1 <> $value["jenis_persediaan"]) {
//
//            $h1=$value["jenis_persediaan"];
//            $h2=$value["jenis_barang"];
//
//            IsiBaris('<b>'.$value[jenis_persediaan].'</b>','<b>'.$value[satuan].'</b>',$value[saldoakhir_jumlah]);
//            IsiBaris('<b><i>'.$value[jenis_barang].'</b></i>','<b><i>'.$value[output].'</b></i>',$totoutput[jumlah]);
//            IsiBaris($value[nama_barang],$spasi1.'<u>'.$value[satuan].'</u>',$value[saldoakhir_jumlah]);
//        }
//
//        //---------------------------------------------------------
//        else  if ($h2 <> $value["jenis_barang"]) {
//
//            $h2=$value["jenis_barang"];
//            IsiBaris('<b><i>'.$value[jenis_barang].'</b></i>','<b><i>'.$value[output].'</b></i>',$totoutput[jumlah]);
//            IsiBaris($value[nama_barang],$spasi1.'<u>'.$value[satuan].'</u>',$value[saldoakhir_jumlah]);
//        }
//
//        //---------------------------------------------------------
//        else  if ($h3 <> $value["nama_barang"]) {
//            IsiBaris($value[nama_barang],$spasi1.'<u>'.$value[satuan].'</u>',$value[saldoakhir_jumlah]);
//        }
//
//
//        ?>
<!---->
<!---->
<!--    --><?php //endforeach; ?>
<!---->
<!--</table>-->

<?php
echo CHtml::endForm();
?>




