<?php

class DbHelper {

    static public function getDbSetting() {
        $array = explode(";", Yii::app()->db->connectionString);
        $db_host = explode("=", $array[0]);
        $db_name = explode("=", $array[1]);
        $array["db_host"] = $db_host[1];
        $array["db_name"] = $db_name[1];
        $array["db_user"] = Yii::app()->db->username;
        $array["db_pass"] = Yii::app()->db->password;
        return $array;
    }

}

?>
