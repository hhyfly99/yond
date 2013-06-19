<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $userId
 * @property string $userName
 * @property string $userMail
 * @property string $userPhone
 * @property string $userPasswd
 * @property string $userSalt
 * @property integer $userAgree
 * @property string $activeKey
 * @property string $lastVisitDate
 * @property string $signupDate
 * @property integer $state
 */
class User extends CActiveRecord
{
	public $passwdNotCrypt;
	public $userPasswdConfirm;
	public $captchaCode;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			/*
			array('state', 'numerical', 'integerOnly'=>true),
			array('userName', 'length', 'max'=>20),
			array('userMail', 'length', 'max'=>100),
			array('userPhone', 'length', 'max'=>16),
			array('userPasswd, activeKey', 'length', 'max'=>128),
			array('lastVisitDate, signupDate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userId, userName, userMail, userPhone, userPasswd, activeKey, lastVisitDate, signupDate, state', 'safe', 'on'=>'search'),
			*/
		
			// userName, userMail, userPasswd, userPasswdConfirm, captchaCode are required
			array('userName, userMail, userPasswd, userPasswdConfirm, captchaCode', 'required'),
			
			// userName has to be a length valid 
			array('userName', 'length', 'min'=>6, 'max'=>16),
			// userName regex
			array('userName', 'match', 'pattern' => '/^[a-zA-Z0-9_]{6,16}$/u'),
			// userName unique 
			array('userName', 'unique', 'attributeName'=> 'userName', 'className' => 'User',  'message' => 'User Name exist'),
			
			// userMail unique 
			array('userMail', 'unique', 'attributeName'=> 'userMail', 'className' => 'User',  'message' => 'User Email exist'),
			// userMail has to be a length valid 
			array('userMail', 'length', 'min'=>5, 'max'=>60),
			// userMail has to be a valid email address
			array('userMail', 'email'),
			
			// userPasswd has to be a length valid 
			array('userPasswd', 'length', 'min'=>6, 'max'=>16),
			// userPasswd regex
			array('userPasswd', 'match', 'pattern' => '/^(?=.*\d)(?=.*[a-zA-Z]).{6,16}$/'),
			
			// userPasswdConfirm has to be the same as userPasswd
			array('userPasswdConfirm', 'compare', 'compareAttribute'=>'userPasswd'),
			
			// captchaCode needs to be entered correctly
			array('captchaCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
			
			// userAgree needs to value = 1 
			array( 'userAgree', 'required', 'requiredValue'=>1, 'message'=>'You must agree with terms'),
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
			'userId' => 'User',
			'userName' => 'User Name',
			'userMail' => 'User Mail',
			'userPhone' => 'User Phone',
			'userPasswd' => 'User Passwd',
			'userSalt' => 'User Salt',
			'activeKey' => 'Active Key',
			'lastVisitDate' => 'Last Visit Date',
			'signupDate' => 'Signup Date',
			'state' => 'State',
			*/
			'userId' => 'User',
			'userName' => 'User Name',
			'userMail' => 'User Mail',
			'userPasswd' => 'User Passwd',
			'userSalt' => 'User Salt',
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

		$criteria->compare('userId',$this->userId,true);
		$criteria->compare('userName',$this->userName,true);
		$criteria->compare('userMail',$this->userMail,true);
		$criteria->compare('userPhone',$this->userPhone,true);
		$criteria->compare('userPasswd',$this->userPasswd,true);
		$criteria->compare('userSalt',$this->userSalt,true);
		$criteria->compare('userAgree',$this->userAgree,true);
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
			$this->passwdNotCrypt = $this->userPasswd;
			$this->userSalt = time() . $this->captchaCode;
			$this->userPasswd = md5($this->userSalt . $this->userPasswd);
			$this->signupDate = date('Y-m-d H:i:s');
			$this->activeKey = RandomString(32, '');
		}
		
		return parent::beforeSave();
	}
	
	public function getUserSalt() {
		$userSalts = Yii::app()->db->createCommand()
			    ->select('userSalt')
			    ->from('User')
			    ->where('userName=:userName', array(':userName'=>$this->userName))
			    ->queryRow();
		return $userSalt = $userSalts['userSalt'];
	}
	
	public function sendUserActiveMail() {
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
        	'userName'=>$this->userName,
        	'userMail'=>$this->userMail,
        	'userPasswd'=>$this->passwdNotCrypt,
        	'activeKey'=>$this->activeKey
        );
        $message->subject = 'Thank you for your registration';
        $message->setBody($params, 'text/html');
        $message->addTo($this->userMail);
        $message->from = 'hhyfly99@163.com';
        Yii::app()->mail->send($message);
        
	}
}