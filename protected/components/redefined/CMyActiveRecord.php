<?php

class CMyActiveRecord extends CActiveRecord {

    protected $cache = array();
    protected $field_order = false;
    protected $order_delemmiter = ";";
    public $status = array();
    protected static $property;

    protected function afterSave() {
        parent::afterSave();
        $this->clearCache();
    }

    protected function afterDelete() {
        parent::afterDelete();
        $this->deleteRelation($this->getPrimaryKey());
        $this->clearCache();
    }

    public function is_serialized($data) {
        return (@unserialize($data) !== false);
    }

    /// get all model to array(key=>value), where key= field $key_index and value=field $value_index 
    /// condition is $params
    /// rezult array - $rezult array
    public function getKeyValueArray($key_index, $value_index, array $params=array(), array $rezult_array=array()) {
        /*       $command = Yii::app()->db->createCommand();
          $array = $command
          ->select("$key_index,$value_index")
          ->from($this->tableName())
          ->queryAll();
          if (count($array) > 0) {
          foreach ($array as $list) {
          $rezult_array[$list[$key_index]] = $list[$value_index];
          }
          } */

        $params["select"] = "$key_index,$value_index";
        if ($models = $this->findAll($params)) {
            foreach ($models as $list) {
                $rezult_array[$list->$key_index] = $list->$value_index;
            }
        }
        return $rezult_array;
    }

    protected function deleteRelation($id) {
        $relations = $this->relations();
        foreach ($relations as $relation) {
            if ($relation[0] == self::HAS_MANY) {
                $models = $relation[1]::model()->findAll($relation[2] . "=?", Array($id));
                foreach ($models as $model) {
                    $model->delete();
                }
            }
        }
    }

    protected function clearCache() {
        Cache::deleteCache($this->cache);
    }

    protected function addToCache(array $cacheIDS) {
        foreach ($cacheIDS as $key => $value) {
            $this->cache[] = $value;
        }
    }

    public static function getCache($cache_name, $object, $cache_function, array $params=array()) {
        return Cache::getDataCashe($cache_name, $object, $cache_function, $params);
    }

    public function getSetting($setting_key) {
        return Setting::in()->$setting_key;
    }

    public function setProperty($setting_key, $setting_value) {
        SystemProperty::setSetting($setting_key, $setting_value);
    }

    public function setOrder($order) {
        if (is_string($order)) {
            $order_array = explode($this->order_delemmiter, $order);
            foreach ($order_array as $key => $id) {
                if ($id) {
                    $model = $this->findByPk($id);
                    $model->{$this->field_order} = $key;
                    $model->save();
                }
            }
        }
    }

}

?>
