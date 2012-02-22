<?php

/**
 * This is the model class for table "catalog_value_common".
 *
 * The followings are the available columns in table 'catalog_value_common':
 * @property integer $id
 * @property integer $item_id
 * @property integer $parameter_id
 * @property integer $value
 */
class ValueSelectable extends Value {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'catalog_value_common';
    }

    public function rules() {

        return array(
            array('item_id, parameter_id,value', 'numerical', 'integerOnly' => true),
        );
    }

    public function relations() {

        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'item_id' => 'Item',
            'parameter_id' => 'Parameter',
            'selectable_value_id' => 'Selectable Value',
        );
    }

     public function getValue($item_id, Parameter $parameter) {
        if ($parameter->parameter_number_id == 2) {
            if ($model = $this->find(array("condition" => "item_id=:item_id and parameter_id=:parameter_id",
                "params" => array(":item_id" => $item_id, ":parameter_id" => $parameter->parameter_id)))) {
                return $model;
            } else {
                 $parameter->_issetValue=false;
                return false;
            }
        } else if ($parameter->parameter_number_id == 3) {
            $models = $this->getKeyValueArray("id", "value", array("condition" => "item_id=:item_id and parameter_id=:parameter_id",
                "params" => array(":item_id" => $item_id, ":parameter_id" => $parameter->parameter_id)), array());
            if (count($models) > 0) {
                return $models;
            } else {
                 $parameter->_issetValue=false;
                return false;
            }
        }
    }
    
        public function saveValue($attributes, $value_id=null) {
        if (!isset($attributes["value"]) or $attributes["value"] == 0) {
            $attributes["value"]=null;
        }
        var_Dump($attributes);
        parent::saveValue($attributes, $value_id);
    }
    

}