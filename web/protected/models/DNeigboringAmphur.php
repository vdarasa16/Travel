<?php

/**
 * This is the model class for table "d_neigboring_amphur".
 *
 * The followings are the available columns in table 'd_neigboring_amphur':
 * @property integer $id
 * @property string $amphur_id
 * @property string $neigboring_amphur_id
 * @property string $distance
 *
 * The followings are the available model relations:
 * @property MAmphur $amphur
 * @property MAmphur $neigboringAmphur
 */
class DNeigboringAmphur extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DNeigboringAmphur the static model class
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
		return 'd_neigboring_amphur';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('amphur_id, neigboring_amphur_id', 'required'),
			array('amphur_id, neigboring_amphur_id', 'length', 'max'=>50),
			array('distance', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, amphur_id, neigboring_amphur_id, distance', 'safe', 'on'=>'search'),
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
			'amphur' => array(self::BELONGS_TO, 'MAmphur', 'amphur_id'),
			'neigboringAmphur' => array(self::BELONGS_TO, 'MAmphur', 'neigboring_amphur_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('neigboringamphur', 'id'),
			'amphur_id' => Yii::t('neigboringamphur', 'amphur_id'),
			'neigboring_amphur_id' => Yii::t('neigboringamphur', 'neigboring_amphur_id'),
			'distance' => Yii::t('neigboringamphur', 'distance'),
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