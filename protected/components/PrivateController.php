<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class PrivateController extends Controller
{
	
	public $layout='//layouts/column1';
	
	public function init()
	{
		return parent::init();
	}
	
	public function checkPermission()
	{
		
	}
}