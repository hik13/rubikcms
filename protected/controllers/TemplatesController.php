<?php

/**
 * Description of TemplatesController
 * @author VrublevskyPO
 */
class TemplatesController extends BackController {

    public function filterBasicActionsFilter($filterChain) {
        $filterChain->run();
    }

    public function actionIndex($template="template") {
        $this->scanfolder($template);
        $this->render($template);
    }

    private function scanfolder($template) {
        $folder = $_SERVER["DOCUMENT_ROOT"] . Yii::app()->getTheme()->getBaseUrl() . "/views/templates/";
        if (is_dir($folder)) {
            if ($dir = opendir($folder)) {
                while (false !== ($file = readdir($dir))) {
                    if ($file != "." && $file != "..") {
                        $this->punkts[] = array("name" => substr($file, 0, -4), "action" => "/management/templates/index/?template=" . substr($file, 0, -4), "active_t" => substr($file, 0, -4) == $template ? true : false);
                    }
                }
                closedir($dir);
            }
        }
    }

}

?>
