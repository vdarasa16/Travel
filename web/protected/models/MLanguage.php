<?php

/**
 * This is the model class for table "m_language".
 *
 * The followings are the available columns in table 'm_language':
 * @property integer $language_id
 * @property string $name_th
 * @property string $name_en
 * @property string $description_th
 * @property string $description_en
 * @property string $create_date
 * @property string $edit_date
 *
 * The followings are the available model relations:
 * @property MCountry[] $mCountries
 */
class MLanguage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MLanguage the static model class
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
		return 'm_language';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name_th, create_date', 'required'),
			array('name_th, name_en', 'length', 'max'=>255),
			array('description_th, description_en, edit_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('language_id, name_th, name_en, description_th, description_en, create_date, edit_date', 'safe', 'on'=>'search'),
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
			'countries' => array(self::MANY_MANY, 'MCountry', 'd_language_country(language_id, country_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'language_id' => Yii::t('language', 'language_id'),
			'name_th' => Yii::t('language', 'name_th'),
			'name_en' => Yii::t('language', 'name_en'),
			'description_th' => Yii::t('language', 'description_th'),
			'description_en' => Yii::t('language', 'description_en'),
			'create_date' => Yii::t('language', 'create_date'),
			'edit_date' => Yii::t('language', 'edit_date'),
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