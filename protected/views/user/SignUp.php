<?php
/* @var $this SiteController */
/* @var $model SignUpForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - SignUp';
$this->breadcrumbs=array(
	'SignUp',
);
?>

<h1>SignUp</h1>

<p>Please fill out the following form with your SignUp credentials:</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'SignUp-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'userName'); ?>
		<?php echo $form->textField($model,'userName'); ?>
		<?php echo $form->error($model,'userName'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'userMail'); ?>
		<?php echo $form->textField($model,'userMail'); ?>
		<?php echo $form->error($model,'userMail'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'userPasswd'); ?>
		<?php echo $form->passwordField($model,'userPasswd'); ?>
		<?php echo $form->error($model,'userPasswd'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'userPasswdConfirm'); ?>
		<?php echo $form->passwordField($model,'userPasswdConfirm'); ?>
		<?php echo $form->error($model,'userPasswdConfirm'); ?>
	</div>
	
	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'captchaCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'captchaCode'); ?>
		</div>
		<div class="hint">Please enter the letters as they are shown in the image above.
		<br/>Letters are not case-sensitive.</div>
		<?php echo $form->error($model,'captchaCode'); ?>
	</div>
	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('SignUp'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
