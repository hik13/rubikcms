<?php

class ContentManagerModule extends CMyModule {

    public $defaultController = "content";

    public function init() {
        parent::init();
        $this->setImport(array(
            'contentmanager.models.*',
            'contentmanager.components.*',
        ));
       
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            $locals = Locale::getLocaleList(array("key" => "locale_id", "value" => "locale_description"));
            foreach ($locals as $key => $value) {
                $controller->punkts[] = array("name" => $value, "action" => $controller->createUrl("/contentmanager/content/index/", array("locale_id" => $key)), "access" => $controller->checkAccess("manageContent"), "active_t" => false, "controller" => $key);
            }
            $controller->punkts[] = array("name" => Translater::getDictionary()->contentmanager_nonstrukt, "action" => $controller->createUrl("/contentmanager/content/index/", array("nottree" => "")), "access" => $controller->checkAccess("manageContent"), "active_t" => false, "controller" => "nottree");
            $controller->punkts[] = array("name" => Translater::getDictionary()->localemanager_name, "action" => $controller->createUrl("/contentmanager/locale/index/", array()), "access" => $controller->checkAccess("manageLocale"), "controller" => array("locale"));
            return true;
        }
        else
            return false;
    }

}
