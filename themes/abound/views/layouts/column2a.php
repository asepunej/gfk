<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/clipone'); ?>

    <div class="row-fluid">
        <div class="span3">
            <div class="sidebar-nav">

                <?php $this->widget('zii.widgets.CMenu', array(
                    /*'type'=>'list',*/
                    'encodeLabel'=>false,
                    'items'=>array(
//				array('label'=>'<i class="icon icon-home"></i>  INFORMASI RKAKL <span class="label label-info pull-right">2015</span>', 'url'=>array('/site/index'),'itemOptions'=>array('class'=>'')),
                        array('label'=>'<i class="icon icon-home"></i>  DINKES WEBSITE <span class="label label-info pull-right">2015</span>', 'url'=>'http://dinkes.bondowoso.go.id','linkOptions' => array('target'=>'_blank')),
                        array('label'=>'<i class="icon icon-search"></i> BERITA  <span class="label label-important pull-right">HOT</span>',  'url'=>'http://dinkes.bondowoso.go.id','linkOptions' => array('target'=>'_blank')),
                        array('label'=>'<i class="icon icon-envelope"></i> DOWNLOAD <span class="badge badge-success pull-right">5</span>','url'=>'#'),
                        // Include the operations menu
                        array('label'=>'OPERATIONS','items'=>$this->menu),
                    ),
                ));?>
            </div>
            <br>

            <table class="table table-striped table-bordered">
                <tbody>
                <tr>
                    <td width="50%"><a href="#">Panduan Aplikasi</a></td>

                    <td>
                        <div class="progress progress-danger">
                            <div class="bar" style="width: 90%"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="50%"><a href="files/PanduanRaker2014.docx">Stok Obat</a></td>

                    <td>
                        <div class="progress progress-info">
                            <div class="bar" style="width: 80%"></div>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td><a href="files/FormatTOR&RAB.pdf" target="_blank">Obat Expired</a></td>
                    <td>
                        <div class="progress progress-warning">
                            <div class="bar" style="width: 70%"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><a href="files/akun.pdf" target="_blank">Mutasi Obat</a></td>
                    <td>
                        <div class="progress progress-success">
                            <div class="bar" style="width: 60%"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><a href="files/PMK72-2013-SBMTA2014.pdf" target="_blank">Rekap Muutasi Obat</a></td>
                    <td>
                        <div class="progress progress-info">
                            <div class="bar" style="width: 50%"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><a href="files/SB_UNEJ.pdf" target="_blank">Laporan Puskesmas</a></td>
                    <td>
                        <div class="progress progress-warning">
                            <div class="bar" style="width: 40%"></div>
                        </div>
                    </td>
                </tr>

                </tbody>
            </table>

            <!--		<div class="well">-->
            <!---->
            <!--            <dl>-->
            <!--              <dt>Panduan Aplikasi</dt>-->
            <!--              <dd>tes</dd>-->
            <!--              <dt>Panduan RAK</dt>-->
            <!---->
            <!--              <dt>Format TOR</dt>-->
            <!---->
            <!--              <dt>Form RAB</dt>-->
            <!---->
            <!--              <dt>Jenis Belanja MAK</dt>-->
            <!---->
            <!--              <dt>Biaya Akun Standar</dt>-->
            <!---->
            <!--            </dl>-->
            <!--      </div>-->

        </div><!--/span-->
        <div class="span9">

            <?php if(isset($this->breadcrumbs)):?>
                <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links'=>$this->breadcrumbs,
                    'homeLink'=>CHtml::link('Dashboard'),
                    'htmlOptions'=>array('class'=>'breadcrumb')
                )); ?><!-- breadcrumbs -->
            <?php endif?>

            <!-- Include content pages -->
            <?php echo $content; ?>

        </div><!--/span-->
    </div><!--/row-->


<?php $this->endContent(); ?>