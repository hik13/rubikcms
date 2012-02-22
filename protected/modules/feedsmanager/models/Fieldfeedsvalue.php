<?php

/**
 * @property integer $field_id
 * @property integer $field_feed_id
 * @property integer $property_id
 * @property string  $field_value
 */
class FieldFeedsValue extends CMyActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'field_feeds_value';
    }

    public function rules() {
        return array(
            array('field_feed_id, property_id', 'numerical', 'integerOnly' => true),
            array('field_value', 'safe'),
        );
    }

    public function relations() {
        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'field_id' => 'Field',
            'field_feed_id' => 'Field Feeds',
            'property_id' => 'Field Property',
            'field_value' => 'Field Value',
        );
    }

    protected function afterFind() {
        parent::afterFind();
        if ($this->is_serialized($this->field_value))
            $this->field_value = unserialize($this->field_value);
    }

    protected function beforeValidate() {
        if (parent::beforeValidate()) {
            if ($this->field_value) {
                if (is_array($this->field_value)) {
                    $this->field_value = serialize($this->field_value);
                }
            } else {
                $this->field_value = "";
            }
            return true;
        }
        else
            return false;
    }

    
     protected function beforeSave() {
        if (parent::beforeSave()) {

            return true;
        }
        else
            return false;
    }
    
    protected function afterDelete() {
        parent::afterDelete();
        $this->deleteRelation($this->field_id);
    }

}