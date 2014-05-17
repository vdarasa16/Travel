<?php

class UserManager extends BusinessInterface
{

	public function getById($id = '')
	{
		$mUser = new MUser();
		return $this->getModelById($mUser, $id);
	}

	public function getAllProvider($criteria = array(), $sort = array(), $pageination = false)
	{
		$mUser = new MUser();
		$sExtension = new UserSearchHelper($this->parent, $criteria);
		$criteria = $sExtension->generateCriteria();
		return $this->getAllModelProvider($mUser, $criteria, $sort, $pageination);
	}

	public function getDefault()
	{
		$mUser = new MUser();
		return $mUser;
	}
	
	public function updateLastLogin($model)
	{
		$this->edit($model, array('lastlogindate' => date('Y-m-d H:i:s')));
	}

}