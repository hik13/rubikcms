<?php

class Cache {

    static public function getDataCashe($cacheId, $objectClass, $executeFunction, array $paramsFunction=array()) {
        if (CMS_CASCH_ENABLED) {
            if (Yii::app()->cache->get($cacheId) === false) {
                $result = call_user_func_array(array($objectClass, $executeFunction), $paramsFunction);
                Yii::app()->cache->set($cacheId, $result);
            } else {
                $result = Yii::app()->cache->get($cacheId);
            }
            return $result;
        }
        else
            return call_user_func_array(array($objectClass, $executeFunction), $paramsFunction);
    }

    static public function deleteCache(array $cache) {
        foreach ($cache as $key => $value) {
            Yii::app()->cache->delete($value);
        }
    }
    
   static public function clearAllCache() {
        $dirname = $_SERVER["DOCUMENT_ROOT"] . "/site/runtime/cache/";
        $dir = opendir($_SERVER["DOCUMENT_ROOT"] . "/site/runtime/cache/");
        while (($file = readdir($dir))) {
            if ((is_file($dirname . $file))) {
                unlink($dirname . $file);
            }
        }
        closedir($dir);
    }

}

?>
