<?php

class CMyController extends CController {

    protected $themepath;
    
    public $defaultAction = 'index';
    public $pageTitle;

    public function init() {
        parent::init();
        Yii::app()->themeManager->setBasePath($_SERVER["DOCUMENT_ROOT"] . $this->themepath);
        Yii::app()->themeManager->setBaseUrl($this->themepath);
        Session::initApplication();
        Translater::setCurrentLocale(Setting::in()->backendLocale);
        if (isset($_GET["clearCache"])) {
            Cache::clearAllCache();
        }
    }

    public function getCache($cache_name, $object, $cache_function, array $params=array()) {
        return Cache::getDataCashe($cache_name, $object, $cache_function, $params);
    }

}
?>