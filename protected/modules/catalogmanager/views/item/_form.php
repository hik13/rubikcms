<?php
Yii::app()->clientScript->registerScriptFile(CHtml::asset(Yii::getPathOfAlias('catalogmanager.resourse.js') . '/item.js'), CClientScript::POS_HEAD);
?>
<div class="column-70-percent">
    <?php
   $model->status = array(
    "0" => Translater::getDictionary()->status_notactive,
    "1" => Translater::getDictionary()->status_active
); 
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'content-form',
        'enableAjaxValidation' => false,
            ));
    $inputs = array(
        array("type" => "hidden",
            "input" => $form->hiddenField($model, 'item_parent_id'),
        ),
        array("type" => "textfield",
            "label" => $form->labelEx($model, 'item_name'),
            "input" => $form->textField($model, 'item_name'),
            "error" => $form->error($model, 'item_name'),
        ),
        array("type" => "textfield",
            "label" => $form->labelEx($model, 'item_short_description'),
            "input" => $form->textArea($model, 'item_short_description', array('rows' => 4)),
            "error" => $form->error($model, 'item_short_description'),
        ),
        array("type" => "textfield",
            "label" => $form->labelEx($model, 'item_full_description'),
            "input" => $form->textArea($model, 'item_full_description', array('rows' => 6)),
            "error" => $form->error($model, 'item_full_description'),
        ),
        array("type" => "textfield",
            "label" => $form->labelEx($model, 'item_page_title'),
            "input" => $form->textField($model, 'item_page_title'),
            "error" => $form->error($model, 'item_page_title'),
        ),
        array("type" => "textarea",
            "label" => $form->labelEx($model, 'item_meta_description'),
            "input" => $form->textArea($model, 'item_meta_description', array('rows' => 4)),
            "error" => $form->error($model, 'item_meta_description'),
        ),
        array("type" => "textarea",
            "label" => $form->labelEx($model, 'item_meta_keywords'),
            "input" => $form->textArea($model, 'item_meta_keywords', array('rows' => 4)),
            "error" => $form->error($model, 'item_meta_keywords'),
        ),
        array("type" => "select",
            "label" => $form->labelEx($model, 'item_status_id'),
            "input" => $form->dropDownList($model, 'item_status_id', $model->status),
            "error" => $form->error($model, 'item_status_id', array("class" => "error-form-message")),
        ),
    );
    ?>
    <div class="category-common-form">
        <div class="form-row clearfix">
            <div class="form-row-item">
                <?php echo $form->labelEx($model, 'item_manufacturer_id'); ?>
                <div class="input-border">
                    <?php echo Chtml::textField("manufacturer_name", $model->manufacturer->manufacturer_name, array("id" => "suggest_manufacturer_name")); ?>
                </div>
                <div id="manufacturer_suggest"></div>
            </div>
        </div>
        <?php $this->renderPartial("//block/inputs/rendertypedInputs", array("inputs" => $inputs)); ?>
    </div>
    <?php $essense = Essence::model()->findByPk($model->item_parent_id); ?>

    <?php foreach ($essense->groups as $group) { ?>
        <div class="catalog-parametrs">
            <table>
                <thead>
                    <tr>
                        <td colspan="2">
                            <div class="section-title">
                                <div class="inner-border">
                                    <?php echo $group->group_name ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                </thead> 
                <tbody>
                    <?php
                    foreach ($group->parameters as $parameter) {
                        $this->renderPartial("/item/value/parameter_value", array("parameter" => $parameter, "item_id" => $model->item_id));
                    }
                    ?> 
                </tbody>
            </table>
        </div>
        <?php
    }

    $blockButton = array(
        array("name" => Translater::getDictionary()->button_save, "class" => "", "hidden" => false, "action" => false, 'access' => $this->checkAccess("manageObject"), "onclick" => "$(this).parents('form').submit();"),
        array("name" => Translater::getDictionary()->button_cansel, "class" => "red", "hidden" => false, "action" => $this->createUrl("/catalogmanager/object/index/", array("catalog" => $essense->essence_catalog_id, "typeobject" => "essence", "id" => $essense->essence_id)), "access" => $this->checkAccess("manageObject"), "onclick" => false),
    );
    $this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));
    $this->endWidget();
    ?> 
</div>
<div class="column-30-percent">
    <div class="padding-left-36px">
        <div class="catalog-help-block">
            <h4><?php echo Translater::getDictionary()->catalogmanager_esensyHelpTitle; ?></h4>
            <div><?php echo Translater::getDictionary()->catalogmanager_esensyHelp; ?></div>
        </div>
    </div>
</div>