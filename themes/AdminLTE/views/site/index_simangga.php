<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
//$this->redirect('index.php?r=site/login');
$baseUrl = Yii::app()->theme->baseUrl;
?>

<div class="row-fluid">

    <div class="span9">


<?php
        $this->beginWidget('zii.widgets.CPortlet', array(
            'title'=>"<i class='icon-arrow-down'></i> SISTEM INFORMASI MANAJEMEN ANGGARAN 2014",
        ));

        ?>
        <div style="height: 337px;width:700px;margin-top:15px; margin-bottom:15px; margin-left:10px;margin-right:10px;background-image: url(images/rkakl2015.jpg);">

        </div>


        <?php $this->endWidget();?>
    </div>

<!--    <div class="row-fluid">-->
<!--        <div class="span6">-->
<!--            --><?php
//            $this->beginWidget('zii.widgets.CPortlet', array(
//                'title'=>"<i class='icon-tint'></i> SERAPAN ANGGARAN UNIT KERJA",
//            ));
//
//            ?>
<!--            <div class="simple-pie" style="height: 250px;width:100%;margin-top:15px; margin-bottom:15px;"></div>-->
<!--            --><?php //$this->endWidget();?>
        </div>

    <div class="row-fluid">
            <div class="span11">
                <marquee><font color="red" size="4">Untuk menghapus kegiatan yang telah dientri, harus dimulai dengan menghapus RAB terlebih dahulu</font></marquee>
             </div>
</div>
