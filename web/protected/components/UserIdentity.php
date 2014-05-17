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
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	private $_id;
	private $_role = array('man');

	public function authenticate()
	{
		$bUser = new UserManager($this);
		$user = $bUser->getAll(array('username' => $this->username));

		if (count($user) != 1)
		{
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		}
		else
		{
			$user = array_shift($user);
			if (!$user->validatePassword($this->password))
				$this->errorCode = self::ERROR_PASSWORD_INVALID;
			else
			{
				$this->_id = $user->userid;
				$this->errorCode = self::ERROR_NONE;
				
				$bUser->updateLastLogin($user);
			}
		}

		return $this->errorCode == self::ERROR_NONE;
	}

}