<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'banner-form',
    'method' => 'post',
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,)
        ));
Yii::app()->clientScript->registerScriptFile(CHtml::asset(Yii::app()->getTheme()->getBasePath() . '/js/public/tiny_mce/jquery.tinymce.js', CClientScript::POS_HEAD));
Yii::app()->clientScript->registerScriptFile(CHtml::asset(Yii::app()->getTheme()->getBasePath() . '/js/private/tinymce_init.js', CClientScript::POS_HEAD));
Yii::app()->clientScript->registerScriptFile(CHtml::asset(Yii::app()->getTheme()->getBasePath() . '/js/public/jquery-ui-1.8.16.custom.min.js'), CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCssFile(CHtml::asset(Yii::app()->getTheme()->getBasePath() . '/js/public/css/jquery-ui-1.8.16.custom.css'));
Yii::app()->clientScript->registerScriptFile(CHtml::asset(Yii::getPathOfAlias('blockmanager.resourse.js') . '/block.js'), CClientScript::POS_HEAD);
?> 

<script>
    $(function() {
        $( ".datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });
    });
</script>

<?php
$model->status = array(
    "1" => Translater::getDictionary()->status_active,
    "0" => Translater::getDictionary()->status_notactive
);

$inputs = array(
    array("type" => "textfield",
        "label" => $form->labelEx($model, 'banner_name'),
        "input" => $form->textField($model, 'banner_name'),
        "error" => $form->error($model, 'banner_name', array("class" => "error-form-message")),
    ),
    array("type" => "select",
        "label" => $form->labelEx($model, 'banner_status'),
        "input" => $form->dropDownList($model, 'banner_status', $model->status),
        "error" => $form->error($model, 'banner_status'),
    ),
    array("type" => "select",
        "label" => $form->labelEx($model, 'banner_position_id'),
        "input" => $form->dropDownList($model, 'banner_position_id', $position),
        "error" => $form->error($model, 'banner_name', array("class" => "error-form-message")),
    ),
    array("type" => "textarea",
        "label" => $form->labelEx($model, 'banner_desc'),
        "input" => $form->textArea($model, 'banner_desc', array('rows' => 4)),
        "error" => $form->error($model, 'banner_desc'),
    ),
    array("type" => "textarea",
        "label" => $form->labelEx($model, 'banner_pattern'),
        "input" => $form->textArea($model, 'banner_pattern', array('rows' => 8)),
        "error" => $form->error($model, 'banner_pattern'),
    ),
    
    array("type" => "checkbox",
        "label" => $form->labelEx($model, 'banner_type'),
        "input" => $form->checkBox($model, 'banner_type'),
    ),
    array("type" => "checkbox",
        "label" => $form->labelEx($model, 'banner_priority'),
        "input" => $form->checkBox($model, 'banner_priority'),
    ),
    array("type" => "textfield",
        "label" => $form->labelEx($model, 'banner_date_to'),
        "input" => $form->textField($model, 'banner_date_to', array("class" => "datepicker")),
        "error" => $form->error($model, 'banner_date_to'),
    ),
);

$this->renderPartial("//block/inputs/rendertypedInputs", array("inputs" => $inputs));
if (empty($model->banner_url)) {
    ?>
    <div class="form-row clearfix">
        <?php echo $form->labelEx($model, 'banner_url'); ?>
        <div class="block_dependies_div clearfix" >
            <?php echo CHtml::activeFileField($model, 'banner_url'); ?>
            <?php echo $form->error($model, 'banner_url'); ?>
        </div>
    </div>
<?php } else { ?>

    <div id="file-form" class="form-row clearfix" style="display:none">
        <?php echo $form->labelEx($model, 'banner_url'); ?>
        <div class="block_dependies_div clearfix" >
            <?php echo CHtml::activeFileField($model, 'banner_url'); ?>
            <?php echo $form->error($model, 'banner_url'); ?>
        </div>
    </div>

    <div class="block_dependies_div clearfix">
        <div class="dependent-file-location">
            <?php echo CHtml::hiddenField("banner_delete", ''); ?>
            <?php echo $model->banner_url ?>
        </div>
        <div rel="<?php echo $model->banner_url ?>" class="delbanner">
            <span>
                <?php echo Translater::getDictionary()->blockmanager_delFile ?>
            </span></div>
    </div>
    <?php
}
foreach ($locales as $key => $value) {
    $this->renderPartial('//block/dropdown_4_checkbox', array('if_delete' => false,
        'dropdown_header_value' => Translater::getDictionary()->blockmanager_onPage . " - " . $value . "<input type='checkbox' id='checkall' onclick='checkitAll(this,\".dropdown-block\")'/>",
        'array_chekbox' => $relation[$key],
    ));
}

$blockButton = array(
    array("name" => Translater::getDictionary()->button_save, "class" => "", "action" => false, "hidden" => false, 'access' => $this->checkAccess("manageBanner"), "onclick" => "$(this).parents('form').submit();"),
    array("name" => Translater::getDictionary()->button_justsave, "class" => "", "hidden" => false, "action" => false, "access" => $this->checkAccess("manageBanner"), "onclick" => "$(this).parents('form').append('<input type=\'hidden\' name=\'just_save\' value=\'true\' />').submit();"),
    array("name" => Translater::getDictionary()->button_cansel, "class" => "red", "action" => $this->createUrl("/blockmanager/banner/"), "hidden" => false, "access" => $this->checkAccess("manageBanner"), "onclick" => false),
);
$this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));
$this->endWidget();
?>