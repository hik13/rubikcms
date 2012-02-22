<?php

/**
 * This is the model class for table "catalog_value_boolean".
 *
 * The followings are the available columns in table 'catalog_value_boolean':
 * @property integer $id
 * @property integer $item_id
 * @property integer $parameter_id
 * @property integer $value
 */
class ValueBoolean extends Value {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'catalog_value_boolean';
    }

    public function rules() {
        return array(
            array('item_id, parameter_id, value', 'numerical', 'integerOnly' => true),
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
            'value' => 'Value',
        );
    }

    protected function beforeValidate() {
        if (parent::beforeValidate()) {
            if ($this->isNewRecord) {
                if ($this->value == 0) {
                    return false;
                }
                return true;
            } else {
                if ($this->value == 0) {
                    $this->delete();
                }
            }
        }
        else
            return false;
    }

    public function getValue($item_id, Parameter $parameter) {
        if ($model = $this->find(array("condition" => "item_id=:item_id and parameter_id=:parameter_id",
            "params" => array(":item_id" => $item_id, ":parameter_id" => $parameter->parameter_id)))) {
            return $model;
        } else {
            $parameter->_issetValue=false;
            return false;
        }
    }

}