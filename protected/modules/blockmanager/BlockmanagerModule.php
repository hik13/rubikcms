<?php

class BlockManagerModule extends CMyModule {

    public $defaultController = "block";

    public function init() {
        parent::init();
        $this->setImport(array(
            'blockmanager.models.*',
            'blockmanager.components.*',
        ));
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            $controller->punkts = array(
                "block" => array("name" => Translater::getDictionary()->blockmanagerName, "action" => $controller->createUrl("/blockmanager/"), "controller" => array("block"), "access" => $controller->checkAccess("manageBlock")),
                "systemblock" => array("name" => Translater::getDictionary()->blockmanagersystemName, "action" => $controller->createUrl("/blockmanager/blocksystem/"), "controller" => array("blocksystem"), "access" => $controller->checkAccess("manageSystemBlock")),
                "banner" => array("name" => Translater::getDictionary()->bannerModuleName, "action" => $controller->createUrl("/blockmanager/banner/"), "controller" => array("banner"), "access" => $controller->checkAccess("manageBanner")),
                "blockposition" => array("name" => Translater::getDictionary()->blockmanagerpositionName, "action" => $controller->createUrl("/blockmanager/blockposition/"), "controller" => array("blockposition",), "access" => $controller->checkAccess("managePosition")),
            );
            return true;
        }
        else
            return false;
    }

}
