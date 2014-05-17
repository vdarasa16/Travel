<?php

/**
 * This is the model class for table "m_amphur".
 *
 * The followings are the available columns in table 'm_amphur':
 * @property string $amphur_id
 * @property string $province_id
 * @property integer $gprs_id
 * @property integer $map_id
 * @property string $name_th
 * @property string $name_en
 * @property string $zipcode
 * @property string $area
 * @property integer $population
 * @property string $location_th
 * @property string $location_en
 * @property string $slogan
 * @property string $story_th
 * @property string $story_en
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
 * @property DNeigboringAmphur[] $dNeigboringAmphurs
 * @property DNeigboringAmphur[] $dNeigboringAmphurs1
 * @property MReference[] $mReferences
 * @property MGprs $gprs
 * @property MImage $map
 * @property MProvince $province
 * @property MAttraction[] $mAttractions
 * @property MFestival[] $mFestivals
 */
class MAmphur extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MAmphur the static model class
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
		return 'm_amphur';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('amphur_id, province_id, gprs_id, name_th, location_th, overview_th, create_date', 'required'),
			array('gprs_id, map_id, population', 'numerical', 'integerOnly'=>true),
			array('amphur_id, province_id', 'length', 'max'=>50),
			array('name_th, name_en', 'length', 'max'=>255),
			array('zipcode, area', 'length', 'max'=>10),
			array('location_en, slogan, story_th, story_en, overview_en, full_info_th, full_info_en, description_th, description_en, meta_description, meta_keyword, edit_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('amphur_id, province_id, gprs_id, map_id, name_th, name_en, zipcode, area, population, location_th, location_en, slogan, story_th, story_en, overview_th, overview_en, full_info_th, full_info_en, description_th, description_en, meta_description, meta_keyword, create_date, edit_date', 'safe', 'on'=>'search'),
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
			'images' => array(self::MANY_MANY, 'MImage', 'd_image_amphur(amphur_id, image_id)'),
			'neigboringAmphurs' => array(self::HAS_MANY, 'DNeigboringAmphur', 'amphur_id'),
			'references' => array(self::MANY_MANY, 'MReference', 'd_referance_amphur(amphur_id, referance_id)'),
			'gprs' => array(self::BELONGS_TO, 'MGprs', 'gprs_id'),
			'map' => array(self::BELONGS_TO, 'MImage', 'map_id'),
			'province' => array(self::BELONGS_TO, 'MProvince', 'province_id'),
			'attractions' => array(self::HAS_MANY, 'MAttraction', 'amphur_id'),
			'festivals' => array(self::HAS_MANY, 'MFestival', 'amphur_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'amphur_id' => Yii::t('amphur', 'amphur_id'),
			'province_id' => Yii::t('amphur', 'province_id'),
			'gprs_id' => Yii::t('amphur', 'gprs_id'),
			'map_id' => Yii::t('amphur', 'map_id'),
			'name_th' => Yii::t('amphur', 'name_th'),
			'name_en' => Yii::t('amphur', 'name_en'),
			'zipcode' => Yii::t('amphur', 'zipcode'),
			'area' => Yii::t('amphur', 'area'),
			'population' => Yii::t('amphur', 'population'),
			'location_th' => Yii::t('amphur', 'location_th'),
			'location_en' => Yii::t('amphur', 'location_en'),
			'slogan' => Yii::t('amphur', 'slogan'),
			'story_th' => Yii::t('amphur', 'story_th'),
			'story_en' => Yii::t('amphur', 'story_en'),
			'overview_th' => Yii::t('amphur', 'overview_th'),
			'overview_en' => Yii::t('amphur', 'overview_en'),
			'full_info_th' => Yii::t('amphur', 'full_info_th'),
			'full_info_en' => Yii::t('amphur', 'full_info_en'),
			'description_th' => Yii::t('amphur', 'description_th'),
			'description_en' => Yii::t('amphur', 'description_en'),
			'meta_description' => Yii::t('amphur', 'meta_description'),
			'meta_keyword' => Yii::t('amphur', 'meta_keyword'),
			'create_date' => Yii::t('amphur', 'create_date'),
			'edit_date' => Yii::t('amphur', 'edit_date'),
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