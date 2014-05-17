<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="language" content="en" />

		<!-- blueprint CSS framework -->
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
		<!--[if lt IE 8]>
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
		<![endif]-->

		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/base.css" />

		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	</head>

	<body>

		<div class="container" id="page">

			<div id="header">
				<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
			</div><!-- header -->


				<?php
//				$this->widget('zii.widgets.CMenu', array(
//					'items' => array(
//						array('label' => 'Home', 'url' => array('/site/index')),
//						array('label' => 'System', 'items' => array(
//								array('label' => 'User', 'url' => array('/user/manageuser')),
//						)),
//						array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
//						array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
//					),
//				));

				$menuItem = array();
				$menuItem[] = array('label' => 'Home', 'url' => array('/site/index'));
				$menuItem[] = array('label' => 'System', 'items' => array(
						array('label' => 'User', 'url' => array('/user/manageuser')),
						array('label' => 'User', 'url' => array('/user/manageuser')),
						));
				$menuItem[] = array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest);
				$menuItem[] = array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest);

				$this->widget('application.extensions.mbmenu.MbMenuCustom', array('items' => $menuItem));
				?>

			<div class="background <?php echo Yii::app()->controller->getAction()->getId(); ?>">
				<!-- breadcrumbs -->
				<?php if (isset($this->breadcrumbs)): ?>
					<?php
					$this->widget('zii.widgets.CBreadcrumbs', array(
						'links' => $this->breadcrumbs,
					));
					?>
				<?php endif ?>

				<?php echo $content; ?>
			</div>

			<div id="footer">
				Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
				All Rights Reserved.<br/>
				<?php echo Yii::powered(); ?>
			</div><!-- footer -->

		</div><!-- page -->

	</body>
</html>
