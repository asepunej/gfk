<STYLE>
<!--
  tr { }
  .initial { background-color: #FFFFFF; color:#000000 }
  .normal { background-color: #FFFFFF }
  .highlight { background-color: #DFFBED }
 //-->
</style>

<script type="text/javascript">


       function detaildata(id_barang)
       {
           var url = '/index.php?r=Rekap/DetailMutasiBarangBidang';
           var form = $('<form action="' + url + '" method="POST">' +
               '<input type="hidden" name="id_barang" value="' + id_barang + '" />' +
               '<input type="hidden" name="ddltahun" value="' + $('#ddltahun').val() + '" />' +
               '<input type="hidden" name="ddlskpd" value="' + $('#ddlskpd').val() + '" />' +
               '<input type="hidden" name="ddlbidang" value="' + $('#ddlbidang').val() + '" />' +

               '</form>');
           $('body').append(form);
           $(form).submit();
       }

       function cetakexcel()
       {
           var url = '/index.php?r=Rekap/CetakExcelMutasiBarangBidang';
           var form = $('<form action="' + url + '" method="POST" + target=_blank>' +
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
    <b>LAPORAN PENGELUARAN BARANG PER UNIT /BIDANG </b>
</div>

<br>
<table border=0 cellspacing=0 cellpadding=0 width=900>
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
            <?php
            if(Yii::app()->session['id_level_user']=='9'   )
            {
                echo CHtml::dropDownList('ddlskpd',$id_skpd,$ReferensiModel->getdaftarskpd()
                    , array('onChange'=>'this.form.submit();','style'=>'width: 400px;background-color: #F3FDF0'
                    ,'disabled'=>false,
                        'options'=>array($id_skpd=>array('selected'=>'selected'))));
            }
            else
            {
                echo CHtml::dropDownList('ddlskpd',$id_skpd,$ReferensiModel->getdaftarskpd()
                    , array('onChange'=>'this.form.submit();','style'=>'width: 400px;background-color: #F3FDF0'
                    ,'disabled'=>true,
                        'options'=>array($id_skpd=>array('selected'=>'selected'))));
            }
            ?>
        </td>
    </tr>
    <tr>
        <td valign="top" width=120><?php echo "Unit / Bidang"?></td>
        <td valign="top" width=20><?php echo ":"?></td>
        <td valign="top">
            <?php
            echo CHtml::dropDownList('ddlbidang',$id_bidang,$ReferensiModel->getdaftarbidang($id_skpd)
                , array('onChange'=>'this.form.submit();','style'=>'width: 300px;background-color: #F3FDF0'
                    , 'prompt'=>'Pilih '
                ,'disabled'=>false,
                    'options'=>array($id_bidang=>array('selected'=>'selected'))));
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

<table border=1  bordercolor=#96EBFD cellspacing=1 cellpadding=1 width=900>
    <thead>
    <tr rowspan="2" align="center" height='40px' bgcolor="#C4E9fA">
            <th align='center' width=50>NO</th>
            <th align='center' width=400>Barang / Obat</th>
            <th align='center' width=200>Satuan</th>
            <th align='center' width=200>Jumlah</th>
            <th align='center' width=50>Aksi </th>

        </tr>
        </thead>
        <tbody>
        <?php $number = 1; ?>
        <?php foreach($dataProvider as $value): ?>
        <tr height="30" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
            <td valign="top" align="center"><?php echo $number++?>.</td>
            <td valign="top"><?php echo $value["nama_barang"]?></td>
            <td valign="top"><?php echo $value["satuan"]?></td>
            <td valign="top" align="right"> <?php echo number_format( $value["volume"] , 0 , "" , '.' )?></td>
            <td valign="top" align="center">
                <?php echo CHtml::image('/images/kpi1.png','',
                    array(
                        'title' => 'Detail pengeluaran',
                        'style' => 'width:20px',
                        "onClick"=>"detaildata('$value[id_barang]')"
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




