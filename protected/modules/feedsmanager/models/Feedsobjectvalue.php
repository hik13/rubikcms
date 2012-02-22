<?php

/**
 * @property integer $feed_object_value_id
 * @property integer $feed_object_id
 * @property integer $field_feed_id
 * @property string  $field_feed_value
 */
class FeedsObjectValue extends CMyActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'feeds_object_value';
    }
  
    public function rules() {

        return array(
            array('feed_object_id, field_feed_id', 'numerical', 'integerOnly' => true),
            array('field_feed_value', 'safe'),
            
        );
    }

    public function relations() {
        return array();
    }


    public function attributeLabels() {
        return array(
            'feed_object_value_id' => 'Feeds Object Value',
            'feed_object_id' => 'Object',
            'field_feed_id' => 'Field Feeds',
            'field_feed_value' => 'Field Feeds Value',
        );
    }

    
    protected function afterFind() {
        parent::afterFind();
        if ($this->is_serialized($this->field_feed_value))
            $this->field_feed_value = unserialize($this->field_feed_value);
    }
    
        protected function beforeValidate() {
        if (parent::beforeValidate()) {
            if (is_array($this->field_feed_value)) {
                $this->field_feed_value = serialize($this->field_feed_value);
            }
            return true;
        } else
            return false;
    }
    

    
    
    
    protected function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                
            } else {
                if ($model = $this->findByPk($this->feed_object_value_id)) {
                    $field=Fieldfeeds::model()->findByPk($this->field_feed_id);
                    $this->field_feed_value=$field->checkValues($model,$this);
                }
            }
            return true;
        }
        else
            return false;
    }

    protected function beforeDelete() {
        if (parent::beforeDelete()) {
            if (is_file($_SERVER['DOCUMENT_ROOT'] . $this->field_feed_value)) {
                unlink($_SERVER['DOCUMENT_ROOT'] . $this->field_feed_value);
            }
            return true;
        }
        else
            return false;
    }
	


}