<?php

/**
 * This is the model class for table "m_country".
 *
 * The followings are the available columns in table 'm_country':
 * @property string $country_id
 * @property string $capital_id
 * @property integer $gprs_id
 * @property integer $map_id
 * @property integer $currency_id
 * @property string $name_th
 * @property string $name_en
 * @property string $location_th
 * @property string $location_en
 * @property string $dominance_th
 * @property string $dominance_en
 * @property string $area
 * @property integer $population
 * @property string $terrain_th
 * @property string $terrain_en
 * @property string $climate_th
 * @property string $climate_en
 * @property string $description_th
 * @property string $description_en
 * @property string $meta_description
 * @property string $meta_keyword
 * @property string $create_date
 * @property string $edit_date
 *
 * The followings are the available model relations:
 * @property MImage[] $mImages
 * @property MLanguage[] $mLanguages
 * @property DNeigboringCountry[] $dNeigboringCountries
 * @property DNeigboringCountry[] $dNeigboringCountries1
 * @property MReference[] $mReferences
 * @property MReligion[] $mReligions
 * @property MProvince $capital
 * @property MCurrency $currency
 * @property MGprs $gprs
 * @property MImage $map
 * @property MProvince[] $mProvinces
 * @property MSeason[] $mSeasons
 * @property MSector[] $mSectors
 */
class MCountry extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MCountry the static model class
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
		return 'm_country';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('country_id, gprs_id, currency_id, name_th, location_th, create_date', 'required'),
			array('gprs_id, map_id, currency_id, population', 'numerical', 'integerOnly'=>true),
			array('country_id, capital_id', 'length', 'max'=>50),
			array('name_th, name_en', 'length', 'max'=>255),
			array('area', 'length', 'max'=>10),
			array('location_en, dominance_th, dominance_en, terrain_th, terrain_en, climate_th, climate_en, description_th, description_en, meta_description, meta_keyword, edit_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('country_id, capital_id, gprs_id, map_id, currency_id, name_th, name_en, location_th, location_en, dominance_th, dominance_en, area, population, terrain_th, terrain_en, climate_th, climate_en, description_th, description_en, meta_description, meta_keyword, create_date, edit_date', 'safe', 'on'=>'search'),
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
			'images' => array(self::MANY_MANY, 'MImage', 'd_image_country(country_id, image_id)'),
			'languages' => array(self::MANY_MANY, 'MLanguage', 'd_language_country(country_id, language_id)'),
			'neigboringCountries' => array(self::HAS_MANY, 'DNeigboringCountry', 'country_id'),
			'references' => array(self::MANY_MANY, 'MReference', 'd_referance_country(country_id, referance_id)'),
			'religions' => array(self::MANY_MANY, 'MReligion', 'd_religion_country(country_id, religion_id)'),
			'capital' => array(self::BELONGS_TO, 'MProvince', 'capital_id'),
			'currency' => array(self::BELONGS_TO, 'MCurrency', 'currency_id'),
			'gprs' => array(self::BELONGS_TO, 'MGprs', 'gprs_id'),
			'map' => array(self::BELONGS_TO, 'MImage', 'map_id'),
			'provinces' => array(self::HAS_MANY, 'MProvince', 'country_id'),
			'seasons' => array(self::HAS_MANY, 'MSeason', 'country_id'),
			'sectors' => array(self::HAS_MANY, 'MSector', 'country_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'country_id' => Yii::t('country', 'country_id'),
			'capital_id' => Yii::t('country', 'capital_id'),
			'gprs_id' => Yii::t('country', 'gprs_id'),
			'map_id' => Yii::t('country', 'map_id'),
			'currency_id' => Yii::t('country', 'currency_id'),
			'name_th' => Yii::t('country', 'name_th'),
			'name_en' => Yii::t('country', 'name_en'),
			'location_th' => Yii::t('country', 'location_th'),
			'location_en' => Yii::t('country', 'location_en'),
			'dominance_th' => Yii::t('country', 'dominance_th'),
			'dominance_en' => Yii::t('country', 'dominance_en'),
			'area' => Yii::t('country', 'area'),
			'population' => Yii::t('country', 'population'),
			'terrain_th' => Yii::t('country', 'terrain_th'),
			'terrain_en' => Yii::t('country', 'terrain_en'),
			'climate_th' => Yii::t('country', 'climate_th'),
			'climate_en' => Yii::t('country', 'climate_en'),
			'description_th' => Yii::t('country', 'description_th'),
			'description_en' => Yii::t('country', 'description_en'),
			'meta_description' => Yii::t('country', 'meta_description'),
			'meta_keyword' => Yii::t('country', 'meta_keyword'),
			'create_date' => Yii::t('country', 'create_date'),
			'edit_date' => Yii::t('country', 'edit_date'),
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