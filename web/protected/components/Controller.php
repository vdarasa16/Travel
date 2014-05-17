<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{

	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout = '//layouts/column1';

	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu = array();

	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs = array();
	private $businessList = array();
	private $modelList = array();
	private $searchHelperlList = array();

	public function getBusiness($businessName)
	{
		if (isset($this->businessList[$businessName]))
			return $this->businessList[$businessName];

		$business = null;
		if (class_exists($businessName))
		{
			$business = new $businessName($this);
			$this->businessList[$businessName] = $business;
		}

		return $business;
	}

	public function getModel($modelName)
	{
		if (isset($this->modelList[$modelName]))
			return $this->modelList[$modelName];

		$model = null;
		if (class_exists($modelName))
		{
			$model = new $modelName();
			$this->modelList[$modelName] = $model;
		}

		return $model;
	}

	public function getSearchHelper($searchHelperName, $parent, $criteria)
	{
		if (isset($this->searchHelperlList[$searchHelperName]))
			return $this->searchHelperlList[$searchHelperName];

		$searchHelper = null;
		if (class_exists($searchHelperName))
		{
			$searchHelper = new $searchHelperName($parent, $criteria);
			$this->searchHelperlList[$searchHelperName] = $searchHelper;
		}

		return $searchHelper;
	}

}