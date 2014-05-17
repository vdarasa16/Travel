<?php

abstract class SearchHelperInterface
{

	public $criteria = array();
	public $fields = array();
	public $parent;

	function __construct($parent, $criteria = array())
	{
		$this->parent = $parent;
		$this->criteria = $criteria;
		$this->init();
		$this->checkCriteria();
		$this->setDefaultCriteria();
	}

	private function checkCriteria()
	{
		$resultCheckCriteria = array();
		foreach ($this->criteria as $field => $value)
		{
			if (in_array($field, $this->fields) || $this->matchSpecialCriteria($field))
				$resultCheckCriteria[$field] = $value;
		}
		
		$this->criteria = $resultCheckCriteria;
	}

	private function matchSpecialCriteria($field)
	{
		if (preg_match('/ NOT IN$/', $field))
			$field = str_replace(' NOT IN', '', $field);
		elseif (preg_match('/ BETWEEN$/', $field))
			$field = str_replace(' BETWEEN', '', $field);
		elseif (preg_match('/ FROM$/', $field))
			$field = str_replace(' FROM', '', $field);
		elseif (preg_match('/ TO$/', $field))
			$field = str_replace(' TO', '', $field);
		elseif (preg_match('/ LIKE$/', $field))
			$field = str_replace(' LIKE', '', $field);
		elseif (preg_match('/ OR$/', $field))
			$field = str_replace(' OR', '', $field);

		if (in_array($field, $this->fields))
			return true;

		return false;
	}
	
	private function setDefaultCriteria()
	{
		if (isset(Yii::app()->params['useVoidDelete']) && Yii::app()->params['useVoidDelete'] === true && !isset($this->criteria['void']))
		{
			$this->criteria['void'] = false;
		}
		
		if (isset($this->criteria['createdate']) && $this->criteria['createdate'] != '')
		{
			if (is_scalar($this->criteria['createdate']))
			{
				$this->criteria['createdate FROM'] = $this->criteria['createdate'] . ' 00:00:00';
				$this->criteria['createdate TO'] = $this->criteria['createdate'] . ' 23:59:59';
			}
			else
			{
				if ($this->criteria['createdate']['fromDate'] != '')
					$this->criteria['createdate FROM'] = $this->criteria['createdate']['fromDate'] . ' 00:00:00';

				if ($this->criteria['createdate']['toDate'] != '')
					$this->criteria['createdate TO'] = $this->criteria['createdate']['toDate'] . ' 23:59:59';
			}
			
			unset($this->criteria['createdate']);
		}

		if (isset($this->criteria['editdate']) && $this->criteria['editdate'] != '')
		{
			if (is_scalar($this->criteria['editdate']))
			{
				$this->criteria['editdate FROM'] = $this->criteria['editdate'] . ' 00:00:00';
				$this->criteria['editdate TO'] = $this->criteria['editdate'] . ' 23:59:59';
			}
			else
			{
				if ($this->criteria['editdate']['fromDate'] != '')
					$this->criteria['editdate FROM'] = $this->criteria['editdate']['fromDate'] . ' 00:00:00';

				if ($this->criteria['editdate']['toDate'] != '')
					$this->criteria['editdate TO'] = $this->criteria['editdate']['toDate'] . ' 23:59:59';
			}
			
			unset($this->criteria['editdate']);
		}
	}
	
	protected function trimAttributes($criteria)
	{
		if (!is_array($criteria))
			return array();

		foreach ($criteria as $field => & $value)
		{
			if (is_scalar($value) && $value !== false && $value !== true)
				$value = trim($value);
		}

		return $criteria;
	}

	abstract function init();
	abstract function generateCriteria();
}

?>