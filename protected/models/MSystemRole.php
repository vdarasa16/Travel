<?php

/**
 * This is the model class for table "m_system_role".
 *
 * The followings are the available columns in table 'm_system_role':
 * @property integer $systemroleid
 * @property string $systemrolecode
 * @property string $systemrolename
 * @property string $description
 * @property integer $createby
 * @property string $createdate
 * @property integer $editby
 * @property string $editdate
 *
 * The followings are the available model relations:
 * @property MUser[] $mUsers
 */
class MSystemRole extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MSystemRole the static model class
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
		return 'm_system_role';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('systemrolecode, systemrolename, createby, createdate', 'required'),
			array('createby, editby', 'numerical', 'integerOnly'=>true),
			array('systemrolecode', 'length', 'max'=>100),
			array('systemrolename', 'length', 'max'=>255),
			array('description, editdate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('systemroleid, systemrolecode, systemrolename, description, createby, createdate, editby, editdate', 'safe', 'on'=>'search'),
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
			'mUsers' => array(self::MANY_MANY, 'MUser', 'd_system_role_of_user(systemroleid, userid)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'systemroleid' => 'Systemroleid',
			'systemrolecode' => 'Systemrolecode',
			'systemrolename' => 'Systemrolename',
			'description' => 'Description',
			'createby' => 'Createby',
			'createdate' => 'Createdate',
			'editby' => 'Editby',
			'editdate' => 'Editdate',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('systemroleid',$this->systemroleid);
		$criteria->compare('systemrolecode',$this->systemrolecode,true);
		$criteria->compare('systemrolename',$this->systemrolename,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('createby',$this->createby);
		$criteria->compare('createdate',$this->createdate,true);
		$criteria->compare('editby',$this->editby);
		$criteria->compare('editdate',$this->editdate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}