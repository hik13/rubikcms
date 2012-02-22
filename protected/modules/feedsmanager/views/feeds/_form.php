<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'feeds-form',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,)
        ));
Yii::app()->clientScript->registerScriptFile(CHtml::asset(Yii::getPathOfAlias('feedsmanager.resourse.js') . '/feed.js'), CClientScript::POS_HEAD);
foreach ($model->sort_array as $key => $value) {
    $array_sort[$key] = Translater::getDictionary()->$value;
}
foreach ($model->sort_line as $key => $value) {
    $array_line[$key] = Translater::getDictionary()->$value;
}
$model->status = array(
    "1" => Translater::getDictionary()->status_active,
    "0" => Translater::getDictionary()->status_notactive
);
$inputs = array(
    array("type" => "textfield",
        "label" => $form->labelEx($model, 'feed_name'),
        "input" => $form->textField($model, 'feed_name', array('size' => 60, 'maxlength' => 256)),
        "error" => $form->error($model, 'feed_name'),
    ),
    array("type" => "textfield",
        "label" => $form->labelEx($model, 'on_page'),
        "input" => $form->textField($model, 'on_page', array('size' => 60, 'maxlength' => 256)),
        "error" => $form->error($model, 'on_page'),
    ),
    array("type" => "select",
        "label" => $form->labelEx($model, 'sort_by'),
        "input" => CHtml::dropDownList("Feeds[sort_by][sort]", $model->sort_by["sort"], $array_sort) . CHtml::dropDownList("Feeds[sort_by][desc]", $model->sort_by["desc"], $array_line),
    ),
    array("type" => "select",
        "label" => $form->labelEx($model, 'feed_status'),
        "input" => $form->dropDownList($model, 'feed_status', $model->status),
    ),
    array("type" => "hidden",
        "input" => $form->hiddenField($model, 'feed_id', array('id' => 'feed_id')),
    ),
    array("type" => "textarea",
        "label" => $form->labelEx($model, 'template'),
        "input" => $form->textArea($model, 'template', array('rows' => 13, 'cols' => 80, 'class' => "")),
        "error" => $form->error($model, 'template'),
    ),
);
$this->renderPartial("//block/inputs/rendertypedInputs", array("inputs" => $inputs));
?>

<div class="form-row clearfix">
    <?php echo $form->labelEx($model, 'category') ?> 
    <div id="category">
        <?php  
         foreach ($model->category as $key => $category) {  
         $this->renderPartial('/feeds/template/category_form', array('i' => $key, "value"=>$category));
         } ?>
    </div>
    <div id="add_depfile" class="add_category">
        <span><?php echo Translater::getDictionary()->feedsmanagerAddCategory ?></span>
    </div>
</div>




<div id="relation">
    <label> <?php echo Translater::getDictionary()->feedsmanagerFeedDisplayOn;?></label>
   <?php 
   $list = $this->getCache("select_tree", Content::model(), "getToSelect", array(0, false, "-", array(Translater::getDictionary()->fieldChoisePage)));
    $i = 0;

    foreach ($model->relations as $relation) {
        $array_chekbox = array();
        $dropdown_header_value = CHtml::hiddenField("ContentModuleRelation[$i][relation_id]", $relation->relation_id, array("class" =>"relation_id"));
        $dropdown_header_value.=CHtml::dropDownList("ContentModuleRelation[$i][relation_content_id]", $relation->relation_content_id, $list, array("class" => "content_module_relation"));
        $category = unserialize($relation->relation_module_condition);
            $j = 0;
            foreach ($model->category as $key=>$ca) {
                $cheked = false;
                if (is_array($category)) {
                    $cheked = in_array($ca, $category);
                }
                $array_chekbox[$j]["chekbox"] = CHtml::checkBox("ContentModuleRelation[$i][relation_module_condition][$key]", $cheked, array('value' => $ca,"class"=>"relation_$key"));
                $array_chekbox[$j]["label"] = CHtml::label($ca, "my_name" . $j);
                $j++;
            }
        $this->renderPartial('//block/dropdown_4_checkbox', array(
            'if_delete' => true,
            'on_delete'=>"deleteRelation('edit',this)",
            'dropdown_header_value' => $dropdown_header_value,
            'array_chekbox' => $array_chekbox,
        ));
        $i++;
    }
    ?>        
</div>

<div class="form-row clearfix">
    <a id="Add_relation" class="catalog-add-new-group"><?php echo Translater::getDictionary()->feedsmanagerAddRelationPage ?></a>  
</div>



<div id="fields">
    <?php
    if (count($model->fields) > 0) {
        $list = Fieldtype::model()->getKeyValueArray("field_type_id", "field_description", array(), array("feedsmanager_getTypeField"));
        $i = 0;
        foreach ($model->fields as $fields) {
        if ($fields->isNewRecord) {
            $dropdown_header_value = CHtml::dropDownList("FieldFeeds[$i][field_type_id]", $fields->field_type_id, $list, array("class" => "typeField", "id" => $i));
        } else {
            $dropdown_header_value = Translater::getDictionary()->{$fields->fieldstype->field_description} . CHtml::hiddenField("FieldFeeds[$i][field_feed_id]", $fields->field_feed_id, array());
            ;
        }
        $models_Field = Fieldproperty::model()->getPropertys($fields->field_type_id);
        $j = 0;
        foreach ($models_Field as $input) {
            $val = $this->returnValues($fields->values, $input->property_id);
            $inputsC[] = $input->returnInput($i, $j, $val);
            $j++;
        }
        $this->renderPartial('//block/dropdown_blok', array(
            'if_delete' => true,
            'dropdown_header_value' => $dropdown_header_value,
            'inputs' => $inputsC,
        ));
        $i++;
        $inputsC = array();
    }
    }
    ?>
</div>
<div class="form-row clearfix">
    <a id="addTofields" class="catalog-add-new-group">
        <?php echo Translater::getDictionary()->feedsmanagerAddFields ?>
    </a>   
</div>


<?php
$blockButton = array(
    array("name" => Translater::getDictionary()->button_save, "class" => "", "hidden" => false, "action" => false, 'access' => $this->checkAccess("manageFeeds"), "onclick" => "$(this).parents('form').submit();"),
    array("name" => Translater::getDictionary()->button_cansel, "class" => "red", "hidden" => false, "action" => $this->createUrl("/feedsmanager/"), "access" => $this->checkAccess("manageFeeds"), "onclick" => false),
);
$this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));
$this->endWidget();
?>
