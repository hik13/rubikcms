<?php

class ModulHelper {

    static public function getModuleCongfig($moduleName) {
        if (is_file(Yii::app()->getModulePath() . "/" . $moduleName . "/config/setting.php")) {
            return require Yii::app()->getModulePath() . "/" . $moduleName . "/config/setting.php";
        }
    }

    static public function getSQL($moduleName, $sqlName) {
        if (is_file(Yii::app()->getModulePath() . "/" . $moduleName . "/resourse/sql/" . $sqlName)) {
            return file_get_contents(Yii::app()->getModulePath() . "/" . $moduleName . "/resourse/sql/" . $sqlName);
        }
    }

    static public function getListModulesDir() {
        $list_module_dir = array();
        $folder = Yii::app()->getModulePath();
        if (is_dir($folder)) {
            if ($dir = opendir($folder)) {
                while (false !== ($module_dir = readdir($dir))) {
                    if ($module_dir != "." && $module_dir != "..") {
                        if (is_dir($folder . "/" . $module_dir)) {
                            $list_module_dir[] = $folder . "/" . $module_dir;
                        }
                    }
                }
                closedir($dir);
            }
        }
        return $list_module_dir;
    }

    static public function getModulesConfigFiles() {
        $list_config = array();
        $folders = self::getListModulesDir();
        foreach ($folders as $folder) {
            if (is_file($folder . "/config/setting.php")) {
                $list_config[] = require $folder . "/config/setting.php";
            }
        }
        return ($list_config);
    }

    public static function saveModules($modules_id) {
        $list = self::getModulesConfigFiles();
        foreach ($list as $modul) {
            if (!$modul["required"]) {
                if (!$rez = Module::model()->findByPk($modul["module_id"])) {
                    if (is_array($modules_id)) {
                        if (in_array($modul["module_id"], $modules_id)) {
                            self::initModul($modul);
                        }
                    }
                } else {
                    if (is_array($modules_id)) {
                        if (!in_array($modul["module_id"], $modules_id)) {
                            $rez->delete();
                        }
                    }
                }
            }
        }
    }

    static public function initModules() {
        Yii::import("application.modules.modulemanager.models.*", true);
        $listModuleConfig = self::getModulesConfigFiles();
        $array=array("notinstalled"=>array(),"installed"=>array());
        foreach ($listModuleConfig as $key => $modul) {
            $order = $i++;
            if ($modul["required"]) {
                if (!$m = Module::model()->findByPk($modul["module_id"])) {
                    self::initModul($modul);
                }
                $array["installed"][$m->module_order] = $modul;
            } else {
                if ($m = Module::model()->findByPk($modul["module_id"])) {
                    $array["installed"][$m->module_order] = $modul;
                } else {
                    $array["notinstalled"][$order] = $modul;
                }
            }
        }
        ksort($array["installed"], SORT_NUMERIC);
        ksort($array["notinstalled"], SORT_NUMERIC);
        return $array;
    }

    static public function initModul($modul) {
        if ($m = Module::model()->saveModule($modul)) {
            self::createTables($modul["moduleID"]);
        }
        return $m;
    }

    static public function createTables($modulPath) {
        self::deleteTables($modulPath);
        self::sqlQuery(self::getSQL($modulPath, "create_sql.sql"));
    }

    static public function deleteTables($modulPath) {
        self::sqlQuery(self::getSQL($modulPath, "drop_sql.sql"));
    }

    private static function sqlQuery($sql) {
        $db_setting = DbHelper::getDbSetting();
        if ($desk = @mysql_pconnect($db_setting["db_host"], $db_setting["db_user"], $db_setting["db_pass"])) {
            if (mysql_select_db($db_setting["db_name"], $desk)) {
                $sql = preg_split('/(?<=[a-zA-Z0-9`)]);/', $sql);
                foreach ($sql as $query) {
                    (mysql_query(trim($query)));
                }
            }
        }
    }

}

?>