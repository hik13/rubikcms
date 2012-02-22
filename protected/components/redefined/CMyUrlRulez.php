<?php

class CMyUrlRulez extends CBaseUrlRule {

    static public $chablon = "/^[\w.-]+(?=\/|)/";
    public $reservedUrl = array('search', 'find');

    public function createUrl($manager, $route, $params, $ampersand) {
        
    }

    public static function patchVar($pathInfo) {
        if (preg_match(self::$chablon, $pathInfo, $var)) {
            return $var[0];
        } else {
            return false;
        }
    }

    private function chekLocaleVersion($locale_key) {
        $locale_keys = Locale::getLocaleList();
        if (in_array($locale_key, $locale_keys)) {
            $_GET['locale_id'] = $locale_key;
            return true;
        }
        return false;
    }

    private function chekDomen() {
        $locale_url = Locale::getLocaleList(array("key" => "locale_domen_version", "value" => "locale_code"));
        if ($locale_url[$_SERVER["HTTP_HOST"]]) {
            $_GET['locale_id'] = $locale_url[$_SERVER["HTTP_HOST"]];
        }
    }

    private function parseReserverUrl($reservedWord) {
        if (in_array($reservedWord, $this->reservedUrl)) {
            $_GET["reserved"] = $reservedWord;
            return true;
        } else {
            return false;
        }
    }

    private function parseIdUrl($pathInfo, $var) {
        $textlink = Cache::getDataCashe("all_textlink", Content::model(), "getKeyValueArray", array("content_id", "textlink", array()));
        if (!in_array($var, $textlink)) {
            if ($var1 = self::patchVar($pathInfo)) {
                $pathInfo1 = substr($pathInfo, strlen($var1) + 1);
                return $this->parseIdUrl($pathInfo1, $var . "/" . $var1);
            } else {
                return false;
            }
        } else {
            $_GET['id'] = $var;
            $this->parseKeyValueUrl($pathInfo);
            return true;
        }
    }

    private function parseKeyValueUrl($pathInfo) {
        if (preg_match("(([a-zA-Z0-9._-]*)/([a-zA-Z0-9._-]*))", $pathInfo, $keyValueUrl)) {
            $_GET[$keyValueUrl[1]] = $keyValueUrl[2];
            $after = substr($pathInfo, strlen($keyValueUrl[0]) + 1);
            if ($after) {
                $this->parseKeyValueUrl($after);
            }
        }
    }

    public function parseUrl($manager, $request, $pathInfo, $rawPathInfo) {
        $this->chekDomen();
        if ($var = self::patchVar($pathInfo)) {
            $pathInfo = substr($pathInfo, strlen($var) + 1);
            if ($this->chekLocaleVersion($var)) {
                if ($var = self::patchVar($pathInfo)) {
                    $pathInfo = substr($pathInfo, strlen($var) + 1);
                }
            }
            if ($var) {
                if ($this->parseReserverUrl($var)) {
                    if ($var = self::patchVar($pathInfo)) {
                        $pathInfo = substr($pathInfo, strlen($var) + 1);
                    }
                }
                if ($var) {
                    if (!$this->parseIdUrl($pathInfo, $var)) {
                        return 'content/404';
                    }
                }
            }
        }
        return 'content/index';
    }

}

?>
