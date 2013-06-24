<?php
/* @var $this SiteController */
/* @var $model SignInForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - ' . Yii::t('mainTemplate','AdminSignIn');
$this->breadcrumbs=array(
	Yii::t('mainTemplate','AdminSignIn'),
);
?>

<h1><?php echo Yii::t('mainTemplate','SignIn');?></h1>

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

	

	<div class="row buttons">
		<?php echo CHtml::submitButton('SignIn'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->

