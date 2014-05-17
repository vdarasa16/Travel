<?php

/**
 * This is the model class for table "m_member_permission".
 *
 * The followings are the available columns in table 'm_member_permission':
 * @property integer $permissoin_id
 * @property integer $parent_id
 * @property string $code
 * @property string $name_th
 * @property string $name_en
 * @property string $extradata
 * @property integer $void
 * @property string $create_date
 * @property string $edit_date
 *
 * The followings are the available model relations:
 * @property MGroupPermission[] $mGroupPermissions
 * @property MMemberPermission $parent
 * @property MMemberPermission[] $mMemberPermissions
 */
class MMemberPermission extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MMemberPermission the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'm_member_permission';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, name_th, create_date', 'required'),
			array('parent_id, void', 'numerical', 'integerOnly'=>true),
			array('code, name_th, name_en, extradata', 'length', 'max'=>100),
			array('edit_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('permissoin_id, parent_id, code, name_th, name_en, extradata, void, create_date, edit_date', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'groupPermissions' => array(self::MANY_MANY, 'MGroupPermission', 'd_group_permission(permission_id, group_id)'),
			'parent' => array(self::BELONGS_TO, 'MMemberPermission', 'parent_id'),
			'memberPermissions' => array(self::HAS_MANY, 'MMemberPermission', 'parent_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'permissoin_id' => Yii::t('memberpermission', 'permissoin_id'),
			'parent_id' => Yii::t('memberpermission', 'parent_id'),
			'code' => Yii::t('memberpermission', 'code'),
			'name_th' => Yii::t('memberpermission', 'name_th'),
			'name_en' => Yii::t('memberpermission', 'name_en'),
			'extradata' => Yii::t('memberpermission', 'extradata'),
			'void' => Yii::t('memberpermission', 'void'),
			'create_date' => Yii::t('memberpermission', 'create_date'),
			'edit_date' => Yii::t('memberpermission', 'edit_date'),
		);
	}
	
	public function beforeSave()
	{
		if($this->isNewRecord)
			$this->create_date = new CDbExpression('NOW()');
		
		$this->edit_date = new CDbExpression('NOW()');
		
		return parent::beforeSave();
	}
	
	public function beforeDelete()
	{
		return parent::beforeDelete();
	}
	
	public function afterFind()
	{
		return parent::afterFind();
	}
	
	public function afterDelete()
	{
		return parent::afterDelete();
	}
}