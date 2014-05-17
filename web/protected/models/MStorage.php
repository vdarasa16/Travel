<?php

/**
 * This is the model class for table "m_storage".
 *
 * The followings are the available columns in table 'm_storage':
 * @property integer $storage_id
 * @property string $path
 * @property string $thumbnail_path
 * @property integer $current_file_count
 * @property integer $max_file_count
 * @property integer $is_default
 *
 * The followings are the available model relations:
 * @property MImage[] $mImages
 */
class MStorage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MStorage the static model class
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
		return 'm_storage';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('path, thumbnail_path, current_file_count, max_file_count, is_default', 'required'),
			array('current_file_count, max_file_count, is_default', 'numerical', 'integerOnly'=>true),
			array('path, thumbnail_path', 'length', 'max'=>512),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('storage_id, path, thumbnail_path, current_file_count, max_file_count, is_default', 'safe', 'on'=>'search'),
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
			'images' => array(self::HAS_MANY, 'MImage', 'storage_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'storage_id' => Yii::t('storage', 'storage_id'),
			'path' => Yii::t('storage', 'path'),
			'thumbnail_path' => Yii::t('storage', 'thumbnail_path'),
			'current_file_count' => Yii::t('storage', 'current_file_count'),
			'max_file_count' => Yii::t('storage', 'max_file_count'),
			'is_default' => Yii::t('storage', 'is_default'),
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