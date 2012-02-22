<?php

class ContentController extends FrontController {

    public $layout = "/layouts/template";
    public $current_id;
    public $array;

    public function actionIndex($id=false) {
        if ($model = ContentDataReciver::getModelByContentId($id)) {
            $this->current_id = $model->content_id;
            $this->array["model"] = &$model;
            $this->array["locale"] = Locale::getLocaleListNavifation($model);
            $this->array["block"] = ContentDataReciver::getPositionContent($model);
            $this->array["navi"] = Navigation::returnMenus($model->content_id);
            $this->render('/common/contentview', array('model' => $this->array));
        } else {
            $this->redirect("/404/", false, 301);
        }
    }

    public function actionCustomAction() {
        $BURL=Yii::app()->getTheme()->getBaseUrl();
        if (isset($_POST["main_slider"])) {
            $this->renderFile($BURL. "/module/randombanner/randomWork.php", array("part" => true, "locale_id" => $_POST["locale_id"], "locale_key" => "/" . $_POST["locale_key"],));
        }

        if (isset($_GET["set_viev_cookie"])) {
            $value = !CookieManager::getCookie("listViev");
            CookieManager::setCookie("listViev", $value);
        }

        if (isset($_GET["contakt_form"])) {
            $this->renderFile($BURL . "/module/cform/contactform.php");
        }

        if (isset($_POST["nameRequest"])) {
            $this->renderFile($BURL . "/module/cform/contactform.php", array("not_show" => true));
        }

        if (isset($_GET["get_fulltable"]) or (isset($_GET["work"]))) {
            $this->renderFile($BURL . "/module/prftemplates/main_portfolio.php");
        }
    }
    
    
    public function actionTest() {
        $connection = Yii::app()->db;
        $com = $connection->createCommand();
        $co=$com->select("content.*,content_block_relation.*")->from("content,content_block_relation")->execute();
       echo $com->getText();
        var_dump($co);
    }
    
    
    
    
    public function action404() {
        header("HTTP/1.1 404 Not Found");
        $this->render('/system/404', array());
    }

}

?>