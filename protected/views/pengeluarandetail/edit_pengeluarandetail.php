
<script type="text/javascript">

        function Kembali(){
            var url = '/index.php?r=Pengeluarandetail/DaftarPengeluaranDetail';
            var form = $('<form action="' + url + '" method="POST">' +
                '<input type="hidden" name="id_pengeluaran" value="' + $('#id_pengeluaran').val() + '" />' +
                     '</form>');
            $('body').append(form);
            $(form).submit();
        }

    var SelectedValue = "Rp.";
    var SelectedText;

    function getddlCurrency() {
        var DropdownList =document.getElementById('ddlCurrency');
        var SelectedIndex = DropdownList.selectedIndex;
        SelectedValue = DropdownList.value;
        SelectedText = DropdownList.options[DropdownList.selectedIndex].text;
        document.getElementById('m_oJmlStr').value = formatCurr('');
        document.getElementById('m_oJmlStr').focus();
        document.getElementById('m_oJmlStr').select();
    }

    function formatAmountNoDecimals(number) {
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(number)) {
            number = number.replace(rgx, '$1' + '.' + '$2');
        }
        return number;
    }

    function formatCurr(number) {
        number = number.replace(/[^0-9]/g, '');


        if (number.length == 0) number = "";
        else number = number.substring(0, number.length);

        x = number.split(',');
        x1 = x[0];
        x2 = x.length > 1 ? ',' + x[1] : '';
        return formatAmountNoDecimals(x1) + x2;
    }

    function runCurr() {
        document.getElementById("m_oJmlStr").value = formatCurr(document.getElementById("m_oJmlStr").value);
    }
</script>

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog'
    ,array(
        'id'=>'pop',
        'options'=>array(
            'autoOpen'=>false,
            'title'=>'Pilih Barang',
            'height'=>'400',
            'width'=>'750px',
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
//echo "level_user".Yii::app()->session['level_user'];
//echo "id_level_user".Yii::app()->session['id_level_user'];
?>

<div class="panel-heading">
    <i class="fa fa-external-link-square"></i>
    <b>INSERT PENGELUARAN BARANG</b>
</div>
<br>

<div align="left">
    <table >
        <tr>
            <td valign="top" width=120><?php echo "Unit Kerja"?></td>
            <td valign="top" width=20><?php echo ":"?></td>
            <td valign="top">
                <?php echo $nama_skpd;
                ?>

            </td>
        </tr>
        <tr>
            <td valign="top" width=120><?php echo "No Permintaan"?></td>
            <td valign="top" width=20><?php echo ""?>:</td>
            <td valign="top">
                <?php echo $no_permintaan.' / '.$tgl_permintaan ;?>
            </td>
        </tr>

        <tr>
            <td valign="top" width=120><?php echo "Unit Penerima"?></td>
            <td valign="top" width=20><?php echo ""?>:</td>
            <td valign="top">
                <?php echo $bidang ;?>
            </td>
        </tr>

        <tr>
            <td valign="top" width=120><?php echo "Sumber Dana"?></td>
            <td valign="top" width=20><?php echo ":"?></td>
            <td valign="top">
                <?php  echo $nm_sumber_dana;   ?>
            </td>
        </tr>

        <tr>
            <td valign="top"><?php echo "Nama Barang"?></td>
            <td valign="top"><?php echo ":"?></td>
            <td valign="top">
                <?php

                echo $nama_barang;
                ?>

            </td>
        </tr>

        <tr>
            <td valign="top" width=120><?php echo "volume"?></td>
            <td valign="top" width=20><?php echo ""?>:</td>
            <td valign="top">
                <?php echo CHtml::textField('txtvolume', $volume,
                    array( 'style'=>'width: 50px'));;?>
            </td>
        </tr>

        <tr>
            <td valign="top" width=120><?php echo "Keterangan"?></td>
            <td valign="top" width=20><?php echo ""?>:</td>
            <td valign="top">
                <?php echo CHtml::textField('txtketerangan', $keterangan,
                    array( 'style'=>'width: 400px'));;?>
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

    <?php echo CHtml::hiddenField('id_skpd',$id_skpd);  ?>
    <?php Yii::app()->session['id_skpd_induk'] =$id_skpd;  ?>
    <?php echo CHtml::hiddenField('id_pengeluaran',$id_pengeluaran);  ?>
    <?php echo CHtml::hiddenField('id_pengeluaran_barang',$id_pengeluaran_barang);  ?>
    <?php echo CHtml::hiddenField('id_pengeluaran_detail',$id_pengeluaran_detail);  ?>
    <?php echo CHtml::hiddenField('statussimpan','1');  ?>


</div>

</table>

<?php
echo CHtml::endForm();
?>

