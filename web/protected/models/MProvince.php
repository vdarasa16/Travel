<?php

/**
 * This is the model class for table "m_province".
 *
 * The followings are the available columns in table 'm_province':
 * @property string $province_id
 * @property string $country_id
 * @property integer $gprs_id
 * @property integer $map_id
 * @property integer $emblem_id
 * @property integer $sector_id
 * @property string $name_th
 * @property string $name_en
 * @property string $location_th
 * @property string $location_en
 * @property string $area
 * @property string $slogan
 * @property string $overview_th
 * @property string $overview_en
 * @property string $full_info_th
 * @property string $full_info_en
 * @property string $description_th
 * @property string $description_en
 * @property string $meta_description
 * @property string $meta_keyword
 * @property string $create_date
 * @property string $edit_date
 *
 * The followings are the available model relations:
 * @property MImage[] $mImages
 * @property DNeigboringProvince[] $dNeigboringProvinces
 * @property DNeigboringProvince[] $dNeigboringProvinces1
 * @property MReference[] $mReferences
 * @property MAmphur[] $mAmphurs
 * @property MCountry[] $mCountries
 * @property MCountry $country
 * @property MImage $emblem
 * @property MGprs $gprs
 * @property MImage $map
 * @property MSector $sector
 */
class MProvince extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MProvince the static model class
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
		return 'm_province';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('province_id, country_id, gprs_id, map_id, emblem_id, name_th, location_th, overview_th, full_info_th, create_date', 'required'),
			array('gprs_id, map_id, emblem_id, sector_id', 'numerical', 'integerOnly'=>true),
			array('province_id, country_id', 'length', 'max'=>50),
			array('name_th, name_en', 'length', 'max'=>255),
			array('area', 'length', 'max'=>10),
			array('location_en, slogan, overview_en, full_info_en, description_th, description_en, meta_description, meta_keyword, edit_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('province_id, country_id, gprs_id, map_id, emblem_id, sector_id, name_th, name_en, location_th, location_en, area, slogan, overview_th, overview_en, full_info_th, full_info_en, description_th, description_en, meta_description, meta_keyword, create_date, edit_date', 'safe', 'on'=>'search'),
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
			'images' => array(self::MANY_MANY, 'MImage', 'd_image_province(province_id, image_id)'),
			'neigboringProvinces' => array(self::HAS_MANY, 'DNeigboringProvince', 'neigboring_province_id'),
			'references' => array(self::MANY_MANY, 'MReference', 'd_referance_province(province_id, referance_id)'),
			'amphurs' => array(self::HAS_MANY, 'MAmphur', 'province_id'),
			'country' => array(self::BELONGS_TO, 'MCountry', 'country_id'),
			'emblem' => array(self::BELONGS_TO, 'MImage', 'emblem_id'),
			'gprs' => array(self::BELONGS_TO, 'MGprs', 'gprs_id'),
			'map' => array(self::BELONGS_TO, 'MImage', 'map_id'),
			'sector' => array(self::BELONGS_TO, 'MSector', 'sector_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'province_id' => Yii::t('province', 'province_id'),
			'country_id' => Yii::t('province', 'country_id'),
			'gprs_id' => Yii::t('province', 'gprs_id'),
			'map_id' => Yii::t('province', 'map_id'),
			'emblem_id' => Yii::t('province', 'emblem_id'),
			'sector_id' => Yii::t('province', 'sector_id'),
			'name_th' => Yii::t('province', 'name_th'),
			'name_en' => Yii::t('province', 'name_en'),
			'location_th' => Yii::t('province', 'location_th'),
			'location_en' => Yii::t('province', 'location_en'),
			'area' => Yii::t('province', 'area'),
			'slogan' => Yii::t('province', 'slogan'),
			'overview_th' => Yii::t('province', 'overview_th'),
			'overview_en' => Yii::t('province', 'overview_en'),
			'full_info_th' => Yii::t('province', 'full_info_th'),
			'full_info_en' => Yii::t('province', 'full_info_en'),
			'description_th' => Yii::t('province', 'description_th'),
			'description_en' => Yii::t('province', 'description_en'),
			'meta_description' => Yii::t('province', 'meta_description'),
			'meta_keyword' => Yii::t('province', 'meta_keyword'),
			'create_date' => Yii::t('province', 'create_date'),
			'edit_date' => Yii::t('province', 'edit_date'),
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