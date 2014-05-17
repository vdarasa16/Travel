<?php

/**
 * This is the model class for table "m_member".
 *
 * The followings are the available columns in table 'm_member':
 * @property integer $member_id
 * @property string $member_code
 * @property string $member_name
 * @property string $password
 * @property string $create_date
 * @property string $last_login_date
 * @property string $last_change_password_date
 *
 * The followings are the available model relations:
 * @property DMemberChangePasswordDetail[] $dMemberChangePasswordDetails
 * @property MAttraction[] $mAttractions
 * @property MFestival[] $mFestivals
 * @property MPosition[] $mPositions
 */
class MMember extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MMember the static model class
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
		return 'm_member';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('member_code, member_name, password, create_date', 'required'),
			array('member_code, member_name', 'length', 'max'=>50),
			array('password', 'length', 'max'=>100),
			array('last_login_date, last_change_password_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('member_id, member_code, member_name, password, create_date, last_login_date, last_change_password_date', 'safe', 'on'=>'search'),
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
			'memberChangePasswordDetails' => array(self::HAS_MANY, 'DMemberChangePasswordDetail', 'member_id'),
			'attractions' => array(self::HAS_MANY, 'MAttraction', 'owner_id'),
			'festivals' => array(self::HAS_MANY, 'MFestival', 'owner_id'),
			'info' => array(self::HAS_ONE, 'MMemberInfo', 'member_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'member_id' => Yii::t('member', 'member_id'),
			'member_code' => Yii::t('member', 'member_code'),
			'member_name' => Yii::t('member', 'member_name'),
			'password' => Yii::t('member', 'password'),
			'create_date' => Yii::t('member', 'create_date'),
			'last_login_date' => Yii::t('member', 'last_login_date'),
			'last_change_password_date' => Yii::t('member', 'last_change_password_date'),
		);
	}
	
	public function beforeSave()
	{
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