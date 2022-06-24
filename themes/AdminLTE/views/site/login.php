

<div class="card card-info">            
<div class="card-header">
    <h3 class="card-title">Login to SIM -RSGM</h3>
</div>        
<div class="card-body">


    
    <div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>
    
<!--        <p class="note">Fields with <span class="required">*</span> are required.</p>-->
           
    
        <div class="form-group row">
            <?php echo $form->labelEx($model,'username'); ?>
            <?php echo $form->textField($model,'username'); ?>
            <?php echo $form->error($model,'username'); ?>
        </div>
    
        <div class="form-group row">
            <?php echo $form->labelEx($model,'password'); ?>
            <?php echo $form->passwordField($model,'password'); ?>
            <?php echo $form->error($model,'password'); ?>
<!--            <p class="hint">-->
<!--                Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.-->
<!--            </p>-->
        </div>

      

        <div class="form-group row">          
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

</div><!-- card-body -->

</div><!-- card-info-->


