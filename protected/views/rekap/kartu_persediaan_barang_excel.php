<?php
if ($action=='excel'){
    header("Content-Type: application/force-download");
    header("Cache-Control: no-cache, must-revalidate");
    header("content-disposition: attachment;filename=rekap_mutasi_barang".date('dmY').".xls");
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
        <td valign="top" width=120><?php echo "Nama Barang"?></td>
        <td valign="top" width=20><?php echo ":"?></td>
        <td valign="top">
            <?php echo CHtml::textField('txtnama_barang', $nama_barang.'  ['.$satuan.']',
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
                , array('style'=>'width: 100px;background-color: #F3FDF0'
                , 'prompt'=>'Semua'
                ,'disabled'=>true,
                    'options'=>array($id_sumber_dana=>array('selected'=>'selected'))));
            ?>

            <?php echo CHtml::button('Export Excel',
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
        <th align='center' width=100>Tanggal</th>
        <th align='center' width=150>Uraian</th>
        <th align='center' width=200>Keterangan</th>
        <th align='center' width=100>Masuk</th>
        <th align='center' width=100>Keluar</th>
        <th align='center' width=100>Sisa</th>
        <th align='center' width=100>Harga Satuan</th>
        <th align='center' width=100>Bertambah</th>
        <th align='center' width=100>Berkurang </th>
        <th align='center' width=100>Sisa</th>
    </tr>
    </thead>
    <tbody>
    <?php $number = 1; $saldo_stok = 0;  $saldo_nilai = 0; $baru=0;?>
    <?php foreach($dataProvider as $value):
    $saldo_stok = ($saldo_stok+$value["masuk"])-$value["keluar"];
    $saldo_nilai = ($saldo_nilai+$value["nominal_bertambah"])-$value["nominal_berkurang"];

//      if  (date('d/m/Y', $value["tgl_penerimaan"])>=date('d/m/Y', $tgl_mulai) &&
//           date('d/m/Y', $value["tgl_penerimaan"])<=date('d/m/Y', $tgl_akhir) &&
//          ($value["id_sumber_dana"]==$id_sumber_dana or $id_sumber_dana='')
//        ){
//            if ($baru==0) {          $baru=1;?>
<!---->
<!--                 <tr height="30" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">-->
<!--                     <td valign="top">--><?php //echo ''?><!--</td>-->
<!--                     <td valign="top" align="center">--><?php //echo 'Saldo Awal';?><!--</td>-->
<!--                     <td valign="top" align="left">--><?php //echo '';?><!--</td>-->
<!--                     <td valign="top" align="right"> --><?php //echo '';?><!--</td>-->
<!--                     <td valign="top" align="right"> --><?php //echo '';?><!--</td>-->
<!--                     <td valign="top" align="right"> --><?php //echo number_format( $saldo_stok , 0 , "" , '.' )?><!--</td>-->
<!--                     <td valign="top" align="center">--><?php //echo ''?><!--</td>-->
<!--                 </tr>-->
<!--            --><?php //}?>


                <tr height="30" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td valign="top"><?php echo $value["tgl_penerimaan"]?></td>
                    <td valign="top" align="center"><?php echo $value["uraian"]?></td>
                    <td valign="top" align="left"><?php echo $value["no_faktur"]?></td>
                    <td valign="top" align="right"> <?php echo  $value["masuk"] ?></td>
                    <td valign="top" align="right"> <?php echo $value["keluar"] ?></td>
                    <td valign="top" align="right"> <?php echo  $saldo_stok ?></td>

                    <td valign="top" align="right"> <?php echo number_format( $value["harga_satuan"] , 0 , "" , '.' )?></td>
                    <td valign="top" align="right"> <?php echo number_format( $value["nominal_bertambah"] , 0 , "" , '.' )?></td>
                    <td valign="top" align="right"> <?php echo number_format( $value["nominal_berkurang"] , 0 , "" , '.' )?></td>
                    <td valign="top" align="right"> <?php echo number_format( $saldo_nilai , 0 , "" , '.' )?></td>

                </tr>
<!--      --><?php //}?>

    </tbody>
    <?php endforeach; ?>

</table>
</td></tr>
</table>

<?php echo CHtml::hiddenField('id_barang',$id_barang);  ?>
<?php echo CHtml::hiddenField('ddltahun',$tahun);  ?>


<?php
echo CHtml::endForm();
?>




