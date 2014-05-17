<?php

/**
 * This is the model class for table "d_neigboring_country".
 *
 * The followings are the available columns in table 'd_neigboring_country':
 * @property integer $id
 * @property string $country_id
 * @property string $neigboring_country_id
 * @property string $distance
 *
 * The followings are the available model relations:
 * @property MCountry $country
 * @property MCountry $neigboringCountry
 */
class DNeigboringCountry extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DNeigboringCountry the static model class
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
		return 'd_neigboring_country';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, country_id, neigboring_country_id', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('country_id, neigboring_country_id', 'length', 'max'=>50),
			array('distance', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, country_id, neigboring_country_id, distance', 'safe', 'on'=>'search'),
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
			'country' => array(self::BELONGS_TO, 'MCountry', 'country_id'),
			'neigboringCountry' => array(self::BELONGS_TO, 'MCountry', 'neigboring_country_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('neigboringcountry', 'id'),
			'country_id' => Yii::t('neigboringcountry', 'country_id'),
			'neigboring_country_id' => Yii::t('neigboringcountry', 'neigboring_country_id'),
			'distance' => Yii::t('neigboringcountry', 'distance'),
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