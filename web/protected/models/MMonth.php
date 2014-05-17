<?php

/**
 * This is the model class for table "m_month".
 *
 * The followings are the available columns in table 'm_month':
 * @property integer $month_id
 * @property string $name_th
 * @property string $name_en
 * @property string $short_name_th
 * @property string $short_name_en
 * @property string $description_th
 * @property string $description_en
 * @property string $create_date
 * @property string $edit_date
 *
 * The followings are the available model relations:
 * @property MSeason[] $mSeasons
 * @property MAttraction[] $mAttractions
 * @property MFestival[] $mFestivals
 */
class MMonth extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MMonth the static model class
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
		return 'm_month';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name_th, short_name_th, create_date', 'required'),
			array('name_th, name_en', 'length', 'max'=>100),
			array('short_name_th, short_name_en', 'length', 'max'=>50),
			array('description_th, description_en, edit_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('month_id, name_th, name_en, short_name_th, short_name_en, description_th, description_en, create_date, edit_date', 'safe', 'on'=>'search'),
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
			'seasons' => array(self::MANY_MANY, 'MSeason', 'd_season_month(month_id, season_id)'),
			'attractions' => array(self::MANY_MANY, 'MAttraction', 't_view_attraction(month_id, attraction_id)'),
			'festivals' => array(self::MANY_MANY, 'MFestival', 't_view_festival(month_id, festival_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'month_id' => Yii::t('month', 'month_id'),
			'name_th' => Yii::t('month', 'name_th'),
			'name_en' => Yii::t('month', 'name_en'),
			'short_name_th' => Yii::t('month', 'short_name_th'),
			'short_name_en' => Yii::t('month', 'short_name_en'),
			'description_th' => Yii::t('month', 'description_th'),
			'description_en' => Yii::t('month', 'description_en'),
			'create_date' => Yii::t('month', 'create_date'),
			'edit_date' => Yii::t('month', 'edit_date'),
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