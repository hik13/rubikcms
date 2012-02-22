<?php

/**
 * @property integer $field_type_id
 * @property string $field_description
 */
class FieldType extends CMyActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'field_type';
    }

    public function rules() {

        return array(
            array('field_description', 'length', 'max' => 256),
            array('field_type_id, field_description', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'property' => array(self::HAS_MANY, 'Fieldproperty', 'field_type_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'field_type_id' => 'Field',
            'field_description' => 'Field Description',
        );
    }

    public function getKeyValueArray($key_index, $value_index, array $params, array $rezult_array=array()) {
        if ($array = parent::getKeyValueArray($key_index, $value_index, $params, $rezult_array)) {
            foreach ($array as $key => $value) {
                $array[$key] = Translater::getDictionary()->$value;
            }
            return $array;
        } else {
            return false;
        }
    }

}