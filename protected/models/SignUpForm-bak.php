<?php

/**
 * SignUpForm class.
 * SignUpForm is the data structure for keeping
 * user SignUp form data. It is used by the 'SignUp' action of 'SiteController'.
 */
class SignUpForm extends CFormModel
{
	public $userName;
	public $userMail;
	public $userPasswd;
	public $userPasswdConfirm;
	public $captchaCode;

	/**
	 * Declares the validation rules.
	 * The rules state that userName, userMail, userPasswd, userPasswdConfirm are required,
	 */
	public function rules()
	{
		return array(
			// userName, userMail, userPasswd, userPasswdConfirm are required
			array('userName, userMail, userPasswd, userPasswdConfirm, captchaCode', 'required'),
			// userPasswd has to be a length valid 
			array('userName,userPasswd', 'length', 'min'=>6, 'max'=>16),
			// userMail has to be a length valid 
			array('userMail', 'length', 'min'=>6, 'max'=>60),
			// userMail has to be a valid email address
			array('userMail', 'email'),
			// userPasswdConfirm has to be the same as userPasswd
			array('userPasswdConfirm', 'compare', 'compareAttribute'=>'userPasswd'),
			// captchaCode needs to be entered correctly
			array('captchaCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		);
	}
	
	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'captchaCode'=>'Verification Code',
		);
	}
	
	public function beforeSave() {
		
	}

	/**
	 * SignUp using the given userName, userMail, userPasswd in the model.
	 * @return boolean whether SignUp is successful
	 */
	public function SignUp()
	{
		
	}
}
