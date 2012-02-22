<?php Yii::app()->clientScript->registerScriptFile(CHtml::asset(Yii::getPathOfAlias('catalogmanager.resourse.js') . '/category.js'), CClientScript::POS_HEAD); ?>
<?php Yii::app()->clientScript->registerScriptFile(CHtml::asset(Yii::getPathOfAlias('catalogmanager.resourse.js') . '/modal_dimension.js'), CClientScript::POS_HEAD); ?>
<div class="column-70-percent">
    <div class="category-common-form">

        <?php
        $model->status = array(
            "0" => Translater::getDictionary()->status_notactive,
            "1" => Translater::getDictionary()->status_active
        );
        
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'content-form',
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,)
                ));


        $inputs = array(
            array("type" => "hidden",
                "input" => $form->hiddenField($model, 'essence_catalog_id'),
            ),
            array("type" => "hidden",
                "input" => $form->hiddenField($model, 'essence_parent_id'),
            ),
            array("type" => "textfield",
                "label" => $form->labelEx($model, 'essence_name'),
                "input" => $form->textField($model, 'essence_name'),
                "error" => $form->error($model, 'essence_name'),
            ),
            array("type" => "textfield",
                "label" => $form->labelEx($model, 'essence_description'),
                "input" => $form->textField($model, 'essence_description'),
                "error" => $form->error($model, 'essence_description'),
            ),
            array("type" => "textfield",
                "label" => $form->labelEx($model, 'essence_page_title'),
                "input" => $form->textField($model, 'essence_page_title'),
                "error" => $form->error($model, 'essence_page_title'),
            ),
            array("type" => "textarea",
                "label" => $form->labelEx($model, 'essence_meta_description'),
                "input" => $form->textArea($model, 'essence_meta_description', array('rows' => 4)),
                "error" => $form->error($model, 'essence_meta_description'),
            ),
            array("type" => "textarea",
                "label" => $form->labelEx($model, 'essence_meta_keywords'),
                "input" => $form->textArea($model, 'essence_meta_keywords', array('rows' => 4)),
                "error" => $form->error($model, 'essence_meta_keywords'),
            ),
            array("type" => "checkbox",
                "label" => $form->labelEx($model, 'essence_parent_visible'),
                "input" => $form->checkBox($model, 'essence_parent_visible'),
            ),
            array("type" => "select",
                "label" => $form->labelEx($model, 'essence_status_id'),
                "input" => $form->dropDownList($model, 'essence_status_id', $model->status),
                "error" => $form->error($model, 'essence_status_id', array("class" => "error-form-message")),
            ),
        );
        $this->renderPartial("//block/inputs/rendertypedInputs", array("inputs" => $inputs));
        ?>

        <h1><?php echo Translater::getDictionary()->catalogmanager_essenseParameterTitle ?></h1>
        <ul class="sortable_group catalog-list" id="areas">
            <?php
            if (count($model->groups) > 0) {
                foreach ($model->groups as $group) {
                    $this->renderPartial("/essence/group/_form", array("model" => $group, "i" => Group::$i++));
                }
            }
            ?>
        </ul>


        <a id="addGroup" class="catalog-add-new-group">
            <?php echo Translater::getDictionary()->catalogmanager_addNewParametersGroup ?>    
        </a>

        <?php
        $blockButton = array(
            array("name" => Translater::getDictionary()->button_save, "class" => "", "hidden" => false, "action" => false, 'access' => $this->checkAccess("manageObject"), "onclick" => "$(this).parents('form').submit();"),
            array("name" => Translater::getDictionary()->button_cansel, "class" => "red", "hidden" => false, "action" => $this->createUrl("/catalogmanager/object/index/", array("catalog" => $model->essence_catalog_id)), "access" => $this->checkAccess("manageObject"), "onclick" => false),
        );
        $this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));
        $this->endWidget();
        ?>
    </div>

</div>
<div class="column-30-percent">
    <div class="padding-left-36px">
        <div class="catalog-help-block">
            <h4> <?php echo Translater::getDictionary()->catalogmanager_esensyHelpTitle; ?></h4>
            <div>
                <?php echo Translater::getDictionary()->catalogmanager_esensyHelp; ?>      
            </div>
        </div>
    </div>
</div>
