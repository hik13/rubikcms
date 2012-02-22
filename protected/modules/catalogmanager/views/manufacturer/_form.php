<?php
$form = $this->beginWidget('CActiveForm', array(
            'id' => 'content-form',
            'enableAjaxValidation' => false,
        ));
?>

<?php echo $form->hiddenField($model, 'manufacturer_id'); ?>
<?php // echo $form->errorSummary($model); ?>






<div class="form-row clearfix">
    <div class="form-row-item">
        <?php echo $form->labelEx($model, 'manufacturer_name'); ?>
        <div class="input-border">
            <?php echo $form->textField($model, 'manufacturer_name', array('size' => 60, 'maxlength' => 200)); ?>
        </div>
        <?php echo $form->error($model, 'item_name'); ?>
    </div>        
</div>


<?php
$blockButton = array(
    array("name" => Translater::getDictionary()->button_save, "class" => "", "hidden" => false, "action" =>false, 'access' => $this->checkAccess("manageManufacturer"), "onclick" => "$(this).parents('form').submit();"),
    array("name" => Translater::getDictionary()->button_delete, "class" => "red", "hidden" => false, "action" => $this->createUrl("/catalogmanager/manufacturer/delete/", array("id" => $model->manufacturer_id)), "access" => $this->checkAccess("manageManufacturer")&&$model->isNewRecord, "onclick" => false),
    array("name" => Translater::getDictionary()->button_cansel, "class" => "red", "hidden" => false, "action" =>$this->createUrl("/catalogmanager/manufacturer/"), "access" => $this->checkAccess("manageManufacturer"), "onclick" => false),
        );
$this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));


$this->endWidget();
?>
