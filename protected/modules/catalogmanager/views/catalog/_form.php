<?php

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'content-form',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,)
        ));
$model->status = array(
    "0" => Translater::getDictionary()->status_notactive,
    "1" => Translater::getDictionary()->status_active
);

$list = $this->getCache("select_tree", Content::model(), "getToSelect", array(0));
array_unshift($list, Translater::getDictionary()->fieldChoisePage);
$inputs = array(
    array("type" => "textfield",
        "label" => $form->labelEx($model, 'catalog_name'),
        "input" => $form->textField($model, 'catalog_name'),
        "error" => $form->error($model, 'catalog_name'),
    ),
    array("type" => "select",
        "label" => $form->labelEx($model, 'catalog_display_on'),
        "input" => $form->dropDownList($model, 'catalog_display_on', $list),
        "error" => $form->error($model, 'catalog_display_on'),
    ),
    array("type" => "select",
        "label" => $form->labelEx($model, 'catalog_status_id'),
        "input" => $form->dropDownList($model, 'catalog_status_id', $model->status),
        "error" => $form->error($model, 'catalog_status_id'),
    ),
    array("type" => "select",
        "label" => $form->labelEx($model, 'catalog_version_id'),
        "input" => $form->dropDownList($model, 'catalog_version_id', Locale::getLocaleList(Array("key" => "locale_id", "value" => "locale_description"))),
    ),
);
$this->renderPartial("//block/inputs/rendertypedInputs", array("inputs" => $inputs));


$blockButton = array(
    array("name" => Translater::getDictionary()->button_save, "class" => "", "hidden" => false, "action" => false, 'access' => $this->checkAccess("manageObject"), "onclick" => "$(this).parents('form').submit();"),
    array("name" => Translater::getDictionary()->button_cansel, "class" => "red", "hidden" => false, "action" => $this->createUrl("/catalogmanager/"), "access" => $this->checkAccess("manageObject"), "onclick" => false),
);
$this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));

$this->endWidget();
?>

