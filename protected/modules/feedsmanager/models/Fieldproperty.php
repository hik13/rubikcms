<?php

/**
 * @property integer $property_id
 * @property string  $property_name_id
 * @property integer $field_type_id
 * @property string  $property_name
 * @property string  $default_values
 * @property string  $type_input
 * @property integer $order_field
 * @property string  $class
 */
class FieldProperty extends CActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'field_type_property';
    }

    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('field_type_id', 'required'),
            array('field_type_id', 'numerical', 'integerOnly' => true),
            array('property_name', 'length', 'max' => 256),
            array('default_values,property_name_id', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('property_id,property_name_id, field_type_id, property_name, default_values', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'values' => array(self::HAS_MANY, 'Fieldfeedsvalue', 'property_id')
        );
    }

    public function attributeLabels() {
        return array(
            'property_id' => 'Property',
            'field_type_id' => 'Field',
            'property_name' => 'Property Name',
            'default_values' => 'Default Values',
        );
    }

    protected function afterFind() {
        parent::afterFind();
        if ($this->property_name_id == "time_format") {
            $this->default_values = unserialize($this->default_values);
        }
    }

    public function getPropertys($id) {
        return $this->findAll(array('condition' => "field_type_id=:field_type_id",
                    'params' => array(':field_type_id' => $id),
                    'order' => "order_field"));

        /* return  Yii::app()->db->createCommand()
          ->select('field_type_id,property_id as id,property_name as desk,default_values as value,type_input as input,class')
          ->from($this->tableName())
          ->order('order_field')
          ->where('field_type_id=:field_type_id', array(':field_type_id'=>$id))
          ->queryAll(true); */
    }

    public function yiichangeInput($Yiiinputname) {
        $array = array("textField" => "textfield", "checkBox" => "checkbox", "dropDownList" => "select", "getImageSize" => "select","getListData"=>"select");
        return $array[$Yiiinputname];
    }

    public function returnInput($i, $j, $value=false) {
        $z = $this->type_input;
        $inputik=CHtml::hiddenField("FieldFeedsValue[$i][$j][property_id]", $this->property_id, array("rel"=>"FieldFeedsValue[$i]"));
        if ($value) {
            $inputik.= CHtml::hiddenField("FieldFeedsValue[$i][$j][field_id]", $value->field_id);
        }
        $val = $value ? $value->field_value : "";
       
        

        switch ($this->type_input) {
            case (!in_array($this->type_input, array("dropDownList", "getListData","getImageSize"))) : {
                    $inputik.= CHtml::$z("FieldFeedsValue[$i][$j][field_value]", $val);
                    break;
                }
            case "dropDownList" : {
                    $inputik = CHtml::$z("FieldFeedsValue[$i][$j][field_value]", $val, $this->default_values, array());
                    break;
                }
            case "getListData" : {
                    $inputik.= Yii::app()->controller->renderPartial("/feeds/template/add_list_data", array("get_full"=>true,'name'=>"FieldFeedsValue[$i]","value"=>$val), true);
                    break;
                }
            case "getImageSize" : {
                    $inputik.= Yii::app()->controller->renderPartial("/feeds/template/image_galery", array("get_full"=>true,'name'=>"FieldFeedsValue[$i]","value"=>$val), true);
                    break;
                }     
        }
        return array("type" => $this->yiichangeInput($this->type_input),
            "label" => CHtml::label(Translater::getDictionary()->{$this->property_name}, "ch" . $this->property_id),
            "input" => $inputik);
    }

}