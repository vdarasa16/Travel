<?php

class StorageSearchHelper extends SearchHelperInterface
{

	function init()
	{
		$this->fields = array(
			'storage_id',
			'path',
			'thumbnail_path',
			'current_file_count',
			'max_file_count',
			'is_default',
		);
	}

	function generateCriteria()
	{
		return $this->trimAttributes($this->criteria);
	}

}