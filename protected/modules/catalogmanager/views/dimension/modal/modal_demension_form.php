<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'modal-demension-form',
    'enableAjaxValidation' => false,
        ));
$inputs = array(
    array("type" => "hidden",
        "input" => CHtml::hiddenField("modal", true),
    ),
    array("type" => "hidden",
        "input" => $form->hiddenField($model, 'dimension_group_id',array("id"=>"dimension_group_id")),
    ),
    array("type" => "textfield",
        "label" => $form->labelEx($model, 'dimension_name'),
        "input" => $form->textField($model, 'dimension_name'),
        "error" => $form->error($model, 'dimension_name'),
    ),
    array("type" => "textfield",
        "label" => $form->labelEx($model, 'dimension_cut'),
        "input" => $form->textField($model, 'dimension_cut'),
        "error" => $form->error($model, 'dimension_cut'),
    ),
    array("type" => "textfield",
        "label" => $form->labelEx($model, 'dimension_coefficient'),
        "input" => $form->textField($model, 'dimension_coefficient'),
        "error" => $form->error($model, 'dimension_coefficient'),
    ),
    array("type" => "checkbox",
        "label" => $form->labelEx($model, 'dimension_base'),
        "input" => $form->checkBox($model, 'dimension_base'),
    ),
);
?>
<div class="new-value-block">
    <div class="new-value-form">
        <?php
        $this->renderPartial("//block/inputs/rendertypedInputs", array("inputs" => $inputs));

        $blockButton = array(
            array("name" => Translater::getDictionary()->button_save, "class" => "", "hidden" => false, "action" => false, 'access' => $this->checkAccess("manageDimension"), "onclick" => "saveModalDimension(this)"),
            array("name" => Translater::getDictionary()->button_cansel, "class" => "red", "hidden" => false, "action" => false, "access" => $this->checkAccess("manageDimension"), "onclick" => "canselSaveModalDimension(this)"),
        );
        $this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));
        $this->endWidget();
        ?>
    </div>
</div>
