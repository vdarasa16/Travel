<?php

class AbstractBusiness extends Business
{

	protected $parent;
	public $modelName = '';
	public $searchHelperName = '';
	
	function getAllList($value, $text, $criteria = array(), $sort = array())
	{
		$dataRows = $this->getAll($criteria, $sort);
		$dataList = $this->getList($dataRows, $value, $text);

		return $dataList;
	}
	
	function getAll($criteria = array(), $sort = array(), $pageination = false)
	{
		return $this->getAllProvider($criteria, $sort, $pageination)->data;
	}
	
	function getList($data, $value, $text)
	{
		return getListObject($data, $value, $text);
	}
	
	function add($model, $data, $relatedData = array())
	{
		return $this->addModel($model, $data, $relatedData);
	}
	
	function edit($model, $data, $relatedData = array())
	{
		return $this->editModel($model, $data, $relatedData);
	}
	
	function delete($model)
	{
		return $this->deleteModel($model);
	}
	
	function deleteRows($criteria = array())
	{
		$modelRows = $this->getAll($criteria);
		$result = true;
		foreach ($modelRows as $model)
		{
			$token = $this->delete($model);
			$result = $result && $token;
		}
		
		return $result;
	}
	
	public function getById($id = '')
	{
		$model = $this->getModel($this->modelName);
		return $this->getModelById($model, $id);
	}

	public function getAllProvider($criteria = array(), $sort = array(), $pageination = false)
	{
		$model = $this->getModel($this->modelName);
		$searchHelper = $this->getSearchHelper($this->searchHelperName, $criteria);
		if($searchHelper)
			$criteria = $searchHelper->generateCriteria();
		return $this->getAllModelProvider($model, $criteria, $sort, $pageination);
	}

	public function getDefault()
	{
		$model = $this->getModel($this->modelName);
		return $model;
	}
	

}