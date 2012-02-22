<?php

class UserManagerModule extends CMyModule {

    public $defaultController = "user";

    public function init() {
        parent::init();
        $this->setImport(array(
            'usermanager.models.*',
            'usermanager.components.*',
        ));
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            $controller->punkts = array(
                "usermanager" => array("name" => Translater::getDictionary()->usermanager_name, "action" => $controller->createUrl("/usermanager/user/"), "controller" => array("user"), "access" => $controller->checkAccess("manageUser")),
                "groupmanager" => array("name" => Translater::getDictionary()->groupmanager_name, "action" => $controller->createUrl("/usermanager/grouprole/"), "controller" => array("grouprole"), "access" => $controller->checkAccess("manageGroupRole"))
            );
            return true;
        }
        else
            return false;
    }

}
