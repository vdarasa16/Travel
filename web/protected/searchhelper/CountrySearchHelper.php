<?php

class CountrySearchHelper extends SearchHelperInterface
{

	function init()
	{
		$this->fields = array(
			'country_id',
			'capital_id',
			'gprs_id',
			'map_id',
			'currency_id',
			'name_th',
			'name_en',
			'location_th',
			'location_en',
			'dominance_th',
			'dominance_en',
			'area',
			'population',
			'terrain_th',
			'terrain_en',
			'climate_th',
			'climate_en',
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
		if(isset($this->criteria['name_th']) && $this->criteria['name_th'] != '')
		{
			$this->criteria['name_th LIKE'] = $this->criteria['name_th'];
			unset($this->criteria['name_th']);
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