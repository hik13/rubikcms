<?php

/**
 * @property integer $block_id
 * @property string  $block_name
 * @property string  $block_desk
 * @property integer $block_position_id
 * @property string  $block_content
 * @property string  $block_dependies
 * @property integer $block_order
 * @property string  $created
 * @property integer $creator_id
 * @property string  $edition
 * @property integer $editor_id
 * @property integer $block_system
 * @property integer $block_status
 * @property string  $block_system_html
 * @property string  $block_system_php
 */
class Block extends CMyActiveRecord {

    public $array_dependies = array();
    public $block_system_html;
    public $block_system_php;
    protected $field_order = "block_order";

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'block';
    }

    public function rules() {
        return array(
            array('block_name', 'required'),
            array('block_position_id,block_system,block_status', 'numerical', 'integerOnly' => true),
            array('block_name', 'length', 'max' => 128),
            array('block_desk', 'length', 'max' => 512),
            array('block_content,block_system_html,block_system_php', 'safe'),
        );
    }

    public function relations() {
        return array(
            'positionrelation' => array(self::HAS_MANY, 'ContentBlockRelation', 'relation_block_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'block_name' => Translater::getDictionary()->blockmanagermanageBlockName,
            'block_desk' => Translater::getDictionary()->blockmanagermanageBlockDesc,
            'block_position_id' => Translater::getDictionary()->blockmanagermanageBlockPosition,
            'block_content' => Translater::getDictionary()->blockmanagermanageBlockContent,
            'block_dependies' => Translater::getDictionary()->blockmanagermanageBlockDependies,
            "block_system" => Translater::getDictionary()->blockmanagermanageBlockSystem,
            "block_status" => Translater::getDictionary()->blockmanagermanageBlockStatus,
        );
    }

    public function getRelatedPosition($type=0) {
        $models = $this->findAll(array('condition' => 'block_system=:block_system',
            'params' => array(':block_system' => $type),
            'order' => "block_position_id,block_order"));
        $tables = array();
        if (($orients = Blockposition::model()->getKeyValueArray("position_id", "position_desk", array("order" => "position_code"), array(0 => "Без позиции"))) && (!empty($models))) {
            $i = 0;
            foreach ($orients as $key => $orient) {
                $tables[$i]["key"] = $key;
                $tables[$i]["header"] = $orient;
                $tables[$i]["rows"] = $this->returnModelbyKey($models, $key);
                $i++;
            }
        }
        return $tables;
    }

    private function returnModelbyKey(array $models, $key) {
        $array = array();
        foreach ($models as $model) {
            if ($model->block_position_id == $key)
                $array[] = $model;
        }
        return $array;
    }

    public function saveDependies(array $files) {
        if (!empty($files["name"]["block_dependies"])) {
            $arraylink = array();
            foreach ($files["name"]["block_dependies"] as $key => $filename) {
                $arraylink[] = Uploader::uploadfile($filename, $files["tmp_name"]["block_dependies"][$key]);
            }
            foreach ($arraylink as $dependie) {
                if (!in_array($dependie, $this->array_dependies)) {
                    $this->array_dependies[] = $dependie;
                }
            }
            $this->block_dependies = serialize($this->array_dependies);
            $this->save();
        }
        return true;
    }

    public function deleteDependies(array $deldependies) {
        $array = array();
        foreach ($this->array_dependies as $dependie) {
            if (!in_array($dependie, $deldependies)) {
                $array[] = $dependie;
            }
        }
        Uploader::delfile($deldependies);
        $this->array_dependies = $array;
        $this->block_dependies = serialize($this->array_dependies);
        $this->save();
    }

    protected function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $maxparent = Yii::app()->db->createCommand()
                        ->select('max(block_order) as max')
                        ->from($this->tableName())
                        ->where('block_position_id=:block_position_id', array(':block_position_id' => $this->block_position_id))
                        ->queryRow();
                $this->block_order = $maxparent["max"] + 1;
                $this->created = $this->edition = Time::getCurrentTime();
                $this->creator_id = $this->editor_id = Yii::app()->user->id;
            } else {
                $this->edition = Time::getCurrentTime();
                $this->editor_id = Yii::app()->user->id;
            }
             return true;
        }
        else
            return false;
    }

    protected function beforeDelete() {
        if (parent::beforeDelete()) {
            Uploader::delfile(unserialize($this->block_dependies));
            return true;
        }
        else
            return false;
    }

    protected function beforeValidate() {
        if (parent::beforeValidate()) {
            $this->block_content = serialize($this->block_content);
            return true;
        }
        else
            return false;
    }

    protected function afterFind() {
        parent::afterFind();
        if ($this->is_serialized($this->block_dependies))
            $this->array_dependies = unserialize($this->block_dependies);
        else{
            $this->array_dependies = array();
        }
        if ($this->is_serialized($this->block_content)) {
           $this->block_content = unserialize($this->block_content);  
        }      
    }
    
    public function manageRelation(array $post) {
        $relation = Contentblockrelation::model()->getAllRelation($this->block_id);
        $common = array_intersect($post, $relation);
        $add_relation = array_diff($post, $common);
        $del_relation = array_diff($relation, $common);
        foreach ($add_relation as $rel) {
            $relationModel = new ContentBlockRelation();
            $relationModel->relation_content_id = $rel;
            $relationModel->relation_block_id = $this->block_id;
            $relationModel->save();
        }
        foreach ($del_relation as $key => $rel) {
            $relationModel = Contentblockrelation::model()->findByPk($key);
            $relationModel->delete();
        }
    }

}