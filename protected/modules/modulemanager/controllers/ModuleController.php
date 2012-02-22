<?php

class ModuleController extends BackController {

    protected $basicRigth = "manageModule";

    public function init() {
        parent::init();
        $this->breadcrumb = array(
            array("name" => Translater::getDictionary()->modulemanager_name, "action" => "")
        );
    }

    public function filters() {
        $array = parent::filters();
        $array[0] = $array[0] . ",savelistmodule";
        return $array;
    }

    public function actionIndex() {
        $list=ModulHelper::initModules();
        $this->render('index', array('installed' => $list["installed"],'notinstalled'=>$list["notinstalled"]));
    }

    public function actionSaveListModule() {     
        ModulHelper::saveModules($_POST['module_id']);
        if (isset($_POST["module_order"])) {
            if (is_array($_POST["module_order"])) {
                foreach ($_POST["module_order"] as $order) {
                    Module::model()->setOrder($order);
                }
            }
        }
        $this->redirect($this->createUrl("/modulemanager/"));
    }

    public function loadModel($id) {
        $model = Module::model()->findByPk($id);
        if ($model === null)
            $this->redirect($this->createUrl("/system/system/404"));
        return $model;
    }
    
    
}