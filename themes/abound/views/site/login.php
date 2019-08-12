<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<!--<div class="page-header">-->
<!--	<h1>Login <small>to SIMANGGA</small></h1>-->
<!--</div>-->
<div class="row-fluid">
	
    <div class="span6 offset3">
<?php
	$this->beginWidget('zii.widgets.CPortlet', array(
		//'title'=>"Login to SIMKEU",
	));
	
?>

<!--    <p>Please fill out the following form with your login credentials:</p>-->
    
    <div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>
    
<!--        <p class="note">Fields with <span class="required">*</span> are required.</p>-->
    
        <div class="row">
            <?php echo $form->labelEx($model,'username'); ?>
            <?php echo $form->textField($model,'username'); ?>
            <?php echo $form->error($model,'username'); ?>
        </div>
    
        <div class="row">
            <?php echo $form->labelEx($model,'password'); ?>
            <?php echo $form->passwordField($model,'password'); ?>
            <?php echo $form->error($model,'password'); ?>
<!--            <p class="hint">-->
<!--                Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.-->
<!--            </p>-->
        </div>

        <div class="row">

            <?php
            $ReferensiModel=new ReferensiModel();
            echo CHtml::dropDownList('ddltahun',$tahun,$ReferensiModel->getdaftartahunall()
                , array('onChange'=>'this.form.submit();','style'=>'width: 200px;background-color: #F3FDF0'
                ,'disabled'=>false,
                    'options'=>array( Yii::app()->session['tahun_anggaran']=>array('selected'=>'selected'))));
            ?>

        </div>

        <div class="row rememberMe">
            <?php echo $form->checkBox($model,'rememberMe'); ?>
            <?php echo $form->label($model,'rememberMe'); ?>
            <?php echo $form->error($model,'rememberMe'); ?>
        </div>
    
        <div class="row buttons">
            <?php echo CHtml::submitButton('Login',array('class'=>'btn btn btn-primary')); ?>
        </div>
    
    <?php $this->endWidget(); ?>
    </div><!-- form -->


        <?php
        echo CHtml::endForm();
        ?>


<?php $this->endWidget();?>
         <!--<marquee><font color="red" size="4">PENTING...!!!!!! Batas Pengisian Rencana Kerja dan Anggaran 2016 di Aplikasi SIMANGGA sampai tgl 14 November 2014
<!--                            --><?php //echo $rekaptiket ?>
                    </font></marquee>  
    </div>

</div>


