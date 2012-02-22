<?php

class CMyModule extends CWebModule {
    protected $permissionModule;
    public $setting;

    public function init() {
        parent::init();
        $this->setting = ModulHelper::getModuleCongfig($this->getName());
        $this->permissionModule = Cache::getDataCashe("permission_" . $this->getId(), $this, "returnPermission");
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            Translater::setDictionary("{$this->basePath}/messages", $this->id);
            return true;
        }
        else
            return false;
    }
    
    
    public function returnPermission() {
        $array = array();
        if ($model = Module::model()->findByPk($this->setting["module_id"])) {
            $array = ModulePermission::model()->getKeyValueArray("access", "permission_id", array("condition" => 'module_id=:module_id', "params" => array(":module_id" => $this->setting["module_id"])));
            $array["module_id"] = $model->module_id;
        }
        
        return $array;
    }

    public function returnPermissions($key=false) {
        if ($key) {
            return $this->permissionModule[$key];
        }
    }
}

?>
