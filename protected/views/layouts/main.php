<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />


	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />


	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>


<body>


<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>

		<?php $widget=$this->beginWidget('application.widgets.LangBox'); ?>	
		<?php $this->endWidget(); ?>
		
		
		
		<!-- 
		<?php //echo CHtml::link('<span class="zh_cn">中文</span>',array(Yii::app()->defaultController.'/',Yii::app()->LangUrlManager->langParam=>'zh_cn'),array(
                    //'class'=>((Yii::app()->language=='zh_cn') ? 'action':''),
                //));?>
                <?php //echo CHtml::link('<span class="ua">English</span>',array(Yii::app()->defaultController.'/',Yii::app()->LangUrlManager->langParam=>'en_us'),array(
                    //'class'=>((Yii::app()->language=='en_us') ? 'action':''),
                //));?>
		 -->
	</div><!-- header -->


	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>Yii::t('mainTemplate','Home'), 'url'=>array('/site/index')),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>Yii::t('mainTemplate','SignIn'), 'url'=>array('/site/SignIn'), 'visible'=>Yii::app()->user->isGuest),
				//array('label'=>Yii::t('mainTemplate','SignUp'), 'url'=>array('/member/SignUp')),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>


	<?php echo $content; ?>


	<div class="clear"></div>


	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by YondShion.<br/>
		All Rights Reserved.<br/>
		<?php //echo Yii::powered(); ?>
	</div><!-- footer -->


</div><!-- page -->


</body>
</html>

