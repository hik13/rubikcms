<?php

class Session {

    static public function initApplication() {
        self::setIntefaceLocale();
    }

    static private function setIntefaceLocale() {
        if (!empty($_GET['interfaceLocale'])) {
            $backendLocale = $_GET['interfaceLocale'];
        } else if (!$backendLocale=Yii::app()->session["backendLocale"]) {
            $value = CookieManager::getCookie("backendLocale");
            $backendLocale = $value ? $value : Yii::app()->language;
        }
        Yii::app()->session["backendLocale"] = $backendLocale;
        CookieManager::setCookie("backendLocale", $backendLocale);
    }

}

?>
