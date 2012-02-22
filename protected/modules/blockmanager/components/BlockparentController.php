<?php

class BlockparentController extends BackController {

    protected $typeblock;
    protected $url_string;

    public function init() {
        parent::init();
        $this->breadcrumb = array(
            array("name" => Translater::getDictionary()->blockmanagerName, "action" => $this->createUrl("/blockmanager/")),
        );
    }

    public function loadModel($id) {
        $model = Block::model()->findByPk((int) $id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function filters() {
        $array = parent::filters();
        $array[0] = $array[0] . ",savechange,setstatus";
        return $array;
    }

    public function actionIndex() {
        $positionWithBloks = Block::model()->getRelatedPosition($this->typeblock);
        $this->render('/blocks/index', array("tables" => $positionWithBloks));
    }

    public function actionCreate() {
        $model = new Block();
        $model->block_system = $this->typeblock;
        if (isset($_POST['Block'])) {
            $model->attributes = $_POST['Block'];
            if ($model->save()) {
                if (!empty($_POST["relation_content_id"])) {
                    $model->manageRelation($_POST["relation_content_id"]);
                }
                if (!empty($_FILES["Block"])) {
                    $model->saveDependies($_FILES["Block"]);
                }
                if (!isset($_POST['just_save'])) {
                    $this->redirect($this->createUrl($this->url_string));
                }
                else
                    $this->redirect($this->createUrl("/blockmanager/block/update/", array("id" => $model->block_id)));
            }
        }
        $array_render = $this->returnBlockModel($model);
        $this->render('/blocks/create', array("array" => $array_render));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        if (isset($_POST['Block'])) {
            $model->attributes = $_POST['Block'];
            if ($model->save()) {
                $model->manageRelation($_POST["relation_content_id"] ? $_POST["relation_content_id"] : array());
                if (!empty($_POST["del_dependies"])) {
                    $model->deleteDependies($_POST["del_dependies"]);
                }
                if (!empty($_FILES["Block"])) {
                    $model->saveDependies($_FILES["Block"]);
                }
                if (!isset($_POST['just_save'])) {
                    $this->redirect($this->createUrl($this->url_string));
                }
                else
                    $this->redirect($this->createUrl("/blockmanager/block/update/", array("id" => $model->block_id)));
            }
        }
        $array_render = $this->returnBlockModel($model);
        $this->render('/blocks/update', array("array" => $array_render));
    }

    protected function returnBlockModel(CMyActiveRecord $model) {
        $array = array();
        $array["model"] = $model;
        $array["position"] = Blockposition::model()->getKeyValueArray("position_id", "position_code", array("order" => "position_code"));
        $array["locales"] = Locale::getLocaleList(Array("key" => "locale_id", "value" => "locale_description"));
        $relations_content = Contentblockrelation::model()->getAllRelation($model->getPrimaryKey());
       
        $i = 0;
        foreach ($array["locales"] as $key_locale => $value) {
            $array_chekbox = array();
            $contents = $contents = $this->getCache("all_content" . $key_locale, Content::model(), "getContentAll", array(0, $key_locale, array()));
            foreach ($contents as $key => $content) {
                $cheked = in_array($key, $relations_content);
                $array_chekbox[$i]["chekbox"] = CHtml::checkBox("relation_content_id[$i]", $cheked, array('value' => $key,));
                $array_chekbox[$i]["label"] = CHtml::label($content, "my_name" . $i);
                $i++;
            }
            $array["relation"][$key_locale] = $array_chekbox;
        }
        return $array;
    }

    public function actionDelete($id=false) {
        if ($id) {
            $this->loadModel($id)->delete();
        }
        $this->redirect($this->createUrl($this->url_string));
    }

    public function actionSaveChange() {
        if (isset($_POST["block_order"])) {
            if (is_array($_POST["block_order"])) {
                foreach ($_POST["block_order"] as $order) {
                    Block::model()->setOrder($order);
                }
            }
        }
        $this->redirect($this->createUrl($this->url_string));
    }

    public function actionSetstatus() {
        if (!empty($_POST['id'])) {
            $model = $this->loadModel($_POST['id']);
            $model->block_status = $model->block_status == 0 ? 1 : 0;
            $model->save();
        }
    }

}

?>
