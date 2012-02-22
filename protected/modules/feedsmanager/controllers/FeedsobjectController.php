<?php

class FeedsobjectController extends BackController {

    protected $basicRigth = "manageFeedsObject";

    public function init() {
        parent::init();
        $this->breadcrumb = array(
            array("name" => Translater::getDictionary()->feedsmanager_name, "action" => $this->createUrl("/feedsmanager/")),
        );
    }

    public function filters() {
        $array = parent::filters();
        $array[0] = $array[0] . ",savechange,setstatus,gettemplate";
        return $array;
    }

    public function actionIndex($id) {
        $feed = Feeds::model()->findByPk((int) $id);
        $feedobjects = Feedsobject::model()->findAll(array("order" => "object_order", "condition" => "feed_id=:feed_id", "params" => array(":feed_id" => $id)));
        $this->render('index', array(
            'feedobjects' => $feedobjects, 'feed' => $feed,
        ));
    }

    public function actionCreate($id) {
        $model = new Feedsobject;
        $model->feed_id = $id;
        $feed = Feeds::model()->findByPk((int) $id);
        if (isset($_POST['FeedsObject'])) {
            $model->attributes = $_POST['FeedsObject'];
            if ($model->save()) {
                if (isset($_POST['FeedObjectValue'])) {
                    foreach ($_POST['FeedObjectValue'] as $key => $value) {
                        $this->saveValues($key, $value, $model);
                    }
                }
                if ($feed->feed_rss) {
                    $model->createRSS($feed);
                }
                  if (isset($_POST['just_save'])) {
                    $this->redirect(array("update",'id' =>$model->feed_object_id));
                }
                else $this->redirect(array('index', 'id' => $model->feed_id));
            }
        } else {
            foreach ($feed->fields as $field) {
                $field->object_values = "";
            }
        }
        $this->render('create', array('model' => $model, 'feed' => $feed));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $feed = Feeds::model()->findByPk((int) $model->feed_id);
        if (isset($_POST['FeedsObject'])) {
            $model->attributes = $_POST['FeedsObject'];
            if ($model->save()) {
                if (isset($_POST['FeedObjectValue'])) {
                    foreach ($_POST['FeedObjectValue'] as $key => $value) {
                        $this->saveValues($key, $value, $model);
                    } 
                }
                if ($feed->feed_rss) {
                    $model->createRSS($feed);
                }
                 if (isset($_POST['just_save'])) {
                    $this->redirect(array("update",'id' =>$model->feed_object_id));
                }
                else $this->redirect(array('index', 'id' => $model->feed_id));
            }
        }
        $this->render('update', array('model' => $model, 'feed' => $feed));
    }

    private function saveValues($key, $value, $model) {
        if (!$records = Feedsobjectvalue::model()->findByPk((int) $value["feed_object_value_id"])) {
            $records = new Feedsobjectvalue();
            $records->feed_object_id = $model->feed_object_id;
        }
        if (isset($value["setting"])) {
            $value["field_feed_value"] = $this->analyzSetting($value["setting"], $key);
        }  
        $records->attributes = $value;
        $records->save();
    }

    private function analyzSetting(array $setting, $index) {
        
        switch ($setting["type"]) {
            case "image" : {
                    $name= Randomizator::get_random_md5hash().$_FILES["FeedObjectValue"]["name"][$index]["imagefile"];
                    return $this->saveImage($_FILES["FeedObjectValue"]["tmp_name"][$index]["imagefile"], $name, array("witdh" => $setting["imagewidth"], "height" => $setting["imageheight"]));
                }
            case "imagegalery" : {
                    $image_array=array();
                    $sizes = unserialize($setting["sizes"]);
                    if (!empty($_POST["FieldGaleryObjectValue"][$index]["galeryfile"])) {
                        foreach ($_POST["FieldGaleryObjectValue"][$index]["galeryfile"] as $image) {
                            $image_array[] = $image;
                        }
                    }
                    if (is_array($_FILES["FieldGaleryObjectValue"]["name"][$index]["galeryfile"]))
                    foreach ($_FILES["FieldGaleryObjectValue"]["name"][$index]["galeryfile"] as $key => $image) {
                      $image= Randomizator::get_random_md5hash().$image;  
                        if ($image) {
                            $image_array[] = $image;
                         foreach ($sizes as $size) { 
                                $this->saveImage($_FILES["FieldGaleryObjectValue"]["tmp_name"][$index]["galeryfile"][$key], $size["width"] . "_" . $image, array("witdh" => $size["width"], "height" => $size["heigth"]));
                            }
                        }
                    }
                    return $image_array;
                }
        }
    }

    private function saveImage($file, $name, array $size) {
        if (is_file($file)) {
            $file_path = Uploader::getUploadedPatch($name);
            Image::resizeAndUpload($file, $file_path, $size["witdh"], $size["height"]);
            return $name;
        }
    }

    public function actionDelete($id=false) {
        if ($id) {
            $model = $this->loadModel($id);
            $model->delete();
        }
        $this->redirect(array('index', 'id' => $model->feed_id));
    }

    public function actionSaveChange() {
        if (isset($_POST["object_order"])) {
            if (is_array($_POST["object_order"])) {
                foreach ($_POST["object_order"] as $order) {
                    $model=Feedsobject::model()->setOrder($order);
                }
            }
        }
        $feed_id = $feed_id ? $feed_id : $object->feed_id;
        if (!empty($_POST["delete_feed_object_id"])) {
            foreach ($_POST["delete_feed_object_id"] as $id) {
                $model = $this->loadModel($id);
                $feed_id = $feed_id ? $feed_id : $model->feed_id;
                $model->delete();
            }
        }
        $this->redirect(array('index', 'id' => $feed_id));
    }

    public function actionView($id) {
        $model = Feedsobject::model()->findByPk((int) $id);
        $feed = Feeds::model()->with(array("fields" => array('with' => 'values',
                        'with' => array('object_values' => array(
                                'condition' => 'feed_object_id=:id',
                                'params' => array(':id' => $id),
                        )))))->findByPk((int) $model->feed_id);
        echo $template = $this->changeTemplate($feed->template, $feed->fields);
        //	$this->render('index',array(
        //		'feedobjects'=>$feedobjects,'feed'=>$feed
        //	));
    }

    private function uploadFiles(array $files, array $post, FeedsObject $model) {
        if ($files["fileToUpload"]["size"]) {
            if (filesize($files["fileToUpload"]["tmp_name"]) > 1024 * 1024 * $post["file_size"]) {
                ResponseAjax::setResponseError(Translater::getDictionary()->errorMaxFileSize);
            } else {
                $fileName = Randomizator::get_random_md5hash() . "_" . $files["fileToUpload"]["name"];
                $linkVariable = Uploader::uploadfile($fileName, $files["fileToUpload"]["tmp_name"]);
                $i = 0;
                foreach ($model->values as $value) {
                    if (strstr($value->field_feed_value, $files["imageToUpload"]["name"])) {
                        $model->values[$i]->field_feed_value = $linkVariable;
                    }
                    $i++;
                }
            }
        }
        return $model;
    }

    private function changeTemplate($template, $fields) {
        foreach ($fields as $field) {
            $template = str_replace("{" . $field->getValue("template_name") . "}", $field->object_values[0]->field_feed_value, $template);
        }
        return $template;
    }

    public function actionSetstatus() {
        if (!empty($_POST['id'])) {
            $model = $this->loadModel($_POST['id']);
            $model->status_id = $model->status_id == 0 ? 1 : 0;
            $model->save();
        }
    }

     public function actionGetTemplate() {

        switch ($_POST["template_name"]) {
            case "get_galery_input" : {
                    $i=$_POST["i"]+1;
                    $this->renderPartial("/feedsobject/template/galery_template", array("get_image_input"=>true,"name"=>$_POST['name'],"i"=>$i));
                    break;
           };   
        }
    }
    
    
    
}
