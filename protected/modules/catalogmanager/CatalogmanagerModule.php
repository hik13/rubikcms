<?php

class CatalogManagerModule extends CMyModule {

    public $defaultController = "catalog";

    public function init() {
        parent::init();
        $this->setImport(array(
            'catalogmanager.models.*',
            'catalogmanager.components.*',
        ));
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            $controller->punkts = array(
                "catalog" => array("name" => Translater::getDictionary()->catalogmanager_CatalogName, "action" => $controller->createUrl("/catalogmanager/"), "controller" => array("catalog", "object"), "access" => $controller->checkAccess("manageObject")),
                "dimension" => array("name" => Translater::getDictionary()->catalogmanager_DimensionName, "action" => $controller->createUrl("/catalogmanager/dimension/"), "controller" => array("dimension"), "access" => $controller->checkAccess("manageDimension")),
                "manufacturer" => array("name" => Translater::getDictionary()->catalogmanager_ManufacturerName, "action" => $controller->createUrl("/catalogmanager/manufacturer/"), "controller" => array("manufacturer"), "access" => $controller->checkAccess("manageManufacturer")),
            );
            return true;
        }
        else
            return false;
    }

}
