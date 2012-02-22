<?php

/**
 * @property integer $relation_id
 * @property integer $relation_content_id
 * @property integer $relation_block_id
 */
class ContentBlockRelation extends CMyActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'content_block_relation';
    }

    public function rules() {
        return array();
    }

    public function relations() {
        return array();
    }

    public function attributeLabels() {
        return array(
            'relation_id' => 'Relation',
            'relation_content_id' => 'Relation Content',
            'relation_block_id' => 'Relation Block',
        );
    }

    public function getAllRelation($id) {
        return $this->getKeyValueArray("relation_id", "relation_content_id", array("order" => "relation_content_id", "condition" => 'relation_block_id=:relation_block_id', "params" => array(':relation_block_id' => $id)), array());
    }

}