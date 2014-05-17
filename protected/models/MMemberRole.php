<?php

/**
 * This is the model class for table "m_member_role".
 *
 * The followings are the available columns in table 'm_member_role':
 * @property integer $memberroleid
 * @property string $memberrolecode
 * @property string $memberrolename
 * @property string $description
 * @property integer $createby
 * @property string $createdate
 * @property integer $editby
 * @property string $editdate
 *
 * The followings are the available model relations:
 * @property MUser[] $mUsers
 */
class MMemberRole extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MMemberRole the static model class
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
		return 'm_member_role';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('memberrolecode, memberrolename, createby, createdate', 'required'),
			array('createby, editby', 'numerical', 'integerOnly'=>true),
			array('memberrolecode', 'length', 'max'=>100),
			array('memberrolename', 'length', 'max'=>255),
			array('description, editdate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('memberroleid, memberrolecode, memberrolename, description, createby, createdate, editby, editdate', 'safe', 'on'=>'search'),
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
			'mUsers' => array(self::MANY_MANY, 'MUser', 'd_member_role_of_user(memberroleid, userid)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'memberroleid' => 'Memberroleid',
			'memberrolecode' => 'Memberrolecode',
			'memberrolename' => 'Memberrolename',
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

		$criteria->compare('memberroleid',$this->memberroleid);
		$criteria->compare('memberrolecode',$this->memberrolecode,true);
		$criteria->compare('memberrolename',$this->memberrolename,true);
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