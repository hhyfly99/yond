<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'userName'); ?>
		<?php echo $form->textField($model,'userName',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'userName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'userMail'); ?>
		<?php echo $form->textField($model,'userMail',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'userMail'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'userPhone'); ?>
		<?php echo $form->textField($model,'userPhone',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'userPhone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'userPasswd'); ?>
		<?php echo $form->textField($model,'userPasswd',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'userPasswd'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'activeKey'); ?>
		<?php echo $form->textField($model,'activeKey',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'activeKey'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lastVisitDate'); ?>
		<?php echo $form->textField($model,'lastVisitDate'); ?>
		<?php echo $form->error($model,'lastVisitDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'signupDate'); ?>
		<?php echo $form->textField($model,'signupDate'); ?>
		<?php echo $form->error($model,'signupDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'state'); ?>
		<?php echo $form->textField($model,'state'); ?>
		<?php echo $form->error($model,'state'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->