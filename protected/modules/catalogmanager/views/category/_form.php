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
                "input" => $form->hiddenField($model, 'category_catalog_id'),
            ),
            array("type" => "hidden",
                "input" => $form->hiddenField($model, 'category_parent_id'),
            ),
            array("type" => "textfield",
                "label" => $form->labelEx($model, 'category_name'),
                "input" => $form->textField($model, 'category_name'),
                "error" => $form->error($model, 'category_name'),
            ),
            array("type" => "textfield",
                "label" => $form->labelEx($model, 'category_description'),
                "input" => $form->textField($model, 'category_description'),
                "error" => $form->error($model, 'category_description'),
            ),
            array("type" => "textfield",
                "label" => $form->labelEx($model, 'category_page_title'),
                "input" => $form->textField($model, 'category_page_title'),
                "error" => $form->error($model, 'category_page_title'),
            ),
            array("type" => "textarea",
                "label" => $form->labelEx($model, 'category_meta_description'),
                "input" => $form->textArea($model, 'category_meta_description', array('rows' => 4)),
                "error" => $form->error($model, 'category_meta_description'),
            ),
            array("type" => "textarea",
                "label" => $form->labelEx($model, 'category_meta_keywords'),
                "input" => $form->textArea($model, 'category_meta_keywords', array('rows' => 4)),
                "error" => $form->error($model, 'category_meta_keywords'),
            ),
            array("type" => "checkbox",
                "label" => $form->labelEx($model, 'category_parent_visible'),
                "input" => $form->checkBox($model, 'category_parent_visible'),
            ),
            array("type" => "select",
                "label" => $form->labelEx($model, 'category_status_id'),
                "input" => $form->dropDownList($model, 'category_status_id', $model->status),
                "error" => $form->error($model, 'category_status_id', array("class" => "error-form-message")),
            ),
        );

        $this->renderPartial("//block/inputs/rendertypedInputs", array("inputs" => $inputs));
        $blockButton = array(
            array("name" => Translater::getDictionary()->button_save, "class" => "", "hidden" => false, "action" => false, 'access' => $this->checkAccess("manageObject"), "onclick" => "$(this).parents('form').submit();"),
            array("name" => Translater::getDictionary()->button_cansel, "class" => "red", "hidden" => false, "action" => $this->createUrl("/catalogmanager/object/index/", array("catalog" => $model->category_catalog_id)), "access" => $this->checkAccess("manageObject"), "onclick" => false),
        );
        $this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));

        $this->endWidget();
        ?>
    </div>
</div>
<div class="column-30-percent">
</div>