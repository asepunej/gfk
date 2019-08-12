<STYLE>
<!--
  tr { }
  .initial { background-color: #FFFFFF; color:#000000 }
  .normal { background-color: #FFFFFF }
  .highlight { background-color: #DFFBED }
 //-->
</style>

<script type="text/javascript">



       function insertpenerimaan()
       {
           var url = '/index.php?r=Penerimaan/InsertPenerimaan';
           var form = $('<form action="' + url + '" method="POST">' +
               '<input type="hidden" name="ddltahun" value="' + $('#ddltahun').val() + '" />' +
               '<input type="hidden" name="ddlskpd" value="' + $('#ddlskpd').val() + '" />' +
               '<input type="hidden" name="ddlbidang" value="' + $('#ddlbidang').val() + '" />' +
               '<input type="hidden" name="ddlbulan" value="' + $('#ddlbulan').val() + '" />' +
               '</form>');
           $('body').append(form);
           $(form).submit();
       }
       function editdata(id_penerimaan)
       {
           var url = '/index.php?r=Penerimaan/EditPenerimaan';
           var form = $('<form action="' + url + '" method="POST">' +
               '<input type="hidden" name="id_penerimaan" value="' + id_penerimaan + '" />' +
               '</form>');
           $('body').append(form);
           $(form).submit();
       }

       function detaildata(id_penerimaan)
       {
           var url = '/index.php?r=Penerimaandetail/DaftarPenerimaanDetail';
           var form = $('<form action="' + url + '" method="POST">' +
               '<input type="hidden" name="id_penerimaan" value="' + id_penerimaan + '" />' +
               '</form>');
           $('body').append(form);
           $(form).submit();
       }
    function deletedata(id_penerimaan,nomor_pembukuan)
    {
        theConfirm = "Anda yakin ingin menghapus data ";
        theConfirm += nomor_pembukuan + "?";
        var go = confirm(theConfirm);
        if (go == true) {
            var url = '/index.php?r=Penerimaan/DaftarPenerimaan';
            var form = $('<form action="' + url + '" method="POST">' +
                '<input type="hidden" name="action" value="statusdelete" />' +
                '<input type="hidden" name="id_penerimaan" value="' + id_penerimaan + '" />' +
                '<input type="hidden" name="ddltahun" value="' + $('#ddltahun').val() + '" />' +
                '<input type="hidden" name="ddlskpd" value="' + $('#ddlskpd').val() + '" />' +
                '<input type="hidden" name="ddlbidang" value="' + $('#ddlbidang').val() + '" />' +
                '<input type="hidden" name="ddlbulan" value="' + $('#ddlbulan').val() + '" />' +
                '</form>');
            $('body').append(form);
            $(form).submit();
        }

    }
       function cetakspby(id_pembukuan)
       {
           var url = '/index.php?r=Pembukuan/CetakKuitansi';
           var form = $('<form action="' + url + '" method="POST" + target=_blank>' +
               '<input type="hidden" name="id_pembukuan" value="' + id_pembukuan + '" />' +
               '</form>');
           $('body').append(form);
           $(form).submit();
       }
       function UploadExcel()
       {
           var url = '/index.php?r=Penerimaan/UploadExcel';
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
    <b>TRANSAKSI PENERIMAAN </b>
</div>
<br>
<table border=0 cellspacing=0 cellpadding=0 width=1000>
    <tr>
        <td valign="top" width=120><?php echo "Tahun ";?></td>
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
        <td valign="top" width=120><?php echo "Bulan"?></td>
        <td valign="top" width=20><?php echo ":"?></td>
        <td valign="top">
            <?php  echo CHtml::dropDownList('ddlbulan',$kdbulan,$ReferensiModel->getdaftarbulan()
                , array('onChange'=>'this.form.submit();','style'=>'width: 120px;background-color: #F3FDF0'
                ,'disabled'=>false,
                    'options'=>array($kdbulan=>array('selected'=>'selected'))));
            ?>
        </td>
    </tr>

</table>


<table border=0 cellspacing=0 cellpadding=0 width=1000>

    <tr><td align='right' width=1000>

<!--            --><?php //echo CHtml::button(' Upload Excel ',
//                array(
//                    'title' => 'Upload Excel',
//                    'style' => 'width:100px',
//                    "onClick"=>"UploadExcel()"
//                ));  ?>


            <b>Data Baru</b>
            <?php
            echo CHtml::image('/images/plus2.png','',
                array('height'=>'18px',
                    'title' => 'Data Baru',
                    'style' => 'width:20px',
                    "onClick"=>"insertpenerimaan()"
                )
            );

            ?>

        </td>
    </tr>
</table>




<table border=1  bordercolor=#96EBFD cellspacing=1 cellpadding=1 width=1000>
    <thead>
    <tr rowspan="2" align="center" height='40px' bgcolor="#C4E9fA">
        <th align='center' width=50>No</th>
        <th align='center' width=100>Tgl Terima</th>
        <th align='center' width=100>No Faktur</th>
        <th align='center' width=100>Tgl Faktur</th>
        <th align='center' width=250>Asal Barang</th>
        <th align='center' width=100>Sumberdana</th>
        <th align='center' width=50>Item</th>
        <th align='center' width=100>Aksi </th>

    </tr>
    </thead>
    <tbody>
    <?php $number = 1; ?>
    <?php foreach($dataProvider as $value): ?>
    <?php

    if  (date('m', strtotime($value["tgl_penerimaan"]))==$kdbulan){ ?>

        <?php
        if($value["id_distributor"]==4){
            echo "<tr height=30 bgcolor=#adff2f> ";  // Mewarnai Baris Kegiatan

        }else  {

            echo "<tr height=30 onMouseOver=this.className='highlight' onMouseOut=this.className='normal' bgcolor=white> "; }
        ?>


        <td valign="top" align="center"><?php echo $number++?>.</td>
        <td valign="top" align="center"><?php echo $value["tgl_penerimaan"]?></td>
        <td valign="top"><?php echo $value["no_faktur"]?></td>
        <td valign="top" align="center"><?php echo $value["tgl_faktur"]?></td>
        <td valign="top"><?php echo $value["diserahkan"]?></td>
        <td valign="top"><?php echo $value["nm_sumber_dana"]?></td>
        <td valign="top"  align="center"><?php echo $value["jml_item"]?></td>

        <td valign="top" align="center">

        <?php  if ($value["id_distributor"]!=44444444444){?>

            <?php echo CHtml::image('/images/kpi1.png','',
                array(
                    'title' => 'Detail Penerimaan',
                    'style' => 'width:20px',
                    "onClick"=>"detaildata('$value[id_penerimaan]')"
                ));?>
            <?php echo CHtml::image('/images/tbedit.png','',
                array(
                    'title' => 'Edit Penerimaan',
                    'style' => 'width:20px',
                    "onClick"=>"editdata('$value[id_penerimaan]')"
                ));?>

            <?php
//            if (Yii::app()->session['id_level_user']==9){
            echo CHtml::image('/images/error.png','',
                array(
                    'title' => 'Hapus Penerimaan',
                    'style' => 'width:20px',
                    "onClick"=>"deletedata('$value[id_penerimaan]','$value[no_faktur]')"
                ));
//            }
            ?>


        <?php  } ?>
        </td>

    </tr>
    <?php }?>
    </tbody>
    <?php endforeach; ?>

</table>
</td></tr>
</table>
<?php
echo CHtml::endForm();
?>




