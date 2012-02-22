<?php

class TranslatemanagerModule extends CMyModule {

    
    public $defaultController="translate";
    
    public function init() {
        parent::init();
        $this->setImport(array(
                'translatemanager.models.*',
                'translatemanager.components.*',
        ));
    }
    
    public function beforeControllerAction($controller, $action) {
        if(parent::beforeControllerAction($controller, $action)) {
            return true;
        }
        else
            return false;
    }



}
