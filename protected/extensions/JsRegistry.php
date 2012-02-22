<?php

class JsRegistry {

    protected static $instance;
    protected static $cS;

    private function __construct() {
        self::$cS = Yii::app()->clientScript;
    }

    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new JsRegistry();
        }
        return self::$instance;
    }

    public function sortTable($tableClass, $inputClass, $inputName, $buttonClass) {
        self::$cS->registerScriptFile(CHtml::asset(Yii::app()->getTheme()->getBasePath() . '/js/public/jquery.tablednd_0_5.js', CClientScript::POS_HEAD));
        self::$cS->registerScriptFile(CHtml::asset(Yii::app()->getTheme()->getBasePath() . '/js/private/functionCollector.js', CClientScript::POS_HEAD));
        $script = "$(function(){ sortTable('$tableClass','$inputClass','$inputName','$buttonClass') })";
        self::$cS->registerScript(md5("sort_$tableClass"), $script, CClientScript::POS_HEAD);
    }
    
   public function setStatus($clickObjectClass, $attrObject, $url) {
        self::$cS->registerScriptFile(CHtml::asset(Yii::app()->getTheme()->getBasePath() . '/js/private/functionCollector.js', CClientScript::POS_HEAD));
        $script = "$(function(){ setStatus('$clickObjectClass','$attrObject','$url') })";
        self::$cS->registerScript(md5("sort_$url"), $script, CClientScript::POS_HEAD);
    }
    

}

?>