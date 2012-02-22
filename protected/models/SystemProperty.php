<?php

/**
 * The followings are the available columns in table 'system_property':
 * @property integer $property_id
 * @property string $property_key
 * @property string $property_value
 */
class SystemProperty extends CMyActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }
  
    public function tableName() {
        return 'system_property';
    }

    public function rules() {
        return array(
            array('property_key', 'length', 'max' => 128),
            array('property_id, property_key, property_value', 'safe', 'on' => 'search'),
        );
    }

    static public function setSetting($key, $value) {
        if (!$model = SystemProperty::model()->find('property_key=:key', array(":key" => $key))) {
            $model = new SystemProperty;
            $model->property_key = $key;
        }
        $model->property_value = $value;
        if ($model->save()) {
            return $model;
        } else {
            return false;
        }
    }

}