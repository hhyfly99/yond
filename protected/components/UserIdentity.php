<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the userName and userPasswd
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		/*
		$users=array(
			// userName => userPasswd
			'demo'=>'demo',
			'admin'=>'admin',
		);
		if(!isset($users[$this->userName]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($users[$this->userName]!==$this->userPasswd)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
		*/
		$user = User::model()->findByAttributes(array('userName' => $this->userName));
		
		
		$userSalts = Yii::app()->db->createCommand()
			    ->select('userSalt')
			    ->from('User')
			    ->where('userName=:userName', array(':userName'=>$this->userName))
			    ->queryRow();
		$userSalt = $userSalts['userSalt'];
		
		//echo $this->getUserPasswd();
		//$user->getUserSalt();
		
		if (null === $user)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif ($this->getUserPasswd() !== md5($user->getUserSalt() . $this->userPasswd))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	}
	
	public function getUserPasswd() {
		$userSalts = Yii::app()->db->createCommand()
			    ->select('userPasswd')
			    ->from('User')
			    ->where('userName=:userName', array(':userName'=>$this->userName))
			    ->queryRow();
		return $userPasswd = $userSalts['userPasswd'];
	}
}