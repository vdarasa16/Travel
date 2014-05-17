<?php

/**
 * This is the model class for table "m_user".
 *
 * The followings are the available columns in table 'm_user':
 * @property integer $userid
 * @property string $usercode
 * @property string $username
 * @property string $password
 * @property string $createdate
 * @property string $lastlogindate
 * @property string $lastchangepassworddate
 *
 * The followings are the available model relations:
 * @property DUserChangePassword $dUserChangePassword
 * @property MUserInfo $mUserInfo
 */
class MUser extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MUser the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'm_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password', 'required'),
			array('usercode', 'length', 'max' => 100),
			array('username, password', 'length', 'max' => 50),
			array('lastlogindate, lastchangepassworddate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userid, usercode, username, password, createdate, lastlogindate, lastchangepassworddate', 'safe', 'on' => 'search'),
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
			'changePasswordDetail' => array(self::HAS_MANY, 'DUserChangePassword', 'userid'),
			'userInfo' => array(self::HAS_ONE, 'MUserInfo', 'userid'),
			'memberRoles' => array(self::MANY_MANY, 'MMemberRole', 'd_member_role_of_user(userid, memberroleid)'),
            'systemRoles' => array(self::MANY_MANY, 'MSystemRole', 'd_system_role_of_user(userid, systemroleid)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'userid' => 'Userid',
			'usercode' => 'Usercode',
			'username' => 'Username',
			'password' => 'Password',
			'createdate' => 'Createdate',
			'lastlogindate' => 'Lastlogindate',
			'lastchangepassworddate' => 'Lastchangepassworddate',
		);
	}
	
	public function beforeSave()
	{
		if($this->isNewRecord)
		{
			$this->createdate = date('Y-m-d H:i:s');
		}
		
		return parent::beforeSave();
	}

	public function validatePassword($password)
	{
		return md5($password) === $this->password;
	}
}