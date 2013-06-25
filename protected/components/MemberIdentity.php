<?php

/**
 * MemberIdentity represents the data needed to identity a member.
 * It contains the authentication method that checks if the provided
 * data can identity the member.
 */
class MemberIdentity extends CMemberIdentity
{
	/**
	 * Authenticates a member.
	 * The example implementation makes sure if the memberName and memberPasswd
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent member identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		/*
		$members=array(
			// memberName => memberPasswd
			'demo'=>'demo',
			'admin'=>'admin',
		);
		if(!isset($members[$this->memberName]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($users[$this->userName]!==$this->userPasswd)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
		*/
		$member = Member::model()->findByAttributes(array('memberName' => $this->memberName));
		
		if (null === $member)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif ($this->getMemberPasswd() !== md5($member->getMemberSalt() . $this->memberPasswd))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	}
	
	public function getMemberPasswd() {
		$memberSalts = Yii::app()->db->createCommand()
			    ->select('memberPasswd')
			    ->from('Member')
			    ->where('memberName=:memberName', array(':memberName'=>$this->memberName))
			    ->queryRow();
		return $memberPasswd = $memberSalts['memberPasswd'];
	}
}