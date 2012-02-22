<?php

class TranslaterParent {

    private $dictionary;

    public function setter($path) {
        try {
            if (is_file($path)) {

                $array = require $path;
                foreach ($array as $key => $value) {
                    $this->$key = $value;
                }
            } else {
                //  throw new Exception("Файла <strong>" . $path . "</strong> не существует");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function __set($name, $value) {
        $this->dictionary[$name] = $value;
    }

    public function __get($name) {
        try {
            if (!$this->dictionary[$name])
                throw new Exception("Ошибка перевода<br/>Свойства <strong>$name</strong> не существует в данной и базовой языковых версиях");
            return $this->dictionary[$name];
        } catch (Exception $e) {
            //  echo $e->getMessage();
        }
    }

}

class Translater extends TranslaterParent {

    private static $instance;
    private static $currentLocale;
    public static $baseVersion = "en";

    protected function __construct() {
        $this->setter(Yii::app()->basePath . "/messages/" . self::$baseVersion . "/system.php");
        if ((!empty(self::$currentLocale)) and (self::$currentLocale != "en")) {
            $path = Yii::app()->basePath . "/messages/" . self::$currentLocale . "/system.php";
            $this->setter($path);
        }
    }

    static public function setDictionary($pathto, $filename) {
        if (empty(self::$instance)) {
            self::$instance = new Translater();
        }
        self::$instance->setter($pathto . "/" . self::$baseVersion . "/" . $filename . ".php");
        if (self::$baseVersion != self::$currentLocale) {
            $path = $pathto . "/" . self::$currentLocale . "/" . $filename . ".php";
            self::$instance->setter($path);
        }
        return self::$instance;
    }

    static public function getDictionary() {
        if (empty(self::$instance)) {
            return self::$instance = new Translater();
        } else {
            return self::$instance;
        }
    }

    static public function setCurrentLocale($currentLocale) {
        self::$currentLocale = $currentLocale;
    }

}

class FrontTranslater extends TranslaterParent {

    private static $instance;
    private static $currentLocale;
    public static $baseVersion = "en";

    protected function __construct() {
        $this->setter(Yii::app()->basePath . "/messages/" . self::$baseVersion . "/system.php");
        if ((!empty(self::$currentLocale)) and (self::$currentLocale != "en")) {
            $path = Yii::app()->basePath . "/messages/" . self::$currentLocale . "/system.php";
            $this->setter($path);
        }
    }

    static public function setDictionary($pathto, $filename) {
        if (empty(self::$instance)) {
            self::$instance = new FrontTranslater();
        }
        self::$instance->setter($pathto . "/" . self::$baseVersion . "/" . $filename . ".php");

        if (self::$baseVersion != self::$currentLocale) {
            $path = $pathto . "/" . self::$currentLocale . "/" . $filename . ".php";
            self::$instance->setter($path);
        }
        return self::$instance;
    }

    static public function getDictionary() {

        if (empty(self::$instance)) {
            return self::$instance = new FrontTranslater();
        } else {
            return self::$instance;
        }
    }

    static public function setCurrentLocale($currentLocale) {
        self::$currentLocale = $currentLocale;
    }

}

?>
