<?php

/**
 * This is the model class for table "m_season".
 *
 * The followings are the available columns in table 'm_season':
 * @property integer $season_id
 * @property string $country_id
 * @property string $name_th
 * @property string $name_en
 * @property string $description_th
 * @property string $description_en
 * @property string $create_date
 * @property string $edit_date
 *
 * The followings are the available model relations:
 * @property MMonth[] $mMonths
 * @property MCountry $country
 */
class MSeason extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MSeason the static model class
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
		return 'm_season';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('country_id, name_th, create_date', 'required'),
			array('country_id', 'length', 'max'=>50),
			array('name_th, name_en', 'length', 'max'=>255),
			array('description_th, description_en, edit_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('season_id, country_id, name_th, name_en, description_th, description_en, create_date, edit_date', 'safe', 'on'=>'search'),
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
			'months' => array(self::MANY_MANY, 'MMonth', 'd_season_month(season_id, month_id)'),
			'country' => array(self::BELONGS_TO, 'MCountry', 'country_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'season_id' => Yii::t('season', 'season_id'),
			'country_id' => Yii::t('season', 'country_id'),
			'name_th' => Yii::t('season', 'name_th'),
			'name_en' => Yii::t('season', 'name_en'),
			'description_th' => Yii::t('season', 'description_th'),
			'description_en' => Yii::t('season', 'description_en'),
			'create_date' => Yii::t('season', 'create_date'),
			'edit_date' => Yii::t('season', 'edit_date'),
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