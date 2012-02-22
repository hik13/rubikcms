<?php

/**
 * This is the model class for table "catalog_manufacturer".
 *
 * The followings are the available columns in table 'catalog_manufacturer':
 * @property integer $manufacturer_id
 * @property string $manufacturer_name
 * @property string $manufacturer_letter
 */
class Manufacturer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Manufacturer the static model class
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
		return 'catalog_manufacturer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('manufacturer_name', 'required'),
			array('manufacturer_name', 'length', 'max'=>200),
                        array('manufacturer_letter', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('manufacturer_id, manufacturer_name,manufacturer_letter', 'safe', 'on'=>'search'),
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
			'manufacturer_id' => 'Manufacturer',
			'manufacturer_name' => 'Manufacturer Name',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('manufacturer_id',$this->manufacturer_id);
		$criteria->compare('manufacturer_name',$this->manufacturer_name,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}


           protected function beforeSave() {
            if(parent::beforeSave()) {
                $string=iconv("UTF-8","CP1251",$this->manufacturer_name);
                $first=strtolower(substr($string,0,1));
                $first=iconv("CP1251","UTF-8",$first);
                if($this->isNewRecord) {
                    if (is_numeric($first)) {
                      $this->manufacturer_letter="digit";
                    } else {
                     $this->manufacturer_letter=$first;
                    }
                    return true;
                }
                else {
                   if ($first!=$this->manufacturer_letter) {
                    if (is_numeric($first)) {
                      $this->manufacturer_letter="digit";
                    } else {
                     $this->manufacturer_letter=$first;
                    }
                   }
                    return true;
                }
            }
            else
                return false;
        }


        public function getByLetter($letter) {
            $array = Yii::app()->db->createCommand()
            ->select('manufacturer_id as id,manufacturer_name as name')
            ->from($this->tableName())
            ->where('manufacturer_letter=:letter', array(':letter'=>$letter))
            ->order("manufacturer_name")
            ->queryAll();
         return $array;
       }

        public function getById($id) {
            if ($id) {
            $array = Yii::app()->db->createCommand()
            ->select('manufacturer_name as name')
            ->from($this->tableName())
            ->where('manufacturer_id=:id', array(':id'=>$id))
            ->queryRow();
            }
         return $array["name"];
       }

            public function getSuggest($str) {
            if ($str) {
            $array = Yii::app()->db->createCommand()
                    ->select('manufacturer_id as id,manufacturer_name as name')
                    ->from($this->tableName())      
                    // ->where("MATCH ('manufacturer_name') AGAINST (:str)", array(':str'=>$str))
                    ->where("manufacturer_name like '$str%'")
                    ->limit(10)
                    ->order("manufacturer_name")
                    ->queryAll();
           }
        return $array;

    }


}