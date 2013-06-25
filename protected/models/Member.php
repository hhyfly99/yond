<?php

/**
 * This is the model class for table "member".
 *
 * The followings are the available columns in table 'member':
 * @property string $memberId
 * @property string $memberName
 * @property string $memberMail
 * @property string $memberPhone
 * @property string $memberPasswd
 * @property string $memberSalt
 * @property integer $memberAgree
 * @property string $activeKey
 * @property string $lastVisitDate
 * @property string $signupDate
 * @property integer $state
 */
class Member extends CActiveRecord
{
	public $passwdNotCrypt;
	public $memberPasswdConfirm;
	public $captchaCode;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Member the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'member';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive member inputs.
		return array(
			/*
			array('state', 'numerical', 'integerOnly'=>true),
			array('memberName', 'length', 'max'=>20),
			array('memberMail', 'length', 'max'=>100),
			array('memberPhone', 'length', 'max'=>16),
			array('memberPasswd, activeKey', 'length', 'max'=>128),
			array('lastVisitDate, signupDate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('memberId, memberName, memberMail, memberPhone, memberPasswd, activeKey, lastVisitDate, signupDate, state', 'safe', 'on'=>'search'),
			*/
		
			// memberName, memberMail, memberPasswd, memberPasswdConfirm, captchaCode are required
			array('memberName, memberMail, memberPasswd, memberPasswdConfirm, captchaCode', 'required'),
			
			// memberName has to be a length valid 
			array('memberName', 'length', 'min'=>6, 'max'=>16),
			// memberName regex
			array('memberName', 'match', 'pattern' => '/^[a-zA-Z0-9_]{6,16}$/u'),
			// memberName unique 
			array('memberName', 'unique', 'attributeName'=> 'memberName', 'className' => 'Member',  'message' => 'Member Name exist'),
			
			// memberMail unique 
			array('memberMail', 'unique', 'attributeName'=> 'memberMail', 'className' => 'Member',  'message' => 'Member Email exist'),
			// memberMail has to be a length valid 
			array('memberMail', 'length', 'min'=>5, 'max'=>60),
			// memberMail has to be a valid email address
			array('memberMail', 'email'),
			
			// memberPasswd has to be a length valid 
			array('memberPasswd', 'length', 'min'=>6, 'max'=>16),
			// memberPasswd regex
			array('memberPasswd', 'match', 'pattern' => '/^(?=.*\d)(?=.*[a-zA-Z]).{6,16}$/'),
			
			// memberPasswdConfirm has to be the same as memberPasswd
			array('memberPasswdConfirm', 'compare', 'compareAttribute'=>'memberPasswd'),
			
			// captchaCode needs to be entered correctly
			array('captchaCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
			
			// memberAgree needs to value = 1 
			array( 'memberAgree', 'required', 'requiredValue'=>1, 'message'=>'You must agree with terms'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			/*
			'memberId' => 'member',
			'memberName' => 'Member Name',
			'memberMail' => 'Member Mail',
			'memberPhone' => 'Member Phone',
			'memberPasswd' => 'Member Passwd',
			'memberSalt' => 'Member Salt',
			'activeKey' => 'Active Key',
			'lastVisitDate' => 'Last Visit Date',
			'signupDate' => 'Signup Date',
			'state' => 'State',
			*/
			'memberId' => 'Member',
			'memberName' => 'Member Name',
			'memberMail' => 'Member Mail',
			'memberPasswd' => 'Member Passwd',
			'memberSalt' => 'Member Salt',
			'activeKey' => 'Active Key',
			'signupDate' => 'Signup Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('memberId',$this->memberId,true);
		$criteria->compare('memberName',$this->memberName,true);
		$criteria->compare('memberMail',$this->memberMail,true);
		$criteria->compare('memberPhone',$this->memberPhone,true);
		$criteria->compare('memberPasswd',$this->memberPasswd,true);
		$criteria->compare('memberSalt',$this->memberSalt,true);
		$criteria->compare('memberAgree',$this->memberAgree,true);
		$criteria->compare('activeKey',$this->activeKey,true);
		$criteria->compare('lastVisitDate',$this->lastVisitDate,true);
		$criteria->compare('signupDate',$this->signupDate,true);
		$criteria->compare('state',$this->state);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave() 
	{
		if ($this->isNewRecord) {
			$this->passwdNotCrypt = $this->memberPasswd;
			$this->memberSalt = time() . $this->captchaCode;
			$this->memberPasswd = md5($this->memberSalt . $this->memberPasswd);
			$this->signupDate = date('Y-m-d H:i:s');
			$this->activeKey = RandomString(32, '');
			$this->state = 0;
		}
		
		return parent::beforeSave();
	}
	
	public function getMemberSalt() {
		$memberSalts = Yii::app()->db->createCommand()
			    ->select('memberSalt')
			    ->from('Member')
			    ->where('memberName=:memberName', array(':memberName'=>$this->memberName))
			    ->queryRow();
		return $memberSalt = $memberSalts['memberSalt'];
	}
	
	public function sendMemberActiveMail() {
		/*
		$mail = new YiiMailer();
		$mail->setView('SignUp');
		$mail->setData(array(
				'message'=>'Message to send',
				'name'=>'YondShion.Co. Ltd',
				'description'=>'contact form',
				'mailer' => $mail
			)
		);
		
		$mail->render();
		//$mail->From = 'hhyfly99@163.com';
		//$mail->FromName = 'Info@YondShion.com';
		$mail->Subject = 'Thanks for your registration';
		$mail->From = 'hhyfly99@163.com';
		$mail->FromName = 'tuomu';
		$mail->AddAddress('871818355@qq.com');
		
		var_dump($mail);
		if ($mail->Send()) {
			$mail->ClearAddresses();
			echo 'Mail sent successfuly';
		} else {
			echo 'Error while sending email: '.$mail->ErrorInfo;
		}
		*/
		
		
		/*
		//Do some cron processing...
		$cronResult="Cron job finished successfuly";
		
		$mail = new YiiMailer();
		$mail->Encoding = 'base64';
		$mail->CharSet='UTF-8';
		$mail->Port=25;
		//use "cron" view from views/mail
		$mail->setView('SignUp');
		$mail->setData(array('message' => $cronResult, 'name' => get_class($this), 'description' => 'Cron job', 'mailer' => $mail));
		//render HTML mail, layout is set from config file or with $mail->setLayout('layoutName')
		$mail->render();
		//set properties as usually with PHPMailer
		$mail->From = 'hhyfly99@163.com';
		//$mail->FromName = 'tuomu';
		$mail->Subject = $cronResult;
		$mail->AddAddress('871818355@qq.com');
		//send
		var_dump($mail);
		if ($mail->Send()) {
			$mail->ClearAddresses();
			echo 'Mail sent successfuly';
		} else {
			echo 'Error while sending email: '.$mail->ErrorInfo;
		}
		echo PHP_EOL;
		*/
		
		$message = new YiiMailMessage();
        //this points to the file test.php inside the view path
        $message->view = "SignUpMailTemplate";
        //echo $this->activeKey;
        $params = array(
        	'MailFrom'=>'YondShion.com',
        	'memberName'=>$this->memberName,
        	'memberMail'=>$this->memberMail,
        	'memberPasswd'=>$this->passwdNotCrypt,
        	'activeKey'=>$this->activeKey
        );
        $message->subject = 'Thank you for your registration';
        $message->setBody($params, 'text/html');
        $message->addTo($this->memberMail);
        $message->from = 'hhyfly99@163.com';
        Yii::app()->mail->send($message);
        
	}
	
	
	public function activeMemberState($memberName, $activeKey) {
		$member = Yii::app()->db->createCommand()
			    ->update('member', 
			    	array('state'=>1),
			    	'memberName=:memberName AND activeKey=:activeKey',
			    	array(':memberName'=>$memberName,':activeKey'=>$activeKey));
		return $memberSalt = $memberSalts['memberSalt'];
	}
	
}