<?php
/* @var $this MemberController */
/* @var $model Member */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'memberId'); ?>
		<?php echo $form->textField($model,'memberId',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'memberName'); ?>
		<?php echo $form->textField($model,'memberName',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'memberMail'); ?>
		<?php echo $form->textField($model,'memberMail',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'memberPhone'); ?>
		<?php echo $form->textField($model,'memberPhone',array('size'=>16,'maxlength'=>16)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'memberPasswd'); ?>
		<?php echo $form->textField($model,'memberPasswd',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'memberSalt'); ?>
		<?php echo $form->textField($model,'memberSalt',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'memberAgree'); ?>
		<?php echo $form->textField($model,'memberAgree'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'activeKey'); ?>
		<?php echo $form->textField($model,'activeKey',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lastVisitDate'); ?>
		<?php echo $form->textField($model,'lastVisitDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'signupDate'); ?>
		<?php echo $form->textField($model,'signupDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'state'); ?>
		<?php echo $form->textField($model,'state'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'memberFrom'); ?>
		<?php echo $form->textField($model,'memberFrom',array('size'=>60,'maxlength'=>60)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'memberGrade'); ?>
		<?php echo $form->textField($model,'memberGrade'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'memberPoint'); ?>
		<?php echo $form->textField($model,'memberPoint',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->