<?php
$cs = Yii::app()->clientScript;
$cs->registerScriptFile(XHtml::jsUrl('delete_button.js'));

$this->breadcrumbs = array(
	Yii::t('user', 'menuTitle'),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('muser-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1 class="web-header"><?php echo Yii::t('user', 'manageUser'); ?></h1>

<h6 class="menu">
	<?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl . '/images/icons/search.png', Yii::t('common', 'advencedSearch'), array('style' => 'width: 16px; height: 16px;')) . ' ' . Yii::t('common', 'advencedSearch'), 'javascript:void(0);', array('class' => 'search-button', 'style' => 'margin-right:20px;')); ?>

	<?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl . '/images/icons/add.png', Yii::t('user', 'addUser'), array('style' => 'width: 16px; height: 16px;')) . ' ' . Yii::t('user', 'addUser'), Yii::app()->createUrl('user/adduser'), array('style' => 'margin-right:20px;')); ?>
	<?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl . '/images/icons/delete.png', Yii::t('user', 'deleteUser'), array('style' => 'width: 16px; height: 16px;')) . ' ' . Yii::t('user', 'deleteUser'), Yii::app()->createUrl('user/deleteusers'), array('style' => 'margin-right:20px; display: none; float: right;', 'id' => 'delete-group', 'grid' => 'muser-grid')); ?>
</h6>

<div class="contentwrapper">

	<div class="search-form" style="display:none">
		<?php
//		$this->renderPartial('_search', array(
//			'user' => $user,
//			'genderList' => $genderList,
//		));
		?>
	</div><!-- search-form -->

	<?php
	$column = array(
		array(
			'name' => 'usercode',
			'htmlOptions' => array(
				'class' => 'column-name-150',
			),
		),
		array(
			'name' => 'username',
			'htmlOptions' => array(
				'class' => 'column-name-150',
			),
		),
		array(
			'name' => 'name',
			'value' => '$data->userInfo->fullname',
			'htmlOptions' => array(
				'class' => 'column-name-150',
			),
		),
		array(
			'name' => 'address',
			'htmlOptions' => array(
			),
		),
	);
	

		$column[] = array(
			'class' => 'CButtonColumn',
			'template' => '{view} {update} {changepassword}',
			'buttons' => array(
				'view' => array(
					'url' => 'Yii::app()->createUrl("user/viewuser", array("id"=>$data->userid))',
					//'visible' => ($this->permission['actionPermission']['viewuser']) ? 'true' : 'false',
				),
				'update' => array(
					'url' => 'Yii::app()->createUrl("user/edituser", array("id"=>$data->userid))',
					//'visible' => ($this->permission['actionPermission']['edituser']) ? 'true' : 'false',
				),
				'changepassword' => array(
					'url' => 'Yii::app()->createUrl("user/changepassworduser", array("id"=>$data->userid))',
					//'visible' => ($this->permission['actionPermission']['edituser']) ? 'true' : 'false',
					'imageUrl' => Yii::app()->baseUrl . '/images/icons/change-password.png',
				),
			),
		);

	//if ($this->permission['actionPermission']['deleteusers'])
	{
		$column[] = array(
			'class' => 'CCheckBoxColumnCustom',
			'selectableRows' => 2,
			'allClick' => 'checkDeleteButton(\'delete-group\');',
			'id' => 'userid',
			'variableDisabled' => $userUsedId,
			'checkBoxHtmlOptions' => array(
				'onclick' => 'checkDeleteButton(\'delete-group\');',
				'class' => 'delete-button',
			),
		);
	}

	$this->widget('zii.widgets.grid.CGridViewCustom', array(
		'id' => 'muser-grid',
		'dataProvider' => $userRows,
		'columns' => $column,
	));
	?>

</div>