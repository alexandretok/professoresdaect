<?php

/**
 * This is the model class for table "voto".
 *
 * The followings are the available columns in table 'voto':
 * @property integer $id_voto
 * @property integer $id_professor
 * @property string $voto
 * @property string $ip
 *
 * The followings are the available model relations:
 * @property Professor $idProfessor
 */
class Voto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'voto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_professor, voto, ip', 'required'),
			array('id_professor', 'numerical', 'integerOnly'=>true),
			array('voto, ip', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_voto, id_professor, voto, ip', 'safe', 'on'=>'search'),
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
			'idProfessor' => array(self::BELONGS_TO, 'Professor', 'id_professor'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_voto' => 'Id Voto',
			'id_professor' => 'Id Professor',
			'voto' => 'Voto',
			'ip' => 'Ip',
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

		$criteria->compare('id_voto',$this->id_voto);
		$criteria->compare('id_professor',$this->id_professor);
		$criteria->compare('voto',$this->voto,true);
		$criteria->compare('ip',$this->ip,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Voto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
