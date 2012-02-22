<?php

abstract class Value extends CMyActiveRecord {

    public $id;
    public $item_id;
    public $parameter_id;
    public $value;

    public function rules() {

        return array(
            array('item_id, parameter_id', 'numerical', 'integerOnly' => true),
            array('value', 'safe'),
        );
    }

    abstract public function getValue($item_id, Parameter $parameter);

    protected function beforeValidate() {
        if (parent::beforeValidate()) {
            if ($this->isNewRecord) {
                if ($this->value == null) {
                    return false;
                }
                return true;
            } else {
                if ($this->value == null) {
                    $this->delete();
                    return false;
                }
                return true;
            }
        }
        else
            return false;
    }

    public function saveValue($attributes, $value_id=null) {
        if (!$value_id) {
            $this->attributes = $attributes;
            $this->save();
        } else {
            $model = $this->findByPk($value_id);
            $model->attributes = $attributes;
            if ($model->value != null) {
                $model->save();
            } else {
                $model->delete();
            }
        }
    }

}

?>
