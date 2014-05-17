<?php

/**
 * This is the model class for table "m_member_info".
 *
 * The followings are the available columns in table 'm_member_info':
 * @property integer $member_id
 * @property integer $position_id
 * @property integer $picture_id
 * @property string $first_name
 * @property string $mid_name
 * @property string $last_name
 * @property string $gender
 * @property string $address
 * @property string $phone
 * @property string $mobile
 * @property string $email
 * @property string $edit_date
 * @property string $description
 */
class MMemberInfo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MMemberInfo the static model class
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
		return 'm_member_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('member_id, position_id, first_name, last_name, gender, email, edit_date', 'required'),
			array('member_id, position_id, picture_id', 'numerical', 'integerOnly'=>true),
			array('first_name, mid_name, last_name, phone, mobile', 'length', 'max'=>50),
			array('gender', 'length', 'max'=>1),
			array('email', 'length', 'max'=>100),
			array('address, description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('member_id, position_id, picture_id, first_name, mid_name, last_name, gender, address, phone, mobile, email, edit_date, description', 'safe', 'on'=>'search'),
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
			'member' => array(self::BELONGS_TO, 'MMember', 'member_id'),
			'position' => array(self::BELONGS_TO, 'MPosition', 'position_id'),
			'image' => array(self::BELONGS_TO, 'MImage', 'picture_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'member_id' => Yii::t('memberinfo', 'member_id'),
			'position_id' => Yii::t('memberinfo', 'position_id'),
			'picture_id' => Yii::t('memberinfo', 'picture_id'),
			'first_name' => Yii::t('memberinfo', 'first_name'),
			'mid_name' => Yii::t('memberinfo', 'mid_name'),
			'last_name' => Yii::t('memberinfo', 'last_name'),
			'gender' => Yii::t('memberinfo', 'gender'),
			'address' => Yii::t('memberinfo', 'address'),
			'phone' => Yii::t('memberinfo', 'phone'),
			'mobile' => Yii::t('memberinfo', 'mobile'),
			'email' => Yii::t('memberinfo', 'email'),
			'edit_date' => Yii::t('memberinfo', 'edit_date'),
			'description' => Yii::t('memberinfo', 'description'),
		);
	}
	
	public function beforeSave()
	{
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