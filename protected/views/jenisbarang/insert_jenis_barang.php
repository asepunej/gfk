
<script type="text/javascript">


        function Kembali(){
            var url = '/index.php?r=Jenisbarang/DaftarJenisBarang';
            var form = $('<form action="' + url + '" method="POST">' +
                '<input type="hidden" name="ddljenispersediaan" value="' + $('#ddljenispersediaan').val() + '" />' +
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
    <b>INSERT JENIS BARANG</b>
</div>
<br>

<div align="left">
    <table >
        <tr>
            <td valign="top" width=120><?php echo "Jenis Persediaan"?></td>
            <td valign="top" width=20><?php echo ":"?></td>
            <td valign="top">
                <?php  echo CHtml::dropDownList('ddljenispersediaan',$id_jenis_persediaan,$ReferensiModel->getdaftarjenispersediaan()
                    , array('style'=>'width: 400px;background-color: #F3FDF0'
                    ,'disabled'=>false,
                        'options'=>array($id_jenis_persediaan=>array('selected'=>'selected'))));
                ?>
            </td>
        </tr>
        <tr>
            <td valign="top" width=120><?php echo "Jenis Barang"?></td>
            <td valign="top" width=20><?php echo ""?>:</td>
            <td valign="top">
                <?php echo CHtml::textField('txtjenisbarang', $jenis_barang,
                    array( 'style'=>'width: 600px; ' ,'disabled'=>false,));;?>

            </td>
        </tr>

        <tr>
            <td valign="top" width=120><?php echo "Kode"?></td>
            <td valign="top" width=20><?php echo ""?>:</td>
            <td valign="top">
                <?php echo CHtml::textField('txtkdjenisbarang', $kd_jenis_barang,
                    array( 'style'=>'width: 200px; ' ,'disabled'=>false,));;?>

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

    <?php echo CHtml::hiddenField('id_jenis_barang',$id_jenis_barang);  ?>
    <?php echo CHtml::hiddenField('statussimpan','1');  ?>


</div>

</table>

<?php
echo CHtml::endForm();
?>

