<?php

/**
 * This is the model class for table "d_referance_festival".
 *
 * The followings are the available columns in table 'd_referance_festival':
 * @property integer $referance_id
 * @property string $festival_id
 */
class DReferanceFestival extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DReferanceFestival the static model class
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
		return 'd_referance_festival';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('referance_id, festival_id', 'required'),
			array('referance_id', 'numerical', 'integerOnly'=>true),
			array('festival_id', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('referance_id, festival_id', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'referance_id' => Yii::t('referancefestival', 'referance_id'),
			'festival_id' => Yii::t('referancefestival', 'festival_id'),
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