<?php

class Setting {

    public static $instance;
    private $array_setting = array();

    private function __construct() {
        $this->setConfigSetting();
        $this->setSessionSetting();
        $this->setBDSetting();
    }

    public function __set($name, $value) {
        $this->array_setting[$name] = $value;
    }

    public function __get($name) {
        try {
            if (!$this->array_setting[$name])
                throw new Exception("Ошибка <br/>Свойства <strong>$name</strong> не существует");
            return $this->array_setting[$name];
        } catch (Exception $e) {
            //  echo $e->getMessage();
        }
    }

    private function setConfigSetting() {
        foreach (Yii::app()->params as $key => $param) {
            $this->$key = $param;
        }
    }

    private function setSessionSetting() {
        foreach (Yii::app()->session as $key => $session) {
            $this->$key = $session;
        }
    }

    private function setBDSetting() {
        if (!$this->array_setting["notDB"]) {
            $array = SystemProperty::model()->getKeyValueArray("property_key", "property_value", array(), array());
            foreach ($array as $key => $param) {
                $this->$key = $param;
            }
        }
    }

    static public function in() {
        if (empty(self::$instance)) {
            self::$instance = new Setting();
        }
        return self::$instance;
    }

}

?>
