<?php

/**
 * This is the model class for table "d_image_province".
 *
 * The followings are the available columns in table 'd_image_province':
 * @property integer $image_id
 * @property string $province_id
 * @property string $title_th
 * @property string $title_en
 * @property string $description_th
 * @property string $description_en
 */
class DImageProvince extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DImageProvince the static model class
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
		return 'd_image_province';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('image_id, province_id, title_th', 'required'),
			array('image_id', 'numerical', 'integerOnly'=>true),
			array('province_id', 'length', 'max'=>50),
			array('title_th, title_en', 'length', 'max'=>512),
			array('description_th, description_en', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('image_id, province_id, title_th, title_en, description_th, description_en', 'safe', 'on'=>'search'),
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
			'image_id' => Yii::t('imageprovince', 'image_id'),
			'province_id' => Yii::t('imageprovince', 'province_id'),
			'title_th' => Yii::t('imageprovince', 'title_th'),
			'title_en' => Yii::t('imageprovince', 'title_en'),
			'description_th' => Yii::t('imageprovince', 'description_th'),
			'description_en' => Yii::t('imageprovince', 'description_en'),
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