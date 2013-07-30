<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main-bak.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>

<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="/">框架应用</a>
            <div class="nav-collapse collapse">
                    <?php $this->widget('zii.widgets.CMenu',array(
						'items'=>array(
							array('label'=>Yii::t('mainTemplate','Home'), 'url'=>array('/site/index')),
							array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
							array('label'=>'Contact', 'url'=>array('/site/contact')),
							array('label'=>Yii::t('mainTemplate','SignIn'), 'url'=>array('/site/SignIn'), 'visible'=>Yii::app()->user->isGuest),
							//array('label'=>Yii::t('mainTemplate','SignUp'), 'url'=>array('/member/SignUp')),
							array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
						),
						'htmlOptions'=>array('class'=>'nav'),
					)); ?>
            </div><!--/.nav-collapse -->
            <?php $widget=$this->beginWidget('application.widgets.LangBox'); ?>	
			<?php $this->endWidget(); ?>
        </div>
    </div>
</div>

<div class="container" id="page">
	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
		
		<!-- 
		<?php //echo CHtml::link('<span class="zh_cn">中文</span>',array(Yii::app()->defaultController.'/',Yii::app()->LangUrlManager->langParam=>'zh_cn'),array(
                    //'class'=>((Yii::app()->language=='zh_cn') ? 'action':''),
                //));?>
                <?php //echo CHtml::link('<span class="ua">English</span>',array(Yii::app()->defaultController.'/',Yii::app()->LangUrlManager->langParam=>'en_us'),array(
                    //'class'=>((Yii::app()->language=='en_us') ? 'action':''),
                //));?>
		 -->
	</div><!-- header -->

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by YondShion.
		All Rights Reserved.<br/>
		<?php //echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>

