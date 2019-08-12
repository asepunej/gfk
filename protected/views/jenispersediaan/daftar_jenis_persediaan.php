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
        var url = '/index.php?r=Jenispersediaan/InsertJenisPersediaan';
        var form = $('<form action="' + url + '" method="POST">' +
            '</form>');
        $('body').append(form);
        $(form).submit();
    }

       function editdata(id_jenis_persediaan)
       {
           var url = '/index.php?r=Jenispersediaan/EditJenisPersediaan';
           var form = $('<form action="' + url + '" method="POST">' +
               '<input type="hidden" name="id_jenis_persediaan" value="' + id_jenis_persediaan + '" />' +

               '</form>');
           $('body').append(form);
           $(form).submit();
       }



    function deletedata(id_jenis_persediaan,jenis_persediaan)
    {
        theConfirm = "Anda yakin ingin menghapus data ";
        theConfirm += jenis_persediaan + "?";
        var go = confirm(theConfirm);
        if (go == true) {
            var url = '/index.php?r=Jenispersediaan/DaftarJenisPersediaan';
            var form = $('<form action="' + url + '" method="POST">' +
                '<input type="hidden" name="action" value="statusdelete" />' +
                '<input type="hidden" name="id_jenis_persediaan" value="' + id_jenis_persediaan + '" />' +
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
echo "test tahun".Yii::app()->session['tahun'];
?>

<div class="panel-heading">
    <i class="fa fa-external-link-square"></i>
    <b>DAFTAR JENIS PERSEDIAAN </b>
</div>

<br>


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
            <th align='center' width=700>Jenis Persediaan</th>
            <th align='center' width=50>Aksi </th>

        </tr>
        </thead>
        <tbody>
        <?php $number = 1; ?>
        <?php foreach($dataProvider as $value): ?>
        <tr height="30" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
            <td valign="top" align="center"><?php echo $number++?>.</td>
            <td valign="top"><?php echo $value["jenis_persediaan"]?></td>
            <td valign="top" align="center">
                <?php echo CHtml::image('/images/tbedit.png','',
                    array(
                        'title' => 'edit',
                        'style' => 'width:20px',
                        "onClick"=>"editdata('$value[id_jenis_persediaan]')"
                    ));?>

            <?php
                echo CHtml::image('/images/error.png','',
                    array(
                        'title' => 'hapus',
                        'style' => 'width:20px',
                        "onClick"=>"deletedata('$value[id_jenis_persediaan]','$value[jenis_persediaan]')"
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




