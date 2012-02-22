<?php

class PropertyManager {

    private static $instance;
    private $property_array;

    private function __construct() {
        if ($models = SystemProperty::model()->findAll()) {
            foreach ($models as $model) {
                $this->$model->property_key = $model->property_value;
            }
        }
    }

    private function __set($name, $value) {
        $this->property_array[$name] = $value;
    }

    private function __get($name) {
        try {
            if (!$this->property_array[$name])
                throw new Exception("Ошибка<br/>Настройки  <strong>$name</strong> не существует !");
            return $this->property_array[$name];
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    static public function getProperty($key) {
        if (empty(self::$instance)) {
            self::$instance = new PropertyManager();
            return self::$instance->$key;
        } else {
            return self::$instance->$key;
        }
    }

}

?>
