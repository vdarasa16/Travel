<?php

/**
 * This is the model class for table "m_gprs".
 *
 * The followings are the available columns in table 'm_gprs':
 * @property integer $gprs_id
 * @property string $name_th
 * @property string $name_en
 * @property string $latitude
 * @property string $longitude
 * @property string $description
 * @property string $create_date
 * @property string $edit_date
 *
 * The followings are the available model relations:
 * @property MAmphur[] $mAmphurs
 * @property MAttraction[] $mAttractions
 * @property MCountry[] $mCountries
 * @property MProvince[] $mProvinces
 * @property MSector[] $mSectors
 */
class MGprs extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MGprs the static model class
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
		return 'm_gprs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('latitude, longitude, create_date', 'required'),
			array('name_th, name_en', 'length', 'max'=>255),
			array('latitude', 'length', 'max'=>10),
			array('longitude', 'length', 'max'=>25),
			array('description, edit_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('gprs_id, name_th, name_en, latitude, longitude, description, create_date, edit_date', 'safe', 'on'=>'search'),
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
			'amphurs' => array(self::HAS_MANY, 'MAmphur', 'gprs_id'),
			'attractions' => array(self::HAS_MANY, 'MAttraction', 'gprs_id'),
			'countries' => array(self::HAS_MANY, 'MCountry', 'gprs_id'),
			'provinces' => array(self::HAS_MANY, 'MProvince', 'gprs_id'),
			'sectors' => array(self::HAS_MANY, 'MSector', 'gprs_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'gprs_id' => Yii::t('gprs', 'gprs_id'),
			'name_th' => Yii::t('gprs', 'name_th'),
			'name_en' => Yii::t('gprs', 'name_en'),
			'latitude' => Yii::t('gprs', 'latitude'),
			'longitude' => Yii::t('gprs', 'longitude'),
			'description' => Yii::t('gprs', 'description'),
			'create_date' => Yii::t('gprs', 'create_date'),
			'edit_date' => Yii::t('gprs', 'edit_date'),
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