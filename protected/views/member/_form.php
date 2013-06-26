<?php
/* @var $this MemberController */
/* @var $model Member */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'member-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'memberName'); ?>
		<?php echo $form->textField($model,'memberName',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'memberName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'memberMail'); ?>
		<?php echo $form->textField($model,'memberMail',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'memberMail'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'memberPhone'); ?>
		<?php echo $form->textField($model,'memberPhone',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'memberPhone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'memberPasswd'); ?>
		<?php echo $form->textField($model,'memberPasswd',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'memberPasswd'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'memberSalt'); ?>
		<?php echo $form->textField($model,'memberSalt',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'memberSalt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'memberAgree'); ?>
		<?php echo $form->textField($model,'memberAgree'); ?>
		<?php echo $form->error($model,'memberAgree'); ?>
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

	<div class="row">
		<?php echo $form->labelEx($model,'memberFrom'); ?>
		<?php echo $form->textField($model,'memberFrom',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'memberFrom'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'memberGrade'); ?>
		<?php echo $form->textField($model,'memberGrade'); ?>
		<?php echo $form->error($model,'memberGrade'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'memberPoint'); ?>
		<?php echo $form->textField($model,'memberPoint',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'memberPoint'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->