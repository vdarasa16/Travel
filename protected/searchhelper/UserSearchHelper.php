<?php

class UserSearchHelper extends SearchHelperInterface
{

	function init()
	{
		$this->fields = array(
			'userid',
			'usercode',
			'username',
			'password',
			'createdate',
			'lastlogindate',
			'lastchangepassworddate',
		);
	}

	function generateCriteria()
	{
		if (isset($this->criteria['lastlogindate']) && $this->criteria['lastlogindate'] != '')
		{
			if (is_scalar($this->criteria['lastlogindate']))
			{
				$this->criteria['lastlogindate FROM'] = $this->criteria['lastlogindate'] . ' 00:00:00';
				$this->criteria['lastlogindate TO'] = $this->criteria['lastlogindate'] . ' 23:59:59';
			}
			else
			{
				if ($this->criteria['lastlogindate']['fromDate'] != '')
					$this->criteria['lastlogindate FROM'] = $this->criteria['lastlogindate']['fromDate'] . ' 00:00:00';

				if ($this->criteria['lastlogindate']['toDate'] != '')
					$this->criteria['lastlogindate TO'] = $this->criteria['lastlogindate']['toDate'] . ' 23:59:59';
			}
			
			unset($this->criteria['lastlogindate']);
		}
		
		if (isset($this->criteria['lastchangepassworddate']) && $this->criteria['lastchangepassworddate'] != '')
		{
			if (is_scalar($this->criteria['lastchangepassworddate']))
			{
				$this->criteria['lastchangepassworddate FROM'] = $this->criteria['lastchangepassworddate'] . ' 00:00:00';
				$this->criteria['lastchangepassworddate TO'] = $this->criteria['lastchangepassworddate'] . ' 23:59:59';
			}
			else
			{
				if ($this->criteria['lastchangepassworddate']['fromDate'] != '')
					$this->criteria['lastchangepassworddate FROM'] = $this->criteria['lastchangepassworddate']['fromDate'] . ' 00:00:00';

				if ($this->criteria['lastchangepassworddate']['toDate'] != '')
					$this->criteria['lastchangepassworddate TO'] = $this->criteria['lastchangepassworddate']['toDate'] . ' 23:59:59';
			}
			
			unset($this->criteria['lastchangepassworddate']);
		}

		return $this->trimAttributes($this->criteria);
	}

}