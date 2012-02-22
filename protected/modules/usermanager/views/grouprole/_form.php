<?php
$form = $this->beginWidget('CActiveForm', array(
            'id' => 'group-role-form',
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,)
        ));


$inputs = array(
    array("type" => "textfield",
        "label" => $form->labelEx($model, 'group_role_name'),
        "input" => $form->textField($model, 'group_role_name', array("class" => $this->getclassError("group_role_name", $model->errors))),
        "error" => $form->error($model, 'group_role_name', array("class" => "error-form-message")),
    ),
    array("type" => "textfield",
        "label" => $form->labelEx($model, 'group_desk'),
        "input" => $form->textField($model, 'group_desk', array('size' => 16, 'maxlength' => 16, "class" => $this->getclassError("group_role_name", $model->errors))),
        "error" => $form->error($model, 'group_desk', array("class" => "error-form-message")),
    ),   
);
$this->renderPartial("//block/inputs/rendertypedInputs", array("inputs" => $inputs));
$list = ModulHelper::getModulesConfigFiles();
foreach ($list as $modul) {
    Translater::setDictionary(Yii::app()->basePath . "/modules" . $modul["defaultCntrl"] . "messages", $modul["class"]);
}

foreach ($permission as $modul) {
    $j = 0;
    foreach ($modul->permission as $value) {
        $cheked = false;
        if (is_array($model->group_permission[$modul->module_id]["rights"])) {
            $cheked = in_array($value->permission_id, $model->group_permission[$modul->module_id]["rights"]) ? true : false;
        }
        $inputsC[] =
                array("type" => "checkbox",
                    "label" => CHtml::label(Translater::getDictionary()->{$value->name}, "ch" . $value->permission_id),
                    "input" => CHtml::checkBox("GroupRole[group_permission][" . $modul->module_id . "][rights][$j]", $cheked, array('value' => $value->permission_id, 'id' => "ch" . $value->permission_id)),
        );
        $j++;
    }
    $this->renderPartial('//block/dropdown_blok', array(
        'if_delete' => false,
        'dropdown_header_value' => CHtml::hiddenField("GroupRole[group_permission][" . $modul->module_id . "][modul]", $modul->module_id, array('id' => "ch" . $modul->module_id)) . Translater::getDictionary()->{$modul->module_name},
        'inputs' => $inputsC,
    ));
    $inputsC = array();
}

$blockButton = array(
    array("name" => Translater::getDictionary()->button_save, "class" => "green", "hidden" => false, "action" => false, 'access' => $this->checkAccess("manageGroupRole"), "onclick" =>"$(this).parents('form').submit()"),
    array("name" => Translater::getDictionary()->button_cansel, "class" => "red", "hidden" => false, "action" => $this->createUrl("/usermanager/grouprole/"), "access" => $this->checkAccess("manageGroupRole"), "onclick" => false),
);
$this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));
$this->endWidget();
?>
