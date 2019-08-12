<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
//$this->breadcrumbs=array(
//	'Login',
//);

?>

<h1>Login</h1>

<p>Masukan Username dan Password :</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
		<p class="hint">
			Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.
		</p>
	</div>



	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>


<!--    --><?php // echo CHtml::dropDownList('ddltahun',$tahun,$ReferensiModel->getdaftartahun()
//        , array('onChange'=>'this.form.submit();','style'=>'width: 80px;background-color: #F3FDF0'
//        ,'disabled'=>false,
//            'options'=>array($tahun=>array('selected'=>'selected'))));
//    ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Login'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->

<?php echo CHtml::beginForm('','POST');
$ReferensiModel=new ReferensiModel();
?>

<?php // echo CHtml::dropDownList('ddltahun',$tahun,$ReferensiModel->getdaftartahun()
//    , array('onChange'=>'this.form.submit();','style'=>'width: 80px;background-color: #F3FDF0'
//    ,'disabled'=>false,
//        'options'=>array($tahun=>array('selected'=>'selected'))));
//?>

<?php
echo CHtml::endForm();
?>
