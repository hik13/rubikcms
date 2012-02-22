<?php

class InstallController extends BackParentController {

    private $check_locale = array("install[locale_id]");
    private $check_user = array("install[user_login]", "install[user_pass]");
    private $check_db = array("install[db_host]","install[db_name]", "install[db_host]", "install[db_login]",);
    private $check_config = array("install[theme]",);

    public function actionStart() {
        if (!empty($_POST)) {
            $this->setInstallState($_POST);
        }
        if ($this->chekout($this->check_locale)) {
            Translater::setCurrentLocale(Yii::app()->user->getState("install[locale_id]"));
        }
        if (!$this->chekout($this->check_locale)) {
            Yii::import("application.modules.translatemanager.models.Language", true);
            $locals = Language::model()->getTranslateVersion();
            $instal_array = array('setTo' => "choiceLanguage", 'locales' => $locals);
        } else if (!$this->chekout($this->check_user)) {
            $instal_array = array('setTo' => "setUser");
        } else if (!$this->chekout($this->check_db)) {
            $instal_array = array('setTo' => "setDb");
        } else if ($error = $this->mysqlDumpExecute()) {
            $instal_array = array('setTo' => "setDb", "block_message" => array("class" => "error-system-message", "message" => $error));
        } else if (!$this->chekout($this->check_config)) {
            $instal_array = array('setTo' => "setConfig", "themes" => $this->getThemeFolder());
        } else if ($error = $this->createSiteConfig()) {
            $instal_array = array('setTo' => "setConfig", "block_message" => array("class" => "error-system-message", "message" => $error));
        } else {
            $this->insertDbRecords();
            $instal_array = array('setTo' => "finish", "block_message" => array("class" => "success-system-message", "message" => Translater::getDictionary()->messageCongrat));
            Yii::app()->user->clearStates();
        }
        $this->render("//system/install", $instal_array);
    }

    private function chekout($array) {
        $result = true;
        foreach ($array as $value) {
            $result = $result && (Yii::app()->user->hasState($value));
        }
        return $result;
    }

    private function setInstallState($post) {
        if (!empty($_POST["SET"])) {
            foreach ($_POST["SET"] as $key => $state)
                if (!empty($state))
                    Yii::app()->user->setState("install[$key]", $state);
        }
        if (!empty($_POST["UNSET"])) {
            foreach ($_POST["UNSET"] as $key => $state)
                Yii::app()->user->setState("install[$key]", null);
        }
    }

    private function mysqlDumpExecute() {
        if (!Yii::app()->user->hasState("install[installed]")) {
            if ($desk = @mysql_pconnect(Yii::app()->user->getState("install[db_host]"), Yii::app()->user->getState("install[db_login]"), Yii::app()->user->getState("install[db_pass]"))) {
                if (mysql_select_db(Yii::app()->user->getState("install[db_name]"), $desk)) {
                    $sql = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/protected/data/dump.sql");
                    $sql = preg_split('/(?<=[a-zA-Z0-9`)]);/', $sql);
                    foreach ($sql as $query)
                        (@mysql_query(trim($query)));
                    Yii::app()->user->setState("install[installed]", true);
                    return false;
                } else {
                    return $error = Translater::getDictionary()->messageErrorDbExisting;
                }
            } else {
                return $error = Translater::getDictionary()->messageErrorDbConection;
            }
        } else {
            return false;
        }
    }

    private function createSiteConfig() {
        if (is_writable($_SERVER["DOCUMENT_ROOT"] . "/site")) {
            if (is_file($_SERVER["DOCUMENT_ROOT"] . "/protected/config/config-default.php")) {
                $config = new CMyConfiguration($_SERVER["DOCUMENT_ROOT"] . "/protected/config/config-default.php");
                $config->add("language", Yii::app()->user->getState("install[locale_id]"));
                $config->add("components", $config->mergeArray($config->itemAt("components"), array("db" => array(
                                'class' => 'CDbConnection',
                                'connectionString' => 'mysql:host=' . Yii::app()->user->getState("install[db_host]") . ';dbname=' . Yii::app()->user->getState("install[db_name]"),
                                'emulatePrepare' => true,
                                'username' => Yii::app()->user->getState("install[db_login]"),
                                'password' => Yii::app()->user->getState("install[db_pass]"),
                                'charset' => 'utf8',
                                'schemaCacheID' => 'cache',
                                'queryCacheID' => 'cache',
                                'schemaCachingDuration' => 3600,
                                ))));
                $filePatch = $_SERVER["DOCUMENT_ROOT"] . '/site/config/setting.php';
                $config->saveTxtToFile($filePatch);
                return false;
            }
        } else {
            return $error = Translater::getDictionary()->messageErrorGrantFolder;
        }
    }

    private function insertDbRecords() {
        $dsn = "mysql:host=" . Yii::app()->user->getState("install[db_host]") . ";dbname=" . Yii::app()->user->getState("install[db_name]");
        $connection = new CDbConnection($dsn, Yii::app()->user->getState("install[db_login]"), Yii::app()->user->getState("install[db_pass]"));
        $connection->active = true;
        $comand = $connection->createCommand();
        $array_module_configs = ModulHelper::getModulesConfigFiles();
        $i = 0;
        
        foreach ($array_module_configs as $module) {
            if ($module["required"]) {
                $comand->insert("module", array(
                    'module_id' => $module["module_id"],
                    'module_name' => $module["module_name"],
                    'defaultCntrl' => $module["defaultCntrl"],
                    'class' => $module["class"],
                    'module_order' => $i++,
                        )
                );
                $array[$module["module_id"]]["modul"] = $module["module_id"];
                foreach ($module["modulePermission"] as $perm) {
                    $comand->insert("user_permission", array(
                        'module_id' => $module["module_id"],
                        'access' => $perm["access"],
                        'name' => $perm["name"],
                            )
                    );
                    $array[$module["module_id"]]["rights"][] = $connection->getLastInsertId();
                }
            }
        }        
        $comand->insert("user_group_role", array(
            'group_role_name' => "Administrator",
            'group_permission' => serialize($array),
            'group_desk' => "admin",
                )
        );
        $admin_id = $connection->getLastInsertId();
        $comand->insert("user_table", array(
            'name' => "Administrator",
            'user_login' => Yii::app()->user->getState("install[user_login]"),
            'user_password' => md5(Yii::app()->user->getState("install[user_pass]")),
            'group_role_id' => $admin_id,
            'date_registr' => Time::getCurrentTime(),
            'date_lastUpdate' => Time::getCurrentTime(),
            'user_status' => 1
                )
        );
    }

    private function getThemeFolder() {
        $dir = $_SERVER["DOCUMENT_ROOT"] . '/site/themes';
        $rgFiles = array();
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if (is_dir($dir . "/" . $file) && ($file != ".") && ($file != "..")) {
                        $rgFiles[$file] = $file;
                    }
                }
                closedir($dh);
            }
        }
        return $rgFiles;
    }

    private function setDbComponent() {
        Yii::app()->setComponents(array(
            'db' => array(
                "class" => "CDbConnection",
                "connectionString" => 'mysql:host=' . Yii::app()->user->getState("install[db_host]") . ';dbname=' . Yii::app()->user->getState("install[db_name]"),
                "emulatePrepare" => true,
                "username" => Yii::app()->user->getState("install[db_login]"),
                "password" => Yii::app()->user->getState("install[db_pass]"),
                "charset" => "utf8",
                )));
    }
       
}
?>
