<?php

/**
 * @property integer $field_feed_id
 * @property integer $feed_id
 * @property integer $field_type_id
 */
class Fieldfeeds extends CMyActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'field_feeds';
    }

    public function getTableSchema() {
        $table = parent::getTableSchema();
        $table->columns['field_type_id']->isForeignKey = true;
        $table->foreignKeys['field_type_id'] = array('Fieldtype', 'field_type_id');
        return $table;
    }

    public function rules() {
        return array(
            array('field_type_id,feed_id', 'numerical', 'integerOnly' => true),
        );
    }

    public function relations() {
        return array(
            'fieldstype' => array(self::BELONGS_TO, 'Fieldtype', 'field_type_id'),
            'values' => array(self::HAS_MANY, 'Fieldfeedsvalue', 'field_feed_id'),
            'object_values' => array(self::HAS_MANY, 'Feedsobjectvalue', 'field_feed_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'field_feed_id' => 'Field Feeds',
            'feed_id' => 'Feeds Id',
            'field_type_id' => 'Field Type',
        );
    }

    protected function afterSave() {
        parent::afterSave();
    }


    
    protected function afterDelete() {
        parent::afterDelete();
        $this->deleteRelation($this->field_feed_id);
    }
    
    
    public function getValue($property_key=false, $vID=false) {
        foreach ($this->fieldstype->property as $prop) {
            if ($prop->property_name_id == $property_key) {
                $property_id = $prop->property_id;
                break;
            }
        }
        foreach ($this->values as $val) {
            if ($val->property_id == $property_id) {
                if (!$vID) {
                    return $val->field_value;
                } else {
                    return array($val->field_feed_id => $val->field_value);
                }
            }
        }
        return false;
    }

    public function returnInput($id=false) {
        if ($id) {
            $values = $this->object_values(array('condition' => 'feed_object_id=' . $id));
        }
        return Areas::printArea($this, $values[0]);
    }

   public function checkValues(FeedsObjectValue $modelBase, FeedsObjectValue $modelBeforeSave) {
        switch ($this->field_type_id) {
            case in_array($this->field_type_id, array(1, 2, 3,6)) : {
                    return $modelBeforeSave->field_feed_value;
                }
            case in_array($this->field_type_id, array(4, 5)) : {
                    return $this->checkFile($modelBase->field_feed_value, $modelBeforeSave->field_feed_value);
                }
            case in_array($this->field_type_id, array(7)) : {
                    if (!is_array($modelBase->field_feed_value)) $modelBase->field_feed_value=array();
                    return $this->checkArrayFile($modelBase->field_feed_value, $modelBeforeSave->field_feed_value);
                }
        }
    }
    
   private function checkFile($old_value, $nev_value) {
        if ($nev_value != "") {
            if (($old_value != $nev_value) and is_file(Uploader::getUploadedPatch($old_value))) {
                unlink(Uploader::getUploadedPatch($old_value));
            }
        } else if ($old_value != "") {
            $nev_value = $old_value;
        }
        return $nev_value;
    }
    
    private function checkArrayFile($old_value, $nev_value) {
        $nev_value=unserialize($nev_value);
        $common = array_intersect($old_value, $nev_value);
        $del_relation = array_diff($old_value, $common);
        $sizes = $this->getValue("image_galery_add");
        foreach ($del_relation as $name) {
            foreach ($sizes as $size) {
                if (is_file(Uploader::getUploadedPatch($size["width"] . "_" . $name))) {
                    unlink(Uploader::getUploadedPatch($size["width"] . "_" . $name));
                }
            }
        }
        return serialize($nev_value);
    }
    
   
}