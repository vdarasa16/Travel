<?php

class MemberSearchHelper extends SearchHelperInterface
{

	function init()
	{
		$this->fields = array(
			'member_id',
			'member_code',
			'member_name',
			'password',
			'create_date',
			'last_login_date',
			'last_change_password_date',
		);
	}

	function generateCriteria()
	{
		if (isset($this->criteria['create_date']) && $this->criteria['create_date'] != '')
		{
			if (is_scalar($this->criteria['create_date']))
			{
				$this->criteria['create_date FROM'] = $this->criteria['create_date'] . ' 00:00:00';
				$this->criteria['create_date TO'] = $this->criteria['create_date'] . ' 23:59:59';
			}
			else
			{
				if ($this->criteria['create_date']['fromDate'] != '')
					$this->criteria['create_date FROM'] = $this->criteria['create_date']['fromDate'] . ' 00:00:00';

				if ($this->criteria['create_date']['toDate'] != '')
					$this->criteria['create_date TO'] = $this->criteria['create_date']['toDate'] . ' 23:59:59';
			}

			unset($this->criteria['create_date']);
		}

		if (isset($this->criteria['last_login_date']) && $this->criteria['last_login_date'] != '')
		{
			if (is_scalar($this->criteria['last_login_date']))
			{
				$this->criteria['last_login_date FROM'] = $this->criteria['last_login_date'] . ' 00:00:00';
				$this->criteria['last_login_date TO'] = $this->criteria['last_login_date'] . ' 23:59:59';
			}
			else
			{
				if ($this->criteria['last_login_date']['fromDate'] != '')
					$this->criteria['last_login_date FROM'] = $this->criteria['last_login_date']['fromDate'] . ' 00:00:00';

				if ($this->criteria['last_login_date']['toDate'] != '')
					$this->criteria['last_login_date TO'] = $this->criteria['last_login_date']['toDate'] . ' 23:59:59';
			}

			unset($this->criteria['last_login_date']);
		}

		if (isset($this->criteria['last_change_password_date']) && $this->criteria['last_change_password_date'] != '')
		{
			if (is_scalar($this->criteria['last_change_password_date']))
			{
				$this->criteria['last_change_password_date FROM'] = $this->criteria['last_change_password_date'] . ' 00:00:00';
				$this->criteria['last_change_password_date TO'] = $this->criteria['last_change_password_date'] . ' 23:59:59';
			}
			else
			{
				if ($this->criteria['last_change_password_date']['fromDate'] != '')
					$this->criteria['last_change_password_date FROM'] = $this->criteria['last_change_password_date']['fromDate'] . ' 00:00:00';

				if ($this->criteria['last_change_password_date']['toDate'] != '')
					$this->criteria['last_change_password_date TO'] = $this->criteria['last_change_password_date']['toDate'] . ' 23:59:59';
			}

			unset($this->criteria['last_change_password_date']);
		}

		return $this->trimAttributes($this->criteria);
	}

}