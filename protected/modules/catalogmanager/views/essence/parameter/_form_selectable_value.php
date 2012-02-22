<div rel="<?php echo $i; ?>" class="selectable_div_parents form-row clearfix">				
    <div class="input-border">
        <?php echo CHtml::hiddenField($inputname."[id]",$model->id) ?>
        <?php echo CHtml::hiddenField($inputname."[temp_id]",$model->getModelID(),array("class"=>"selectable_value_id")) ?>
        <?php echo CHtml::textField($inputname."[value]",$model->value,array("class"=>"selectable_value_value")) ?>
    </div>
    <a class="delete_selectable_value delete-group-parametr" title="<?php echo Translater::getDictionary()->delete ?>"
       onclick="deleteEssenseObject($(this).parent(),<?php echo $model->isNewRecord ? "true" : "false" ?>,'Selectable',<?php echo $model->isNewRecord ? "0" : $model->id ?>)"></a>
</div>	
