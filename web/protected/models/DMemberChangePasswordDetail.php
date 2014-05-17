<?php

/**
 * This is the model class for table "d_member_change_password_detail".
 *
 * The followings are the available columns in table 'd_member_change_password_detail':
 * @property integer $member_id
 * @property integer $sequence
 * @property string $password
 * @property string $change_password_date
 *
 * The followings are the available model relations:
 * @property MMember $member
 */
class DMemberChangePasswordDetail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DMemberChangePasswordDetail the static model class
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
		return 'd_member_change_password_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('member_id, sequence, password, change_password_date', 'required'),
			array('member_id, sequence', 'numerical', 'integerOnly'=>true),
			array('password', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('member_id, sequence, password, change_password_date', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'member_id' => Yii::t('memberchangepassworddetail', 'member_id'),
			'sequence' => Yii::t('memberchangepassworddetail', 'sequence'),
			'password' => Yii::t('memberchangepassworddetail', 'password'),
			'change_password_date' => Yii::t('memberchangepassworddetail', 'change_password_date'),
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