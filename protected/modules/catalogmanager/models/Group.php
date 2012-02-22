<?php

/**
 * This is the model class for table "catalog_parameter_group".
 *
 * The followings are the available columns in table 'catalog_parameter_group':
 * @property integer $group_id
 * @property integer $group_essence_id
 * @property string  $group_name
 * @property integer $group_order
 * @property integer $group_status
 */
class Group extends CMyActiveRecord {

    static public $i = 0;
    public $temp_group_id;
    static public $group_ids = array();

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'catalog_parameter_group';
    }

    public function rules() {
        return array(
            array('group_essence_id, group_name, group_order', 'required'),
            array('group_essence_id, group_order, group_status,temp_group_id', 'numerical', 'integerOnly' => true),
            array('group_name', 'length', 'max' => 300),
        );
    }

    public function relations() {
        return array(
            'parameters' => array(self::HAS_MANY, 'Parameter', 'parameter_group_id', 'condition' => 'parameter_slave_id is NULL and parameter_joint_id is NULL', 'order' => 'parameters.parameter_order',),
        );
    }

    public function attributeLabels() {
        return array(
            'group_name' => Translater::getDictionary()->catalogmanager_groupName,
            'group_status' => Translater::getDictionary()->catalogmanager_groupStatus,
        );
    }

    protected function afterSave() {
        parent::afterSave();
        $id = $this->isNewRecord ? $this->temp_group_id : $this->group_id;
        self::$group_ids[$id] = $this->group_id;
    }

    protected function beforeDelete() {
        if (parent::beforeDelete()) {
            foreach ($this->parameters as $parameter) {
                $parameter->delete();
            }
            return true;
        }
        else
            return false;
    }

    protected function afterDelete() {
        parent::afterDelete();
        $this->deleteRelation($this->group_id);
    }

    public function groupSave($attributes, $group_id=null) {
        if ($group_id) {
            $group = $this->findByPk($group_id);
            $group->attributes = $attributes;
            if ($group->save()) {
                return $group;
            } else
                return false;
        }
        $this->attributes = $attributes;
        if ($this->save()) {
            return $this;
        } else
            return false;
    }

    protected function beforeValidate() {
        if (parent::beforeValidate()) {
            if ($this->isNewRecord) {
                $maxparent = Yii::app()->db->createCommand()
                        ->select('max(group_order) as max')
                        ->from($this->tableName())
                        ->where('group_essence_id=:group_essence_id', array(':group_essence_id' => $this->group_essence_id))
                        ->queryRow();
                $this->group_order = $maxparent["max"] + 1;
            }
            return true;
        }
        else
            return false;
    }

    public function getGroupId() {
        if ($this->isNewRecord) {
            return $this->temp_group_id = empty($this->temp_group_id) ? Randomizator::get_random_number() : $this->temp_group_id;
        } else {
            return $this->group_id;
        }
    }

}