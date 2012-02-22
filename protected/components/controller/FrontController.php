<?php

class FrontController extends CMyController {

    protected $themepath="/site/themes";
    
    
    public function init() {
        parent::init();
        Yii::app()->setTheme(Setting::in()->mainTheme);
    }

}

?>
