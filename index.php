<?php

$config = dirname(__FILE__) . '/site/config/setting-qa.php';
if (!is_file($config)) {
    header("Location:install.php");
} else {
    require_once("protected/developState.php");
    $yii = 'yii/framework/yii.php';
    require_once($yii);
    Yii::createWebApplication($config)->run();
}