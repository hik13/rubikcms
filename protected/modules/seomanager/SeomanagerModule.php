<?php

class SeoManagerModule extends CMyModule {


    public $defaultController="seo";
    
    public function init() {
        parent::init();
        $this->setImport(array(
            'seomanager.models.*',
            'seomanager.components.*',
        ));
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        }
        else
            return false;
    }

}
