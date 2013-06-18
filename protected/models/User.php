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
	
	public function SignIn() {
		
	}
}