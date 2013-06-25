<?php
/* @var $this SiteController */
/* @var $model SignUpForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - ' . Yii::t('mainTemplate','SignUp');
$this->breadcrumbs=array(
	Yii::t('mainTemplate','SignUp'),
);
?>

<h1><?php echo Yii::t('mainTemplate','SignUp')?></h1>

<p>Please fill out the following form with your SignUp credentials:</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'SignUp-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'memberName'); ?>
		<?php echo $form->textField($model,'memberName'); ?>
		<?php echo $form->error($model,'memberName'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'memberMail'); ?>
		<?php echo $form->textField($model,'memberMail'); ?>
		<?php echo $form->error($model,'memberMail'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'memberPasswd'); ?>
		<?php echo $form->passwordField($model,'memberPasswd'); ?>
		<?php echo $form->error($model,'memberPasswd'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'memberPasswdConfirm'); ?>
		<?php echo $form->passwordField($model,'memberPasswdConfirm'); ?>
		<?php echo $form->error($model,'memberPasswdConfirm'); ?>
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
	
	<div class="row">
		<?php echo $form->labelEx($model,'memberAgree'); ?>
		<?php $form->widget('application.extensions.fancybox.EFancyBox',
                        array('target'=>'#protocol',
                        'config'=>array(), ));?>
		Access <a id="protocol" href="<?php echo Yii::app()->request->baseUrl;?>/images/Member/protocol.html">Member Protocol</a>
		<?php echo $form->checkBox($model,'memberAgree',array('value'=>1, 'uncheckValue'=>0)); ?>
		<?php echo $form->error($model,'memberAgree'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('SignUp'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
