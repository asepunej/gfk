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
        var url = '/index.php?r=Jenisbarang/InsertJenisBarang';
        var form = $('<form action="' + url + '" method="POST">' +
            '<input type="hidden" name="ddljenispersediaan" value="' + $('#ddljenispersediaan').val() + '" />' +
            '</form>');
        $('body').append(form);
        $(form).submit();
    }

       function editdata(id_jenis_barang)
       {
           var url = '/index.php?r=Jenisbarang/EditJenisBarang';
           var form = $('<form action="' + url + '" method="POST">' +
               '<input type="hidden" name="id_jenis_barang" value="' + id_jenis_barang + '" />' +
               '<input type="hidden" name="ddljenispersediaan" value="' + $('#ddljenispersediaan').val() + '" />' +
               '</form>');
           $('body').append(form);
           $(form).submit();
       }



    function deletedata(id_jenis_barang,jenis_barang)
    {
        theConfirm = "Anda yakin ingin menghapus data ";
        theConfirm += jenis_barang + "?";
        var go = confirm(theConfirm);
        if (go == true) {
            var url = '/index.php?r=Jenisbarang/DaftarJenisBarang';
            var form = $('<form action="' + url + '" method="POST">' +
                '<input type="hidden" name="action" value="statusdelete" />' +
                '<input type="hidden" name="id_jenis_barang" value="' + id_jenis_barang + '" />' +
                '<input type="hidden" name="ddljenispersediaan" value="' + $('#ddljenispersediaan').val() + '" />' +
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
    <b>DAFTAR JENIS BARANG</b>
</div>

<br>
<table border=0 cellspacing=0 cellpadding=0 width=600>
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

</table>

<table border=0 cellspacing=0 cellpadding=0 width=800>
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



<table border=1  bordercolor=#96EBFD cellspacing=1 cellpadding=1 width=800>
    <thead>
    <tr rowspan="2" align="center" height='40px' bgcolor="#C4E9fA">
            <th align='center' width=50>NO</th>
            <th align='center' width=500>Jenis Barang</th>
            <th align='center' width=200>Kode Jenis</th>
            <th align='center' width=50>Aksi </th>

        </tr>
        </thead>
        <tbody>
        <?php $number = 1; ?>
        <?php foreach($dataProvider as $value): ?>
        <tr height="30" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
            <td valign="top" align="center"><?php echo $number++?>.</td>
            <td valign="top"><?php echo $value["jenis_barang"]?></td>
            <td valign="top"><?php echo $value["kd_jenis_barang"]?></td>
            <td valign="top" align="center">
                <?php echo CHtml::image('/images/tbedit.png','',
                    array(
                        'title' => 'edit',
                        'style' => 'width:20px',
                        "onClick"=>"editdata('$value[id_jenis_barang]')"
                    ));?>

            <?php
                echo CHtml::image('/images/error.png','',
                    array(
                        'title' => 'hapus',
                        'style' => 'width:20px',
                        "onClick"=>"deletedata('$value[id_jenis_barang]','$value[jenis_barang]')"
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




