<STYLE>
<!--
  tr { }
  .initial { background-color: #FFFFFF; color:#000000 }
  .normal { background-color: #FFFFFF }
  .highlight { background-color: #DFFBED }
 //-->
</style>

<script type="text/javascript">


    function pilihkegiatan(id_kegiatan)
    {

            var url = '/index.php?r=Pagu/InsertPagu';
            var form = $('<form action="' + url + '" method="POST">' +
                '<input type="hidden" name="id_kegiatan" value="' + id_kegiatan + '" />' +
                '<input type="hidden" name="tahun" value="' + $('#tahun').val() + '" />' +
                '<input type="hidden" name="idunitkerja" value="' + $('#idunitkerja').val() + '" />' +
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
            'title'=>'PILIH PAGU MAK',
            'height'=>'auto',
            'width'=>'550px',
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

<table border=1 bordercolor=#96EBFD cellspacing=1 cellpadding=1 width=900>
    <thead>
    <tr rowspan="2" align="center" height='40px' bgcolor="#C4E9fA">
            <th align='center' width=50>NO</th>
            <th align='center' width=150>KODE</th>
            <th align='center' width=550>URAIAN</th>
            <th align='center' width=50>AKSI </th>

        </tr>
        </thead>
        <tbody>
        <?php $number = 1; ?>
        <?php foreach($dataProvider as $value): ?>
        <tr height="30" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
            <td valign="top" align="center"><?php echo $number++?>.</td>
            <td valign="top"><font size="2"> <?php echo $value["kd_mak"]?> </font></td>
            <td valign="top"><font size="2"><?php echo $value["uraian"]?></font></td>

            <td valign="top" align="center">

            <?php
                echo CHtml::image('/images/eksekusi0.png','',
                    array(
                        'title' => 'pilih',
                        'style' => 'width:20px',
                        "onClick"=>"pilihkegiatan('$value[id_kegiatan]')"
                    ));?>
            </td>

        </tr>
        </tbody>
        <?php endforeach; ?>

    </table>
     </td></tr>
</table>

<?php echo CHtml::hiddenField('tahun',$tahun);  ?>
<?php echo CHtml::hiddenField('idunitkerja',$idunitkerja);  ?>
<?php
echo CHtml::endForm();
?>




