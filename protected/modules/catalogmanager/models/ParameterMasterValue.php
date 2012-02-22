<?php

/**
 * This is the model class for table "catalog_parameter_master_value".
 *
 * The followings are the available columns in table 'catalog_parameter_master_value':
 * @property integer $id
 * @property integer $parameter_id
 * @property integer $master_value_id
 */
class ParameterMasterValue extends CActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'catalog_parameter_master_value';
    }

    public function rules() {

        return array(
            array('parameter_id, master_value_id', 'numerical', 'integerOnly' => true),
        );
    }

    public function relations() {
        return array(
        );
    }

    public function attributeLabels() {
        return array(
        );
    }

}