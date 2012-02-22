<?php

class ContentController extends BackController {

    protected $basicRigth = "manageContent";

    public function init() {
        parent::init();
        $this->breadcrumb = array(
            array("name" => Translater::getDictionary()->contentmanagerName, "action" => $this->createUrl("/contentmanager/"))
        );
    }

    public function filters() {
        $array = parent::filters();
        $array[0] = $array[0] . ",savetreechange,setstatus";
        return $array;
    }

    public function actionIndex($locale_id=false) {
        $model = new Content();
        Yii::import("application.modules.usermanager.models.*", true);
        $render_array["userList"] = User::model()->getKeyValueArray("user_id", 'name', array());
        if (Setting::in()->countActiveLocale) {
            $render_array["locales"] = Locale::getLocaleList();
        }
        if (isset($_GET["nottree"])) {
            $render_array["content"] = $this->getCache("not_tree", $model, "getNotThree");
            $this->render('nottree', $render_array);
        } else {
            $render_array["locale_id"] = $locale_id = $locale_id ? $locale_id : Setting::in()->defaultLocaleId;
            $render_array["content"] = $this->getCache("tree_object_locale_id" . $locale_id, $model, "getFullTree", array($locale_id));
            $this->render('index', $render_array);
        }
    }

    public function actionCreate($locale_id=0, $parent_id=0, $related_content=0) {
        $model = new Content;
        $model->parent_id = $parent_id;
        $model->locale_id = $locale_id ? $locale_id : Setting::in()->defaultLocaleId;
        $model->related_content = $related_content;
        if (isset($_GET['nontree']))
            $model->content_nonstructur = 1;

        if (isset($_POST['Content'])) {
            $model->attributes = $_POST['Content'];
            if ($model->save()) {
                if (!isset($_POST['just_save'])) {
                    $this->redirect($this->createUrl("/contentmanager/content/index", $this->redirectArray($model)));
                }
                else
                    $this->redirect($this->createUrl("/contentmanager/content/update", array("id" => $model->content_id)));
            }
        }
        $render_array["form_array"]["model"] = $model;
        if (Setting::in()->countActiveLocale) {
            $render_array["form_array"]["locales"] = Locale::getLocaleList(array("key" => "locale_id", "value" => "locale_description"));
        }
        $this->render('create', $render_array);
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $render_array["form_array"]["model"] = $model;
        if (Setting::in()->countActiveLocale) {
            $render_array["form_array"]["locales"] = Locale::getLocaleList(array("key" => "locale_id", "value" => "locale_description"));
        }

        if (isset($_POST['Content'])) {
            $model->attributes = $_POST['Content'];
            if ($model->save()) {
                if (!isset($_POST['just_save'])) {
                    $this->redirect($this->createUrl("/contentmanager/content/index", $this->redirectArray($model)));
                } else
                    $this->redirect($this->createUrl("/contentmanager/content/update", array("id" => $model->content_id)));
            }
        }
        $this->render('update', $render_array);
    }

    public function actionDelete($id) {
        $model = $this->loadModel($id);
        $rA = $this->redirectArray($model);
        $model->delete();
        $this->redirect($this->createUrl("/contentmanager/content/index", $rA));
    }

    public function actionSavetreechange() {
        if (isset($_POST['NewParent'])) {
            foreach ($_POST['NewParent'] as $np) {
                $model = $this->loadModel($np["childId"]);
                $model->parent_id = $np["parentId"];
                $model->save();
            }
        }
        if (isset($_POST['NewOrder'])) {
            foreach ($_POST['NewOrder'] as $key => $no) {
                $li = explode("|", $no);
                if ($li)
                    foreach ($li as $key => $value) {
                        if (!empty($value)) {
                            $model = $this->loadModel($value);
                            $model->content_order = $key;
                            $model->save();
                        }
                    }
            }
        }
        exit;
        $this->redirect($this->createUrl("/contentmanager/content/index", $this->redirectArray($model)));
    }

    public function actionTranslit() {
        if (!empty($_POST['translit'])) {
            if ($r = Translite::TranslitIt(trim($_POST['translit']))) {
                ResponseAjax::setResponseText($r);
            } else {
                ResponseAjax::setResponseError(Translater::getDictionary()->contentmanager_ajaxTranslitError);
                ResponseAjax::setResponseError(Translater::getDictionary()->contentmanager_ajaxTranslitError);
            }
        } else {
            ResponseAjax::setResponseError(Translater::getDictionary()->contentmanager_ajaxEmptyError);
            ResponseAjax::setResponseError(Translater::getDictionary()->contentmanager_ajaxTranslitError);
        }
        echo ResponseAjax::jsonRspObj();
    }

    public function actionSetstatus() {
        if (!empty($_POST['id'])) {
            $model = $this->loadModel($_POST['id']);
            $model->status_id = $model->status_id == 0 ? 1 : 0;
            $model->save();
        }
    }

    private function redirectArray(Content $model) {
        if ($model->content_nonstructur) {
            return array("nottree" => true);
        } else {
            return array("locale_id" => $model->locale_id);
        }
    }

}
