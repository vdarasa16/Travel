<?php

class ImageSearchHelper extends SearchHelperInterface
{

	function init()
	{
		$this->fields = array(
			'image_id',
			'storage_id',
			'orifinal_file_name',
			'new_file_name',
			'extension',
			'mime_type',
			'image_size',
		);
	}

	function generateCriteria()
	{
		return $this->trimAttributes($this->criteria);
	}

}