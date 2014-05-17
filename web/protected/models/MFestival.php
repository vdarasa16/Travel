<?php

/**
 * This is the model class for table "m_festival".
 *
 * The followings are the available columns in table 'm_festival':
 * @property string $festival_id
 * @property integer $owner_id
 * @property string $amphur_id
 * @property integer $category_id
 * @property string $title_th
 * @property string $title_en
 * @property string $festival_date_from
 * @property string $festival_date_to
 * @property string $overview_th
 * @property string $overview_en
 * @property string $full_info_th
 * @property string $full_info_en
 * @property string $meta_description
 * @property string $meta_keyword
 * @property string $create_date
 * @property string $edit_date
 *
 * The followings are the available model relations:
 * @property MImage[] $mImages
 * @property MReference[] $mReferences
 * @property MAmphur $amphur
 * @property MCategoryFestival $category
 * @property MMember $owner
 * @property MMonth[] $mMonths
 */
class MFestival extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MFestival the static model class
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
		return 'm_festival';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('festival_id, amphur_id, category_id, title_th, festival_date_from, festival_date_to, overview_th, create_date', 'required'),
			array('owner_id, category_id', 'numerical', 'integerOnly'=>true),
			array('festival_id, amphur_id', 'length', 'max'=>50),
			array('title_th, title_en', 'length', 'max'=>512),
			array('overview_en, full_info_th, full_info_en, meta_description, meta_keyword, edit_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('festival_id, owner_id, amphur_id, category_id, title_th, title_en, festival_date_from, festival_date_to, overview_th, overview_en, full_info_th, full_info_en, meta_description, meta_keyword, create_date, edit_date', 'safe', 'on'=>'search'),
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
			'images' => array(self::MANY_MANY, 'MImage', 'd_image_festival(festival_id, image_id)'),
			'references' => array(self::MANY_MANY, 'MReference', 'd_referance_festival(festival_id, referance_id)'),
			'amphur' => array(self::BELONGS_TO, 'MAmphur', 'amphur_id'),
			'category' => array(self::BELONGS_TO, 'MCategoryFestival', 'category_id'),
			'owner' => array(self::BELONGS_TO, 'MMember', 'owner_id'),
			'months' => array(self::MANY_MANY, 'MMonth', 't_view_festival(festival_id, month_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'festival_id' => Yii::t('festival', 'festival_id'),
			'owner_id' => Yii::t('festival', 'owner_id'),
			'amphur_id' => Yii::t('festival', 'amphur_id'),
			'category_id' => Yii::t('festival', 'category_id'),
			'title_th' => Yii::t('festival', 'title_th'),
			'title_en' => Yii::t('festival', 'title_en'),
			'festival_date_from' => Yii::t('festival', 'festival_date_from'),
			'festival_date_to' => Yii::t('festival', 'festival_date_to'),
			'overview_th' => Yii::t('festival', 'overview_th'),
			'overview_en' => Yii::t('festival', 'overview_en'),
			'full_info_th' => Yii::t('festival', 'full_info_th'),
			'full_info_en' => Yii::t('festival', 'full_info_en'),
			'meta_description' => Yii::t('festival', 'meta_description'),
			'meta_keyword' => Yii::t('festival', 'meta_keyword'),
			'create_date' => Yii::t('festival', 'create_date'),
			'edit_date' => Yii::t('festival', 'edit_date'),
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