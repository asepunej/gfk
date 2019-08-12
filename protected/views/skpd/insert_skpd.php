
<script type="text/javascript">


        function Kembali(){
            var url = '/index.php?r=Bidang/DaftarBidang';
            var form = $('<form action="' + url + '" method="POST">' +
                '<input type="hidden" name="ddlskpd" value="' + $('#ddlskpd').val() + '" />' +
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
    <b>INSERT BIDANG</b>
</div>
<br>

<div align="left">
    <table >
        <tr>
            <td valign="top" width=120><?php echo "SKPD"?></td>
            <td valign="top" width=20><?php echo ":"?></td>
            <td valign="top">
                <?php  echo CHtml::dropDownList('ddlskpd',$id_skpd,$ReferensiModel->getdaftarskpd()
                    , array('onChange'=>'this.form.submit();','style'=>'width: 400px;background-color: #F3FDF0'
                    ,'disabled'=>false,
                        'options'=>array($id_skpd=>array('selected'=>'selected'))));
                ?>
            </td>
        </tr>
        <tr>
            <td valign="top" width=120><?php echo "Nama Bidang"?></td>
            <td valign="top" width=20><?php echo ""?>:</td>
            <td valign="top">
                <?php echo CHtml::textField('txtbidang', $bidang,
                    array( 'style'=>'width: 600px; ' ,'disabled'=>false,));;?>

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

    <?php echo CHtml::hiddenField('id_bidang',$id_bidang);  ?>
    <?php echo CHtml::hiddenField('statussimpan','1');  ?>


</div>

</table>

<?php
echo CHtml::endForm();
?>

