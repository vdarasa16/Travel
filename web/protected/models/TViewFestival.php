<?php

/**
 * This is the model class for table "t_view_festival".
 *
 * The followings are the available columns in table 't_view_festival':
 * @property string $festival_id
 * @property integer $month_id
 * @property integer $count
 * @property integer $rating
 * @property string $description_th
 * @property string $description_en
 */
class TViewFestival extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TViewFestival the static model class
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
		return 't_view_festival';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('festival_id, month_id', 'required'),
			array('month_id, count, rating', 'numerical', 'integerOnly'=>true),
			array('festival_id', 'length', 'max'=>50),
			array('description_th, description_en', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('festival_id, month_id, count, rating, description_th, description_en', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'festival_id' => Yii::t('viewfestival', 'festival_id'),
			'month_id' => Yii::t('viewfestival', 'month_id'),
			'count' => Yii::t('viewfestival', 'count'),
			'rating' => Yii::t('viewfestival', 'rating'),
			'description_th' => Yii::t('viewfestival', 'description_th'),
			'description_en' => Yii::t('viewfestival', 'description_en'),
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