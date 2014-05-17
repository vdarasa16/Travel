<?php

/**
 * This is the model class for table "m_reference".
 *
 * The followings are the available columns in table 'm_reference':
 * @property integer $referance_id
 * @property string $title_th
 * @property string $title_en
 * @property string $link
 * @property string $create_date
 * @property string $edit_date
 *
 * The followings are the available model relations:
 * @property MAmphur[] $mAmphurs
 * @property MAttraction[] $mAttractions
 * @property MCountry[] $mCountries
 * @property MFestival[] $mFestivals
 * @property MProvince[] $mProvinces
 */
class MReference extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MReference the static model class
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
		return 'm_reference';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title_th, link, create_date', 'required'),
			array('title_th, title_en', 'length', 'max'=>255),
			array('link', 'length', 'max'=>1024),
			array('edit_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('referance_id, title_th, title_en, link, create_date, edit_date', 'safe', 'on'=>'search'),
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
			'amphurs' => array(self::MANY_MANY, 'MAmphur', 'd_referance_amphur(referance_id, amphur_id)'),
			'attractions' => array(self::MANY_MANY, 'MAttraction', 'd_referance_attraction(referance_id, attraction_id)'),
			'countries' => array(self::MANY_MANY, 'MCountry', 'd_referance_country(referance_id, country_id)'),
			'festivals' => array(self::MANY_MANY, 'MFestival', 'd_referance_festival(referance_id, festival_id)'),
			'provinces' => array(self::MANY_MANY, 'MProvince', 'd_referance_province(referance_id, province_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'referance_id' => Yii::t('reference', 'referance_id'),
			'title_th' => Yii::t('reference', 'title_th'),
			'title_en' => Yii::t('reference', 'title_en'),
			'link' => Yii::t('reference', 'link'),
			'create_date' => Yii::t('reference', 'create_date'),
			'edit_date' => Yii::t('reference', 'edit_date'),
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