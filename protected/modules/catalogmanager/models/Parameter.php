<?php

/**
 * This is the model class for table "catalog_parameter".
 *
 * The followings are the available columns in table 'catalog_parameter':
 * @property integer $parameter_id
 * @property integer $parameter_group_id
 * @property integer $parameter_essence_id
 * @property integer $parameter_type_id
 * @property integer $parameter_number_id
 * @property integer $parameter_work_id
 * @property string  $parameter_name
 * @property string  $parameter_short_name
 * @property string  $parameter_description
 * @property integer $parameter_order
 * @property integer $parameter_key_sort
 * @property integer $parameter_primary_sort
 * @property integer $parameter_joint_id
 * @property integer $parameter_slave_id
 * @property integer $parameter_master_value_id
 * @property integer $parameter_dimension_id
 * @property string  $parameter_separator
 */
class Parameter extends CMyActiveRecord {

    static public $i = 0;
    public $boolean;
    public $work_type;
    public $data_type;
    public $number_type;
    public $temp_parameter_id;
    public $parameter_master_value_id;
    public $value;
    protected $_issetValue = true;
    static $parameter_ids;

    public function init() {
        parent::init();
        $this->boolean = array("0" => Translater::getDictionary()->catalogmanager_parameterArrayBooleanNo,
            "1" => Translater::getDictionary()->catalogmanager_parameterArrayBooleanYes);
        $this->work_type = array(
            "1" => Translater::getDictionary()->catalogmanager_parameterArrayWorkTypeNormal,
            "2" => Translater::getDictionary()->catalogmanager_parameterArrayWorkTypeUniting,
            "3" => Translater::getDictionary()->catalogmanager_parameterArrayWorkTypeSubordinates,
        );
        $this->data_type = array(
            "1" => Translater::getDictionary()->catalogmanager_parameterArrayDataTypeTextual,
            "2" => Translater::getDictionary()->catalogmanager_parameterArrayDataTypeNumerical,
            "3" => Translater::getDictionary()->catalogmanager_parameterArrayDataTypeLogical,
        );
        $this->number_type = array(
            "1" => Translater::getDictionary()->catalogmanager_parameterArrayNumberTypeUnique,
            "2" => Translater::getDictionary()->catalogmanager_parameterArrayNumberTypeSelectable,
            "3" => Translater::getDictionary()->catalogmanager_parameterArrayNumberTypeMultiple,
        );
    }

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'catalog_parameter';
    }

    public function getTableSchema() {
        $table = parent::getTableSchema();
        $table->columns['parameter_dimension_id']->isForeignKey = true;
        $table->foreignKeys['parameter_dimension_id'] = array('Dimension', 'dimension_id');
        return $table;
    }

    public function rules() {
        return array(
            array('parameter_essence_id,parameter_group_id,parameter_type_id, parameter_number_id, parameter_work_id, parameter_name', 'required'),
            array('parameter_joint_id,parameter_slave_id,temp_parameter_id,parameter_dimension_id', 'numerical', 'integerOnly' => true),
            array('parameter_key_sort,parameter_primary_sort', 'boolean'),
            array('parameter_name', 'length', 'max' => 300),
            array('parameter_short_name', 'length', 'max' => 100),
            array('parameter_description', 'length', 'max' => 2000),
            array('parameter_separator', 'length', 'max' => 10),
            array('parameter_master_value_id', 'safe'),
        );
    }

    public function relations() {
        return array(
            "group" => array(self::HAS_MANY, 'Parameter', 'parameter_joint_id', 'order' => 'group.parameter_order',),
            "slave" => array(self::HAS_MANY, 'Parameter', 'parameter_slave_id', 'order' => 'slave.parameter_order',),
            "selectable" => array(self::HAS_MANY, 'Selectable', 'id_parameter',),
            "dimension" => array(self::BELONGS_TO, 'Dimension', 'parameter_dimension_id'),
            "multiple_value" => array(self::HAS_MANY, 'ParameterMasterValue', 'parameter_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'parameter_type_id' => Translater::getDictionary()->catalogmanager_parameterDataType,
            'parameter_number_id' => Translater::getDictionary()->catalogmanager_parameterNumberType,
            'parameter_work_id' => Translater::getDictionary()->catalogmanager_parameterWorkType,
            'parameter_name' => Translater::getDictionary()->catalogmanager_parameterName,
            'parameter_short_name' => Translater::getDictionary()->catalogmanager_parameterShortName,
            'parameter_description' => Translater::getDictionary()->catalogmanager_parameterDescription,
            'parameter_key_sort' => Translater::getDictionary()->catalogmanager_parameterKey,
            'parameter_primary_sort' => Translater::getDictionary()->catalogmanager_parameterPrimarySort,
            'parameter_joint_id' => Translater::getDictionary()->catalogmanager_parameterJointParent,
            'parameter_dimension_id' => Translater::getDictionary()->catalogmanager_parameterDimension,
            'parameter_separator' => Translater::getDictionary()->catalogmanager_parameterSeparator,
        );
    }

    public function returnInputByWorkId($item_id=null) {
        $val = ParameterValue::getNewParameterModel($this->parameter_work_id, $this->parameter_type_id, $this->parameter_number_id);
        $this->value = $val->getValue($item_id, &$this);

        switch (in_array($this->parameter_work_id, array(1, 3))) {
            case true : {
                    return $this->returnInputByNumberId();
                };
            case false : {
                    return false;
                };
        }
    }

    private function returnInputByNumberId() {
        switch ($this->parameter_number_id) {
            case 1 : {
                    return Yii::app()->controller->renderPartial("/item/value/inputs/one_input", array("i" => Parameter::$i++, 'parameter' => $this, 'data' => $data, 'value' => $this->value), true);
                };
            case 2 : {
                    if (in_array($this->parameter_type_id, array(1, 2))) {
                        $data = $this->getSelectableValue(array(Translater::getDictionary()->catalogmanager_selectValue));
                    } else {
                        if ($this->parameter_work_id == 3) {
                            $data = array("z" => Translater::getDictionary()->catalogmanager_selectValue,
                                "0" => $this->boolean[0],
                                "1" => $this->boolean[1]);
                        }
                        else
                            $data = $this->boolean;
                    }
                    return Yii::app()->controller->renderPartial("/item/value/inputs/multiple_input", array("i" => Parameter::$i++, 'parameter' => $this, 'data' => $data, 'value' => $this->value), true);
                };
            case 3 : {

                    $data = $this->getSelectableValue(array());
                    return Yii::app()->controller->renderPartial("/item/value/inputs/match_values", array("i" => Parameter::$i++, 'parameter' => $this, 'data' => $data, 'value' => $this->value), true);
                };
        }
    }

    private function getSelectableValue(array $result_array) {
        $model = Selectable::model();
        return $model->getKeyValueArray("id", $model->keys[$this->parameter_type_id], array("order" => $model->keys[$this->parameter_type_id], "condition" => 'id_parameter=:id_parameter', "params" => array(':id_parameter' => $this->parameter_id)), $result_array);
    }

    protected function afterSave() {
        parent::afterSave();
        $id = $this->temp_parameter_id ? $this->temp_parameter_id : $this->parameter_id;
        self::$parameter_ids[$id] = $this->parameter_id;
        if ($this->parameter_slave_id) {
            if (!($this->parameter_master_value_id == null)) {
                if (!is_array($this->parameter_master_value_id)) {
                    $this->parameter_master_value_id = array($this->parameter_master_value_id);
                }
                $this->chekoutMasterValue($this->parameter_master_value_id);
            }
        }
    }

    protected function beforeDelete() {
        if (parent::beforeDelete()) {
            return true;
        }
        else
            return false;
    }

    protected function afterDelete() {
        parent::afterDelete();
        $this->deleteRelation($this->parameter_id);
        if ($val = ParameterValue::getNewParameterModel($this->parameter_work_id, $this->parameter_type_id, $this->parameter_number_id))
            $val->deleteAll(array("condition" => "parameter_id=:parameter_id", "params" => array(":parameter_id" => $this->parameter_id)));
    }

    protected function beforeValidate() {
        if (parent::beforeValidate()) {
            if ($this->isNewRecord) {
                $this->parameter_group_id = !empty(Group::$group_ids[$this->parameter_group_id]) ? Group::$group_ids[$this->parameter_group_id] : $this->parameter_group_id;
                $maxparent = Yii::app()->db->createCommand()
                        ->select('max(parameter_order) as max')
                        ->from($this->tableName())
                        ->where('parameter_group_id=:parameter_group_id', array(':parameter_group_id' => $this->parameter_group_id))
                        ->queryRow();
                $this->parameter_order = $maxparent["max"] + 1;
                if ($this->parameter_joint_id) {
                    $this->parameter_joint_id = self::$parameter_ids[$this->parameter_joint_id];
                } else if ($this->parameter_slave_id) {
                    $this->parameter_slave_id = self::$parameter_ids[$this->parameter_slave_id];
                }
            }
            return true;
        }
        else
            return false;
    }

    public function parameterSave($attributes, $parameter_id=null) {
        if ($parameter_id) {
            $parameter = $this->findByPk($parameter_id);
            $parameter->attributes = $attributes;
            if ($parameter->save()) {
                return $parameter;
            } else
                return false;
        }
        $this->attributes = $attributes;
        if ($this->save()) {
            return $this;
        } else
            return false;
        exit;
    }

    public function issetValue() {
        return $this->_issetValue;
    }

    private function chekoutMasterValue($var_values) {
        $models = ParameterMasterValue::model()->findAll(array("condition" => "parameter_id=:parameter_id", "params" => array(":parameter_id" => $this->parameter_id)));
        foreach ($models as $model) {
            if (in_array($model->master_value_id, $var_values)) {
                $isset_values[] = $model->master_value_id;
            } else {
                $model->delete();
            }
        }
        if (!$isset_values)
            $isset_values = array();
        foreach ($var_values as $id) {
            if (!in_array($id, $isset_values)) {
                $master_value = new ParameterMasterValue();
                $master_value->parameter_id = $this->parameter_id;
                $master_value->master_value_id = Selectable::$temp_ids[$id];
                $master_value->save();
                $master_value = null;
            }
        }
    }

        public function getParameterId() {
        if ($this->isNewRecord) {
            return $this->temp_parameter_id = empty($this->temp_parameter_id) ? Randomizator::get_random_number() : $this->temp_parameter_id;
        } else {
            return $this->parameter_id;
        }
    }
    
    
}