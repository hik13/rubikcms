<?php

/**
 * @property integer $id
 * @property integer $id_parameter
 * @property string $selectable_literal
 * @property double $selectable_numerical
 */
class Selectable extends CMyActiveRecord {

    public $value;
    public $keys = array("1" => "selectable_literal", "2" => "selectable_numerical");
    public $temp_id;
    public $type_id;
    static public $temp_ids = array("0" => "0", "1" => "1");

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'catalog_selectable';
    }

    public function rules() {
        return array(
            array("selectable_literal", 'length', 'max' => 256),
            array('selectable_numerical', 'numerical'),
            array('value,temp_id,id_parameter,type_id', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
            "master_value" => array(self::HAS_MANY, 'ParameterMasterValue', 'master_value_id',),
            "value_selctable" => array(self::HAS_MANY, 'ValueSelectable', 'value',),
        );
    }

    public function attributeLabels() {
        return array(
            'selectable_literal' => 'Value',
            'selectable_numerical' => 'Value',
        );
    }

    protected function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->type_id == "1") {
                $this->selectable_literal = $this->value;
            } else if ($this->type_id == "2") {
                $this->selectable_numerical = $this->value;
            }
            return true;
        }
        else
            return false;
    }

    protected function afterSave() {
        parent::afterSave();
        $id = $this->temp_id ? $this->temp_id : $this->id;
        self::$temp_ids[$id] = $this->id;
        $this->selectable_literal;
    }

    protected function afterDelete() {
        parent::afterDelete();
        $this->deleteRelation($this->id);
    }

    public function setValue($type_id) {
        if ($type_id == "1") {
            $this->value = $this->selectable_literal;
        } else if ($type_id == "2") {
            $this->value = $this->selectable_numerical;
        }
    }

    public function getModelID() {
        if ($this->isNewRecord) {
            return Randomizator::get_random_number();
        } else {
            return $this->id;
        }
    }

    public function selectableSave($attributes, $selectable_id=null) {
        if ($selectable_id) {
            $selectable = $this->findByPk($selectable_id);
            $selectable->attributes = $attributes;
            if ($selectable->save()) {
                return $selectable;
            } else
                return false;
        }
        $this->attributes = $attributes;
        if ($this->save()) {
            return $this;
        } else
            return false;
    }

}