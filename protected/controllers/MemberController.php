<?php

class MemberController extends Controller {
	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'		=>	'CCaptchaAction',
				'minLength' =>	4,
				'maxLength' =>	4,
				'foreColor'	=>	0x3480FF,
				'backColor'	=>	0xFFFFFF,
				'width'		=>	100,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	
	/**
	 * This is the action to handle external exceptions.
	 */
	
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
	
	
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by members.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}
	
	public function actionSignUp() {
		
		$model = new Member();
		
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='SignUp-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect member input data
		if(isset($_POST['Member']))
		{
			$model->attributes=$_POST['Member'];
			// validate member input and redirect to the previous page if valid
			if($model->validate()) {
				//$model->sendMemberActiveMail();
				$model->save();
				$model->sendMemberActiveMail();
				$this->redirect(Yii::app()->member->returnUrl);
			}
		}
		// display the SignUp form
		$this->render('SignUp',array('model'=>$model));
		
	}
	
	public function actionActiveMember() {
		$memberName = Yii::app()->request->getQuery('memberName');
		$activeKey = Yii::app()->request->getQuery('activeKey');
		$model = new Member();
		$model->activeMemberState($memberName, $activeKey);
		$this->redirect(array('/site/page', 'view'=>'SignUpSuccess'));
	}
}