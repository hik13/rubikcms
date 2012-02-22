<?php

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'content-form',
    'enableAjaxValidation' => false,
        ));

$inputs = array(
    array("type" => "textfield",
        "label" => $form->labelEx($model, 'dimension_group_name'),
        "input" => $form->textField($model, 'dimension_group_name'),
        "error" => $form->error($model, 'dimension_group_name'),
    ),
);

$this->renderPartial("//block/inputs/rendertypedInputs", array("inputs" => $inputs));

$blockButton = array(
    array("name" => Translater::getDictionary()->button_save, "class" => "", "hidden" => false, "action" => false, 'access' => $this->checkAccess("manageDimension"), "onclick" => "$(this).parents('form').submit();"),
    array("name" => Translater::getDictionary()->button_cansel, "class" => "red", "hidden" => false, "action" => $model->isNewRecord ? $this->createUrl("/catalogmanager/dimension/", array()) : $this->createUrl("/catalogmanager/dimension/view/", array("id" => $model->dimension_group_id)), "access" => $this->checkAccess("manageDimension"), "onclick" => false),
);

$this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));
$this->endWidget();
?>
