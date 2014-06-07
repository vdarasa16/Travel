<?php

class UserController extends PrivateController
{
	public function filters()
	{
		return array(
			'accessControl',
		);
	}
	
	public function accessRules()
	{
		return array(
			array('allow',
				'actions' => array(
					'index',
					'manageuser',
				),
				'users' => array('@'),
			),
			array('deny',
				'users' => array('*'),
			),
		);
	}
	
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionManageUser()
	{
		$fsfsdf;
		$bUser = new UserManager($this);
		$user = $bUser->getById();
		$user->scenario = 'search';
		
		$criteria = array();
		if (isset($_REQUEST[get_class($user)]))
			$criteria = $_REQUEST[get_class($user)];

		$arg_output['user'] = $user;
		$arg_output['userRows'] = $bUser->getAllProvider($criteria, array('username' => 'ASC'), true);
		$arg_output['userUsedId'] = array(Yii::app()->user->id);
		$this->render('manageUser', $arg_output);
	}
}