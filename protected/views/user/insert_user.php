
<script type="text/javascript">

        function Kembali(){
            var url = '/index.php?r=User/DaftarUser';
            var ddllevel = $('#ddllevel').val();
            var form = $('<form action="' + url + '" method="POST">' +
                '<input type="hidden" name="ddllevel" value="' + ddllevel + '" />' +
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
            'title'=>'Pilih User',
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
    <b>MANAJEMEN USER - INSERT</b>
</div>
<br>

<div align="center">
        <table >

            <tr>
                <td valign="top" width=120><?php echo "Username"?></td>
                <td valign="top" width=20><?php echo ":"?></td>
                <td valign="top"><?php echo CHtml::textField('txtusername', $username,
                        array('id'=>'txtusername',
                            'width'=>'250px',
                            'maxlength'=>250,
                            'required'=>true,
                            // 'disabled'=>true,
                            'style'=>'width: 250px'));;?></td>
            </tr>

            <tr>
                <td valign="top" width=120><?php echo "Password"?></td>
                <td valign="top" width=20><?php echo ":"?></td>
                <td valign="top"><?php echo CHtml::passwordField('txtpassword', $password,
                        array('id'=>'txtpassword',
                            'width'=>'250px',
                            'maxlength'=>250,
                            'required'=>true,
                            // 'disabled'=>true,
                            'style'=>'width: 250px'));;?></td>
            </tr>

            <tr>
                <td valign="top" width=120><?php echo "Nama"?></td>
                <td valign="top" width=20><?php echo ":"?></td>
                <td valign="top"><?php echo CHtml::textField('txtnama', $nama_lengkap,
                        array('id'=>'txtnama',
                            'width'=>'500px',
                            'maxlength'=>500,
                            'required'=>true,
                            'style'=>'width: 500px'));;?></td>
            </tr>
            <tr>
                <td valign="top" width=120><?php echo "NIP"?></td>
                <td valign="top" width=20><?php echo ":"?></td>
                <td valign="top"><?php echo CHtml::textField('txtnip', $nip,
                        array('id'=>'txtnip',
                            'width'=>'500px',
                            'maxlength'=>500,
                            'required'=>true,
                            'style'=>'width: 500px'));;?></td>
            </tr>
            <tr>
                <td valign="top" width=120><?php echo "Jabatan"?></td>
                <td valign="top" width=20><?php echo ":"?></td>
                <td valign="top"><?php echo CHtml::textField('txtjabatan', $jabatan,
                        array('id'=>'txtjabatan',
                            'width'=>'500px',
                            'maxlength'=>500,
                            'required'=>true,
                            'style'=>'width: 500px'));;?></td>
            </tr>
            <tr>
                <td valign="top" width=120><?php echo "ID Unit Kerja"?></td>
                <td valign="top" width=20><?php echo ":"?></td>
                <td valign="top">  <?php  echo CHtml::dropDownList('ddlunitkerja',$id_unitkerja,$ReferensiModel->getdaftarunitkerja()
                        , array('style'=>'width: 265px;background-color: #F3FDF0'
                        ,'disabled'=>false));
                    ?>
                </td>
            </tr>
            <tr>
                <td valign="top" width=120><?php echo "Level"?></td>
                <td valign="top" width=20><?php echo ":"?></td>
                <td valign="top"><?php echo CHtml::dropDownList('ddllevel',$id_level_user,$ReferensiModel->getdaftarlevel()
                        , array('style'=>'width: 265px;background-color: #F3FDF0','disabled'=>false)) ;?></td>

            </tr>
            <tr>
                <td valign="top" width=120><?php echo "Beban Anggaran"?></td>
                <td valign="top" width=20><?php echo ":"?></td>
                <td valign="top">  <?php  echo CHtml::dropDownList('ddlbebananggaran',$id_beban_anggaran,$ReferensiModel->getdaftarbebananggaran()
                        , array('style'=>'width: 265px;background-color: #F3FDF0'
                        ,'disabled'=>false));
                    ?>
                </td>


        <tr>
            <td valign="top" width=120></td>
            <td valign="top" width=20></td>
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

    <?php echo CHtml::hiddenField('id_user',$id_user);  ?>	

	
    <?php echo CHtml::hiddenField('statussimpan','1');  ?>


</div>
<?php
echo CHtml::endForm();
?>

