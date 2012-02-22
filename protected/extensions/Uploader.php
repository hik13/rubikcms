<?php

class Uploader {

   static public $arrayfolder = array(
        "css" => array("css"),
        "doc" => array("doc", "pdf", "docx"),
        "image" => array("jpg", "jpeg", "gif", "png"),
        "script" => array("js"),
        "video" => array("flv"),
    );

    static public function uploadfile($filename, $filenametemp) {
        $dest = self::getUploadedPatch($filename);
        move_uploaded_file($filenametemp, $dest);
        return self::getUploadedPatch($filename,true);
    }

    static public function getUploadedPatch($filename, $baseDir=false) {
        $folder = self::getfolder(preg_replace("/.*?\./", '', $filename));
        if (!$baseDir) {
            return $dest = $_SERVER['DOCUMENT_ROOT'] . "/uploaded/" . $folder . "/" . $filename;
        } else {
            return "/uploaded/" . $folder . "/" . $filename;
        }
    }
    
    
    static private function getfolder($ext) {
        switch ($ext) {
            case in_array($ext, self::$arrayfolder["css"]) : {
                    return "css";
                    break;
                }
            case in_array($ext, self::$arrayfolder["doc"]) : {
                    return "document";
                    break;
                }
            case in_array($ext, self::$arrayfolder["image"]) : {
                    return "image";
                    break;
                }
            case in_array($ext, self::$arrayfolder["script"]) : {
                    return "js";
                    break;
                }
            case in_array($ext, self::$arrayfolder["video"]) : {
                    return "video";
                    break;
                }
            default : {
                    return "all";
                    break;
                }
        }
    }

    static public function delfile($filenames) {
        if (is_array($filenames)) {
            foreach ($filenames as $filename)
                self::delfile($filename);
        } else {
            if (is_file($_SERVER['DOCUMENT_ROOT'] . $filenames)) {
                unlink($_SERVER['DOCUMENT_ROOT'] . $filenames);
            }
        }
    }

    static public function registrFile(array $array) {
        if (!empty($array)) {
            foreach ($array as $file) {
                self::analyzeAndRegistrFile($file);
            }
        }
    }

    static private function analyzeAndRegistrFile($file) {
        $ext = preg_replace("/.*?\./", '', $file);
        switch ($ext) {
            case in_array($ext, self::$arrayfolder["css"]) : {
                    Yii::app()->clientScript->registerCssFile($file);
                    break;
                }
            case in_array($ext, self::$arrayfolder["script"]) : {
                    Yii::app()->clientScript->registerScriptFile(CHtml::asset(Yii::getPathOfAlias('webroot') . $file), CClientScript::POS_HEAD);
                    break;
                }

            default : {
                    return;
                    break;
                }
        }
    }

}

?>
