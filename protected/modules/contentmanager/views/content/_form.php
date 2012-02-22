<?php

foreach ($this->punkts as $key => $punkt) {
    if ($model->content_nonstructur) {
        if ($punkt["controller"] == "nottree") {
            $this->punkts[$key]["active_t"] = true;
            break;
        }
    } else if ($punkt["controller"] == $model->locale_id) {
        $this->punkts[$key]["active_t"] = true;
        break;
    }
}

$model->status = array(
    "0" => Translater::getDictionary()->status_notactive,
    "1" => Translater::getDictionary()->status_active
);
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'content-form',
    'enableClientValidation' => true,
    'clientOptions' => array('validateOnSubmit' => true,)
        ));
Yii::app()->clientScript->registerScriptFile(Yii::app()->getTheme()->getBaseUrl() . '/js/public/tiny_mce/jquery.tinymce.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->getTheme()->getBaseUrl() . '/js/private/tinymce_init.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(CHtml::asset(Yii::getPathOfAlias('contentmanager.resourse.js') . '/content.js'), CClientScript::POS_HEAD);

$list = $this->getCache("select_tree" . $model->locale_id, Content::model(), "getToSelect", array(0, $model->locale_id, "-", array()));
$inputs = array(
    array("type" => "x2",
        "inputs" => array(
            array("type" => "textfield",
                "label" => $form->labelEx($model, 'name'),
                "input" => $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)),
                "error" => $form->error($model, 'name', array("class" => "error-form-message")),
            ),
            array("type" => "textfield",
                "label" => $form->labelEx($model, 'textlink'),
                "additional_class" => "input-with-button",
                "input" => $form->textField($model, 'textlink', array('size' => 60, 'maxlength' => 255)) . "<div class='translit'></div>",
                "error" => $form->error($model, 'textlink'),
            )
        )
    ),
    array("type" => "textfield",
        "label" => $form->labelEx($model, 'content_redirectlink'),
        "input" => $form->textField($model, 'content_redirectlink', array('size' => 60, 'maxlength' => 255, "class" => $this->getclassError("title", $model->errors))),
        "error" => $form->error($model, 'content_redirectlink', array("class" => "error-form-message")),
    ),
    array("type" => "textfield",
        "label" => $form->labelEx($model, 'title'),
        "input" => $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255, "class" => $this->getclassError("title", $model->errors))),
        "error" => $form->error($model, 'title', array("class" => "error-form-message")),
    ),
    array("type" => "textfield",
        "label" => $form->labelEx($model, 'content_hone'),
        "input" => $form->textField($model, 'content_hone', array('size' => 60, 'maxlength' => 255, "class" => $this->getclassError("title", $model->errors))),
        "error" => $form->error($model, 'content_hone', array("class" => "error-form-message")),
    ),
    array("type" => "x2",
        "inputs" => array(
            array("type" => "textarea",
                "label" => $form->labelEx($model, 'meta_keywords'),
                "input" => $form->textArea($model, 'meta_keywords', array('rows' => 4)),
                "error" => $form->error($model, 'meta_keywords'),
            ),
            array("type" => "textarea",
                "label" => $form->labelEx($model, 'meta_text'),
                "input" => $form->textArea($model, 'meta_text', array('rows' => 4)),
                "error" => $form->error($model, 'meta_text'),
            )
        )
    ),
    array("type" => "select",
        "label" => $form->labelEx($model, 'parent_id'),
        "input" => $form->dropDownList($model, 'parent_id', $list,array("empty"=>Translater::getDictionary()->fieldChoisePage)),
    ),
    array("type" => "select",
        "label" => $form->labelEx($model, 'status_id'),
        "input" => $form->dropDownList($model, 'status_id', $model->status),
    ),
    array("type" => "checkbox",
        "label" => $form->labelEx($model, 'main_page'),
        "input" => $form->checkBox($model, 'main_page')
    ),
    array("type" => "checkbox",
        "label" => $form->labelEx($model, 'not_show_in_menu'),
        "input" => $form->checkBox($model, 'not_show_in_menu')
    ),
    array("type" => "checkbox",
        "label" => $form->labelEx($model, 'empty_link'),
        "input" => $form->checkBox($model, 'empty_link')
    ),
    array("type" => "textarea",
        "label" => $form->labelEx($model, 'content'),
        "input" => $form->textArea($model, 'content', array('class' => "tinymce", 'style' => "width:100%;height:600px")),
        "error" => $form->error($model, 'content'),
    )
);
if ($model->content_nonstructur) {
    $inputs[] = array(
        "type" => "hidden",
        "input" => $form->hiddenField($model, 'content_nonstructur')
    );
}

if (Setting::in()->countActiveLocale) {
    $inputs[] = array("type" => "select",
        "label" => $form->labelEx($model, 'locale_id'),
        "input" => $form->dropDownList($model, 'locale_id', $locales),
    );
    $model->setRelatedContent();
    foreach ($locales as $key => $value) {
        if ($model->locale_id != $key) {
            $cA = $this->getCache("select_tree" . $key, Content::model(), "getToSelect", array(0, $key));
            $inputs[] = array(
                "type" => "select",
                "label" => "<label>" . Translater::getDictionary()->contentmanagerObjectId . " - " . $value . "</label>",
                "input" => CHtml::dropDownList("Content[related_content][]", $model->related_content[$key], $cA, array("empty" => Translater::getDictionary()->fieldChoisePage))
            );
        }
    }
} else {
    $inputs[] = array(
        "type" => "hidden",
        "input" => $form->hiddenField($model, 'locale_id')
    );
}

$this->renderPartial("//block/inputs/rendertypedInputs", array("inputs" => $inputs));

$blockButton = array(
    array("name" => Translater::getDictionary()->button_save, "class" => "", "hidden" => false, "action" => false, 'access' => $this->checkAccess("manageContent"), "onclick" => "$(this).parents('form').submit();"),
    array("name" => Translater::getDictionary()->button_justsave, "class" => "", "hidden" => false, "action" => false, "access" => $this->checkAccess("manageContent"), "onclick" => "$(this).parents('form').append('<input type=\'hidden\' name=\'just_save\' value=\'true\' />').submit();"),
    array("name" => Translater::getDictionary()->button_cansel, "class" => "red", "hidden" => false, "action" => $this->createUrl("/contentmanager/"), "access" => $this->checkAccess("manageContent"), "onclick" => false),
);
$this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));
$this->endWidget();
?>
