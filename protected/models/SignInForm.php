<?php

/**
 * SignInForm class.
 * SignInForm is the data structure for keeping
 * member SignIn form data. It is used by the 'SignIn' action of 'SiteController'.
 */
class SignInForm extends CFormModel
{
	public $memberName;
	public $memberPasswd;
	public $captchaCode;
	public $rememberMe;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that memberName and memberPasswd are required,
	 * and memberPasswd needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// memberName, memberPasswd, captchaCode are required
			array('memberName, memberPasswd, captchaCode', 'required'),
			// captchaCode needs to be entered correctly
			array('captchaCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// memberPasswd needs to be authenticated
			array('memberPasswd', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Remember me next time',
		);
	}

	/**
	 * Authenticates the memberPasswd.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new MemberIdentity($this->memberName,$this->memberPasswd);
			if(!$this->_identity->authenticate())
				$this->addError('memberPasswd','Incorrect memberName or memberPasswd.');
		}
	}

	/**
	 * Logs in the member using the given memberName and memberPasswd in the model.
	 * @return boolean whether SignIn is successful
	 */
	public function SignIn()
	{
		if($this->_identity===null)
		{
			$this->_identity=new MemberIdentity($this->memberName,$this->memberPasswd);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===MemberIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*7 : 0; // 7 days
			Yii::app()->user->SignIn($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
}
