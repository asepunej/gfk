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
        var url = '/index.php?r=Barangrusak/InsertBarangRusak';
        var form = $('<form action="' + url + '" method="POST">' +
            '<input type="hidden" name="id_barang" value="' + $('#id_barang').val() + '" />' +

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



    function deletedata(id_status_barang,nama_barang)
    {
        theConfirm = "Anda yakin ingin menghapus data ";
        theConfirm += nama_barang + "?";
        var go = confirm(theConfirm);
        if (go == true) {
            var url = '/index.php?r=Barangrusak/DaftarBarangRusak';
            var form = $('<form action="' + url + '" method="POST">' +
                '<input type="hidden" name="action" value="statusdelete" />' +
                '<input type="hidden" name="id_status_barang" value="' + id_status_barang + '" />' +
                '<input type="hidden" name="id_barang" value="' + $('#$id_barang').val() + '" />' +
                '<input type="hidden" name="ddljenisbarang" value="' + $('#ddljenisbarang').val() + '" />' +
                '</form>');
            $('body').append(form);
            $(form).submit();
        }

    }
       function Kembali(){
           var url = '/index.php?r=Barang/DaftarBarang';
           var form = $('<form action="' + url + '" method="POST">' +
               '<input type="hidden" name="id_barang" value="' + $('#id_barang').val() + '" />' +
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
    <b>DAFTAR BARANG RUSAK ATAU USANG </b>
</div>

<br>
<table border=0 cellspacing=0 cellpadding=0 width=900>
    <tr>
        <td valign="top" width=100><?php echo "Nama Barang"?></td>
        <td valign="top" width=20><?php echo ":"?></td>
        <td valign="top">
            <?php echo CHtml::textField('txtbarang', $nama_barang,
                array( 'style'=>'width: 500px; ' ,'disabled'=>false,));;?>

        </td>
    </tr>

    <tr>
        <td valign="top" width=100><?php echo "Satuan"?></td>
        <td valign="top" width=20><?php echo ":"?></td>
        <td valign="top">
            <?php echo CHtml::textField('txtsatuan', $satuan,
                array( 'style'=>'width: 200px; ' ,'disabled'=>false,));;?>

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
           <th align='center' width=100>Tanggal</th>
            <th align='center' width=200>No Faktur </th>
            <th align='center' width=100>Volume</th>
            <th align='center' width=100>Harga </th>
            <th align='center' width=200>Total</th>
            <th align='center' width=100>Status</th>
            <th align='center' width=50>Aksi </th>

        </tr>
        </thead>
        <tbody>
        <?php $number = 1; ?>
        <?php foreach($dataProvider as $value): ?>
        <tr height="30" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
            <td valign="top" align="center"><?php echo $number++?>.</td>
            <td valign="top" align="center"><?php echo $value["tgl_penerimaan"]?></td>
            <td valign="top"><?php echo $value["no_faktur"]?></td>
            <td valign="top" align='center'><?php echo $value["jumlah"]?></td>
            <td valign="top" align='center'><?php echo number_format( $value["harga_satuan"] , 0 , "" , '.' )?></td>
            <td valign="top" align='center'><?php echo number_format( $value["total"] , 0 , "" , '.' )?></td>
            <td valign="top" align='center'><?php echo $value["status_barang"]?></td>

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
                        "onClick"=>"deletedata('$value[id_status_barang]','$value[tgl_penerimaan]')"
                    ));?>
            </td>

        </tr>
        </tbody>
        <?php endforeach; ?>

    </table>
     </td></tr>
</table>

<?php echo CHtml::button(' Kembali ',
    array(
        'title' => 'Kembali',
        'style' => 'width:100px',
        "onClick"=>"Kembali()"
    ));  ?>

<?php
echo CHtml::hiddenField('id_barang',$id_barang);
echo CHtml::hiddenField('xxxid_status_barang',$id_status_barang);  ?>
<?php
echo CHtml::endForm();
?>




