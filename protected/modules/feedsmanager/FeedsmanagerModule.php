<?php

class FeedsManagerModule extends CMyModule {

    public $defaultController = "feeds";

    public function init() {
        parent::init();
        $this->setImport(array(
            'feedsmanager.models.*',
            'feedsmanager.components.*',
        ));
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            $controller->punkts = array(
                "feeds" => array("name" => Translater::getDictionary()->feeds_name, "action" => $controller->createUrl("/feedsmanager/"), "controller" => array("feeds", "feedsobject"), "access" => $controller->checkAccess("manageFeeds")),
                "rss" => array("name" => Translater::getDictionary()->feedsrss_name, "action" => $controller->createUrl("/feedsmanager/feedsrss/"), "controller" => array("feedsrss"), "access" => $controller->checkAccess("manageFeedsRss"))
            );
            return true;
        }
        else
            return false;
    }

}
