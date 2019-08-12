<STYLE>
<!--
  tr { }
  .initial { background-color: #FFFFFF; color:#000000 }
  .normal { background-color: #FFFFFF }
  .highlight { background-color: #DFFBED }
 //-->
</style>

<script type="text/javascript">

       function insertdata()
    {
        var url = '/index.php?r=Barang/InsertBarang';
        var form = $('<form action="' + url + '" method="POST">' +
            '<input type="hidden" name="ddljenispersediaan" value="' + $('#ddljenispersediaan').val() + '" />' +
            '<input type="hidden" name="ddljenisbarang" value="' + $('#ddljenisbarang').val() + '" />' +

            '</form>');
        $('body').append(form);
        $(form).submit();
    }

       function editdata(id_barang)
       {
           var url = '/index.php?r=Barang/EditBarang';
           var form = $('<form action="' + url + '" method="POST">' +
               '<input type="hidden" name="id_barang" value="' + id_barang + '" />' +

               '</form>');
           $('body').append(form);
           $(form).submit();
       }
       function DetailBarangRusak(id_barang)
       {
           var url = '/index.php?r=Barangrusak/DaftarBarangRusak';
           var form = $('<form action="' + url + '" method="POST">' +
               '<input type="hidden" name="id_barang" value="' + id_barang + '" />' +

               '</form>');
           $('body').append(form);
           $(form).submit();
       }



    function deletedata(id_barang,nama_barang)
    {
        theConfirm = "Anda yakin ingin menghapus data ";
        theConfirm += nama_barang + "?";
        var go = confirm(theConfirm);
        if (go == true) {
            var url = '/index.php?r=Barang/DaftarBarang';
            var form = $('<form action="' + url + '" method="POST">' +
                '<input type="hidden" name="action" value="statusdelete" />' +
                '<input type="hidden" name="id_barang" value="' + id_barang + '" />' +
                '<input type="hidden" name="ddljenispersediaan" value="' + $('#ddljenispersediaan').val() + '" />' +
                '<input type="hidden" name="ddljenisbarang" value="' + $('#ddljenisbarang').val() + '" />' +
                '</form>');
            $('body').append(form);
            $(form).submit();
        }

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
    <b>DAFTAR OBAT DAN ALAT KESEHATAN </b>
</div>

<br>
<table border=0 cellspacing=0 cellpadding=0 width=900>
    <tr>
        <td valign="top" width=100><?php echo "Jenis Persediaan"?></td>
        <td valign="top" width=20><?php echo ":"?></td>
        <td valign="top">
            <?php  echo CHtml::dropDownList('ddljenispersediaan',$id_jenis_persediaan,$ReferensiModel->getdaftarjenispersediaan()
                , array('onChange'=>'this.form.submit();','style'=>'width: 400px;background-color: #F3FDF0'
                , 'prompt'=>'Pilih'
                ,'disabled'=>false,
                    'options'=>array($id_jenis_persediaan=>array('selected'=>'selected'))));
            ?>
        </td>
    </tr>

    <tr>
        <td valign="top" width=100><?php echo "Jenis Barang"?></td>
        <td valign="top" width=20><?php echo ":"?></td>
        <td valign="top">
            <?php  echo CHtml::dropDownList('ddljenisbarang',$id_jenis_barang,$ReferensiModel->getdaftarjenisbarang($id_jenis_persediaan)
                , array('onChange'=>'this.form.submit();','style'=>'width: 400px;background-color: #F3FDF0'
                , 'prompt'=>'Pilih'
                ,'disabled'=>false,
                    'options'=>array($id_jenis_barang=>array('selected'=>'selected'))));
            ?>
        </td>
    </tr>


</table>

<table border=0 cellspacing=0 cellpadding=0 width=900>
    <tr><td align='right' width800>

           <b>Data Baru</b>
             <?php
            echo CHtml::image('/images/plus2.png','',
                array('height'=>'18px',
                    'title' => 'Data Baru',
                    'style' => 'width:20px',
                    "onClick"=>"insertdata()"
                        )
            );
            ?>
        </td>
    </tr>
</table>

<table border=1  bordercolor=#96EBFD cellspacing=1 cellpadding=1 width=900>
    <thead>
    <tr rowspan="2" align="center" height='40px' bgcolor="#C4E9fA">
            <th align='center' width=50>No</th>
        <th align='center' width=100>Kode</th>
             <th align='center' width=450>Nama Obat / Barang </th>
            <th align='center' width=100>Satuan</th>
            <th align='center' width=150>kode Rek</th>
<!--            <th align='center' width=50>Rusak</th>-->
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
            <td valign="top" align='center'><?php echo $value["satuan"]?></td>
            <td valign="top" align='center'><?php echo $value["kd_barang_rek"]?></td>
<!--            <td valign="top" align='center'>-->
<!---->
<!--                --><?php
//                    echo CHtml::label('<i>'.'<u>'.$value["jumlah_rusak"].'</u>'.'</i>','',
//                        array(
//                            'title' => 'Barang Rusak',
//                            'style' => 'width:20px',
//                            "onClick"=>"DetailBarangRusak('$value[id_barang]')"
//                        ));
//                                ?>
<!---->
<!--            </td>-->
             <td valign="top" align="center">
                <?php echo CHtml::image('/images/tbedit.png','',
                    array(
                        'title' => 'edit',
                        'style' => 'width:20px',
                        "onClick"=>"editdata('$value[id_barang]')"
                    ));?>

            <?php
                echo CHtml::image('/images/error.png','',
                    array(
                        'title' => 'hapus',
                        'style' => 'width:20px',
                        "onClick"=>"deletedata('$value[id_barang]','$value[nama_barang]')"
                    ));?>
            </td>

        </tr>
        </tbody>
        <?php endforeach; ?>

    </table>
     </td></tr>
</table>

<?php
echo CHtml::endForm();
?>




