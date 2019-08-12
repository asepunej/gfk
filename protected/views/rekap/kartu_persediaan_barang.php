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


    function Kembali(){
        var url = '/index.php?r=Rekap/RekapMutasiBarang';
        var form = $('<form action="' + url + '" method="POST">' +
            '<input type="hidden" name="ddltahun" value="' + $('#ddltahun').val() + '" />' +
            '<input type="hidden" name="ddlskpd" value="' + $('#ddlskpd').val() + '" />' +

            '<input type="hidden" name="txttgl_mulai" value="' + $('#txttgl_mulai').val() + '" />' +
            '<input type="hidden" name="txttgl_akhir" value="' + $('#txttgl_akhir').val() + '" />' +
            '<input type="hidden" name="ddlsumberdana" value="' + $('#ddlsumberdana').val() + '" />' +

            '</form>');
        $('body').append(form);
        $(form).submit();
    }

    function cetakexcel()
    {
        var url = '/index.php?r=Rekap/KartuPersediaanBarang';
        var form = $('<form action="' + url + '" method="POST" + target=_blank>' +
            '<input type="hidden" name="action" value="excel" />' +
            '<input type="hidden" name="ddltahun" value="' + $('#ddltahun').val() + '" />' +
            '<input type="hidden" name="ddlskpd" value="' + $('#ddlskpd').val() + '" />' +

            '<input type="hidden" name="txttgl_mulai" value="' + $('#txttgl_mulai').val() + '" />' +
            '<input type="hidden" name="txttgl_akhir" value="' + $('#txttgl_akhir').val() + '" />' +
            '<input type="hidden" name="id_barang" value="' + $('#id_barang').val() + '" />' +

            '</form>');
        $('body').append(form);
        $(form).submit();
    }

    function cetakpdf()
    {
        var url = '/index.php?r=Rekap/KartuPersediaanBarang';
        var form = $('<form action="' + url + '" method="POST" + target=_blank>' +
            '<input type="hidden" name="action" value="pdf" />' +
            '<input type="hidden" name="ddltahun" value="' + $('#ddltahun').val() + '" />' +
            '<input type="hidden" name="ddlskpd" value="' + $('#ddlskpd').val() + '" />' +

            '<input type="hidden" name="txttgl_mulai" value="' + $('#txttgl_mulai').val() + '" />' +
            '<input type="hidden" name="txttgl_akhir" value="' + $('#txttgl_akhir').val() + '" />' +
            '<input type="hidden" name="id_barang" value="' + $('#id_barang').val() + '" />' +

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
    <b>KARTU BARANG</b>
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

            <?php
            if(Yii::app()->session['id_level_user']=='9'   )
            {
                echo CHtml::dropDownList('ddlskpd',$id_skpd,$ReferensiModel->getdaftarskpdunit(Yii::app()->session['id_skpd'])
                    , array('onChange'=>'this.form.submit();','style'=>'width: 400px;background-color: #F3FDF0'
                    , 'prompt'=>'Semua'
                    ,'disabled'=>FALSE,
                        'options'=>array($id_skpd=>array('selected'=>'selected'))));
            }
            else
            {
                echo CHtml::dropDownList('ddlskpd',$id_skpd,$ReferensiModel->getdaftarskpdunit(Yii::app()->session['id_skpd'])
                    , array('onChange'=>'this.form.submit();','style'=>'width: 400px;background-color: #F3FDF0'
                    , 'prompt'=>'Semua'
                    ,'disabled'=>FALSE,
                        'options'=>array($id_skpd=>array('selected'=>'selected'))));
            }
            ?>


        </td>
    </tr>
    <tr>
        <td valign="top" width=120><?php echo "Nama Barang"?></td>
        <td valign="top" width=20><?php echo ":"?></td>
        <td valign="top">
            <?php echo CHtml::textField('txtnama_barang',' ['.sprintf('%04d',$id_barang).'] '.  $nama_barang.'  ['.$satuan.']',
                array( 'style'=>'width: 400px','disabled'=>true,));;?>
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


        </td>
    </tr>
    <tr>
        <td valign="top" width=120><?php echo "Sumber Dana"?></td>
        <td valign="top" width=20><?php echo ":"?></td>
        <td valign="top">
            <?php  echo CHtml::dropDownList('ddlsumberdana',$id_sumber_dana,$ReferensiModel->getdaftarsumberdana()
                , array('onChange'=>'this.form.submit();','style'=>'width: 100px;background-color: #F3FDF0'
               , 'prompt'=>'Semua'
                ,'disabled'=>false,
                    'options'=>array($id_sumber_dana=>array('selected'=>'selected'))));
            ?>

<!--            --><?php //echo CHtml::button('Cetak Kartu',
//                array(
//                    'title' => 'Cetak Kartu',
//                    'style' => 'width:100px',
//                    "onClick"=>"cetakpdf()"
//                ));  ?>

            <?php
             echo CHtml::button('Export Excel',
                array(
                    'title' => 'Export Excel',
                    'style' => 'width:100px',
                    "onClick"=>"cetakexcel()"
                ));  ?>

            <?php echo CHtml::button(' Kembali ',
                array(
                    'title' => 'Kembali',
                    'style' => 'width:100px',
                    "onClick"=>"Kembali()"
                ));  ?>
        </td>
    </tr>
</table>

<table border=1  bordercolor=#96EBFD cellspacing=1 cellpadding=1 width=1000>
    <thead>
    <tr rowspan="2" align="center" height='40px' bgcolor="#C4E9fA">
        <th align='center' width=80>Tanggal</th>
        <th align='center' width=200>Uraian</th>
        <th align='center' width=250>Keterangan</th>
        <th align='center' width=75>Masuk</th>
        <th align='center' width=75>Keluar</th>
        <th align='center' width=75>Sisa</th>
        <th align='center' width=100>Harga Satuan</th>
        <th align='center' width=100>Bertambah</th>
        <th align='center' width=100>Berkurang </th>
        <th align='center' width=100>Sisa</th>

    </tr>
    </thead>
    <tbody>
    <?php $number = 1; $saldo_stok = 0;  $saldo_nilai = 0; $baru=0;
    $sum_masuk = 0; $sum_keluar = 0;
    $sum_masuk_rp = 0; $sum_keluar_rp = 0;


    ?>


    <?php foreach($dataProvider as $value):

//    if (substr($value["no_faktur"],0,5)=='saldo') {
//        $sum_masuk=$sum_masuk+0;
//        $sum_masuk_rp=$sum_masuk_rp+0;
//    }
//    else{

        $sum_masuk=$sum_masuk+$value["masuk"];
        $sum_masuk_rp=$sum_masuk_rp+$value["nominal_bertambah"];
//    }

    $sum_keluar=$sum_keluar+$value["keluar"];
    $sum_keluar_rp=$sum_keluar_rp+$value["nominal_berkurang"];

    $saldo_stok = ($saldo_stok+$value["masuk"])-$value["keluar"];
    $saldo_nilai = ($saldo_nilai+$value["nominal_bertambah"])-$value["nominal_berkurang"];?>



<?php
    if(strtotime($value["tgl_penerimaan"])<=strtotime($tgl_akhir)) {
?>

        <?php

        if((strpos($value["uraian"],'penerimaan')!==false) or (strpos($value["uraian"],'saldo')!==false)){
            echo "<tr height=30 bgcolor=#ffd700> ";  // Mewarnai Baris Kegiatan
         }else  {

            echo "<tr height=30 onMouseOver=this.className='highlight' onMouseOut=this.className='normal' bgcolor=white> "; }
        ?>

                    <td valign="top"><?php echo $value["tgl_penerimaan"]?></td>
                    <td valign="top" align="center"><?php echo $value["uraian"]?></td>
                    <td valign="top" align="left"><?php echo $value["no_faktur"]?></td>
<!--                    <td valign="top" align="right">--><?php //echo number_format( $value["masuk"] , 0 , "" , '.' )?><!--                                   -->
<!--                    </td>-->
                        <?php if (substr($value["no_faktur"],0,5)=='saldo') {?>
                        <td valign="top" align="right"> <?php echo number_format( 0 , 0 , "" , '.' )?></td>
                        <?php $xx=0; } else {?>
                        <td valign="top" align="right"> <?php echo number_format( $value["masuk"] , 0 , "" , '.' )?></td>
                        <?php $xx=0; };?>

                    <td valign="top" align="right"> <?php echo number_format( $value["keluar"] , 0 , "" , '.' )?></td>
                    <td valign="top" align="right"> <?php echo number_format( $saldo_stok , 0 , "" , '.' )?></td>

                    <td valign="top" align="right"> <?php echo number_format( $value["harga_satuan"] , 2 , "," , '.' )?></td>

                        <?php if (substr($value["no_faktur"],0,5)=='saldo') {?>
                        <td valign="top" align="right"> <?php echo number_format( 0 , 0 , "" , '.' )?></td>
                        <?php $xx=0; } else {?>
                        <td valign="top" align="right"> <?php echo number_format( $value["nominal_bertambah"] , 2 , "," , '.' )?></td>
                        <?php $xx=0; };?>

                     <td valign="top" align="right"> <?php echo number_format( $value["nominal_berkurang"] , 2 , "," , '.' )?></td>
                     <td valign="top" align="right">
                         <?php echo   number_format( $saldo_nilai , 2 , ',' , '.' );
                         ?>

                     </td>
                </tr>
    <?php } ?>

    </tbody>
    <?php endforeach; ?>


    <tr rowspan="2" align="center" height='40px' bgcolor="#C4E9fA">
        <th align='center' width=80></th>
        <th align='center' width=200></th>
        <th align='center' width=250>TOTAL</th>
        <th align='right' width=75><?php echo number_format($sum_masuk, 0 , "" , '.' )?></th>
        <th align='right' width=75><?php echo number_format($sum_keluar , 0 , "" , '.' )?></th>

        <th align='right' width=75><?php echo number_format( $saldo_stok , 0 , "" , '.' )?></th>
        <th align='right' width=100></th>
        <th align='right' width=100><?php echo number_format( $sum_masuk_rp , 2 , ',' , '.' )?></th>
        <th align='right' width=100><?php echo number_format($sum_keluar_rp , 2 , ',' , '.' )?></th>
<!--        <th align='right' width=100>--><?php //echo number_format(round( $value["$sum_masuk_rp"],0) , 0 , ',' , '.' )?><!--</th>-->
<!--        <th align='right' width=100>--><?php //echo number_format(round( $value["$sum_keluar_rp"],0) , 0 , ',' , '.' )?><!--</th>-->
<!--        <th align='right' width=100></th>-->
<!--        <th align='right' width=100></th>-->
        <th align='right' width=100><?php echo   number_format( $saldo_nilai , 2 , ',' , '.' );?></th>

    </tr>
</table>

<?php echo CHtml::hiddenField('id_barang',$id_barang);  ?>
<?php echo CHtml::hiddenField('ddltahun',$tahun);  ?>


<?php
echo CHtml::endForm();
?>




