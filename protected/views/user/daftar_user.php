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
        var url = '/index.php?r=User/InsertUser';
        var form = $('<form action="' + url + '" method="POST">' +
            '<input type="hidden" name="id_level_user" value="' + $('#ddllevel').val() + '" />' +          
            '</form>');
        $('body').append(form);
        $(form).submit();
    }

       function editdata(id_user)
       {
           var url = '/index.php?r=User/EditUser';
           var form = $('<form action="' + url + '" method="POST">' +
               '<input type="hidden" name="id_user" value="' + id_user + '" />' +
			   '</form>');
           $('body').append(form);
           $(form).submit();
       }

    function deletedata(id_user)
    {
        theConfirm = "Anda yakin ingin menghapus data ";
        var go = confirm(theConfirm);
        if (go == true) {
            var url = '/index.php?r=User/DaftarUser';
            var form = $('<form action="' + url + '" method="POST">' +
                '<input type="hidden" name="action" value="statusdelete" />' +
                '<input type="hidden" name="id_user" value="' + id_user + '" />' +
				 '<input type="hidden" name="id_level_user" value="' + $('#ddllevel').val() + '" />' +      
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
            'title'=>'Pilih User',
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
    <b>Manajemen User</b>
</div>
<br>
<table align=center border=0 cellspacing=0 cellpadding=0 width=800>
 <tr>
      <td valign="top" width=120><?php echo "Pilih Level"?></td>
        <td valign="top" width=20><?php echo ":"?></td>
       <td valign="top">
           <?php echo CHtml::dropDownList('ddllevel',$id_level_user,$ReferensiModel->getdaftarlevel()
               , array('onChange'=>'this.form.submit();','style'=>'width: 200px;background-color: #F3FDF0'
               ,'disabled'=>false,
                   'options'=>array(Yii::app()->session['id_level_user']=>array('selected'=>'selected'))));
           ?>
        </td>
   </tr>
</table>


<table align=center border=0 cellspacing=0 cellpadding=0 width=900>
    <tr><td align='right' width=900>
        </td>
        <td align='right' width=900>
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

<table border=1 align=center bordercolor=#96EBFD cellspacing=1 cellpadding=1 width=900>
    <thead>
    <tr rowspan="2" align="center" height='40px' bgcolor="#C4E9fA">
            <th align='center' width=50>NO</th>
            <th align='center' width=150>Username</th>
            <th align='center' width=200>Nama Lengkap</th>
            <th align='center' width=150>Jabatan</th>
            <th align='center' width=100>Level</th>
            <th align='center' width=150>Beban Anggaran</th>
            <th align='center' width=100>AKSI </th>

        </tr>
        </thead>
        <tbody>
        <?php $number = 1; ?>
        <?php foreach($dataProvider as $value): ?>
        <tr height="30" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
            <td valign="top" align="center"><?php echo $number++?>.</td>
            <td valign="top"><?php echo $value["username"]?></td>
            <td valign="top"><?php echo $value["nama_lengkap"]?></td>
            <td valign="top"><?php echo $value["jabatan"]?></td>
            <td valign="top"><?php echo $value["level_user"]?></td>
            <td valign="top"><?php echo $value["beban_anggaran"]?></td>
            <td valign="top" align="center">
                <?php echo CHtml::image('/images/tbedit.png','',
                    array(
                        'title' => 'edit',
                        'style' => 'width:20px',
                        "onClick"=>"editdata('$value[id_user]')"
                    ));?>

            <?php
                echo CHtml::image('/images/error.png','',
                    array(
                        'title' => 'hapus',
                        'style' => 'width:20px',
                        "onClick"=>"deletedata('$value[id_user]')"
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




