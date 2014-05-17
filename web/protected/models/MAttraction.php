<?php

/**
 * This is the model class for table "m_attraction".
 *
 * The followings are the available columns in table 'm_attraction':
 * @property string $attraction_id
 * @property integer $owner_id
 * @property string $amphur_id
 * @property integer $category_id
 * @property integer $gprs_id
 * @property integer $map_id
 * @property string $title_th
 * @property string $title_en
 * @property string $opening_day_th
 * @property string $opening_day_en
 * @property string $opening_time
 * @property string $tel
 * @property string $location_th
 * @property string $location_en
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
 * @property MReference[] $mReferences
 * @property MAmphur $amphur
 * @property MCategoryAttraction $category
 * @property MGprs $gprs
 * @property MImage $map
 * @property MMember $owner
 * @property MMonth[] $mMonths
 */
class MAttraction extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MAttraction the static model class
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
		return 'm_attraction';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('attraction_id, amphur_id, category_id, gprs_id, title_th, opening_day_th, opening_day_en, opening_time, tel, overview_th, create_date', 'required'),
			array('owner_id, category_id, gprs_id, map_id', 'numerical', 'integerOnly'=>true),
			array('attraction_id, amphur_id, tel', 'length', 'max'=>50),
			array('title_th, title_en', 'length', 'max'=>255),
			array('opening_day_th, opening_day_en, opening_time', 'length', 'max'=>100),
			array('location_th, location_en, overview_en, full_info_th, full_info_en, description_th, description_en, meta_description, meta_keyword, edit_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('attraction_id, owner_id, amphur_id, category_id, gprs_id, map_id, title_th, title_en, opening_day_th, opening_day_en, opening_time, tel, location_th, location_en, overview_th, overview_en, full_info_th, full_info_en, description_th, description_en, meta_description, meta_keyword, create_date, edit_date', 'safe', 'on'=>'search'),
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
			'images' => array(self::MANY_MANY, 'MImage', 'd_image_attraction(attraction_id, image_id)'),
			'references' => array(self::MANY_MANY, 'MReference', 'd_referance_attraction(attraction_id, referance_id)'),
			'amphur' => array(self::BELONGS_TO, 'MAmphur', 'amphur_id'),
			'category' => array(self::BELONGS_TO, 'MCategoryAttraction', 'category_id'),
			'gprs' => array(self::BELONGS_TO, 'MGprs', 'gprs_id'),
			'map' => array(self::BELONGS_TO, 'MImage', 'map_id'),
			'owner' => array(self::BELONGS_TO, 'MMember', 'owner_id'),
			'months' => array(self::MANY_MANY, 'MMonth', 't_view_attraction(attraction_id, month_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'attraction_id' => Yii::t('attraction', 'attraction_id'),
			'owner_id' => Yii::t('attraction', 'owner_id'),
			'amphur_id' => Yii::t('attraction', 'amphur_id'),
			'category_id' => Yii::t('attraction', 'category_id'),
			'gprs_id' => Yii::t('attraction', 'gprs_id'),
			'map_id' => Yii::t('attraction', 'map_id'),
			'title_th' => Yii::t('attraction', 'title_th'),
			'title_en' => Yii::t('attraction', 'title_en'),
			'opening_day_th' => Yii::t('attraction', 'opening_day_th'),
			'opening_day_en' => Yii::t('attraction', 'opening_day_en'),
			'opening_time' => Yii::t('attraction', 'opening_time'),
			'tel' => Yii::t('attraction', 'tel'),
			'location_th' => Yii::t('attraction', 'location_th'),
			'location_en' => Yii::t('attraction', 'location_en'),
			'overview_th' => Yii::t('attraction', 'overview_th'),
			'overview_en' => Yii::t('attraction', 'overview_en'),
			'full_info_th' => Yii::t('attraction', 'full_info_th'),
			'full_info_en' => Yii::t('attraction', 'full_info_en'),
			'description_th' => Yii::t('attraction', 'description_th'),
			'description_en' => Yii::t('attraction', 'description_en'),
			'meta_description' => Yii::t('attraction', 'meta_description'),
			'meta_keyword' => Yii::t('attraction', 'meta_keyword'),
			'create_date' => Yii::t('attraction', 'create_date'),
			'edit_date' => Yii::t('attraction', 'edit_date'),
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