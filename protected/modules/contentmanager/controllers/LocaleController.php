<?php

class LocaleController extends BackController {

    protected $basicRigth = "manageLocale";

    public function init() {
        parent::init();
        $this->breadcrumb = array(
             array("name" => Translater::getDictionary()->contentmanagerName, "action" => $this->createUrl("/contentmanager/")),
             array("name" => Translater::getDictionary()->localemanager_name, "action" => $this->createUrl("/contentmanager/locale/")),
        );
    }

    public function filters() {
        $array = parent::filters();
        $array[0] = $array[0] . ",savedefaultlocale,setstatus";
        return $array;
    }

    public function actionIndex() {
        $model = new Locale();
        $this->render('index', array('locales' => $model->findAll()));
    }

    public function actionCreate() {
        $model = new Locale;
        if (isset($_POST['Locale'])) {
            $model->attributes = $_POST['Locale'];
            if ($model->save())
                $this->redirect($this->createUrl("/contentmanager/locale/"));
        }
        $this->render('create', array('model' => $model,));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        if (isset($_POST['Locale'])) {
            $model->attributes = $_POST['Locale'];
            if ($model->save()) {
                $this->redirect($this->createUrl("/contentmanager/locale/"));
            }
        }
        $this->render('update', array('model' => $model));
    }

    public function actionDelete($id=false) {
        if (Locale::model()->count() == 1) {
            $this->render('index', array('locales' => Locale::model()->findAll(), 'errors' => Translater::getDictionary()->errorLastLocaleDeleting));
        } else {
            if ($id) {
                $this->loadModel($id)->delete();
            }
            $this->redirect($this->createUrl("/contentmanager/locale/"));
        }
    }

    public function actionSaveDefaultLocale() {
        if (!empty($_POST["default_locale"])) {
            $this->loadModel($_POST["default_locale"])->changeDefaultLocale();
        }
        $this->redirect($this->createUrl("/contentmanager/locale/"));
    }

    public function actionSetstatus($locale_id=false) {
        if ($locale_id) {
            $model = $this->loadModel($locale_id);
            $model->locale_status = $model->locale_status==0?1:0;
            $model->save();
        }
        $this->redirect($this->createUrl("/contentmanager/locale/"));
    }

    
    public function loadModel($id) {
        $model = Locale::model()->findByPk((int) $id);
        if ($model === null)
            $this->redirect($this->createUrl("/system/system/404"));
        return $model;
    }
    
}
