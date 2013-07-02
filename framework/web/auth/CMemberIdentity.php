<?php
/**
 * CMemberIdentity class file
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2011 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

/**
 * CMemberIdentity is a base class for representing identities that are authenticated based on a memberName and a memberPasswd.
 *
 * Derived classes should implement {@link authenticate} with the actual
 * authentication scheme (e.g. checking memberName and memberPasswd against a DB table).
 *
 * By default, CMemberIdentity assumes the {@link memberName} is a unique identifier
 * and thus use it as the {@link id ID} of the identity.
 *
 * @property string $id The unique identifier for the identity.
 * @property string $name The display name for the identity.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @package system.web.auth
 * @since 1.0
 */
class CMemberIdentity extends CBaseMemberIdentity
{
	/**
	 * @var string memberName
	 */
	public $memberName;
	/**
	 * @var string memberMail
	 */
	public $memberMail;
	/**
	 * @var string memberPasswd
	 */
	public $memberPasswd;

	/**
	 * Constructor.
	 * @param string $memberName memberName
	 * @param string $memberPasswd memberPasswd
	 */
	public function __construct($memberName,$memberPasswd)
	{
		$this->memberName=$memberName;
		$this->memberPasswd=$memberPasswd;
	}

	/**
	 * Authenticates a member based on {@link memberName} and {@link memberPasswd}.
	 * Derived classes should override this method, or an exception will be thrown.
	 * This method is required by {@link IMemberIdentity}.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		throw new CException(Yii::t('yii','{class}::authenticate() must be implemented.',array('{class}'=>get_class($this))));
	}

	/**
	 * Returns the unique identifier for the identity.
	 * The default implementation simply returns {@link memberName}.
	 * This method is required by {@link IMemberIdentity}.
	 * @return string the unique identifier for the identity.
	 */
	public function getId()
	{
		return $this->memberName;
	}

	/**
	 * Returns the display name for the identity.
	 * The default implementation simply returns {@link memberName}.
	 * This method is required by {@link IMemberIdentity}.
	 * @return string the display name for the identity.
	 */
	public function getName()
	{
		return $this->memberName;
	}
}
