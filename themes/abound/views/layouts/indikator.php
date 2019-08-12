<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

    <div class="row-fluid">
        <div class="span3">
            <div class="sidebar-nav">

                <?php

                $sample_text = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.';
                ?>

                <div class="span12">

                    <?php
                    $this->beginWidget('zii.widgets.CPortlet', array(
                        'title'=>"KETERANGAN",
                    ));

                    ?>
                    <table class="table table-striped table-bordered" bgcolor="#7fffd4">
                        <tbody>

                        <tr>
                            <td>
                                <!--
                                <div class="progress progress-success">-->
                                <img src="images/hijau.jpg">
                                <div class="bar" style="width: 100%"></div>
                </div>
                <td width="50%"><a href="#">DISETUJUI</a></td>


                </td>
                </tr>

                <tr>
                    <td>
                        <img src="images/kuning.jpg">
                        <!--                            <div class="progress progress-warning">-->
                        <div class="bar" style="width: 100%"></div>
            </div>
            </td>
            <td><a href="#">DIPERBAIKI</a></td>

            </tr>
            <tr>
                <td>
                    <img src="images/putih.jpg">
                    <!--                            <div class="progress progress-info">-->
                    <div class="bar" style="width: 100%"></div>
        </div>
        </td>
        <td><a href="#">BELUM DIREVIEW</a></td>

        </tr>
        <tr>

            <td>
                <img src="images/merah.jpg">
                <!--                            <div class="progress progress-danger">-->
                <div class="bar" style="width: 100%"></div>
    </div>
    </td>
    <td width="50%"><a href="#">DITOLAK</a></td>


    </tr>

    </tbody>
    </table>
    </div>
    </div>
    <div class="span12">
        <?php
        $this->beginWidget('zii.widgets.CPortlet', array(
            'title'=>"CHATTING",
        ));

        ?>

        <div id='chat'></div>
        <?php

        $nama=Yii::app()->session['nama'];
        //                    echo "Nama=".$nama;

        $this->widget('YiiChatWidget',array(
            'chat_id'=>'123',                   // a chat identificator
            'identity'=>$nama,                  // the user, Yii::app()->user->id ?
            'selector'=>'#chat',                // were it will be inserted
            'minPostLen'=>2,                    // min and
            'maxPostLen'=>500,                   // max string size for post
            //'model'=>new MyYiiChatHandler(),    // the class handler. **** FOR DEMO, READ MORE LATER IN THIS DOC ****
            'model'=>new ChatHandler(), // the class handler using database
            'data'=>'any data',                 // data passed to the handler
            // success and error handlers, both optionals.
            'onSuccess'=>new CJavaScriptExpression(
                    "function(code, text, post_id){   }"),
            'onError'=>new CJavaScriptExpression(
                    "function(errorcode, info){  }"),
        ));
        ?>


    </div>


<?php $this->endWidget();?>
    </div><!--/span-->

<?php $this->endWidget();?>



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