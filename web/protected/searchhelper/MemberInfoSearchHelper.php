<?php

class MemberInfoSearchHelper extends SearchHelperInterface
{

	function init()
	{
		$this->fields = array(
			'member_id',
			'position_id',
			'picture_id',
			'first_name',
			'mid_name',
			'last_name',
			'gender',
			'address',
			'phone',
			'mobile',
			'email',
			'edit_date',
			'description',
		);
	}

	function generateCriteria()
	{
		if (isset($this->criteria['first_name']) && $this->criteria['first_name'] != '')
		{
			$this->criteria['first_name LIKE'] = $this->criteria['first_name'];
			unset($this->criteria['first_name']);
		}

		if (isset($this->criteria['edit_date']) && $this->criteria['edit_date'] != '')
		{
			if (is_scalar($this->criteria['edit_date']))
			{
				$this->criteria['edit_date FROM'] = $this->criteria['edit_date'] . ' 00:00:00';
				$this->criteria['edit_date TO'] = $this->criteria['edit_date'] . ' 23:59:59';
			}
			else
			{
				if ($this->criteria['edit_date']['fromDate'] != '')
					$this->criteria['edit_date FROM'] = $this->criteria['edit_date']['fromDate'] . ' 00:00:00';

				if ($this->criteria['edit_date']['toDate'] != '')
					$this->criteria['edit_date TO'] = $this->criteria['edit_date']['toDate'] . ' 23:59:59';
			}

			unset($this->criteria['edit_date']);
		}

		return $this->trimAttributes($this->criteria);
	}

}