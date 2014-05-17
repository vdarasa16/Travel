<?php

/**
 * This is the model class for table "d_neigboring_province".
 *
 * The followings are the available columns in table 'd_neigboring_province':
 * @property integer $id
 * @property string $province_id
 * @property string $neigboring_province_id
 * @property string $distance
 *
 * The followings are the available model relations:
 * @property MProvince $neigboringProvince
 * @property MProvince $province
 */
class DNeigboringProvince extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DNeigboringProvince the static model class
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
		return 'd_neigboring_province';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('province_id, neigboring_province_id', 'required'),
			array('province_id, neigboring_province_id', 'length', 'max'=>50),
			array('distance', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, province_id, neigboring_province_id, distance', 'safe', 'on'=>'search'),
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
			'neigboringProvince' => array(self::BELONGS_TO, 'MProvince', 'neigboring_province_id'),
			'province' => array(self::BELONGS_TO, 'MProvince', 'province_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('neigboringprovince', 'id'),
			'province_id' => Yii::t('neigboringprovince', 'province_id'),
			'neigboring_province_id' => Yii::t('neigboringprovince', 'neigboring_province_id'),
			'distance' => Yii::t('neigboringprovince', 'distance'),
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