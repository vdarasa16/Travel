<?php

/**
 * This is the model class for table "m_image".
 *
 * The followings are the available columns in table 'm_image':
 * @property integer $image_id
 * @property integer $storage_id
 * @property string $orifinal_file_name
 * @property string $new_file_name
 * @property string $extension
 * @property string $mime_type
 * @property integer $image_size
 *
 * The followings are the available model relations:
 * @property MAmphur[] $mAmphurs
 * @property MAttraction[] $mAttractions
 * @property MCountry[] $mCountries
 * @property MFestival[] $mFestivals
 * @property MProvince[] $mProvinces
 * @property MAmphur[] $mAmphurs1
 * @property MAttraction[] $mAttractions1
 * @property MCountry[] $mCountries1
 * @property MStorage $storage
 * @property MProvince[] $mProvinces1
 * @property MProvince[] $mProvinces2
 */
class MImage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MImage the static model class
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
		return 'm_image';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('storage_id, new_file_name, extension, mime_type, image_size', 'required'),
			array('storage_id, image_size', 'numerical', 'integerOnly'=>true),
			array('orifinal_file_name, new_file_name', 'length', 'max'=>512),
			array('extension', 'length', 'max'=>5),
			array('mime_type', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('image_id, storage_id, orifinal_file_name, new_file_name, extension, mime_type, image_size', 'safe', 'on'=>'search'),
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
			'amphurs' => array(self::MANY_MANY, 'MAmphur', 'd_image_amphur(image_id, amphur_id)'),
			'attractions' => array(self::MANY_MANY, 'MAttraction', 'd_image_attraction(image_id, attraction_id)'),
			'countries' => array(self::MANY_MANY, 'MCountry', 'd_image_country(image_id, country_id)'),
			'festivals' => array(self::MANY_MANY, 'MFestival', 'd_image_festival(image_id, festival_id)'),
			'provinces' => array(self::MANY_MANY, 'MProvince', 'd_image_province(image_id, province_id)'),
			'mapAmphurs' => array(self::HAS_MANY, 'MAmphur', 'map_id'),
			'mapAttractions' => array(self::HAS_MANY, 'MAttraction', 'map_id'),
			'mapCountries' => array(self::HAS_MANY, 'MCountry', 'map_id'),
			'storage' => array(self::BELONGS_TO, 'MStorage', 'storage_id'),
			'emblemProvinces' => array(self::HAS_MANY, 'MProvince', 'emblem_id'),
			'mapProvinces' => array(self::HAS_MANY, 'MProvince', 'map_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'image_id' => Yii::t('image', 'image_id'),
			'storage_id' => Yii::t('image', 'storage_id'),
			'orifinal_file_name' => Yii::t('image', 'orifinal_file_name'),
			'new_file_name' => Yii::t('image', 'new_file_name'),
			'extension' => Yii::t('image', 'extension'),
			'mime_type' => Yii::t('image', 'mime_type'),
			'image_size' => Yii::t('image', 'image_size'),
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