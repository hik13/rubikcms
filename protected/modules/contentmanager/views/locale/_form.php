<?php
Yii::app()->clientScript->registerScriptFile(CHtml::asset(Yii::getPathOfAlias('contentmanager.resourse.js') . '/locale.js'), CClientScript::POS_HEAD);
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'locale-form',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,)
        ));
$model->status = array(
    "0" => Translater::getDictionary()->status_notactive,
    "1" => Translater::getDictionary()->status_active
);
$inputs = array(
    array("type" => "textfield",
        "label" => $form->labelEx($model, 'locale_description'),
        "input" => $form->textField($model, 'locale_description', array("class" => $this->getclassError("locale_description", $model->errors))),
        "error" => $form->error($model, 'locale_description'),
    ),
    array("type" => "textfield",
        "label" => $form->labelEx($model, 'locale_code'),
        "input" => $form->textField($model, 'locale_code', array('size' => 16, 'maxlength' => 16, "class" => $this->getclassError("locale_code", $model->errors))),
        "error" => $form->error($model, 'locale_code'),
    ),
    array("type" => "select",
        "label" => $form->labelEx($model, 'locale_status'),
        "input" => $form->dropDownList($model, 'locale_status', $model->status),
    ),
    array("type" => "array",
        "inputs" => array(
            array("type" => "radiobutton",
                "label" => $form->labelEx($model, 'locale_prefix_version'),
                "input" => CHtml::radioButton("Locale[locale_prefix_version]", $model->locale_prefix_version,array("value"=>1,"class"=>"adress_version"))),
            array("type" => "radiobutton",
                "label" => $form->labelEx($model, 'locale_domen_version'),
                "input" => CHtml::radioButton("Locale[locale_prefix_version]", !$model->locale_prefix_version,array("value"=>0,"class"=>"adress_version"))),
        )
    ),
    "inputs" => array(
         "type" => "textfield",
         "label" =>"",
         "input" => $form->textField($model, 'locale_domen_version', array('size' => 56, 'maxlength' => 512, "class" =>"domen_input")),
    )
);
$this->renderPartial("//block/inputs/rendertypedInputs", array("inputs" => $inputs));
$blockButton = array(
    array("name" => Translater::getDictionary()->button_save, "class" => "", "hidden" => false, "action" => false, 'access' => $this->checkAccess("manageLocale"), "onclick" => "$(this).parents('form').submit();"),
    array("name" => Translater::getDictionary()->button_cansel, "class" => "red", "hidden" => false, "action" => $this->createUrl("/contentmanager/locale/"), "access" => $this->checkAccess("manageLocale"), "onclick" => false),
);
$this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));
$this->endWidget();
?>
