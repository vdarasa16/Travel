<?php

class AmphurSearchHelper extends SearchHelperInterface
{

	function init()
	{
		$this->fields = array(
			'attraction_id',
			'owner_id',
			'amphur_id',
			'category_id',
			'gprs_id',
			'map_id',
			'title_th',
			'title_en',
			'opening_day_th',
			'opening_day_en',
			'opening_time',
			'tel',
			'location_th',
			'location_en',
			'overview_th',
			'overview_en',
			'full_info_th',
			'full_info_en',
			'description_th',
			'description_en',
			'meta_description',
			'meta_keyword',
			'create_date',
			'edit_date',
		);
	}

	function generateCriteria()
	{
		if (isset($this->criteria['title_th']) && $this->criteria['title_th'] != '')
		{
			$this->criteria['title_th LIKE'] = $this->criteria['title_th'];
			unset($this->criteria['title_th']);
		}

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