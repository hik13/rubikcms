<?php
Yii::app()->clientScript->registerScriptFile(CHtml::asset(Yii::getPathOfAlias('feedsmanager.resourse.js') . '/feedobject.js'), CClientScript::POS_HEAD);
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'feeds-object-form',
    'enableClientValidation' => true,
    'clientOptions' => array('validateOnSubmit' => true,),
    'htmlOptions' => array("enctype" => "multipart/form-data")
        ));
$model->status = array(
    "0" => Translater::getDictionary()->status_notactive,
    "1" => Translater::getDictionary()->status_active
);
$inputs = array(
    array("type" => "hidden",
        "input" => $form->hiddenField($model, "feed_id", array())
    ),
    array("type" => "textfield",
        "label" => $form->labelEx($model, 'feed_object_name'),
        "input" => $form->textField($model, 'feed_object_name', array('size' => 60, 'maxlength' => 256)),
        "error" => $form->error($model, 'feed_object_name'),
    ),
    array("type" => "select",
        "label" => $form->labelEx($model, 'status_id'),
        "input" => $form->dropDownList($model, 'status_id', $model->status),
    ),
);
$this->renderPartial("//block/inputs/rendertypedInputs", array("inputs" => $inputs));

if (!empty($feed->category)) {
    foreach ($feed->category as $i => $cat) {
        $cheked = false;
        if (is_array($model->feed_object_category)) {
            $cheked = in_array($cat, $model->feed_object_category);
        }
        $array_chekbox[$i]["chekbox"] = CHtml::checkBox("FeedsObject[feed_object_category][$i]", $cheked, array('value' => $cat));
        $array_chekbox[$i]["label"] = CHtml::label($cat, "my_name" . $i);
    }
    $this->renderPartial('//block/dropdown_4_checkbox', array(
        'if_delete' => false,
        'dropdown_header_value' => Translater::getDictionary()->feedsmanagerFeedCategory,
        'array_chekbox' => $array_chekbox,
    ));
}

foreach ($feed->fields as $field) {
    $this->renderPartial("//block/inputs/rendertypedInputs", array("inputs" => $field->returnInput($model->feed_object_id)));
}
$blockButton = array(
    array("name" => Translater::getDictionary()->button_save, "class" => "", "hidden" => false, "action" => false, 'access' => $this->checkAccess("manageFeedsObject"), "onclick" => "$(this).parents('form').submit();"),
    array("name" => Translater::getDictionary()->button_justsave, "class" => "", "hidden" => false, "action" => false, "access" => $this->checkAccess("manageFeedsObject"), "onclick" => "$(this).parents('form').append('<input type=\'hidden\' name=\'just_save\' value=\'true\' />').submit();"),
    array("name" => Translater::getDictionary()->button_cansel, "class" => "red", "hidden" => false, "action" => $this->createUrl("/feedsmanager/feedsobject/index/", array("id" => $model->feed_id)), "access" => $this->checkAccess("manageFeedsObject"), "onclick" => false),
);
$this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));
$this->endWidget();
?>

