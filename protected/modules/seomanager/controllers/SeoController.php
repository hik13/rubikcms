<?php

class SeoController extends BackController {

    protected $basicRigth = "manageSeo";

    public function filters() {
        $array = parent::filters();
        $array[0] = $array[0] . ",getcounterform";
        return $array;
    }

    public function init() {
        parent::init();
        $this->breadcrumb = array(
            array("name" => Translater::getDictionary()->seomanager_name, "action" => $this->createUrl("/seomanager/")),
        );
    }

    public function loadModel($id) {
        $model = Seo::model()->findByPk((int) $id);
        if ($model === null)
            $this->redirect($this->createUrl("/system/system/404"));
        return $model;
    }

    public function actionIndex() {
        $models = Seo::model()->findAll();
        if (isset($_POST["Seo"])) {
            foreach ($_POST["Seo"] as $seo) {
                $model = $this->loadModel($seo["seo_id"]);
                $model->seo_text = (!is_array($seo["seo_text"])) ? $seo["seo_text"] : serialize($seo["seo_text"]);
                $model->save();
            }
            $this->redirect($this->createUrl("/seomanager/"));
        }
        $this->render('index', array("seo" => $models));
    }

    public function actionGetCounterForm() {
        if (isset($_POST)) {
            $locale = Locale::getLocaleList(Array("key" => "locale_id", "value" => "locale_description"));
            $model = new Seocounter();
            $this->renderPartial('_form_counter', array('model' => $model, "i" => $_POST["i"], "j" => $_POST["j"], "ajax" => true, "locale" => $locale));
        }
    }

}
