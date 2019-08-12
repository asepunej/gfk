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
           var url = '/index.php?r=Penerimaandetail/InsertPenerimaanDetail';
           var form = $('<form action="' + url + '" method="POST">' +
               '<input type="hidden" name="id_penerimaan" value="' + $('#id_penerimaan').val() + '" />' +
               '</form>');
           $('body').append(form);
           $(form).submit();
       }
       function editdata(id_penerimaan_detail)
       {
           var url = '/index.php?r=Penerimaandetail/EditPenerimaanDetail';
           var form = $('<form action="' + url + '" method="POST">' +
               '<input type="hidden" name="id_penerimaan_detail" value="' + id_penerimaan_detail + '" />' +
               '</form>');
           $('body').append(form);
           $(form).submit();
       }

    function deletedata(id_penerimaan_detail,kd_barang)
    {
        theConfirm = "Anda yakin ingin menghapus data ";
        theConfirm += kd_barang + "?";
        var go = confirm(theConfirm);
        if (go == true) {
            var url = '/index.php?r=Penerimaandetail/DaftarPenerimaanDetail';
            var form = $('<form action="' + url + '" method="POST">' +
                '<input type="hidden" name="action" value="statusdelete" />' +
                '<input type="hidden" name="id_penerimaan_detail" value="' + id_penerimaan_detail + '" />' +
                '<input type="hidden" name="id_penerimaan" value="' + $('#id_penerimaan').val() + '" />' +

                '</form>');
            $('body').append(form);
            $(form).submit();
        }

    }
       function Kembali(){
           var url = '/index.php?r=Penerimaan/DaftarPenerimaan';
           var form = $('<form action="' + url + '" method="POST">' +
               '<input type="hidden" name="id_penerimaan" value="' + $('#id_penerimaan').val() + '" />' +
               '<input type="hidden" name="ddltahun" value="' + $('#ddltahun').val() + '" />' +
               '<input type="hidden" name="ddlskpd" value="' + $('#ddlskpd').val() + '" />' +
               '<input type="hidden" name="ddlbidang" value="' + $('#ddlbidang').val() + '" />' +
               '<input type="hidden" name="ddlbulan" value="' + $('#ddlbulan').val() + '" />' +


               '</form>');
           $('body').append(form);
           $(form).submit();
       }



       function deletedatasemua()
       {
           theConfirm = "Anda yakin ingin menghapus Semua Data\n";
           theConfirm += "dengan Kode : ";

           var go = confirm(theConfirm);
           if (go == true) {
               var url = '/index.php?r=Penerimaandetail/DaftarPenerimaanDetail';
               var form = $('<form action="' + url + '" method="POST">' +
                   '<input type="hidden" name="action" value="deletedatasemua" />' +
                   '<input type="hidden" name="id_penerimaan" value="' + $('#id_penerimaan').val() + '" />' +
                   '<input type="hidden" name="ddltahun" value="' + $('#ddltahun').val() + '" />' +
                   '<input type="hidden" name="ddlskpd" value="' + $('#ddlskpd').val() + '" />' +
                   '<input type="hidden" name="ddlbidang" value="' + $('#ddlbidang').val() + '" />' +
                   '</form>');
               $('body').append(form);
               $(form).submit();
           }
       }

</script>

<?php echo CHtml::beginForm('','POST');
$ReferensiModel=new ReferensiModel();
?>


<div class="panel-heading">
    <i class="fa fa-external-link-square"></i>
    <b>DETAIL PENERIMAAN BARANG</b>
</div>
<br>
<table border=0 cellspacing=0 cellpadding=0 width=1000>
    <tr>
        <td valign="top" width=120><?php echo "Unit Kerja"?></td>
        <td valign="top" width=20><?php echo ":"?></td>
        <td valign="top">
            <?php echo $nama_skpd;

            ?>

        </td>
    </tr>
    <tr>
        <td valign="top" width=120><?php echo "Tgl Penerimaan"?></td>
        <td valign="top" width=20><?php echo ""?>:</td>
        <td valign="top"> <?php  echo $tgl_penerimaan; ?> </td>
    </tr>
    <tr>
        <td valign="top" width=120><?php echo "No Faktur"?></td>
        <td valign="top" width=20><?php echo ""?>:</td>
        <td valign="top">
            <?php echo $no_faktur ;?>
        </td>
    </tr>

    <tr>
        <td valign="top" width=120><?php echo "Tgl Faktur"?></td>
        <td valign="top" width=20><?php echo ""?>:</td>
        <td valign="top">  <?php echo $tgl_faktur;?>

        </td>
    </tr>

    <tr>
        <td valign="top" width=120><?php echo "Diserahkan Oleh"?></td>
        <td valign="top" width=20><?php echo ""?>:</td>
        <td valign="top">
            <?php echo $diserahkan;?>
        </td>
    </tr>
    <tr>
        <td valign="top" width=120><?php echo "Direima Oleh"?></td>
        <td valign="top" width=20><?php echo ""?>:</td>
        <td valign="top">
            <?php echo $diterima;?>
        </td>
    </tr>
    <tr>
        <td valign="top" width=120><?php echo "Distributor"?></td>
        <td valign="top" width=20><?php echo ":"?></td>
        <td valign="top">
            <?php  echo $distributor;
            ?>
        </td>
    </tr>

    <tr>
        <td valign="top" width=120><?php echo "Sumber Dana"?></td>
        <td valign="top" width=20><?php echo ":"?></td>
        <td valign="top">
            <?php  echo $nm_sumber_dana;   ?>
        </td>
    </tr>

</table>

<table border=0 cellspacing=0 cellpadding=0 width=1000>

    <tr><td align='right' width=1000>

            <b>Data Baru</b>
            <?php
            echo CHtml::image('/images/plus2.png','',
                array('height'=>'18px',
                    'title' => 'Data Baru',
                    'style' => 'width:20px',
                    "onClick"=>"insertpenerimaan()"
                )
            );

            ?>

        </td>
    </tr>
</table>

<table border=1  bordercolor=#96EBFD cellspacing=1 cellpadding=1 width=1000>
    <thead>
    <tr rowspan="2" align="center" height='40px' bgcolor="#C4E9fA">
        <th align='center' width=50>No</th>
        <th align='center' width=75>Kode</th>
        <th align='center' width=300>Barang</th>
        <th align='center' width=75>Jumlah</th>
        <th align='center' width=75>Satuan</th>
        <th align='center' width=75>Harga</th>
        <th align='center' width=150>Total</th>
        <th align='center' width=175>Keterangan</th>
        <th align='center' width=50>Aksi </th>

    </tr>
    </thead>
    <tbody>
    <?php $number = 1; ?>
    <?php foreach($dataProvider as $value): ?>
    <tr height="30" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
        <td valign="top" align="center"><?php echo $number++?>.</td>
        <td valign="top" align="center"><?php echo $value["kd_barang"]?></td>
        <td valign="top"><?php echo $value["nama_barang"]?></td>
        <td valign="top" align="right"> <?php echo number_format( $value["volume"] , 0 , "" , '.' )?></td>
        <td valign="top" align="center"><?php echo $value["satuan"]?></td>
         <td valign="top" align="right"> <?php echo number_format( $value["harga_satuan"] , 2 , "," , '.' )?></td>
        <td valign="top" align="right"> <?php echo number_format( $value["jumlah"] , 2 , "," , '.' )?></td>
        <td valign="top" align="right"><?php echo $value["expired"] .' / '. $value["batch"]?></td>
        <td valign="top" align="center">
            <?php echo CHtml::image('/images/tbedit.png','',
                array(
                    'title' => 'Edit Penerimaan',
                    'style' => 'width:20px',
                    "onClick"=>"editdata('$value[id_penerimaan_detail]')"
                ));?>
            <?php
//            if (Yii::app()->session['id_level_user']==9){
            echo CHtml::image('/images/error.png','',
                array(
                    'title' => 'Hapus Penerimaan',
                    'style' => 'width:20px',
                    "onClick"=>"deletedata('$value[id_penerimaan_detail]','$value[kd_barang]')"
                ));

//            }
            ?>
        </td>

    </tr>
    </tbody>
    <?php endforeach; ?>

</table>

<table border=0 cellspacing=0 cellpadding=0 width=1000>
    <tr><td align='right' width=1000>

            <?php

            echo CHtml::button(' Kembali ',
                array(
                    'title' => 'Kembali',
                    'style' => 'width:100px',
                    "onClick"=>"Kembali()"
                ));  ?>
        </td>
    </tr>
    <tr><td align='left' width=1000>
   <?php  if (Yii::app()->session['id_level_user']==9 or Yii::app()->session['id_level_user']==1){
            echo CHtml::button('Hapus Semua',
                array(
                    'title' => 'Hapus Semua',
                    'style' => 'width:200px',
                    "onClick"=>"deletedatasemua()"
                ));
            }
            ?>


        </td>
    </tr>
</table>

<?php echo CHtml::hiddenField('ddltahun',$tahun);  ?>
<?php echo CHtml::hiddenField('ddlskpd',$id_skpd);  ?>
<?php echo CHtml::hiddenField('ddlbidang',$id_bidang);  ?>
<?php echo CHtml::hiddenField('ddlbulan',(int)date("m",strtotime($tgl_penerimaan)));  ?>
<?php echo CHtml::hiddenField('id_penerimaan',$id_penerimaan);  ?>
<?php
echo CHtml::endForm();
?>

<?php  if (Yii::app()->session['id_level_user']==9 or Yii::app()->session['id_level_user']==1){?>


<b>UPLOAD EXCEL PER TANGGAL</b>
<table border=0 cellspacing=0 cellpadding=0 width=400>
    <tr><td align='left' width=200>
            <form method=post action='/index.php?r=/Penerimaandetail/DaftarPenerimaanDetail' enctype=multipart/form-data>
                <input class=text type=file name=file id=file size=10>
                <input name="action" type="hidden" value="upload">
                <input name="id_penerimaan" type="hidden" value="<?=$id_penerimaan?>">
                <input type=submit name=submit value=Upload>
            </form>

        </td>
        <td align='right' width=200>

        </td>
    </tr>
</table>



<b>UPLOAD EXCEL PER BULAN</b>
<table border=0 cellspacing=0 cellpadding=0 width=400>
    <tr><td align='left' width=200>
            <form method=post action='/index.php?r=/Penerimaandetail/DaftarPenerimaanDetail' enctype=multipart/form-data>
                <input class=text type=file name=file id=file size=10>
                <input name="action" type="hidden" value="upload_all">
                <input name="id_penerimaan" type="hidden" value="<?=$id_penerimaan?>">
                <input type=submit name=submit value=Upload>
            </form>

        </td>
        <td align='right' width=200>

        </td>
    </tr>
</table>

<?php } ?>