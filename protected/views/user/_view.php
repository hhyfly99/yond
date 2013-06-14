<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('userId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->userId), array('view', 'id'=>$data->userId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('userName')); ?>:</b>
	<?php echo CHtml::encode($data->userName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('userMail')); ?>:</b>
	<?php echo CHtml::encode($data->userMail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('userPhone')); ?>:</b>
	<?php echo CHtml::encode($data->userPhone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('userPasswd')); ?>:</b>
	<?php echo CHtml::encode($data->userPasswd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activeKey')); ?>:</b>
	<?php echo CHtml::encode($data->activeKey); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastVisitDate')); ?>:</b>
	<?php echo CHtml::encode($data->lastVisitDate); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('signupDate')); ?>:</b>
	<?php echo CHtml::encode($data->signupDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('state')); ?>:</b>
	<?php echo CHtml::encode($data->state); ?>
	<br />

	*/ ?>

</div>