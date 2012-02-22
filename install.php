<?php

$config = dirname(__FILE__) . '/site/config/settings.php';
if (is_file($config)) {
    header("Location:index.php");
} else {
    $yii = 'yii/framework/yii.php';
    $configinstall = dirname(__FILE__) . '/protected/config/config-install.php';
    if (is_file($configinstall)) {
        require_once($yii);
        Yii::createWebApplication($configinstall)->run();
    }
}
?>
