<?php
/* @var $this SiteController */
/* @var $model SignInForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - SignIn';
$this->breadcrumbs=array(
	'SignIn',
);
?>

<h1>SignIn</h1>

<p>Please fill out the following form with your SignIn credentials:</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'SignIn-form',
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
		<?php echo $form->labelEx($model,'userPasswd'); ?>
		<?php echo $form->passwordField($model,'userPasswd'); ?>
		<?php echo $form->error($model,'userPasswd'); ?>
		<p class="hint">
			Hint: You may SignIn with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.
		</p>
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

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('SignIn'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
