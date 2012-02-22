<?php
$form = $this->beginWidget('CActiveForm', array(
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,)
        ));

$inputs = array(
    array("type" => "textfield",
        "label" => $form->labelEx($model, 'position_code'),
        "input" => $form->textField($model, 'position_code', array('size' => 60, 'maxlength' => 64)),
        "error" => $form->error($model, 'position_code'),
    ),
    array("type" => "textfield",
        "label" => $form->labelEx($model, 'position_desk'),
        "input" => $form->textField($model, 'position_desk', array('size' => 120, 'maxlength' => 128)),
        "error" => $form->error($model, 'position_desk'),
    ),
);
$this->renderPartial("//block/inputs/rendertypedInputs", array("inputs" => $inputs));
$blockButton = array(
    array("name" => Translater::getDictionary()->button_save, "class" => "", "action" => false, "hidden" => false, 'access' => $this->checkAccess("manageBlock"), "onclick" => "$(this).parents('form').submit();"),
    array("name" => Translater::getDictionary()->button_cansel, "class" => "red", "action" => $this->createUrl("/blockmanager/blockposition/"), "hidden" => false, "access" => $this->checkAccess("manageBlock"), "onclick" => false),
);
$this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));

$this->endWidget();
?>

