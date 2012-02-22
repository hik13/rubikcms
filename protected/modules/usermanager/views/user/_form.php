<?php

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'user-form',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,)
        ));


$inputs [] = array(
    "type" => "textfield",
    "label" => $form->labelEx($model, 'user_login'),
    "input" => $form->textField($model, 'user_login', array('size' => 32, 'maxlength' => 32, 'class' => $this->getclassError("user_login", $model->errors))),
    "error" => $form->error($model, 'user_login', array("class" => "error-form-message")),
);
if (!$model->isNewRecord) {
    $inputs [] = array(
        "type" => "textfield",
        "label" => $form->labelEx($model, 'newPassword'),
        "input" => $form->passwordField($model, 'newPassword', array('size' => 60, 'maxlength' => 64)),
        "error" => $form->error($model, 'newPassword'),
    );
} else {
    $inputs [] = array(
        "type" => "textfield",
        "label" => $form->labelEx($model, 'password'),
        "input" => $form->passwordField($model, 'user_password', array('size' => 60, 'maxlength' => 64, 'class' => $this->getclassError("user_password", $model->errors))),
        "error" => $form->error($model, 'user_password', array("class" => "error-form-message")),
    );
}
$inputs [] = array("type" => "select",
    "label" => $form->labelEx($model, 'group_role_id'),
    "input" => $form->dropDownList($model, 'group_role_id', $role),
);

$inputs [] = array("type" => "select",
    "label" => $form->labelEx($model, 'user_status'),
    "input" => $form->dropDownList($model, 'user_status', array("1" => Translater::getDictionary()->usermanagerUserStatusActive, "0" => Translater::getDictionary()->usermanagerUserStatusBlocked)),
);


$inputs [] = array(
    "type" => "textfield",
    "label" => $form->labelEx($model, 'name'),
    "input" => $form->textField($model, 'name', array('size' => 60, 'maxlength' => 64, 'class' => $this->getclassError("name", $model->errors))),
    "error" => $form->error($model, 'name', array("class" => "error-form-message")),
);

$inputs [] = array(
    "type" => "textfield",
    "label" => $form->labelEx($model, 'email'),
    "input" => $form->textField($model, 'email', array('size' => 60, 'maxlength' => 64, 'class' => $this->getclassError("email", $model->errors))),
    "error" => $form->error($model, 'email', array("class" => "error-form-message")),
);

$this->renderPartial("//block/inputs/rendertypedInputs", array("inputs" => $inputs));

$blockButton = array(
    array("name" => Translater::getDictionary()->button_save, "class" => "green", "hidden" => false, "action" => false, 'access' => $this->checkAccess("manageUser"), "onclick" => "$(this).parents('form').submit()"),
    array("name" => Translater::getDictionary()->button_cansel, "class" => "red", "hidden" => false, "action" => $this->createUrl("/usermanager/"), "access" => $this->checkAccess("manageUser"), "onclick" => false),
);
$this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));
$this->endWidget();
?>

