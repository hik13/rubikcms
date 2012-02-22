<?php

class BannerController extends BackController {

    protected $basicRigth = "manageBanner";

    public function init() {
        parent::init();
        $this->breadcrumb = array(
            array("name" => Translater::getDictionary()->blockmanagerName, "action" => $this->createUrl("/blockmanager/")),
            array("name" => Translater::getDictionary()->bannermanagerBanner, "action" => $this->createUrl("/blockmanager/banner/")),
        );
    }

    public function filters() {
        $array = parent::filters();
        $array[0] = $array[0] . ",savechange,setstatus";
        return $array;
    }

    public function loadModel($id) {
        $model = Banner::model()->findByPk((int) $id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionIndex() {
        $positionWithBanners = Banner::model()->getRelatedPosition();
        $this->render('index', array('id' => $id, 'tables' => $positionWithBanners));
    }

    public function actionCreate($id=0) {
        $model = new Banner;
        if (isset($_POST['Banner'])) {
            $model->attributes = $_POST['Banner'];
            $model->banner_url = CUploadedFile::getInstance($model, 'banner_url');
            if (!empty($model->banner_url)) {
                $model->banner_url->saveAs('uploaded/banner/' . $model->banner_url);
                $model->banner_url = 'uploaded/banner/' . $model->banner_url;
            }
            if ($model->save()) {
                if (!empty($_POST["relation_content_id"])) {
                    $model->manageRelation($_POST["relation_content_id"]);
                }
                if (!isset($_POST['just_save'])) {
                    $this->redirect(array('index'));
                }
                else
                    $this->redirect($this->createUrl("/blockmanager/block/update/", array("id" => $model->block_id)));
            }
        }
        $array_render = $this->returnBlockModel($model);
        $this->render('create', array('array' => $array_render));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        if (!empty($model->banner_date_to)) {
            $model->banner_date_to = date('d-m-Y', $model->banner_date_to);
        }
        if (isset($_POST['Banner'])) {
            if (!empty($_POST['banner_delete'])) {
                $model->banner_url = '';
                Uploader::delfile('/' . $_POST['banner_delete']);
            }
            $tempFile = CUploadedFile::getInstance($model, 'banner_url');
            $model->attributes = $_POST['Banner'];
            if (!empty($tempFile)) {
                $model->banner_url = $tempFile;
                $model->banner_url->saveAs('uploaded/banner/' . $model->banner_url);
                $model->banner_url = 'uploaded/banner/' . $model->banner_url;
            }
            $model->manageRelation($_POST["relation_content_id"] ? $_POST["relation_content_id"] : array());
            if ($model->save()) {
                if (!isset($_POST['just_save'])) {
                    $this->redirect(array('index'));
                }
                else
                    $this->redirect($this->createUrl("/blockmanager/block/update/", array("id" => $model->block_id)));
            }
        }
        $array_render = $this->returnBlockModel($model);
        $this->render('update', array('array' => $array_render));
    }

    protected function returnBlockModel(CMyActiveRecord $model) {
        $array = array();
        $array["model"] = $model;
        $array["position"] = Blockposition::model()->getKeyValueArray("position_id", "position_code", array("order" => "position_code"));
        $array["locales"] = Locale::getLocaleList(Array("key" => "locale_id", "value" => "locale_description"));
        $relations_content = Contentblockrelation::model()->getAllRelation($model->getPrimaryKey(),"1");
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
            $model = $this->loadModel($id);
            $model->delete();
        }
        $this->redirect(array('index'));
    }

    public function actionSaveChange() {
        if (isset($_POST["banner_order"])) {
            if (is_array($_POST["banner_order"])) {
                foreach ($_POST["banner_order"] as $order) {
                    Banner::model()->setOrder($order);
                }
            }
        }
        $this->redirect(array('index'));
    }

    public function actionSetstatus() {
        if (!empty($_POST['id'])) {
            $model = $this->loadModel($_POST['id']);
            $model->banner_status = $model->banner_status == 0 ? 1 : 0;
            $model->save();
        }
    }

}