<?php

/**
 * This is the model class for table "m_user_info".
 *
 * The followings are the available columns in table 'm_user_info':
 * @property integer $userid
 * @property string $firstname
 * @property string $midname
 * @property string $lastname
 * @property string $gender
 * @property string $address
 * @property string $phone
 * @property string $mobile
 * @property string $fax
 * @property string $email
 * @property string $description
 * @property string $picture
 * @property string $editdate
 *
 * The followings are the available model relations:
 * @property MUser $user
 */
class MUserInfo extends CActiveRecord
{
	public $fullname;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MUserInfo the static model class
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
		return 'm_user_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userid, firstname, gender, email', 'required'),
			array('userid', 'numerical', 'integerOnly'=>true),
			array('firstname, midname, lastname, picture', 'length', 'max'=>250),
			array('gender', 'length', 'max'=>1),
			array('phone, mobile, fax', 'length', 'max'=>50),
			array('email', 'length', 'max'=>100),
			array('address, description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userid, firstname, midname, lastname, gender, address, phone, mobile, fax, email, description, picture, editdate', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'MUser', 'userid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'userid' => 'Userid',
			'firstname' => 'Firstname',
			'midname' => 'Midname',
			'lastname' => 'Lastname',
			'gender' => 'Gender',
			'address' => 'Address',
			'phone' => 'Phone',
			'mobile' => 'Mobile',
			'fax' => 'Fax',
			'email' => 'Email',
			'description' => 'Description',
			'picture' => 'Picture',
			'editdate' => 'Edit Date'
		);
	}
	
	public function afterFind()
	{
		$this->fullname = trim(trim($this->firstname . ' ' . $this->midname) . ' ' . $this->lastname);
		return parent::afterFind();
	}
}