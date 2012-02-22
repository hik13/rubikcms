<?php

class TranslateController extends BackController {

    public $defaulLanguage = "en";
    protected $basicRigth = "manageTranslate";

    public function init() {
        parent::init();
        $this->breadcrumb = array(
            array("name" => Translater::getDictionary()->translatemanager_name, "action" => $this->createUrl("/translatemanager/")),
        );
    }

    public function actionIndex() {
        $model = new Language;
        $list = $model->getModulesConfigFiles();
        $this->render('index', array('list' => $list));
    }

    public function actionUpdate($id) {
        $model = new Language;
        $list = $model->getModulesConfigFiles();
        $languagePath = $this->returnLanguagePath($model, $this->defaulLanguage, $id);
        $modules = $model->getModulesList($list);
        if (isset($_POST['translate_path'])) {
            foreach ($_POST['translate_path'] as $key => $value) {
                $model->fileLanguage($_POST[$key], $value);
            }
            $this->redirect(array('index'));
        }
        $this->render('update', array('id' => $id, 'labelList' => $languagePath[0]["def"], 'valueList' => $languagePath[0]["lang"], 'model' => $model, "modules" => $modules, "defaultLanguage" => $this->defaulLanguage));
    }

    public function actionCreate($id=0) {
        $model = new Language;
        if (isset($_POST['LanguageName'])) {
            if ($this->comparePrefix($model, $_POST['LanguageName'])) {
                $model->createLanguage($_POST['LanguageName'], $this->defaulLanguage);
                $this->redirect(array('update', 'id' => $_POST['LanguageName']));
            }
        }
        $this->render('create', array('model' => $model, 'list' => $list[$id]["languages"]));
    }

    public function actionDelete($id=0) {
        $model = new Language;
        $languagePath = $this->returnLanguagePath($model, $this->defaulLanguage, $id);
        $model->deleteLanguage($languagePath[0]["lang"]);
        $this->redirect(array('index'));
    }

    public function actionAdd($id) {
        $model = new Language;
        $list = $model->getModulesConfigFiles();
        $modules = $model->getModulesList($list);
        if (isset($_POST['add_language'])) {
            $model->createModuleLanguage($id, $_POST['add_language'], $this->defaulLanguage);
            $this->redirect(array('update', 'id' => $id));
        }
        $this->render('add', array('model' => $model, 'modules' => $modules, 'id' => $id, 'list' => $list));
    }

    protected function returnLanguagePath($model, $id, $language) {
        $list = $model->getModulesConfigFiles();
        foreach ($list as $lang) {
            if ($lang["name"] == $id) {
                $def = $lang["href"];
            }
            if ($lang["name"] == $language) {
                $langpath = $lang["href"];
            }
        }
        $configLang[0] = array("def" => $def, "lang" => $langpath);
        return ($configLang);
    }

    protected function comparePrefix($model, $prefix) {
        $list = $model->getModulesConfigFiles();
        foreach ($list as $lang) {
            if ($lang["name"] == $prefix) {
                return false;
                break;
            }
        }
        return true;
    }

}
