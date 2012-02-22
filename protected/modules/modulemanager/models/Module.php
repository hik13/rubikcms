<?php

/**
 * @property string  $module_id
 * @property string  $module_name
 * @property string  $defaultCntrl
 * @property string  $class
 * @property integer $module_order
 */
class Module extends CMyActiveRecord {

    protected $field_order = "module_order";

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'module';
    }

    public function rules() {
        return array(
            array('module_id, module_name,defaultCntrl,class,module_order', 'safe',),
        );
    }

    public function relations() {
        return array(
            'permission' => array(self::HAS_MANY, 'ModulePermission', 'module_id', 'select' => 'permission_id,name,access',),
        );
    }

    public function attributeLabels() {
        return array(
            'module_name' => Translater::getDictionary()->modulmanagerModulName,
           // 'module_system' => Translater::getDictionary()->modulmanagerModulSystem,
            'defaultCntrl' => Translater::getDictionary()->modulmanagerModulDefaultCntrl,
            'class' => Translater::getDictionary()->modulmanagerModulClass,
        );
    }

    protected function clearCache() {
        $this->addToCache(array("permission_" . (strtr($this->defaultCntrl, array("/" => "")))));
        parent::clearCache();
    }

    static public function getModulesConfigFiles() {
        $folder = Yii::app()->getModulePath();
        if (is_dir($folder)) {
            if ($dir = opendir($folder)) {
                while (false !== ($file = readdir($dir))) {
                    if ($file != "." && $file != "..") {
                        $configfile = $folder . "/" . $file . "/config/setting.php";
                        if (is_file($configfile)) {
                            $config[] = require($configfile);
                        }
                    }
                }
                closedir($dir);
            }
        }
        return ($config);
    }

    public function saveModule($modul) {
        $m = new Module();
        $m->attributes = $modul;
        if ($m->save()) {
            foreach ($modul["modulePermission"] as $perm) {
                $permission = new ModulePermission();
                $permission->module_id = $m->module_id;
                $permission->attributes = array("access" => $perm["access"], "name" => $perm["name"]);
                $permission->save();
                unset($permission);
            }
            return $m;
        }
        return false;
    }

    protected function afterDelete() {
        parent::afterDelete();
        ModulHelper::deleteTables($this->class);
        $this->deleteRelation($this->module_id);
    }

    protected function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $maxparent = Yii::app()->db->createCommand()
                        ->select('max(module_order) as max')
                        ->from('module')
                        ->queryRow();
                $this->module_order = $maxparent["max"] + 1;
            }
            return true;
        }
        else
            return false;
    }

}