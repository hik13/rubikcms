<?php

/**
 * @property integer $relation_id
 * @property integer $relation_content_id
 * @property integer $relation_module_id
 * @property integer $relation_module_object_id
 * @property string  $relation_module_condition
 */
class ContentModuleRelation extends CMyActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'content_module_relation';
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
            'relation_module_id' => 'Relation Module',
            'relation_module_object_id' => 'Relation Module Object',
            'relation_module_condition' => "condition",
        );
    }

    public function getModuleContent($locale_id) {
        if ($model = Module::model()->find('module_id=:module_id', array(':module_id' => $this->relation_module_id))) {
            $folder = strtr($model->defaultCntrl, array("/" => ""));
            Yii::import("application.modules.$folder.components.Viewer", true);
            $object = new Viewer;
            return $object->getRelatedContent($this,$locale_id);
        } else {
            return false;
        }
    }

}