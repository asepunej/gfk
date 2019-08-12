<?php
if ($action=='excel'){
    header("Content-Type: application/force-download");
    header("Cache-Control: no-cache, must-revalidate");
    header("content-disposition: attachment;filename=kartu_persediaan_barang".date('dmY').".xls");
}

?>
<STYLE>
<!--
  tr { }
  .initial { background-color: #FFFFFF; color:#000000 }
  .normal { background-color: #FFFFFF }
  .highlight { background-color: #DFFBED }
 //-->
</style>

<script type="text/javascript">

    function detailpengeluaran(id_barang)
    {
        var url = '/index.php?r=Pengeluaran/RekapPengeluarandetail';
        var form = $('<form action="' + url + '" method="POST" + target=_blank>' +
            '<input type="hidden" name="id_barang" value="' + id_barang + '" />' +
            '<input type="hidden" name="ddltahun" value="' + $('#ddltahun').val() + '" />' +
            '<input type="hidden" name="ddlskpd" value="' + $('#ddlskpd').val() + '" />' +
            '<input type="hidden" name="ddlskpdpenerima" value="' + $('#ddlskpdpenerima').val() + '" />' +
            '<input type="hidden" name="txttgl_mulai" value="' + $('#txttgl_mulai').val() + '" />' +
            '<input type="hidden" name="txttgl_akhir" value="' + $('#txttgl_akhir').val() + '" />' +

            '</form>');
        $('body').append(form);
        $(form).submit();
    }

    function cetakexcel()
    {
        var url = '/index.php?r=Pengeluaran/RekapPengeluaran';
        var form = $('<form action="' + url + '" method="POST">' +
            '<input type="hidden" name="action" value="excel" />' +
            '<input type="hidden" name="ddltahun" value="' + $('#ddltahun').val() + '" />' +
            '<input type="hidden" name="ddlskpd" value="' + $('#ddlskpd').val() + '" />' +
            '<input type="hidden" name="ddlskpdpenerima" value="' + $('#ddlskpdpenerima').val() + '" />' +
            '<input type="hidden" name="ddlstatus" value="' + $('#ddlstatus').val() + '" />' +
            '<input type="hidden" name="txttgl_mulai" value="' + $('#txttgl_mulai').val() + '" />' +
            '<input type="hidden" name="txttgl_akhir" value="' + $('#txttgl_akhir').val() + '" />' +

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
    <b>REKAP PENGELUARAN </b>
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
        <td valign="top" width=120><?php echo "Unit Kerja"?></td>
        <td valign="top" width=20><?php echo ":"?></td>
        <td valign="top">
            <?php
            if(Yii::app()->session['id_level_user']=='9'   )
            {
                echo CHtml::dropDownList('ddlskpd',$id_skpd,$ReferensiModel->getdaftarskpdunit(Yii::app()->session['id_skpd'])
                    , array('onChange'=>'this.form.submit();','style'=>'width: 400px;background-color: #F3FDF0'
                    ,'disabled'=>FALSE,
                        'options'=>array($id_skpd=>array('selected'=>'selected'))));
            }
            else
            {
                echo CHtml::dropDownList('ddlskpd',$id_skpd,$ReferensiModel->getdaftarskpdunit(Yii::app()->session['id_skpd'])
                    , array('onChange'=>'this.form.submit();','style'=>'width: 400px;background-color: #F3FDF0'
                    ,'disabled'=>FALSE,
                        'options'=>array($id_skpd=>array('selected'=>'selected'))));
            }
            ?>

        </td>
    </tr>
    <tr>
        <td valign="top" width=120><?php echo "Penerima"?></td>
        <td valign="top" width=20><?php echo ":"?></td>
        <td valign="top">
            <?php   echo CHtml::dropDownList('ddlskpdpenerima',$id_skpd_penerima,$ReferensiModel->getdaftarskpdunit($id_skpd)
                , array('onChange'=>'this.form.submit();','style'=>'width: 400px;background-color: #F3FDF0'
                ,'disabled'=>FALSE,
                    'options'=>array($id_skpd_penerima=>array('selected'=>'selected'))));
            ?>
        </td>
    </tr>

    <tr>
        <td valign="top" width=120><?php echo "Tanggal "?></td>
        <td valign="top" width=20><?php echo ":"?></td>
        <td valign="top">
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                'name'=>'txttgl_mulai',
                'value'=>Yii::app()->dateFormatter->format("dd MMMM yyy",$tgl_mulai),
                'options'=>array(
                    'showAnim'=>'fold',
                ),
                'htmlOptions'=>array(
                    'title' => 'tgl_mulai',
                    'style' => 'width:150px'
                ), ));
            ?>
            <?php echo " s/d "?>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                'name'=>'txttgl_akhir',
                'value'=>Yii::app()->dateFormatter->format("dd MMMM yyy",$tgl_akhir),
                'options'=>array(
                    'showAnim'=>'fold',
                ),
                'htmlOptions'=>array(
                    'title' => 'tgl_akhir',
                    'style' => 'width:150px'
                ), ));
            ?>

            <?php echo CHtml::submitButton('Proses',
                array(
                    'title' => 'Proses',
                    'style' => 'width:100px',
                ));

            echo "".$statussimpan
            ?>
        </td>
    </tr>


    <tr>
        <td valign="top" width=120><?php echo "Tampilkan Semua"?></td>
        <td valign="top" width=20><?php echo ":"?></td>
        <td valign="top">
            <?php  echo CHtml::dropDownList('ddlstatus',$id_status,$ReferensiModel->getdaftarstatus()
                , array('onChange'=>'this.form.submit();','style'=>'width: 80px;background-color: #F3FDF0'
                ,'disabled'=>false,
                  'options'=>array($id_status=>array('selected'=>'selected'))));
            ?>

            <?php echo CHtml::button('Export Excel',
                array(
                    'title' => 'Export Excel',
                    'style' => 'width:100px',
                    "onClick"=>"cetakexcel()"
                ));  ?>

        </td>
    </tr>

</table>

<table border=1  bordercolor=#96EBFD cellspacing=1 cellpadding=1 width=80%>
    <thead>
    <tr rowspan="2" align="center" height='40px' bgcolor="#C4E9fA">
<!--        <th align='center' width=10%>No</th>-->
        <th align='center' width=5%>Kode</th>
        <th align='center' width=40%>Nama Obat / Barang </th>
        <th align='center' width=10%>Satuan</th>
        <th align='center' width=10%>Jumlah </th>
        <th align='center' width=15%>Total </th>

    </tr>
    </thead>
    <tbody>
    <?php $number = 1;
    $sum_volume=0;
    $sum_total=0;
    ?>
    <?php foreach($dataProvider as $value):
    $sum_volume=$sum_volume+$value["volume"];
    $sum_total=$sum_total+$value["total"];
    ?>

    <tr height="30" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
<!--        <td valign="top" align="center">--><?php //echo $number++?><!--.</td>-->
        <td valign="top" align="center"><?php echo $value["id_barang"]?></td>
        <td valign="top"><?php echo $value["nama_barang"]?></td>
        <td valign="top" align='center'><?php echo $value["satuan"]?></td>

        <td valign="top" align="right">
            <?php
            echo CHtml::label('<u>'.number_format( $value["volume"].'</u>', 0 , "" , '.' ),'',
                array(
                    'title' => 'Detail',
//                  'style' => 'width:20px',
                    "onClick"=>"detailpengeluaran('$value[id_barang]')"
                ));
            ?>
        </td>
        <td valign="top" align='right'><?php echo number_format(round( $value["total"],2) , 2 , ',' , '.' )?></td>

    </tr>
    </tbody>
    <?php endforeach; ?>

    <tr rowspan="2" align="center" height='40px' bgcolor="#C4E9fA">
        <th align='center' ></th>
        <th align='center' >TOTAL</th>
        <th align='center' ></th>

        <th align='right' > <?php echo number_format($sum_volume, 0 , "" , '.' )?></th>
        <th align='right' ><?php echo number_format($sum_total,  2 , ',' , '.' )?></th>



    </tr>

</table>
</td></tr>
</table>




<?php
echo CHtml::endForm();
?>




