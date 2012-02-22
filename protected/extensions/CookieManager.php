<?php

class CookieManager {

    static public $life_time = 31536000; // one year

    public static function getCookie($key) {
        return !empty(Yii::app()->request->cookies[$key]->value) ? Yii::app()->request->cookies[$key]->value : false;
    }

    public static function setCookie($key, $value) {
        if (!$value) {
            unset(Yii::app()->request->cookies[$key]);
            return true;
        }
        if (!$cookie = Yii::app()->request->cookies[$key]) {
            $cookie = new CHttpCookie($key, $value);
        } else {
            $cookie->value = $value;
        }
        $cookie->expire = time() + self::$life_time;
        Yii::app()->request->cookies[$key] = $cookie;
    }
}

?>
