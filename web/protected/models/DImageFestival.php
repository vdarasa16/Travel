<?php

/**
 * This is the model class for table "d_image_festival".
 *
 * The followings are the available columns in table 'd_image_festival':
 * @property integer $image_id
 * @property string $festival_id
 * @property string $title_th
 * @property string $title_en
 * @property string $description_th
 * @property string $description_en
 * @property integer $sequence
 */
class DImageFestival extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DImageFestival the static model class
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
		return 'd_image_festival';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('image_id, festival_id, title_th, sequence', 'required'),
			array('image_id, sequence', 'numerical', 'integerOnly'=>true),
			array('festival_id', 'length', 'max'=>50),
			array('title_th, title_en', 'length', 'max'=>255),
			array('description_th, description_en', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('image_id, festival_id, title_th, title_en, description_th, description_en, sequence', 'safe', 'on'=>'search'),
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
			'image_id' => Yii::t('imagefestival', 'image_id'),
			'festival_id' => Yii::t('imagefestival', 'festival_id'),
			'title_th' => Yii::t('imagefestival', 'title_th'),
			'title_en' => Yii::t('imagefestival', 'title_en'),
			'description_th' => Yii::t('imagefestival', 'description_th'),
			'description_en' => Yii::t('imagefestival', 'description_en'),
			'sequence' => Yii::t('imagefestival', 'sequence'),
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