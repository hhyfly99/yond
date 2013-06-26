<?php
/* @var $this MemberController */
/* @var $model Member */

$this->breadcrumbs=array(
	'Members'=>array('index'),
	$model->memberId,
);

$this->menu=array(
	array('label'=>'List Member', 'url'=>array('index')),
	array('label'=>'Create Member', 'url'=>array('create')),
	array('label'=>'Update Member', 'url'=>array('update', 'id'=>$model->memberId)),
	array('label'=>'Delete Member', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->memberId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Member', 'url'=>array('admin')),
);
?>

<h1>View Member #<?php echo $model->memberId; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'memberId',
		'memberName',
		'memberMail',
		'memberPhone',
		'memberPasswd',
		'memberSalt',
		'memberAgree',
		'activeKey',
		'lastVisitDate',
		'signupDate',
		'state',
		'memberFrom',
		'memberGrade',
		'memberPoint',
	),
)); ?>
