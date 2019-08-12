<STYLE>
<!--
  tr { }
  .initial { background-color: #FFFFFF; color:#000000 }
  .normal { background-color: #FFFFFF }
  .highlight { background-color: #DFFBED }
 //-->
</style>

<script type="text/javascript">



       function insertpengeluarandetail()
       {
           var url = '/index.php?r=Pengeluarandetail/InsertPengeluaranDetail';
           var form = $('<form action="' + url + '" method="POST">' +
               '<input type="hidden" name="id_pengeluaran" value="' + $('#id_pengeluaran').val() + '" />' +
               '</form>');
           $('body').append(form);
           $(form).submit();
       }

       function editdata(id_pengeluaran_detail)
       {
           var url = '/index.php?r=Pengeluarandetail/EditPengeluaranDetail';
           var form = $('<form action="' + url + '" method="POST">' +
               '<input type="hidden" name="id_pengeluaran_detail" value="' + id_pengeluaran_detail + '" />' +
               '</form>');
           $('body').append(form);
           $(form).submit();
       }

    function deletedata(id_pengeluaran_detail,kd_barang)
    {
        theConfirm = "Anda yakin ingin menghapus data ";
        theConfirm += kd_barang + "?";
        var go = confirm(theConfirm);
        if (go == true) {
            var url = '/index.php?r=Pengeluarandetail/DaftarPengeluaranDetail';
            var form = $('<form action="' + url + '" method="POST">' +
                '<input type="hidden" name="action" value="statusdelete" />' +
                '<input type="hidden" name="id_pengeluaran_detail" value="' + id_pengeluaran_detail + '" />' +
                '<input type="hidden" name="id_pengeluaran" value="' + $('#id_pengeluaran').val() + '" />' +

                '</form>');
            $('body').append(form);
            $(form).submit();
        }

    }
       function Kembali(){
           var url = '/index.php?r=Pengeluaran/DaftarPengeluaran';
           var form = $('<form action="' + url + '" method="POST">' +
               '<input type="hidden" name="id_pengeluaran" value="' + $('#id_pengeluaran').val() + '" />' +
               '<input type="hidden" name="ddltahun" value="' + $('#ddltahun').val() + '" />' +
               '<input type="hidden" name="ddlskpd" value="' + $('#ddlskpd').val() + '" />' +
               '<input type="hidden" name="ddlbidang" value="' + $('#ddlbidang').val() + '" />' +
               '<input type="hidden" name="ddlbulan" value="' + $('#ddlbulan').val() + '" />' +

               '</form>');
           $('body').append(form);
           $(form).submit();
       }

       function distribusipengeluaran()
       {
           theConfirm = "Anda yakin akan menditribusikan pengeluaran barang ?";
           var go = confirm(theConfirm);
           if (go == true) {
               var url = '/index.php?r=Pengeluarandetail/DaftarPengeluaranDetail';
               var form = $('<form action="' + url + '" method="POST">' +
                   '<input type="hidden" name="action" value="statusdistribusi" />' +
                   '<input type="hidden" name="id_pengeluaran" value="' + $('#id_pengeluaran').val() + '" />' +

                   '</form>');
               $('body').append(form);
               $(form).submit();
           }
       }

       function deletedatasemua()
       {
           theConfirm = "Anda yakin ingin menghapus Semua Data\n";
           theConfirm += "dengan Kode : ";

           var go = confirm(theConfirm);
           if (go == true) {
               var url = '/index.php?r=Pengeluarandetail/DaftarPengeluaranDetail';
               var form = $('<form action="' + url + '" method="POST">' +
                   '<input type="hidden" name="action" value="deletedatasemua" />' +
                   '<input type="hidden" name="id_pengeluaran" value="' + $('#id_pengeluaran').val() + '" />' +
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
    <b>DETAIL PENGELUARAN BARANG</b>
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
        <td valign="top" width=120><?php echo "Tgl Pengeluaran"?></td>
        <td valign="top" width=20><?php echo ""?>:</td>
        <td valign="top"> <?php  echo $tgl_pengeluaran; ?> </td>
    </tr>
    <tr>
        <td valign="top" width=120><?php echo "No Permintaan"?></td>
        <td valign="top" width=20><?php echo ""?>:</td>
        <td valign="top">
            <?php echo $no_permintaan ;?>
        </td>
    </tr>

    <tr>
        <td valign="top" width=120><?php echo "Tgl Permintaan"?></td>
        <td valign="top" width=20><?php echo ""?>:</td>
        <td valign="top">  <?php echo $tgl_permintaan;?>

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
        <td valign="top" width=120><?php echo "Diterima Oleh"?></td>
        <td valign="top" width=20><?php echo ""?>:</td>
        <td valign="top">
            <?php echo $diterima;?>
        </td>
    </tr>

    <tr>
        <td valign="top" width=120><?php echo "Unit Penerima"?></td>
        <td valign="top" width=20><?php echo ":"?></td>
        <td valign="top">
            <?php  echo$bidang;
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


            <?php
//            if ($distribusi_status!=1){
                echo '<b>Data Baru</b>';
                echo CHtml::image('/images/plus2.png','',
                    array('height'=>'18px',
                        'title' => 'Data Baru',
                        'style' => 'width:20px',
                        "onClick"=>"insertpengeluarandetail()"
                    )
                );
//            }


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
        <th align='center' width=100>Aksi </th>

    </tr>
    </thead>
    <tbody>
    <?php $number = 1; ?>
    <?php foreach($dataProvider as $value): ?>
    <tr height="30" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
        <td valign="top" align="center"><?php echo $number++?>.</td>
        <td valign="top" align="center"><?php echo $value["kd_barang"]?></td>
        <td valign="top"><?php echo $value["nama_barang"]?></td>
        <td valign="top" align="center"><?php echo $value["volume"]?></td>
        <td valign="top" align="center"><?php echo $value["satuan"]?></td>
        <td valign="top" align="right"> <?php echo number_format( $value["harga_satuan"] , 0 , "" , '.' )?></td>
        <td valign="top" align="right"> <?php echo number_format( $value["volume"]*$value["harga_satuan"] , 0 , "" , '.' )?></td>
        <td valign="top" align="right"><?php echo $value["keterangan"] .'  '. $value["batch"]?></td>


        <td valign="top" align="center">

            <?php
//            if ($distribusi_status!=1){
                echo CHtml::image('/images/tbedit.png','',
                    array(
                        'title' => 'Edit pengeluaran',
                        'style' => 'width:20px',
                        "onClick"=>"editdata('$value[id_pengeluaran_detail]')"
                    ));

                echo CHtml::image('/images/error.png','',
                    array(
                        'title' => 'Hapus Pengeluaran Detail',
                        'style' => 'width:20px',
                        "onClick"=>"deletedata('$value[id_pengeluaran_detail]','$value[kd_barang]')"
                    ));
//            }
            ?>
        </td>

    </tr>
    </tbody>
    <?php endforeach; ?>

</table>

<table border=0 cellspacing=0 cellpadding=0 width=1000>
    <tr><td align='left' width=500>
        </td>
        <td align='right' width=500>

            <?php

            if($level_unit==1 or $level_unit==2)
            {
                if ($distribusi_status!=1 or Yii::app()->session['id_level_user']==999){
                    echo CHtml::button(' Distribusi ',
                        array(
                            'title' => 'Distribusi',
                            'style' => 'width:120px',
                            "onClick"=>"distribusipengeluaran()"
                        ));
                }

                    echo CHtml::button('Hapus Semua',
                        array(
                            'title' => 'Hapus Semua',
                            'style' => 'width:100px',
                            "onClick"=>"deletedatasemua()"
                        ));
//                }
            }



             echo CHtml::button(' Kembali ',
                array(
                    'title' => 'Kembali',
                    'style' => 'width:100px',
                    "onClick"=>"Kembali()"
                ));
            ?>

        </td>
    </tr>
</table>

<?php echo CHtml::hiddenField('ddltahun',$tahun);  ?>
<?php echo CHtml::hiddenField('ddlskpd',$id_skpd);  ?>
<?php echo CHtml::hiddenField('ddlbidang',$id_bidang);  ?>
<?php echo CHtml::hiddenField('id_pengeluaran',$id_pengeluaran);  ?>
<?php echo CHtml::hiddenField('ddlbulan',(int)date("m",strtotime($tgl_pengeluaran)));  ?>


<?php
echo CHtml::endForm();
?>

<b>UPLOAD EXCEL PER TANGGAL</b>
    <table border=0 cellspacing=0 cellpadding=0 width=400>
        <tr><td align='left' width=200>
                <form method=post action='/index.php?r=/Pengeluarandetail/DaftarPengeluaranDetail' enctype=multipart/form-data>
                    <input class=text type=file name=file id=file size=10>
                    <input name="action" type="hidden" value="upload">
                    <input name="id_pengeluaran" type="hidden" value="<?=$id_pengeluaran?>">
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
            <form method=post action='/index.php?r=/Pengeluarandetail/DaftarPengeluaranDetail' enctype=multipart/form-data>
                <input class=text type=file name=file id=file size=10>
                <input name="action" type="hidden" value="upload_all">
                <input name="id_pengeluaran" type="hidden" value="<?=$id_pengeluaran?>">
                <input type=submit name=submit value=Upload>
            </form>

        </td>
        <td align='right' width=200>

        </td>
    </tr>
</table>


