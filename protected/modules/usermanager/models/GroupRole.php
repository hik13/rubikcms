<?php

/**
 * @property integer $group_role_id
 * @property string $group_role_name
 * @property string $group_permission
 * @property string $group_desk
 */
class GroupRole extends CMyActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'user_group_role';
    }

    protected function clearCache() {
        $this->addToCache(array("group_{$this->group_role_id}_right"));
        parent::clearCache();
    }

    public function rules() {
        return array(
            array('group_desk , group_role_name', 'required'),
            array('group_desk', 'length', 'max' => 16),
            array('group_role_name', 'length', 'max' => 128),
        );
    }

    public function relations() {
        return array();
    }

    public function attributeLabels() {
        return array(
            'group_role_name' => Translater::getDictionary()->usermanagerGroupRoleName,
            'group_permission' => Translater::getDictionary()->usermanagerGroupRolePermission,
            'group_desk' => Translater::getDictionary()->usermanagerGroupRoleDesk,
        );
    }



    protected function afterFind() {
        parent::afterFind();
        $this->group_permission = unserialize($this->group_permission);
    }

    protected function beforeSave() {
        if (parent::beforeSave()) {
            foreach ($this->group_permission as $key => $modul) {
                if (count($modul["rights"]) > 0) {
                    $array[$key] = $modul;
                }
            }
            $this->group_permission = serialize($array);
            return true;
        }
        else
            return false;
    }

}

