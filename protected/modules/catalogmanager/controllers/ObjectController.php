<?php

class ObjectController extends BackController {

    protected $basicRigth = "manageObject";
    private $catalog;
    private $object_type;
    public $model = false;
    public $model_name;

    public function init() {
        parent::init();
        $this->breadcrumb = array(
            array("name" => Translater::getDictionary()->catalogmanager_CatalogName, "action" => $this->createUrl("/catalogmanager/"))
        );
    }

    private function returnModel($catalog_id, $object_type="category", $id=false) {
        
        if ($catalog_id) {
            $this->catalog = Catalog::model()->findByPk($catalog_id);
            $this->addBreadcrumb(array(array("name" => $this->catalog->catalog_name, "action" => $this->createUrl("/catalogmanager/object/index/", array("catalog" => $this->catalog->catalog_id)))));
        }

        $this->object_type = $object_type;
        switch ($this->object_type) {
            case "category" : {
                    if ($id) {
                        $this->model = Category::model()->findByPk($id);
                        $this->model_name = $this->model->category_name;
                    } else {
                        $this->model = new Category();
                    }
                    break;
                }
            case "essence" : {
                    if ($id) {
                        $this->model = Essence::model()->findByPk($id);
                        $this->model_name = $this->model->essence_name;
                    } else {
                        $this->model = new Essence();
                    }
                    break;
                }
            case "item" : {
                    if ($id) {
                        $this->model = Item::model()->findByPk($id);
                        $this->model_name = $this->model->item_name;
                    } else {
                        $this->model = new Item();
                    }
                    break;
                }
            default: {
                    $this->model = new Category;
                }
        }
    }

    public function actionIndex($catalog=0, $typeobject="category", $id=0) {
        $this->returnModel($catalog, $typeobject, $id);
        $this->renderObject();
    }

    private function renderObject() {
        switch ($this->object_type) {
            case "category" : {
                    $categorys = Category::model()->findAll("category_catalog_id=:catalog_id and category_parent_id=:id", Array("catalog_id" => $this->catalog->catalog_id, ":id" => $this->model->category_id ? $this->model->category_id : 0));
                    $essences = Essence::model()->findAll("essence_catalog_id=:catalog_id and essence_parent_id=:id", Array("catalog_id" => $this->catalog->catalog_id, ":id" => $this->model->category_id ? $this->model->category_id : 0));
                    $models = array_merge($categorys, $essences);
                    $this->render('index', array('models' => $models, 'catalog' => $this->catalog));
                    break;
                }
            case "essence" : {
                    $this->render('index', array('models' =>$this->model->item, 'catalog' => $this->catalog));
                    break;
                }
            case "item" : {
                    $this->render('/item/index', array('model' => $this->model));
                    break;
                }
        }
    }

    public function actionCreate($catalog=0, $typeobject="category", $parent_id=0) {
        $this->returnModel($catalog, $typeobject);
        $this->createObject($parent_id, $_POST);
    }

    private function createObject($parent_id, $post) {
        switch ($this->object_type) {
            case "category" : {
                    if (isset($parent_id))
                        $this->model->category_parent_id = $parent_id;
                    $this->model->category_catalog_id = $this->catalog->catalog_id;
                    if (isset($post['Category'])) {
                        $this->model->attributes = $post['Category'];
                        if ($this->model->save())
                            $this->redirect($this->createUrl("/catalogmanager/object/index/", array("catalog" => $this->model->category_catalog_id)));
                    }
                    $this->render('/category/create', array('model' => $this->model, "catalog" => $this->catalog));
                    break;
                }

            case "essence" : {
                    if (isset($parent_id))
                        $this->model->essence_parent_id = $parent_id;
                    $this->model->essence_catalog_id = $this->catalog->catalog_id;
                    if (isset($post['Essence'])) {
                        $this->model->attributes = $post['Essence'];

                        if ($this->model->save()) {
                            if (isset($post['Group'])) {
                                $this->saveEssenceAtributes($post);
                            }
                             $this->redirect($this->createUrl("/catalogmanager/object/index/", array("catalog" => $this->model->essence_catalog_id)));
                        }
                    }
                        $this->render('/essence/create', array('model' => $this->model, "catalog" => $this->catalog));
                        break;
                }

            case "item" : {

                    if (isset($parent_id))
                        $this->model->item_parent_id = $parent_id;

                    if (isset($post['Item'])) {
                        if ($post['manufacturer_name']) {
                            $this->model->ifSaveManufactured($post['manufacturer_name']);
                        }
                       
                        
                        $this->model->attributes = $post['Item'];
                        if ($this->model->save()) {
                            if (is_array($post['Item']["ValueSelectable"])) {
                                foreach ($post['Item']["ValueSelectable"] as $val) {
                                    $val["item_id"] = $this->model->item_id;
                                    if (!is_array($val["value"])) {
                                        $value = ParameterValue::getNewParameterModel($val["parameter_work_id"], $val["parameter_type_id"], $val["parameter_number_id"]);
                                        $value->saveValue($val);
                                        $value = null;
                                    } else {
                                        $multival["item_id"] = $this->model->item_id;
                                        $multival["parameter_id"] = $val["parameter_id"];
                                        foreach ($val["value"] as $mvalue) {
                                            if (!empty($mvalue)) {
                                                $multival["value"] = $mvalue["value"];
                                                $value = ParameterValue::getNewParameterModel($val["parameter_work_id"], $val["parameter_type_id"], $val["parameter_number_id"]);
                                                $value->saveValue($multival);
                                                $value = null;
                                            }
                                        }
                                    }
                                }
                            }
                            $this->redirect($this->createUrl("/catalogmanager/object/index/", array("catalog" => $this->catalog->catalog_id, "typeobject" => "essence", "id" => $this->model->item_parent_id)));
                        }
                    }

                    $this->render('/item/create', array('model' => $this->model, "catalog" => $this->catalog));
                    break;
                }
        }
    }

    public function actionUpdate($catalog=0, $typeobject="category", $id=0) {
        $this->returnModel($catalog, $typeobject, $id);
        $this->updateObject($_POST);
    }

    private function updateObject($post=false) {

        switch ($this->object_type) {
            case "category" : {
                    if (isset($post['Category'])) {
                        $this->model->attributes = $post['Category'];
                        if ($this->model->save())
                            $this->redirect($this->createUrl("/catalogmanager/object/index/", array("catalog" => $this->model->category_catalog_id, "typeobject" => "category", "id" => $this->model->category_id)));
                    }
                    $this->render('/category/update', array('model' => $this->model, "catalog" => $this->catalog));
                    break;
                }

            case "essence" : {
                    if (isset($post['Essence'])) {
                        if (isset($post["deleteObject"])) {
                            foreach ($post["deleteObject"] as $id) {
                                $key = key($id);
                                $key::model()->findByPk($id[$key])->delete();
                            }
                        }
                        $this->model->attributes = $post['Essence'];
                       
                        if ($this->model->save()) {
                             if (isset($post['Group'])) {
                               $this->saveEssenceAtributes($post);
                            }
                            $this->redirect($this->createUrl("/catalogmanager/object/index/", array("catalog" => $this->model->essence_catalog_id, "typeobject" => "essence", "id" => $this->model->essence_id)));
                        }
                    }
                    $this->render('/essence/update', array('model' => $this->model, "catalog" => $this->catalog));
                    break;
                }

            case "item" : {
                    if (isset($id))
                        $this->model->item_parent_id = $id;
                    if (isset($post['Item'])) {             
                        if ($post['manufacturer_name']) {
                            $this->model->ifSaveManufactured($post['manufacturer_name']);
                        }
                        $this->model->attributes = $post['Item'];
                        if ($this->model->save()) {
                            if (is_array($post['Item']["ValueSelectable"])) {
                                foreach ($post['Item']["ValueSelectable"] as $val) {
                                    $val["item_id"] = $this->model->item_id;
                                    if (!is_array($val["value"])) {
                                        $value = ParameterValue::getNewParameterModel($val["parameter_work_id"], $val["parameter_type_id"], $val["parameter_number_id"]);
                                        $value->saveValue($val, $val["id"]);
                                        $value = null;
                                    } else {
                                        $multival["item_id"] = $this->model->item_id;
                                        $multival["parameter_id"] = $val["parameter_id"];
                                        foreach ($val["value"] as $mvalue) {
                                            if (!empty($mvalue)) {
                                                $multival["value"] = $mvalue["value"];
                                                $value = ParameterValue::getNewParameterModel($val["parameter_work_id"], $val["parameter_type_id"], $val["parameter_number_id"]);
                                                $value->saveValue($multival, $mvalue["id"]);
                                                $value = null;
                                            }
                                        }
                                  
                                    }
                                }
                            }
                            $this->redirect($this->createUrl("/catalogmanager/object/index/", array("catalog" => $this->catalog->catalog_id, "typeobject" => "essence", "id" => $this->model->item_parent_id)));
                        }
                    }
                    $this->render('/item/update', array('model' => $this->model, "catalog" => $this->catalog));
                    break;
                }
        }
    }

    public function actionDelete($catalog=0, $typeobject="category", $id=0) {
        if ($id) {
            $this->returnModel($catalog, $typeobject, $id);
            $redirect = $this->deleteObject();
        } else if (!empty($_POST["Deleteobject"])) {
            foreach ($_POST["Deleteobject"] as $value) {
                if (!empty($value["id"])) {
                    $this->returnModel($catalog, $value["type"], $value["id"]);
                    $redirect = $this->deleteObject();
                }
            }
        }
        $this->redirect($redirect);
    }

    private function deleteObject() {
        switch ($this->object_type) {
            case "category" : {
                    $redirect = $this->createUrl("/catalogmanager/object/index/", array("catalog" => $this->model->category_catalog_id, "typeobject" => "category", "id" => $this->model->category_parent_id));
                    $this->model->delete();

                    break;
                }
            case "essence" : {
                    $redirect = $this->createUrl("/catalogmanager/object/index/", array("catalog" => $this->model->essence_catalog_id, "typeobject" => "category", "id" => $this->model->essence_parent_id));
                    $this->model->delete();
                    break;
                }
            case "item" : {
                    $es = Essence::model()->findByPk($this->model->item_parent_id);
                    $redirect = $this->createUrl("/catalogmanager/object/index/", array("catalog" => $es->essence_catalog_id, "typeobject" => "essence", "id" => $es->essence_id));
                    $this->model->delete();
                    break;
                }
        }
        return $redirect;
    }

    public function actionGetForm() {
        switch ($_POST["type"]) {
            case "group" : {
                    $model = new Group();
                    $this->renderPartial('/essence/group/_form', array('model' => $model, "i" => $_POST["i"]));
                    break;
                }
            case "parameter" : {
                    $model = new Parameter();
                    if (!empty($_POST["parametr_parent_id"])) {
                        if ($_POST["type_id"] == "2") {
                            $model->parameter_joint_id = $_POST["parametr_parent_id"];
                        } else if ($_POST["type_id"] == "3") {
                            $model->parameter_slave_id = $_POST["parametr_parent_id"];
                        }
                    }
                    $model->parameter_group_id=$_POST["group_id"];
                    $this->renderPartial('/essence/parameter/_form', array('model' => $model));
                    break;
                }
            case "parameter_selectable_value" : {
                    $i = empty($_POST["i"]) ? 1 : $_POST["i"] + 1;
                    $inputname = $_POST["inputname"] . "[Selectable][" . $i . "]";
                    $model = new Selectable();
                    $model->value = $_POST["value"];
                    $this->renderPartial('/essence/parameter/_form_selectable_value', array("i" => $i, "inputname" => $inputname, "model" => $model));
                    break;
                }
            default : {
                    return false;
                }
        }
    }
    
    
     public function actiongetMasterInput() {

        if ($_POST["parameter_id"]) {
            Parameter::$i=$_POST["count_values"];
            $models = Parameter::model()
                    ->with(array("multiple_value"=>array("condition"=>"master_value_id=:master_value_id","params"=>array(":master_value_id"=>$_POST["value_id"]))))
                    ->findAll(array("condition" => "parameter_slave_id=:parameter_slave_id",
                "params" => array(":parameter_slave_id" => $_POST["parameter_id"])));
            if (count($models) > 0) {
                foreach ($models as $model) {
                    $this->renderPartial("/item/value/parameter_value", array("parameter" => $model, "item_id" => ""));
                }
            }
        }
    }
    
    public function actiongetBoolInput() {
        $boolean = array("0" => Translater::getDictionary()->catalogmanager_parameterArrayBooleanNo,
            "1" => Translater::getDictionary()->catalogmanager_parameterArrayBooleanYes);
        if ($_POST["get"]) {
            echo CHtml::dropDownList($_POST["name"], $_POST["value"], $boolean, array("empty" => (Translater::getDictionary()->catalogmanager_selectValue)));
        }
    }
    
    
    private function saveEssenceAtributes($post) {
        
        foreach ($post["Group"] as $var_group) {
            $group = new Group();
            $var_group["group_essence_id"] = $this->model->essence_id;
            $group = $group->groupSave($var_group, $var_group["group_id"]);
        }
        foreach ($post["Parameter"] as $var_parameter) {
            $parameter = new Parameter();
            $var_parameter["parameter_essence_id"] = $this->model->essence_id;
            
            $parameter = $parameter->parameterSave($var_parameter, $var_parameter["parameter_id"]);
            if (isset($var_parameter["Selectable"])) {
                foreach ($var_parameter["Selectable"] as $var_selectable) {
                    $selectable = new Selectable();
                    $var_selectable["type_id"] = $parameter->parameter_type_id;
                    $var_selectable["id_parameter"] = $parameter->parameter_id;
                    $selectable->selectableSave($var_selectable, $var_selectable["id"]);
                }
            }
        }
        if (isset($_POST['NewOrder'])) {
            foreach ($_POST['NewOrder'] as $no) {
                $key = key($no);
                $li = explode("|", $no[$key]);
                if ($li)
                    foreach ($li as $i => $value) {
                        if (!empty($value)) {
                            $model = $key::model()->findByPk($value);
                            $param = strtolower($key) . "_order";
                            $model->$param = $i;
                            $model->save();
                        }
                    }
            }
        }
    }
      
}
?>
