
<script type="text/javascript">


        function Kembali(){
            var url = '/index.php?r=BarangRusak/DaftarBarangRusak';
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
            'width'=>'900px',
            'modal'=>true,
            'position' => 'center',
            'show'=>'{effect: "fade",duration: 1000}'
        )
    )
);
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>

<?php
echo CHtml::beginForm('','POST');
$ReferensiModel=new ReferensiModel();
?>

<div class="panel-heading">
    <i class="fa fa-external-link-square"></i>
    <b>INSERT BARANG RUSAK/USANG</b>
</div>
<br>

<div align="left">
    <table >

        <tr>
            <td valign="top" width=100><?php echo "Nama Barang"?></td>
            <td valign="top" width=20><?php echo ":"?></td>
            <td valign="top">
                <?php echo CHtml::textField('txtbarang', $nama_barang,
                    array( 'style'=>'width: 500px; ' ,'disabled'=>true,));;?>

            </td>
        </tr>

        <tr>
            <td valign="top" width=100><?php echo "Satuan"?></td>
            <td valign="top" width=20><?php echo ":"?></td>
            <td valign="top">
                <?php echo CHtml::textField('txtsatuan', $satuan,
                    array( 'style'=>'width: 200px; ' ,'disabled'=>true,));;?>

            </td>
        </tr>

        <tr>
            <td valign="top" width=100><?php echo "Penerimaan"?></td>
            <td valign="top" width=20><?php echo ":"?></td>
            <td valign="top">
                <?php  echo CHtml::dropDownList('ddlpenerimaan',$id_penerimaan_detail,$ReferensiModel->getdaftarpenerimaanbybarang($id_barang)
                    , array('style'=>'width: 400px;background-color: #F3FDF0'
                    , 'prompt'=>'Pilih'
                    ,'disabled'=>false,
                        'options'=>array($id_penerimaan_detail=>array('selected'=>'selected'))));
                ?>
            </td>
        </tr>

        <tr>
            <td valign="top" width=100><?php echo "Jumlah"?></td>
            <td valign="top" width=20><?php echo ":"?></td>
            <td valign="top">
                <?php echo CHtml::textField('txtjumlah', $jumlah,
                    array( 'style'=>'width: 50px; ' ,'disabled'=>false,));;?>

            </td>
        </tr>

        <tr>
            <td valign="top" width=100><?php echo "Status Barang"?></td>
            <td valign="top" width=20><?php echo ":"?></td>
            <td valign="top">
                <?php  echo CHtml::dropDownList('ddlstatus',$kd_status_barang,$ReferensiModel->getdaftarstatusbarang()
                    , array('style'=>'width: 100px;background-color: #F3FDF0'
                    , 'prompt'=>'Pilih'
                    ,'disabled'=>false,
                        'options'=>array($kd_status_barang=>array('selected'=>'selected'))));
                ?>
            </td>
        </tr>
        <tr>
            <td valign="top"></td>
            <td valign="top"></td>
            <td valign="top">
                <?php echo CHtml::button(' Kembali ',
                    array(
                        'title' => 'Kembali',
                        'style' => 'width:100px',
                        "onClick"=>"Kembali()"
                    ));  ?>

                <?php echo CHtml::submitButton('Simpan',
                    array(
                        'title' => 'Simpan',
                        'style' => 'width:100px',
                    ));

                echo "".$statussimpan
                ?>


            </td>
        </tr>
    </table>


    <?php echo CHtml::hiddenField('id_barang',$id_barang);  ?>

       <?php echo CHtml::hiddenField('statussimpan','1');  ?>


</div>

</table>

<?php
echo CHtml::endForm();
?>

