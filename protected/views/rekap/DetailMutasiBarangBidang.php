<STYLE>
<!--
  tr { }
  .initial { background-color: #FFFFFF; color:#000000 }
  .normal { background-color: #FFFFFF }
  .highlight { background-color: #DFFBED }
 //-->
</style>

<script type="text/javascript">




    function Kembali(){
        var url = '/index.php?r=Rekap/RekapMutasiBarangKegiatan';
        var form = $('<form action="' + url + '" method="POST">' +
            '<input type="hidden" name="ddltahun" value="' + $('#ddltahun').val() + '" />' +
            '<input type="hidden" name="ddlskpd" value="' + $('#ddlskpd').val() + '" />' +
            '<input type="hidden" name="ddlbidang" value="' + $('#ddlbidang').val() + '" />' +

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
            'title'=>'Pilih SPBY',
            'height'=>'400',
            'width'=>'900px',
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
    <b>REKAP MUTASI BARANG </b>
</div>
<br>
<table border=0 cellspacing=0 cellpadding=0 width=1000>
    <tr>
        <td valign="top" width=120><?php echo "Tahun"?></td>
        <td valign="top" width=20><?php echo ":"?></td>
        <td valign="top">
            <?php  echo CHtml::dropDownList('ddltahun',$tahun,$ReferensiModel->getdaftartahun()
            , array('onChange'=>'this.form.submit();','style'=>'width: 80px;background-color: #F3FDF0'
            ,'disabled'=>false,
                'options'=>array($tahun=>array('selected'=>'selected'))));
        ?>


        </td>
    </tr>

    <tr>
        <td valign="top" width=120><?php echo "SKPD"?></td>
        <td valign="top" width=20><?php echo ":"?></td>
        <td valign="top">
            <?php  echo CHtml::dropDownList('ddlskpd',$id_skpd,$ReferensiModel->getdaftarskpd()
                , array('onChange'=>'this.form.submit();','style'=>'width: 400px;background-color: #F3FDF0'
                ,'disabled'=>true,
                    'options'=>array($id_skpd=>array('selected'=>'selected'))));
            ?>
        </td>
    </tr>
    <tr>
        <td valign="top" width=120><?php echo "Bidang"?></td>
        <td valign="top" width=20><?php echo ":"?></td>
        <td valign="top">
            <?php
            echo CHtml::dropDownList('ddlbidang',$id_bidang,$ReferensiModel->getdaftarbidang($id_skpd)
                , array('onChange'=>'this.form.submit();','style'=>'width: 300px;background-color: #F3FDF0'
//                    , 'prompt'=>'Pilih'
                ,'disabled'=>true,
                    'options'=>array($id_bidang=>array('selected'=>'selected'))));

            ?>

        </td>
    </tr>

    <tr>
        <td valign="top" width=120><?php echo "Barang / Obat"?></td>
        <td valign="top" width=20><?php echo ""?>:</td>
        <td valign="top">
            <?php
                echo CHtml::textField('txtkegiatan', $barang,
                array( 'style'=>'width: 500px'
                ,'disabled'=>true));?>
        </td>
    </tr>
</table>




<table border=1  bordercolor=#96EBFD cellspacing=1 cellpadding=1 width=800>
    <thead>
    <tr rowspan="2" align="center" height='40px' bgcolor="#C4E9fA">
        <th align='center' width=50>No</th>
        <th align='center' width=200>Tanggal</th>
        <th align='center' width=20>No Permintaan</th>
        <th align='center' width=200>Penerima</th>
        <th align='center' width=150>Jumlah</th>



    </tr>
    </thead>
    <tbody>
    <?php $number = 1; ?>
    <?php foreach($dataProvider as $value): ?>
    <tr height="30" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
        <td valign="top" align="center"><?php echo $number++?>.</td>

        <td valign="top"><?php echo $value["tgl_pengeluaran"]?></td>
        <td valign="top" align="center"><?php echo $value["no_permintaan"]?></td>
        <td valign="top" align="center"><?php echo $value["diterima"]?></td>
        <td valign="top" align="right"> <?php echo number_format( $value["volume"] , 0 , "" , '.' )?></td>


    </tr>
    </tbody>
    <?php endforeach; ?>

</table>
</td></tr>
</table>


<table border=0 cellspacing=0 cellpadding=0 width=1000>
    <tr><td align='right' width=1000>
            <?php echo CHtml::button(' Kembali ',
                array(
                    'title' => 'Kembali',
                    'style' => 'width:100px',
                    "onClick"=>"Kembali()"
                ));  ?>
        </td>
    </tr>
</table>
<?php
echo CHtml::endForm();
?>




