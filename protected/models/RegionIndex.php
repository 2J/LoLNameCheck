<?php

/**
 * This is the model class for table "region_index".
 *
 * The followings are the available columns in table 'region_index':
 * @property integer $id
 * @property string $region_code
 * @property string $description
 * @property string $timezone
 * @property string $timezone_code
 */
class RegionIndex extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'region_index';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('region_code, timezone, timezone_code', 'required'),
			array('region_code, description, timezone, timezone_code', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, region_code, description, timezone, timezone_code', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'region_code' => 'Region Code',
			'description' => 'Description',
			'timezone' => 'Timezone',
			'timezone_code' => 'Timezone Code',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('region_code',$this->region_code,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('timezone',$this->timezone,true);
		$criteria->compare('timezone_code',$this->timezone_code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RegionIndex the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
