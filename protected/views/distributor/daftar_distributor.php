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
        var url = '/index.php?r=Distributor/InsertDistributor';
        var form = $('<form action="' + url + '" method="POST">' +
            '</form>');
        $('body').append(form);
        $(form).submit();
    }

       function editdata(id_distributor)
       {
           var url = '/index.php?r=Distributor/EditDistributor';
           var form = $('<form action="' + url + '" method="POST">' +
               '<input type="hidden" name="id_distributor" value="' + id_distributor + '" />' +

               '</form>');
           $('body').append(form);
           $(form).submit();
       }



    function deletedata(id_distributor,distributor)
    {
        theConfirm = "Anda yakin ingin menghapus data ";
        theConfirm += distributor + "?";
        var go = confirm(theConfirm);
        if (go == true) {
            var url = '/index.php?r=Distributor/DaftarDistributor';
            var form = $('<form action="' + url + '" method="POST">' +
                '<input type="hidden" name="action" value="statusdelete" />' +
                '<input type="hidden" name="id_distributor" value="' + id_distributor + '" />' +
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
?>

<div class="panel-heading">
    <i class="fa fa-external-link-square"></i>
    <b>DAFTAR DISTRIBUTOR </b>
</div>

<br>


<table border=0 cellspacing=0 cellpadding=0 width=1000>
    <tr><td align='right' width1000>

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



<table border=1  bordercolor=#96EBFD cellspacing=1 cellpadding=1 width=1000>
    <thead>
    <tr rowspan="2" align="center" height='40px' bgcolor="#C4E9fA">
            <th align='center' width=50>NO</th>
            <th align='center' width=300>Distributor</th>
        <th align='center' width=200>Perusahaan</th>
        <th align='center' width=300>Alamat</th>
        <th align='center' width=100>No Telp</th>
            <th align='center' width=50>Aksi </th>

        </tr>
        </thead>
        <tbody>
        <?php $number = 1; ?>
        <?php foreach($dataProvider as $value): ?>
        <tr height="30" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
            <td valign="top" align="center"><?php echo $number++?>.</td>
            <td valign="top"><?php echo $value['distributor']?></td>
            <td valign="top"><?php echo $value["perusahaan"]?></td>
            <td valign="top"><?php echo $value["alamat"]?></td>
            <td valign="top"><?php echo $value["notelp"]?></td>


            <td valign="top" align="center">
                <?php echo CHtml::image('/images/tbedit.png','',
                    array(
                        'title' => 'edit',
                        'style' => 'width:20px',
                        "onClick"=>"editdata('$value[id_distributor]')"
                    ));?>

            <?php
                echo CHtml::image('/images/error.png','',
                    array(
                        'title' => 'hapus',
                        'style' => 'width:20px',
                        "onClick"=>"deletedata('$value[id_distributor]','$value[distributor]')"
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




