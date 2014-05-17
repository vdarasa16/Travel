<?php

/**
 * This is the model class for table "m_religion".
 *
 * The followings are the available columns in table 'm_religion':
 * @property integer $religion_id
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
class MReligion extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MReligion the static model class
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
		return 'm_religion';
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
			array('religion_id, name_th, name_en, description_th, description_en, create_date, edit_date', 'safe', 'on'=>'search'),
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
			'countries' => array(self::MANY_MANY, 'MCountry', 'd_religion_country(religion_id, country_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'religion_id' => Yii::t('religion', 'religion_id'),
			'name_th' => Yii::t('religion', 'name_th'),
			'name_en' => Yii::t('religion', 'name_en'),
			'description_th' => Yii::t('religion', 'description_th'),
			'description_en' => Yii::t('religion', 'description_en'),
			'create_date' => Yii::t('religion', 'create_date'),
			'edit_date' => Yii::t('religion', 'edit_date'),
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