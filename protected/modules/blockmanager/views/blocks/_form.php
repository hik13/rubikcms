<?php
Yii::app()->clientScript->registerScriptFile(CHtml::asset(Yii::app()->getTheme()->getBasePath() . '/js/public/tiny_mce/jquery.tinymce.js', CClientScript::POS_HEAD));
Yii::app()->clientScript->registerScriptFile(CHtml::asset(Yii::app()->getTheme()->getBasePath() . '/js/private/tinymce_init.js', CClientScript::POS_HEAD));
Yii::app()->clientScript->registerScriptFile(CHtml::asset(Yii::getPathOfAlias('blockmanager.resourse.js') . '/block.js'), CClientScript::POS_HEAD);
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'block-form',
    'enableClientValidation' => true,
    'clientOptions' => array('validateOnSubmit' => true,),
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
$model->status = array(
    "1" => Translater::getDictionary()->status_active,
    "0" => Translater::getDictionary()->status_notactive
);

$inputs = array(
    array("type" => "textfield",
        "label" => $form->labelEx($model, 'block_name'),
        "input" => $form->textField($model, 'block_name'),
        "error" => $form->error($model, 'block_name', array("class" => "error-form-message")),
    ),
    array("type" => "select",
        "label" => $form->labelEx($model, 'block_position_id'),
        "input" => $form->dropDownList($model, 'block_position_id', $position, array("empty" => Translater::getDictionary()->fieldChoisePosition)),
        "error" => $form->error($model, 'block_position_id', array("class" => "error-form-message")),
    ),
    array("type" => "textarea",
        "label" => $form->labelEx($model, 'block_desk'),
        "input" => $form->textArea($model, 'block_desk', array('rows' => 4)),
        "error" => $form->error($model, 'block_desk'),
    ),
    array("type" => "select",
        "label" => $form->labelEx($model, 'block_status'),
        "input" => $form->dropDownList($model, 'block_status', $model->status),
        "error" => $form->error($model, 'block_status'),
    ),
);

if ($model->block_system) {
    foreach ($locales as $key => $value) {
        $inputs[] = array("type" => "textarea",
            "label" => CHtml::label("HTML - $value", "block_system_html", array()),
            "input" => CHtml::textArea("Block[block_content][$key][block_system_html]",$model->block_content[$key]["block_system_html"], array('rows' => 13, 'cols' => 100,)),
            "error" => "",
        );
        $inputs[] = array("type" => "textarea",
            "label" => CHtml::label("PHP - $value", "block_system_php", array()),
            "input" => CHtml::textArea("Block[block_content][$key][block_system_php]", $model->block_content[$key]["block_system_php"], array('rows' => 13, 'cols' => 100,)),
            "error" => "",
        );
    }
} else {
    $labels = $model->attributeLabels();
    foreach ($locales as $key => $value) {
        $inputs[] = array("type" => "textarea",
            "label" => CHtml::label($labels["block_content"] . " - " . $value, 'block_content'),
            "input" => CHtml::textArea("Block[block_content][$key]", $model->block_content[$key], array('style' => "width:100%;height:400px", 'class' => "tinymce")),
            "error" => "",
        );
    }
}

$this->renderPartial("//block/inputs/rendertypedInputs", array("inputs" => $inputs));
?>
<div class="form-row clearfix">
    <label>  <?php echo Translater::getDictionary()->blockmanager_dependiesFiles ?> </label>
    <div id="files">
        <?php $i = 0;
        foreach ($model->array_dependies as $dep) { ?>
            <div class="block_dependies_div clearfix">
                <div class="dependent-file-location">
                    <?php
                    echo CHtml::hiddenField("block_dependies[$i]", $dep, array("class" => "block_dependies"));
                    echo $dep;
                    ?>
                </div>
                <div rel="<?php echo $dep ?>" class="deldependies">
                    <span>
                        <?php echo Translater::getDictionary()->blockmanager_delFile ?>
                    </span>
                </div>
            </div>
            <?php $i++;
        } ?>
    </div>
    <div id="add_depfile"><span><?php echo Translater::getDictionary()->blockmanager_addFile ?></span></div>
</div>

<?php
foreach ($locales as $key => $value) {
    $this->renderPartial('//block/dropdown_4_checkbox', array('if_delete' => false,
        'dropdown_header_value' => Translater::getDictionary()->blockmanager_onPage . " - " . $value . "<input type='checkbox' id='checkall' onclick='checkitAll(this,\".dropdown-block\")'/>",
        'array_chekbox' => $relation[$key],
    ));
}




if ($model->block_system) {
    $blockButton = array(
        array("name" => Translater::getDictionary()->button_save, "class" => "", "action" => false, "hidden" => false, 'access' => $this->checkAccess("manageSystemBlock"), "onclick" => "$(this).parents('form').submit();"),
        array("name" => Translater::getDictionary()->button_justsave, "class" => "", "hidden" => false, "action" => false, "access" => $this->checkAccess("manageBlock"), "onclick" => "$(this).parents('form').append('<input type=\'hidden\' name=\'just_save\' value=\'true\' />').submit();"),
        array("name" => Translater::getDictionary()->button_cansel, "class" => "red", "action" => $this->createUrl("/blockmanager/blocksystem/"), "hidden" => false, "access" => $this->checkAccess("manageSystemBlock"), "onclick" => false),
    );
} else {
    $blockButton = array(
        array("name" => Translater::getDictionary()->button_save, "class" => "", "action" => false, "hidden" => false, 'access' => $this->checkAccess("manageBlock"), "onclick" => "$(this).parents('form').submit();"),
        array("name" => Translater::getDictionary()->button_justsave, "class" => "", "hidden" => false, "action" => false, "access" => $this->checkAccess("manageBlock"), "onclick" => "$(this).parents('form').append('<input type=\'hidden\' name=\'just_save\' value=\'true\' />').submit();"),
        array("name" => Translater::getDictionary()->button_cansel, "class" => "red", "action" => $this->createUrl("/blockmanager/block/"), "hidden" => false, "access" => $this->checkAccess("manageBlock"), "onclick" => false),
    );
}
$this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));
$this->endWidget();
?>
