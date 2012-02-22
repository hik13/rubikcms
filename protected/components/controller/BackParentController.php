<?php

class BackParentController extends CMyController {

    public $layout = '/layouts/backParentControllerLayout';
    protected $themepath="/protected/themes";
    
    public function init() {
        parent::init();
        Yii::app()->setTheme(Setting::in()->adminTheme);
    }

    public function checkAccess($right) {
        if ($this->module) {
            return AccessControlClass::checkAccess($right, $this->module);
        }
    }
    
}

?>
