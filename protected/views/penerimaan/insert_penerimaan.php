
<script type="text/javascript">


        function Kembali(){
            var url = '/index.php?r=Penerimaan/DaftarPenerimaan';
            var form = $('<form action="' + url + '" method="POST">' +
                '<input type="hidden" name="ddltahun" value="' + $('#ddltahun').val() + '" />' +
                '<input type="hidden" name="ddlskpd" value="' + $('#ddlskpd').val() + '" />' +
                '<input type="hidden" name="ddlbidang" value="' + $('#ddlbidang').val() + '" />' +
                '<input type="hidden" name="ddlbulan" value="' + $('#ddlbulan').val() + '" />' +

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
    <b>INSERT PENERIMAAN</b>
</div>
<br>

<div align="left">
    <table >
        <tr>
            <td valign="top" width=120><?php echo "Unit Kerja"?></td>
            <td valign="top" width=20><?php echo ":"?></td>
            <td valign="top">
                <?php
                    echo CHtml::dropDownList('ddlskpd',$id_skpd,$ReferensiModel->getdaftarskpdunit(Yii::app()->session['id_skpd'])
                        , array('onChange'=>'this.form.submit();','style'=>'width: 400px;background-color: #F3FDF0'
                        ,'disabled'=>true,
                            'options'=>array($id_skpd=>array('selected'=>'selected'))));
                ?>



            </td>
        </tr>
        <tr>
            <td valign="top" width=120><?php echo "Tgl Penerimaan"?></td>
            <td valign="top" width=20><?php echo ""?>:</td>
            <td valign="top">  <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                    'name'=>'txttgl_penerimaan',
                    'value'=>Yii::app()->dateFormatter->format("dd MMMM yyy",$tgl_penerimaan),
                    'options'=>array(
                        'showAnim'=>'fold',
                    ),
                    'htmlOptions'=>array(
                        'title' => 'tanggal',
                        'style' => 'width:150px'
                    ), ));
                ?>

            </td>
        </tr>
        <tr>
            <td valign="top" width=120><?php echo "No Faktur"?></td>
            <td valign="top" width=20><?php echo ""?>:</td>
            <td valign="top">
                <?php echo CHtml::textField('txtno_faktur', $no_faktur,
                    array( 'style'=>'width: 150px'));;?>
            </td>
        </tr>

        <tr>
            <td valign="top" width=120><?php echo "Tgl Faktur"?></td>
            <td valign="top" width=20><?php echo ""?>:</td>
            <td valign="top">  <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                    'name'=>'txttgl_faktur',
                    'value'=>Yii::app()->dateFormatter->format("dd MMMM yyy",$tgl_faktur),
                    'options'=>array(
                        'showAnim'=>'fold',
                    ),
                    'htmlOptions'=>array(
                        'title' => 'tgl_faktur',
                        'style' => 'width:150px'
                    ), ));
                ?>

            </td>
        </tr>

        <tr>
            <td valign="top" width=120><?php echo "Diserahkan Oleh"?></td>
            <td valign="top" width=20><?php echo ""?>:</td>
            <td valign="top">
                <?php echo CHtml::textField('txtdiserahkan', $diserahkan,
                    array( 'style'=>'width: 500px'));;?>
            </td>
        </tr>
        <tr>
            <td valign="top" width=120><?php echo "Direima Oleh"?></td>
            <td valign="top" width=20><?php echo ""?>:</td>
            <td valign="top">
                <?php echo CHtml::textField('txtditerima', $diterima,
                    array( 'style'=>'width: 500px'));;?>
            </td>
        </tr>
        <tr>
            <td valign="top" width=120><?php echo "Distributor"?></td>
            <td valign="top" width=20><?php echo ":"?></td>
            <td valign="top">
                <?php  echo CHtml::dropDownList('ddldistributor',$id_distributor,$ReferensiModel->getdaftardistributor()
                    , array('style'=>'width: 500px;background-color: #F3FDF0'
                    ,'disabled'=>false,
                        'options'=>array($id_distributor=>array('selected'=>'selected'))));
                ?>
            </td>
        </tr>


        <tr>
            <td valign="top" width=120><?php echo "Sumber Dana"?></td>
            <td valign="top" width=20><?php echo ":"?></td>
            <td valign="top">
                <?php  echo CHtml::dropDownList('ddlsumberdana',$id_m_sumber_dana,$ReferensiModel->getdaftarsumberdana()
                    , array('style'=>'width: 500px;background-color: #F3FDF0'
                    , 'prompt'=>'Pilih'
                    ,'disabled'=>false,
                        'options'=>array($id_m_sumber_dana=>array('selected'=>'selected'))));
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

    <?php echo CHtml::hiddenField('ddltahun',$tahun);  ?>
    <?php echo CHtml::hiddenField('ddlskpd',$id_skpd);  ?>
    <?php echo CHtml::hiddenField('ddlbidang',$id_bidang);  ?>
    <?php echo CHtml::hiddenField('id_penerimaan',$id_penerimaan);  ?>
    <?php echo CHtml::hiddenField('ddlbulan',$kdbulan);  ?>

    <?php echo CHtml::hiddenField('statussimpan','1');  ?>


</div>

</table>

<?php
echo CHtml::endForm();
?>

