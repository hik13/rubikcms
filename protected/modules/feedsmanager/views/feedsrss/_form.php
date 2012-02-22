<?php
Yii::app()->clientScript->registerScriptFile(CHtml::asset(Yii::getPathOfAlias('feedsmanager.resourse.js') . '/feed.js'), CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(CHtml::asset(Yii::getPathOfAlias('feedsmanager.resourse.js') . '/rss.js'), CClientScript::POS_HEAD);

$form = $this->beginWidget('CActiveForm', array(
            'id' => 'feedsrss-form',
            'enableClientValidation' => true,
            'clientOptions' => array(
            'validateOnSubmit' => true,)
        ));
$inputs = array(
        array("type" => "textfield",
        "label" => CHtml::label(Translater::getDictionary()->feedsrss_directory_name,"RSS[name]"),
        "input" => CHtml::textField("RSS[name]",$model->feed_rss['name']),
        "error" =>"",
    ),
    
    array("type" => "select",
        "label" => CHtml::label(Translater::getDictionary()->feedsrss_category_name, 'RSS[feeds]'),
        "input" => CHtml::dropDownList('RSS[feeds]','Feed name',$list),
    ),
    
   array("type" => "textfield",
        "label" => CHtml::label(Translater::getDictionary()->feedsrss_count_name,"RSS[pages]"),
        "input" => CHtml::textField("RSS[pages]",$model->feed_rss['pages']),
        "error" =>"",
    ),
    array("type" => "hidden",
        "input" => CHtml::hiddenField('rss_desc', $model->feed_rss['desc'])
    ),
    array("type" => "nothing",
        "input" =>'<div class="rss_description"></div>'
    ), 
);

$this->renderPartial("//block/inputs/rendertypedInputs", array("inputs" => $inputs));
$blockButton = array(
    array("name" => Translater::getDictionary()->button_save, "class" => "", "hidden" => false, "action" => false, 'access' => $this->checkAccess("manageFeeds"), "onclick" => "$(this).parents('form').submit();"),
    array("name" => Translater::getDictionary()->button_cansel, "class" => "red", "hidden" => false, "action" => $this->createUrl("/feedsmanager/"), "access" => $this->checkAccess("manageFeeds"), "onclick" => false),
);
$this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));
$this->endWidget();
?>
