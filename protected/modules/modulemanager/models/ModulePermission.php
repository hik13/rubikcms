<?php

/**
 * @property integer $permission_id
 * @property string $module_id
 * @property string $access
 * @property string $name
 */
class ModulePermission extends CMyActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'user_permission';
    }

    public function rules() {
        return array(
            array('module_id, access, name', 'safe',),
        );
    }

    public function relations() {

        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'permission_id' => 'Permission',
            'module_id' => 'Module',
            'access' => 'Acces',
            'name' => 'Name',
        );
    }

}