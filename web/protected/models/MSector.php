<?php

/**
 * This is the model class for table "m_sector".
 *
 * The followings are the available columns in table 'm_sector':
 * @property integer $sector_id
 * @property string $country_id
 * @property integer $gprs_id
 * @property string $name_th
 * @property string $name_en
 * @property string $description_th
 * @property string $description_en
 * @property string $create_date
 * @property string $edit_date
 *
 * The followings are the available model relations:
 * @property MProvince[] $mProvinces
 * @property MCountry $country
 * @property MGprs $gprs
 */
class MSector extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MSector the static model class
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
		return 'm_sector';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('country_id, gprs_id, name_th, create_date', 'required'),
			array('gprs_id', 'numerical', 'integerOnly'=>true),
			array('country_id', 'length', 'max'=>50),
			array('name_th, name_en', 'length', 'max'=>255),
			array('description_th, description_en, edit_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sector_id, country_id, gprs_id, name_th, name_en, description_th, description_en, create_date, edit_date', 'safe', 'on'=>'search'),
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
			'provinces' => array(self::HAS_MANY, 'MProvince', 'sector_id'),
			'country' => array(self::BELONGS_TO, 'MCountry', 'country_id'),
			'gprs' => array(self::BELONGS_TO, 'MGprs', 'gprs_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sector_id' => Yii::t('sector', 'sector_id'),
			'country_id' => Yii::t('sector', 'country_id'),
			'gprs_id' => Yii::t('sector', 'gprs_id'),
			'name_th' => Yii::t('sector', 'name_th'),
			'name_en' => Yii::t('sector', 'name_en'),
			'description_th' => Yii::t('sector', 'description_th'),
			'description_en' => Yii::t('sector', 'description_en'),
			'create_date' => Yii::t('sector', 'create_date'),
			'edit_date' => Yii::t('sector', 'edit_date'),
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