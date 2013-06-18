<?php

/**
 * SignInForm class.
 * SignInForm is the data structure for keeping
 * user SignIn form data. It is used by the 'SignIn' action of 'SiteController'.
 */
class SignInForm extends CFormModel
{
	public $userName;
	public $userPasswd;
	public $captchaCode;
	public $rememberMe;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that userName and userPasswd are required,
	 * and userPasswd needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// userName, userPasswd, captchaCode are required
			array('userName, userPasswd, captchaCode', 'required'),
			// captchaCode needs to be entered correctly
			array('captchaCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// userPasswd needs to be authenticated
			array('userPasswd', 'authenticate'),
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
	 * Authenticates the userPasswd.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->userName,$this->userPasswd);
			if(!$this->_identity->authenticate())
				$this->addError('userPasswd','Incorrect userName or userPasswd.');
		}
	}

	/**
	 * Logs in the user using the given userName and userPasswd in the model.
	 * @return boolean whether SignIn is successful
	 */
	public function SignIn()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->userName,$this->userPasswd);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*7 : 0; // 7 days
			Yii::app()->user->SignIn($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
}
