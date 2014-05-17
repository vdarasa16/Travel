<?php

abstract  class BusinessInterface
{

	protected $parent;

	public function __construct(& $controller)
	{
		$this->parent = & $controller;
		$this->init();
	}

	function init()
	{
		
	}

	function getModelById($medel, $id = '')
	{
		if ($id == '')
			return $medel;
		else
			return $medel->findByPk($id);
	}

	function getAllModelProvider($model, $criteriaInput = array(), $sort = array(), $pagination = false)
	{
		$criteria = new CDbCriteria;
		foreach ($criteriaInput as $field => $value)
		{
			if (!$this->matchSpecialCriteria($criteria, $field, $value))
			{
				if ($value === false)
					$value = 0;
				$criteria->compare($field, $value);
			}
		}

		$sorting = array();
		foreach ($sort as $field => $value)
			$sorting[] = $field . ' ' . $value;

		if (count($sorting) > 0)
			$sorting = implode(' , ', $sorting);

		if (!is_array($sorting) && $sorting != '')
		{
			$sort = array();
			$sort = array('defaultOrder' => $sorting);
		}

		if ($pagination === true)
		{
			$pagination = array('pageSize' => Yii::app()->user->getState('pageSize'));
		}
		elseif (is_int($pagination))
		{
			$pagination = array('pageSize' => $pagination);
		}

		return new CActiveDataProvider($model, array(
					'criteria' => $criteria,
					'pagination' => $pagination,
					'sort' => $sort,
				));
	}

	function getAllArrayProvider($data, $pagination = false)
	{
		if ($pagination === true)
		{
			$pagination = array('pageSize' => Yii::app()->user->getState('pageSize'));
		}
		elseif (is_int($pagination))
		{
			$pagination = array('pageSize' => $pagination);
		}

		return new CArrayDataProvider($data, array('pagination' => $pagination));
	}

	function matchSpecialCriteria(&$cDbCriteria, $field, $value)
	{
		if (preg_match('/ NOT IN$/', $field))
		{
			$field = str_replace(' NOT IN', '', $field);
			$cDbCriteria->addNotInCondition($field, $value);
			return true;
		}
		elseif (preg_match('/ BETWEEN$/', $field))
		{
			$field = str_replace(' BETWEEN', '', $field);
			$cDbCriteria->addBetweenCondition($field, $value['START'], $value['TO']);
			return true;
		}
		elseif (preg_match('/ FROM/', $field))
		{
			$field = str_replace(' FROM', '', $field);
			$cDbCriteria->compare($field, '>=' . $value);
			return true;
		}
		elseif (preg_match('/ TO/', $field))
		{
			$field = str_replace(' TO', '', $field);
			$cDbCriteria->compare($field, '<=' . $value);
			return true;
		}
		elseif (preg_match('/ LIKE/', $field))
		{
			$field = str_replace(' LIKE', '', $field);
			$cDbCriteria->compare('LOWER(' . $field . ')', strtolower($value), true);
			return true;
		}
		elseif (preg_match('/ OR/', $field))
		{
			$field = str_replace(' OR', '', $field);
			$cDbCriteria->compare($field, $value, false, 'OR');
			return true;
		}

		return false;
	}

	function getRootPath()
	{
		$protectPath = Yii::app()->basePath;
		$rootPath = str_replace('protected', '', $protectPath);

		return $rootPath;
	}

	function saveModel(&$model, $data, $relatedData = array())
	{
		foreach ($data as $field => &$value)
		{
			if ($value === false)
				$value = 0;

			if (is_scalar($value) && !is_bool($value))
				$value = trim($value);

			$model->$field = $value;
		}

		if ($model->validate())
		{
			if ($this->saveModelWithRelated($model, $relatedData))
				return true;
		}

		return false;
	}

	function addModel(&$model, $data, $relatedData = array())
	{
		return $this->saveModel($model, $data, $relatedData);
	}

	function editModel(&$model, $data, $relatedData = array())
	{
		return $this->saveModel($model, $data, $relatedData);
	}

	function deleteModel(&$model)
	{
		return $model->delete();
	}

	function deleteAllModel(&$model, $criteria = array())
	{
		return $model->deleteAllByAttributes($criteria);
	}

	function convertXMLToArray($xml, $multiKey = '')
	{
		if ($xml != '')
		{
			$xmlp = new CSimpleXmlParser();
			$xmlp->setArrayTag($multiKey);
			return $xmlp->xml2array($xml);
		}

		return array();
	}

	function convertXMLsToArray($xmls, $multiKey = '')
	{
		$result = array();
		foreach ($xmls as $index => $xml)
		{
			$array = $this->convertXMLToArray($xml, $multiKey);
			if (is_array($array) && count($array) > 0)
				$result[$index] = $array;
		}

		return $result;
	}

	function convertArrayToXML($xml, $parentKey = 'Root')
	{
		$xmlp = new CSimpleXmlCreator();
		return $xmlp->array2xml($xml, $parentKey);
	}

	function clearDetail($detail)
	{
		if (is_array($detail))
		{
			$result = true;
			foreach ($detail as $model)
			{
				$token = $this->deleteModel($model);
				$result = $result && $token;
			}
			return $result;
		}
		elseif (is_object($detail))
			return $this->deleteModel($detail);
		else
			return false;
	}

	private function saveModelWithRelated(&$model, $relatedData = array())
	{
		$transacted = false;
		try
		{
			if (($model->getDbConnection()->getCurrentTransaction() === null))
			{
				$transacted = true;
				$transaction = $model->getDbConnection()->beginTransaction();
			}

			// Save the main model.
			if (!$model->save(false))
			{
				if ($transacted)
					$transaction->rollback();
				return false;
			}

			// If there is related data, call saveRelated.
			if (!empty($relatedData))
			{
				if (!$this->saveReleted($model, $relatedData))
				{
					if ($transacted)
						$transaction->rollback();
					return false;
				}
			}

			// If transacted, commit the transaction.
			if ($transacted)
				$transaction->commit();
		}
		catch (Exception $ex)
		{
			if ($transacted)
				$transaction->rollback();
			throw $ex;
		}

		return true;
	}

	private function saveReleted(&$model, $relatedData)
	{
		if (empty($relatedData) || (is_array($relatedData) && count($relatedData) == 0))
			return true;

		if ($model->getIsNewRecord())
			throw new CDbException(Yii::t('business', 'Cannot save the related records to the database because the main record is new.'));

		foreach ($relatedData as $relationName => $relationData)
		{
			$thisFkName = '';
			$relatedFkName = '';
			$pivotClassName = '';
			$activeRelation = $model->getActiveRelation($relationName);
			if (!$activeRelation)
				continue;

			if (preg_match('/(.+)\((.+),\s*(.+)\)/', $activeRelation->foreignKey, $matches))
			{
				$thisFkName = $matches[2];
				$relatedFkName = $matches[3];
			}
			else
			{
				$thisFkName = $activeRelation->foreignKey;
			}


			$relation = $model->relations();
			if (isset($relation[$relationName]) && $relation[$relationName][0] == CActiveRecord::HAS_MANY)
			{
				$pivotClassName = $relation[$relationName][1];
			}
			elseif (method_exists($model, 'pivotModels'))
			{
				$pivotClassNames = $model->pivotModels();
				$relation = $model->relations();
				if (!isset($pivotClassNames[$relationName]))
					continue;
				$pivotClassName = $pivotClassNames[$relationName];
			}
			else
				return false;


			$pivotModelStatic = CActiveRecord::model($pivotClassName);
			if ($relatedFkName == '')
			{
				$table = $pivotModelStatic->getMetaData()->tableSchema;
				if (is_string($table->primaryKey))
					return false;
				$pivotPrimaryKey = array_diff($table->primaryKey, array($thisFkName));
				$relatedFkName = array_shift($pivotPrimaryKey);
				if (count($pivotPrimaryKey) > 0)
					throw new CDbException(Yii::t('business', 'Cannot save the related records to the database because the pivot is more primary.'));
			}

			$thisPkValue = $model->getPrimaryKey();
			if (is_array($thisPkValue))
				throw new Exception(Yii::t('giix', 'Composite primary keys are not supported.'));
			$currentRelation = $pivotModelStatic->findAll(new CDbCriteria(array(
						'select' => $relatedFkName,
						'condition' => "$thisFkName = :thisfkvalue",
						'params' => array(':thisfkvalue' => $thisPkValue),
					)));
			$currentMap = array();
			foreach ($currentRelation as $currentRelModel)
			{
				$currentMap[] = $currentRelModel->$relatedFkName;
			}

			$relationDataWithKey = false;
			if (is_array($relationData) && count($relationData) > 0 && is_array($relationData[0]))
			{
				$newMap = extractArrayValue($relationData, $relatedFkName);
				$relationData = makeAssocArray($relationData, $relatedFkName);
				$relationDataWithKey = true;
			}
			else
				$newMap = $relationData;

			$deleteMap = array();
			$insertMap = array();
			if ($newMap !== null)
			{
				foreach ($currentMap as $currentItem)
				{
					if (!in_array($currentItem, $newMap))
						$deleteMap[] = $currentItem;
				}

				foreach ($newMap as $newItem)
				{
					if (!in_array($newItem, $currentMap))
						$insertMap[] = $newItem;
				}
			}
			else
				$deleteMap = $currentMap;

			$insertMap = array_unique($insertMap);
			$deleteMap = array_unique($deleteMap);

			if (empty($deleteMap) && empty($insertMap))
				continue;
			foreach ($deleteMap as &$deleteMapPkValue)
				$deleteMapPkValue = array_merge(array($relatedFkName => $deleteMapPkValue), array($thisFkName => $thisPkValue));
			unset($deleteMapPkValue);
			foreach ($insertMap as &$insertMapPkValue)
			{
				if ($relationDataWithKey)
					$insertMapPkValue = array_merge($relationData[$insertMapPkValue], array($thisFkName => $thisPkValue));
				else
					$insertMapPkValue = array_merge(array($relatedFkName => $insertMapPkValue), array($thisFkName => $thisPkValue));
			}
			unset($insertMapPkValue);

			foreach ($deleteMap as $value)
			{
				$pivotModel = $this->getModelById(CActiveRecord::model($pivotClassName), $value);
				if (!$pivotModel->delete())
				{
					if ($transacted)
						$transaction->rollback();
					return false;
				}
			}

			// Insert the new data.
			foreach ($insertMap as $value)
			{
				$pivotModel = new $pivotClassName();
				if (!$this->saveModel($pivotModel, $value))
				{
					if ($transacted)
						$transaction->rollback();
					return false;
				}
			}
		}

		return true;
	}

	function mergeDefaultArrayValue($default, $new)
	{
		$result = array();

		if (is_array($default))
		{
			if (count($default) > 0)
			{
				foreach ($default as $key => $value)
				{
					if (is_array($new) && isset($new[$key]))
						$result[$key] = $this->mergeDefaultArrayValue($value, $new[$key]);
					elseif (isset($new[$key]))
						$result[$key] = $new[$key];
					else
						$result[$key] = $value;
				}
				return $result;
			}
			else
				return $new;
		}
		else
		{
			if ($new != '' && $new != null)
				return $new;
			else
				return $default;
		}
	}

	function sendMessageBySocket($message, &$output, $host = '', $port = '')
	{
		try
		{

			$bSoket = new SocketManager();
			$bSoket->setDefaultConfig($host, $port);
			return $bSoket->sendMessage($message, $output);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}

	function waitTime($time = 5)
	{
		for ($i = 0; $i < $time; $i++)
			sleep(1);

		return true;
	}

	function setArrayFileMultiple($files)
	{
		$result = array();
		foreach ($files as $name => $datas)
		{
			foreach ($datas as $field => $data)
			{
				if (is_array($data))
				{
					foreach ($data as $index => $value)
					{
						$result[$name][$index][$field] = $value;
					}
				}
			}
		}

		return $result;
	}

	function getRootStorage()
	{
		$rootStorageFolder = Yii::app()->params['rootStorage'];
		if (!is_dir($rootStorageFolder))
			mkdir($rootStorageFolder);

		return $rootStorageFolder;
	}

	function getDataFromService($sql, $sqlCount)
	{
		//$axlInfo = Yii::app()->params['axlInfo'];

		$params = array('sql' => $sql);
		$paramsCount = array('sql' => $sqlCount);

		$client = $this->getAXLClient();
		$response = $client->executeSQLQuery($params);
		$responseCount = $client->executeSQLQuery($paramsCount);

		return $this->convertObjectServiceToArray($response, $responseCount);
	}

	function executeSQLUpdate($sql)
	{
		$params = array('sql' => $sql);
		//$paramsCount = array('sql' => $sqlCount);

		$client = $this->getAXLClient();
		$response = $client->executeSQLUpdate($params);
		return true;
	}

	function doAuthenticateUser($userid, $password)
	{
		$client = $this->getAXLClient();
		$response = $client->doAuthenticateUser(array('userid' => $userid, 'password' => $password));
		$result = convertObjectServiceToArray($response, 1);
		return $result[0]['userAuthenticated'];
	}
	
	function convertObjectServiceToArray($obj, $count)
	{
		$result = array();
		if ($count->return->row->count == 1)
		{
			$result[] = (array) $obj->return->row;
		}
		elseif ($count->return->row->count != 0)
		{
			foreach ($obj->return->row as $row)
			{
				$result[] = (array) $row;
			}
		}

		return $result;
	}

	private function getAXLClient()
	{
		$axlInfo = Yii::app()->params['axlInfo'];
		$client = null;
		try
		{
			$axlserver = sprintf('https://%s:%s/%s/', $axlInfo['axlip'], $axlInfo['axlport'], $axlInfo['axlpath']);
			$client = new SoapClient('webservice/AXLAPI.wsdl', array('trace' => true, 'exceptions' => true, 'location' => $axlserver, 'login' => $axlInfo['axlusername'], 'password' => $axlInfo['axlpassword']));
		}
		catch (Exception $e)
		{
			$this->parent->hasMessage = true;
			$this->parent->message = array('title' => Yii::t('common', 'cannotSynchronizeAxlServerTitle'), 'content' => Yii::t('common', 'cannotSynchronizeAxlServer'));
			return false;
		}

		return $client;
	}
	
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
		$modelRows = $this->getAllExtension($criteria);
		$result = true;
		foreach ($modelRows as $model)
		{
			$token = $this->delete($model);
			$result = $result && $token;
		}
		
		return $result;
	}
	
	abstract function getById($id);
	abstract function getAllProvider($criteria, $sort, $pageination);
	abstract function getDefault();
	

}