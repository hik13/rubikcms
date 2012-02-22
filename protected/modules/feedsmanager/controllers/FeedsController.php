<?php

class FeedsController extends BackController {

    protected $basicRigth = "manageFeeds";

    public function init() {
        parent::init();
        $this->breadcrumb = array(
            array("name" => Translater::getDictionary()->feedsmanager_name, "action" => $this->createUrl("/feedsmanager/")),
        );
    }

    public function filters() {
        $array = parent::filters();
        $array[0] = $array[0] . ",getfields,getproperty,getrelation,setstatus";
        return $array;
    }

    public function actionIndex() {
        $model = new Feeds();
        $this->render('index', array('feeds' => $model->findAll()));
    }

    public function actionCreate() {
        $model = new Feeds;
        if (isset($_POST['Feeds'])) {
            if (!empty($_POST['ContentModuleRelation'])) {
                $model->tempCondition = $_POST['ContentModuleRelation'];
            }
            $model->attributes = $_POST['Feeds'];
            if ($model->save()) {
                if (isset($_POST['FieldFeeds'])) {
                    $this->saveFields($_POST['FieldFeeds'], $_POST['FieldFeedsValue'], $model);
                }
                $this->redirect(array('index'));
            }
        }
        $this->render('create', array(
            'model' => $model)
        );
    }

    public function actionUpdate($id) {
        if (isset($_POST['Feeds'])) {
            $model = $this->loadModel($id);
            if (isset($_POST['deleteRelation'])) {
                foreach ($_POST["deleteRelation"] as $id) {
                    $model = ContentModuleRelation::model()->findByPk((int) $id);
                    $model->delete();
                }
            }
            if (!empty($_POST['ContentModuleRelation'])) {
                $model->tempCondition = $_POST['ContentModuleRelation'];
            }

            if (isset($_POST['deleteField'])) {
                foreach ($_POST["deleteField"] as $id) {
                    $model = FieldFeeds::model()->findByPk((int) $id);
                    $model->delete();
                }
            }
            $model->attributes = $_POST['Feeds'];
            if ($model->save()) {
                if (isset($_POST['FieldFeeds'])) {
                    $this->saveFields($_POST['FieldFeeds'], $_POST['FieldFeedsValue'], $model);
                }
                $this->redirect(array('index'));
            }
        }
        $model = Feeds::model()->with(array("fields" => array('with' => 'values', "relations",)))->findByPk($id);
        $this->render('update', array('model' => $model));
    }

    private function saveFields($fields, $fields_value, Feeds $model) {
        foreach ($fields as $key => $field) {
            if (!$records = Fieldfeeds::model()->findByPk((int) $field["field_feed_id"])) {
                $records = new FieldFeeds();
                $records->feed_id = $model->feed_id;
            }
            $records->attributes = $field;
            
            if ($records->save()) {
                foreach ($fields_value[$key] as $value) {
                    if (!$records1 = Fieldfeedsvalue::model()->findByPk((int) $value["field_id"])) {
                        $records1 = new Fieldfeedsvalue();
                        $records1->field_feed_id = $records->field_feed_id;
                    }
                    $records1->attributes = $value;
                    $records1->field_value = isset($value["field_value"]) ? $value["field_value"] : "";
                    $records1->save();
                }
            }
        }
    }

    public function actionDelete($id=false) {
        if ($id) {
            $this->loadModel($id)->delete();
        } else if (!empty($_POST["feed_id"])) {
            foreach ($_POST["feed_id"] as $id) {
                $this->loadModel($id)->delete();
            }
        }
        $this->redirect(array('index'));
    }

    public function actionGetTemplate() {

        switch ($_POST["template_name"]) {

            case "fields_choise" : {
                    $list = Fieldtype::model()->getKeyValueArray("field_type_id", "field_description", array());
                    $this->renderPartial('//block/dropdown_blok', array(
                        'if_delete' => true,
                        'dropdown_header_value' => CHtml::dropDownList("FieldFeeds[" . $_POST["count"] . "][field_type_id]", "", $list, array("empty" => Translater::getDictionary()->feedsmanager_getTypeField, "class" => "typeField", "id" => $_POST["count"])),
                        'inputs' => array(),
                    ));
                    break;
                };

            case "fields_property" : {
                    $models = Fieldproperty::model()->getPropertys($_POST['field_id']);
                    $j = 0;
                    foreach ($models as $input) {
                        $inputsC[] = $input->returnInput($_POST['i'], $j);
                        $j++;
                    }
                    $this->renderPartial("//block/inputs/rendertypedInputs", array("inputs" => $inputsC));
                    break;
                };

            case "get_relation" : {
                    if (isset($_POST['category'])) {
                        $list = $this->getCache("select_tree", Content::model(), "getToSelect", array(0, false, "-", array(Translater::getDictionary()->fieldChoisePage)));
                        $array_chekbox = array();
                        $cheked = false;
                        $j = 0;
                        foreach ($_POST['category'] as $key => $ca) {
                            if ($ca != "") {
                                $array_chekbox[$j]["chekbox"] = CHtml::checkBox("ContentModuleRelation[" . $_POST['i'] . "][relation_module_condition][$key]", $cheked, array('value' => $ca,));
                                $array_chekbox[$j]["label"] = CHtml::label($ca, "my_name" . $j);
                                $j++;
                            }
                        }
                        $this->renderPartial('//block/dropdown_4_checkbox', array(
                            'if_delete' => true,
                            'on_delete' => "deleteRelation('new',this)",
                            'dropdown_header_value' => CHtml::dropDownList("ContentModuleRelation[" . $_POST['i'] . "][relation_content_id]", 0, $list, array("class" => "content_module_relation")),
                            'array_chekbox' => $array_chekbox,
                        ));
                    }
                };
            case "get_category" : {
                    $this->renderPartial('/feeds/template/category_form', array(
                        'i' => $_POST['i'] + 1));
                    break;
                };
           case "get_list_data_input" : {
                    $this->renderPartial("/feeds/template/add_list_data", array("get_one_value"=>true,"name"=>$_POST['name']));
                    break;
           };    
            case "get_image_size_input" : {
                    $i=$_POST["i"]+1;
                    $this->renderPartial("/feeds/template/image_galery", array("get_one_value"=>true,"name"=>$_POST['name'],"i"=>$i));
                    break;
           };   
                
        }
    }

    public function returnValues($array, $id) {
        foreach ($array as $value) {
            if ($value->property_id == $id) {
                return $value;
            }
        }
    }

    public function loadModel($id) {
        $model = Feeds::model()->findByPk((int) $id);
        if ($model === null)
            $this->redirect($this->createUrl("/system/system/404"));
        return $model;
    }

    public function actionSetstatus() {
        if (!empty($_POST['id'])) {
            $model = $this->loadModel($_POST['id']);
            $model->feed_status = $model->feed_status == 0 ? 1 : 0;
            $model->save();
        }
    }

}
