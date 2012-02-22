<?php

class Language extends CModel {

    public static function model($className=__CLASS__) {
        return new $className;
    }

    public function attributeNames() {
        return array();
    }

    public function getModulesConfigFiles() {
        $folder = Yii::app()->getBasePath();
        if (is_dir($folder . "/messages/")) {
            $dirLang = opendir($href = $folder . "/messages/");
            while (false !== ($fileLang = readdir($dirLang))) {
                if ($fileLang != "." && $fileLang != ".." && is_dir($href . "/" . $fileLang)) {
                    $config[$fileLang] = array("name" => $fileLang, "href" => $href . $fileLang . "/system.php");
                }
            }
            closedir($dirLang);
        }
        return ($config);
    }

    public function getTranslateVersion() {
        $list = $this->getModulesConfigFiles();
        $array_version = array();
        foreach ($list as $key => $value) {
            $array_version[$key] = $key;
        }
        return $array_version;
    }

    public function fileLanguage($language, $filePath) {
        if (isset($language)) {
            $message.="<?php \n return Array( \n";
            foreach ($language as $key => $value) {
                $message.="\"" . $key . "\" => \"" . $value . "\", \n";
            }
            $message.="); \n ?> \n";
            $file = fopen($filePath, "w+");
            fwrite($file, $message);
            fclose($file);
        }
    }

    public function createLanguage($language, $defaultLanguage) {
        $folder = Yii::app()->getBasePath();
        if (is_dir($folder)) {
            if ($dir = opendir($newFolder = $folder . "/messages/")) {
                if (!is_dir($newFolder . $language)) {
                    mkdir($newFolder . $language, 0777);
                    copy($newFolder . $defaultLanguage . "/system.php", $newFolder . $language . "/system.php");
                }
            }
            closedir($dir);
        }
    }

    public function createModuleLanguage($language, $module, $defaultLanguage) {
        $folder = Yii::app()->getModulePath();
        if (is_dir($folder)) {
            if ($dir = opendir($newFolder = $folder . "/" . $module . "/messages/")) {
                if (!is_dir($newFolder . $language)) {
                    mkdir($newFolder . $language, 0777);
                    copy($newFolder . $defaultLanguage . "/" . $module . ".php", $newFolder . $language . "/" . $module . ".php");
                }
            }
            closedir($dir);
        }
    }

    public function deleteLanguage($languagePath) {
        $dir = dirname($languagePath);
        if (!file_exists($dir)) {
            throw new Exception("Ошибка прав доступа к папке" . $dir);
        } else {
            $this->RemoveDir($dir);
        }
    }

    function RemoveDir($path) {
        if (file_exists($path) && is_dir($path)) {
            $dirHandle = opendir($path);
            while (false !== ($file = readdir($dirHandle))) {
                if ($file != '.' && $file != '..') {
                    $tmpPath = $path . '/' . $file;
                    chmod($tmpPath, 0777);
                    if (is_dir($tmpPath)) {
                        RemoveDir($tmpPath);
                    } else {
                        if (file_exists($tmpPath)) {
                            unlink($tmpPath);
                        }
                    }
                }
            }
            closedir($dirHandle);
            if (file_exists($path)) {
                rmdir($path);
            }
        } else {
            echo "Удаляемой папки не существует или это файл!";
        }
    }

    public function getModulesList($list) {
        foreach ($list as $key => $value) {
            $folder = Yii::app()->getModulePath();
            if (is_dir($folder)) {
                if ($dir = opendir($folder)) {
                    while (false !== ($file = readdir($dir))) {
                        if ($file != "." && $file != "..") {
                            if (is_dir($folder . "/" . $file . "/messages/")) {
                                $dirLang = opendir($href = $folder . "/" . $file . "/messages/");
                                while (false !== ($fileLang = readdir($dirLang))) {
                                    if ($fileLang != "." && $fileLang != ".." && is_dir($href . "/" . $fileLang) && $key == $fileLang) {
                                        $languagesList[$file] = array("filePath" => $href . $fileLang . "/" . $file . ".php");
                                    }
                                }
                                closedir($dirLang);
                            }
                        }
                        $modulesLanguagesList[$key] = $languagesList;
                    }
                    closedir($dir);
                }
                unset($languagesList);
            }
        }
        return ($modulesLanguagesList);
    }

}