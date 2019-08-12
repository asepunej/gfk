
<script type="text/javascript">


        function Kembali(){
            var url = '/index.php?r=Barang/DaftarBarang';
            var form = $('<form action="' + url + '" method="POST">' +
                '<input type="hidden" name="ddljenispersediaan" value="' + $('#ddljenispersediaan').val() + '" />' +
                '<input type="hidden" name="ddljenisbarang" value="' + $('#ddljenisbarang').val() + '" />' +
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
    <b>INSERT BARANG</b>
</div>
<br>

<div align="left">
    <table >

        <tr>
            <td valign="top" width=100><?php echo "Jenis Barang"?></td>
            <td valign="top" width=20><?php echo ":"?></td>
            <td valign="top">
                <?php  echo CHtml::dropDownList('ddljenisbarang',$id_jenis_barang,$ReferensiModel->getdaftarjenisbarang($id_jenis_persediaan)
                    , array('style'=>'width: 300px;background-color: #F3FDF0'
//                    , 'prompt'=>'Pilih'
                    ,'disabled'=>false,
                        'options'=>array($id_jenis_barang=>array('selected'=>'selected'))));
                ?>
                <?php echo CHtml::textField('txtkd_barang', $kd_barang,
                    array('maxlength'=>5, 'style'=>'width: 60px;' ,'disabled'=>false,));;?>
            </td>
        </tr>

        <tr>
            <td valign="top" width=120><?php echo "Nama Barang"?></td>
            <td valign="top" width=20><?php echo ""?>:</td>
            <td valign="top">
                <?php echo CHtml::textArea('txtnama_barang', $nama_barang,
                    array( 'style'=>'width: 600px; ' ,'disabled'=>false,));;?>

            </td>
        </tr>

     
        <tr>
            <td valign="top"><?php echo "Satuan"?></td>
            <td valign="top"><?php echo ":"?></td>
            <td valign="top">
                <?php
                $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                    'name' => 'txtsatuan',
                    'value'=>$satuan,
                    'sourceUrl' => $this->createUrl('Autocomplete'),  //nama action pada controller
                    'options' => array(
                        'minLength' => '1',
                        'width'=>'300px',
                    ),
                    'htmlOptions' => array(
                        'style' => 'height:20px; width:300px;',
                    ),
                ));
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

    <?php echo CHtml::hiddenField('ddljenispersediaan',$id_jenis_persediaan);  ?>
<!--    --><?php //echo CHtml::hiddenField('ddljenisbarang',$id_jenis_barang);  ?>
    <?php echo CHtml::hiddenField('id_barang',$id_barang);  ?>

       <?php echo CHtml::hiddenField('statussimpan','1');  ?>


</div>

</table>

<?php
echo CHtml::endForm();
?>

