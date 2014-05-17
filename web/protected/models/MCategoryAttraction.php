<?php

/**
 * This is the model class for table "m_category_attraction".
 *
 * The followings are the available columns in table 'm_category_attraction':
 * @property integer $category_id
 * @property string $name_th
 * @property string $name_en
 * @property string $description_th
 * @property string $description_en
 * @property string $create_date
 * @property string $edit_date
 *
 * The followings are the available model relations:
 * @property MAttraction[] $mAttractions
 */
class MCategoryAttraction extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MCategoryAttraction the static model class
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
		return 'm_category_attraction';
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
			array('category_id, name_th, name_en, description_th, description_en, create_date, edit_date', 'safe', 'on'=>'search'),
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
			'attractions' => array(self::HAS_MANY, 'MAttraction', 'category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'category_id' => Yii::t('categoryattraction', 'category_id'),
			'name_th' => Yii::t('categoryattraction', 'name_th'),
			'name_en' => Yii::t('categoryattraction', 'name_en'),
			'description_th' => Yii::t('categoryattraction', 'description_th'),
			'description_en' => Yii::t('categoryattraction', 'description_en'),
			'create_date' => Yii::t('categoryattraction', 'create_date'),
			'edit_date' => Yii::t('categoryattraction', 'edit_date'),
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